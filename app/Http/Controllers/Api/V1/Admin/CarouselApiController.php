<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;
use App\Http\Resources\Admin\CarouselResource;
use App\Models\Carousel;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarouselApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('carousel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarouselResource(Carousel::all());
    }

    public function store(StoreCarouselRequest $request)
    {
        $carousel = Carousel::create($request->validated());

        if ($request->input('carousel_gambar', false)) {
            $carousel->addMedia(storage_path('tmp/uploads/' . basename($request->input('carousel_gambar'))))->toMediaCollection('carousel_gambar');
        }

        return (new CarouselResource($carousel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Carousel $carousel)
    {
        abort_if(Gate::denies('carousel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarouselResource($carousel);
    }

    public function update(UpdateCarouselRequest $request, Carousel $carousel)
    {
        $carousel->update($request->validated());

        if ($request->input('carousel_gambar', false)) {
            if (!$carousel->carousel_gambar || $request->input('carousel_gambar') !== $carousel->carousel_gambar->file_name) {
                if ($carousel->carousel_gambar) {
                    $carousel->carousel_gambar->delete();
                }
                $carousel->addMedia(storage_path('tmp/uploads/' . basename($request->input('carousel_gambar'))))->toMediaCollection('carousel_gambar');
            }
        } elseif ($carousel->carousel_gambar) {
            $carousel->carousel_gambar->delete();
        }

        return (new CarouselResource($carousel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Carousel $carousel)
    {
        abort_if(Gate::denies('carousel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carousel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

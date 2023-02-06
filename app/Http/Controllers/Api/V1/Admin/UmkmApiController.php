<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Http\Resources\Admin\UmkmResource;
use App\Models\Umkm;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UmkmApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('umkm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UmkmResource(Umkm::with(['pemilik', 'kategori'])->get());
    }

    public function store(StoreUmkmRequest $request)
    {
        $umkm = Umkm::create($request->validated());

        foreach ($request->input('umkm_carousel', []) as $file) {
            $umkm->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('umkm_carousel');
        }

        return (new UmkmResource($umkm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UmkmResource($umkm->load(['pemilik', 'kategori']));
    }

    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        $umkm->update($request->validated());

        if (count($umkm->umkm_carousel) > 0) {
            foreach ($umkm->umkm_carousel as $media) {
                if (!in_array($media->file_name, $request->input('umkm_carousel', []))) {
                    $media->delete();
                }
            }
        }
        $media = $umkm->umkm_carousel->pluck('file_name')->toArray();
        foreach ($request->input('umkm_carousel', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $umkm->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('umkm_carousel');
            }
        }

        return (new UmkmResource($umkm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $umkm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

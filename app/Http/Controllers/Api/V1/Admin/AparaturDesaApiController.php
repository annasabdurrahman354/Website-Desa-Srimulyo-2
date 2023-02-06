<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreAparaturDesaRequest;
use App\Http\Requests\UpdateAparaturDesaRequest;
use App\Http\Resources\Admin\AparaturDesaResource;
use App\Models\AparaturDesa;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AparaturDesaApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('aparatur_desa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AparaturDesaResource(AparaturDesa::all());
    }

    public function store(StoreAparaturDesaRequest $request)
    {
        $aparaturDesa = AparaturDesa::create($request->validated());

        if ($request->input('aparatur_desa_foto', false)) {
            $aparaturDesa->addMedia(storage_path('tmp/uploads/' . basename($request->input('aparatur_desa_foto'))))->toMediaCollection('aparatur_desa_foto');
        }

        return (new AparaturDesaResource($aparaturDesa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AparaturDesa $aparaturDesa)
    {
        abort_if(Gate::denies('aparatur_desa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AparaturDesaResource($aparaturDesa);
    }

    public function update(UpdateAparaturDesaRequest $request, AparaturDesa $aparaturDesa)
    {
        $aparaturDesa->update($request->validated());

        if ($request->input('aparatur_desa_foto', false)) {
            if (!$aparaturDesa->aparatur_desa_foto || $request->input('aparatur_desa_foto') !== $aparaturDesa->aparatur_desa_foto->file_name) {
                if ($aparaturDesa->aparatur_desa_foto) {
                    $aparaturDesa->aparatur_desa_foto->delete();
                }
                $aparaturDesa->addMedia(storage_path('tmp/uploads/' . basename($request->input('aparatur_desa_foto'))))->toMediaCollection('aparatur_desa_foto');
            }
        } elseif ($aparaturDesa->aparatur_desa_foto) {
            $aparaturDesa->aparatur_desa_foto->delete();
        }

        return (new AparaturDesaResource($aparaturDesa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AparaturDesa $aparaturDesa)
    {
        abort_if(Gate::denies('aparatur_desa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aparaturDesa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

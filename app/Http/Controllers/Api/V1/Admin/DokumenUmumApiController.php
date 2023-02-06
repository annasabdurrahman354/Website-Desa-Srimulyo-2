<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreDokumenUmumRequest;
use App\Http\Requests\UpdateDokumenUmumRequest;
use App\Http\Resources\Admin\DokumenUmumResource;
use App\Models\DokumenUmum;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DokumenUmumApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('dokumen_umum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DokumenUmumResource(DokumenUmum::all());
    }

    public function store(StoreDokumenUmumRequest $request)
    {
        $dokumenUmum = DokumenUmum::create($request->validated());

        if ($request->input('dokumen_umum_berkas_dokumen', false)) {
            $dokumenUmum->addMedia(storage_path('tmp/uploads/' . basename($request->input('dokumen_umum_berkas_dokumen'))))->toMediaCollection('dokumen_umum_berkas_dokumen');
        }

        return (new DokumenUmumResource($dokumenUmum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DokumenUmum $dokumenUmum)
    {
        abort_if(Gate::denies('dokumen_umum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DokumenUmumResource($dokumenUmum);
    }

    public function update(UpdateDokumenUmumRequest $request, DokumenUmum $dokumenUmum)
    {
        $dokumenUmum->update($request->validated());

        if ($request->input('dokumen_umum_berkas_dokumen', false)) {
            if (!$dokumenUmum->dokumen_umum_berkas_dokumen || $request->input('dokumen_umum_berkas_dokumen') !== $dokumenUmum->dokumen_umum_berkas_dokumen->file_name) {
                if ($dokumenUmum->dokumen_umum_berkas_dokumen) {
                    $dokumenUmum->dokumen_umum_berkas_dokumen->delete();
                }
                $dokumenUmum->addMedia(storage_path('tmp/uploads/' . basename($request->input('dokumen_umum_berkas_dokumen'))))->toMediaCollection('dokumen_umum_berkas_dokumen');
            }
        } elseif ($dokumenUmum->dokumen_umum_berkas_dokumen) {
            $dokumenUmum->dokumen_umum_berkas_dokumen->delete();
        }

        return (new DokumenUmumResource($dokumenUmum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DokumenUmum $dokumenUmum)
    {
        abort_if(Gate::denies('dokumen_umum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dokumenUmum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreBerkasPelayananRequest;
use App\Http\Requests\UpdateBerkasPelayananRequest;
use App\Http\Resources\Admin\BerkasPelayananResource;
use App\Models\BerkasPelayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BerkasPelayananApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('berkas_pelayanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BerkasPelayananResource(BerkasPelayanan::with(['pelayanan', 'syaratLayanan'])->get());
    }

    public function store(StoreBerkasPelayananRequest $request)
    {
        $berkasPelayanan = BerkasPelayanan::create($request->validated());

        if ($request->input('berkas_pelayanan_berkas_syarat', false)) {
            $berkasPelayanan->addMedia(storage_path('tmp/uploads/' . basename($request->input('berkas_pelayanan_berkas_syarat'))))->toMediaCollection('berkas_pelayanan_berkas_syarat');
        }

        return (new BerkasPelayananResource($berkasPelayanan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BerkasPelayanan $berkasPelayanan)
    {
        abort_if(Gate::denies('berkas_pelayanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BerkasPelayananResource($berkasPelayanan->load(['pelayanan', 'syaratLayanan']));
    }

    public function update(UpdateBerkasPelayananRequest $request, BerkasPelayanan $berkasPelayanan)
    {
        $berkasPelayanan->update($request->validated());

        if ($request->input('berkas_pelayanan_berkas_syarat', false)) {
            if (!$berkasPelayanan->berkas_pelayanan_berkas_syarat || $request->input('berkas_pelayanan_berkas_syarat') !== $berkasPelayanan->berkas_pelayanan_berkas_syarat->file_name) {
                if ($berkasPelayanan->berkas_pelayanan_berkas_syarat) {
                    $berkasPelayanan->berkas_pelayanan_berkas_syarat->delete();
                }
                $berkasPelayanan->addMedia(storage_path('tmp/uploads/' . basename($request->input('berkas_pelayanan_berkas_syarat'))))->toMediaCollection('berkas_pelayanan_berkas_syarat');
            }
        } elseif ($berkasPelayanan->berkas_pelayanan_berkas_syarat) {
            $berkasPelayanan->berkas_pelayanan_berkas_syarat->delete();
        }

        return (new BerkasPelayananResource($berkasPelayanan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BerkasPelayanan $berkasPelayanan)
    {
        abort_if(Gate::denies('berkas_pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasPelayanan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

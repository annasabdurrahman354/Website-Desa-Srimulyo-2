<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreSyaratLayananRequest;
use App\Http\Requests\UpdateSyaratLayananRequest;
use App\Http\Resources\Admin\SyaratLayananResource;
use App\Models\SyaratLayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SyaratLayananApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('syarat_layanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SyaratLayananResource(SyaratLayanan::all());
    }

    public function store(StoreSyaratLayananRequest $request)
    {
        $syaratLayanan = SyaratLayanan::create($request->validated());

        if ($request->input('syarat_layanan_berkas_formulir', false)) {
            $syaratLayanan->addMedia(storage_path('tmp/uploads/' . basename($request->input('syarat_layanan_berkas_formulir'))))->toMediaCollection('syarat_layanan_berkas_formulir');
        }

        return (new SyaratLayananResource($syaratLayanan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SyaratLayanan $syaratLayanan)
    {
        abort_if(Gate::denies('syarat_layanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SyaratLayananResource($syaratLayanan);
    }

    public function update(UpdateSyaratLayananRequest $request, SyaratLayanan $syaratLayanan)
    {
        $syaratLayanan->update($request->validated());

        if ($request->input('syarat_layanan_berkas_formulir', false)) {
            if (!$syaratLayanan->syarat_layanan_berkas_formulir || $request->input('syarat_layanan_berkas_formulir') !== $syaratLayanan->syarat_layanan_berkas_formulir->file_name) {
                if ($syaratLayanan->syarat_layanan_berkas_formulir) {
                    $syaratLayanan->syarat_layanan_berkas_formulir->delete();
                }
                $syaratLayanan->addMedia(storage_path('tmp/uploads/' . basename($request->input('syarat_layanan_berkas_formulir'))))->toMediaCollection('syarat_layanan_berkas_formulir');
            }
        } elseif ($syaratLayanan->syarat_layanan_berkas_formulir) {
            $syaratLayanan->syarat_layanan_berkas_formulir->delete();
        }

        return (new SyaratLayananResource($syaratLayanan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SyaratLayanan $syaratLayanan)
    {
        abort_if(Gate::denies('syarat_layanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $syaratLayanan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

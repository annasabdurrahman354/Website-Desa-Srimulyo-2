<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreProdukHukumRequest;
use App\Http\Requests\UpdateProdukHukumRequest;
use App\Http\Resources\Admin\ProdukHukumResource;
use App\Models\ProdukHukum;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdukHukumApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('produk_hukum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProdukHukumResource(ProdukHukum::all());
    }

    public function store(StoreProdukHukumRequest $request)
    {
        $produkHukum = ProdukHukum::create($request->validated());

        if ($request->input('produk_hukum_berkas_dokumen', false)) {
            $produkHukum->addMedia(storage_path('tmp/uploads/' . basename($request->input('produk_hukum_berkas_dokumen'))))->toMediaCollection('produk_hukum_berkas_dokumen');
        }

        return (new ProdukHukumResource($produkHukum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProdukHukum $produkHukum)
    {
        abort_if(Gate::denies('produk_hukum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProdukHukumResource($produkHukum);
    }

    public function update(UpdateProdukHukumRequest $request, ProdukHukum $produkHukum)
    {
        $produkHukum->update($request->validated());

        if ($request->input('produk_hukum_berkas_dokumen', false)) {
            if (!$produkHukum->produk_hukum_berkas_dokumen || $request->input('produk_hukum_berkas_dokumen') !== $produkHukum->produk_hukum_berkas_dokumen->file_name) {
                if ($produkHukum->produk_hukum_berkas_dokumen) {
                    $produkHukum->produk_hukum_berkas_dokumen->delete();
                }
                $produkHukum->addMedia(storage_path('tmp/uploads/' . basename($request->input('produk_hukum_berkas_dokumen'))))->toMediaCollection('produk_hukum_berkas_dokumen');
            }
        } elseif ($produkHukum->produk_hukum_berkas_dokumen) {
            $produkHukum->produk_hukum_berkas_dokumen->delete();
        }

        return (new ProdukHukumResource($produkHukum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProdukHukum $produkHukum)
    {
        abort_if(Gate::denies('produk_hukum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produkHukum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

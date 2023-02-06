<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Http\Resources\Admin\ProdukResource;
use App\Models\Produk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdukApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('produk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProdukResource(Produk::with(['umkm', 'satuan', 'kategori'])->get());
    }

    public function store(StoreProdukRequest $request)
    {
        $produk = Produk::create($request->validated());

        if ($request->input('produk_foto', false)) {
            $produk->addMedia(storage_path('tmp/uploads/' . basename($request->input('produk_foto'))))->toMediaCollection('produk_foto');
        }

        return (new ProdukResource($produk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Produk $produk)
    {
        abort_if(Gate::denies('produk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProdukResource($produk->load(['umkm', 'satuan', 'kategori']));
    }

    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $produk->update($request->validated());

        if ($request->input('produk_foto', false)) {
            if (!$produk->produk_foto || $request->input('produk_foto') !== $produk->produk_foto->file_name) {
                if ($produk->produk_foto) {
                    $produk->produk_foto->delete();
                }
                $produk->addMedia(storage_path('tmp/uploads/' . basename($request->input('produk_foto'))))->toMediaCollection('produk_foto');
            }
        } elseif ($produk->produk_foto) {
            $produk->produk_foto->delete();
        }

        return (new ProdukResource($produk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Produk $produk)
    {
        abort_if(Gate::denies('produk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

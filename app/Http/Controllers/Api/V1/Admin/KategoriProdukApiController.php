<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriProdukRequest;
use App\Http\Requests\UpdateKategoriProdukRequest;
use App\Http\Resources\Admin\KategoriProdukResource;
use App\Models\KategoriProduk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriProdukApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_produk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategoriProdukResource(KategoriProduk::all());
    }

    public function store(StoreKategoriProdukRequest $request)
    {
        $kategoriProduk = KategoriProduk::create($request->validated());

        return (new KategoriProdukResource($kategoriProduk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KategoriProduk $kategoriProduk)
    {
        abort_if(Gate::denies('kategori_produk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategoriProdukResource($kategoriProduk);
    }

    public function update(UpdateKategoriProdukRequest $request, KategoriProduk $kategoriProduk)
    {
        $kategoriProduk->update($request->validated());

        return (new KategoriProdukResource($kategoriProduk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KategoriProduk $kategoriProduk)
    {
        abort_if(Gate::denies('kategori_produk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriProduk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

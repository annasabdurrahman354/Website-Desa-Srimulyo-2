<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSatuanProdukRequest;
use App\Http\Requests\UpdateSatuanProdukRequest;
use App\Http\Resources\Admin\SatuanProdukResource;
use App\Models\SatuanProduk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SatuanProdukApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('satuan_produk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SatuanProdukResource(SatuanProduk::all());
    }

    public function store(StoreSatuanProdukRequest $request)
    {
        $satuanProduk = SatuanProduk::create($request->validated());

        return (new SatuanProdukResource($satuanProduk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SatuanProduk $satuanProduk)
    {
        abort_if(Gate::denies('satuan_produk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SatuanProdukResource($satuanProduk);
    }

    public function update(UpdateSatuanProdukRequest $request, SatuanProduk $satuanProduk)
    {
        $satuanProduk->update($request->validated());

        return (new SatuanProdukResource($satuanProduk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SatuanProduk $satuanProduk)
    {
        abort_if(Gate::denies('satuan_produk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satuanProduk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

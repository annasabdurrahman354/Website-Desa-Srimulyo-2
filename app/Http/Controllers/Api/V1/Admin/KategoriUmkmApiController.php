<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriUmkmRequest;
use App\Http\Requests\UpdateKategoriUmkmRequest;
use App\Http\Resources\Admin\KategoriUmkmResource;
use App\Models\KategoriUmkm;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriUmkmApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_umkm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategoriUmkmResource(KategoriUmkm::all());
    }

    public function store(StoreKategoriUmkmRequest $request)
    {
        $kategoriUmkm = KategoriUmkm::create($request->validated());

        return (new KategoriUmkmResource($kategoriUmkm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KategoriUmkm $kategoriUmkm)
    {
        abort_if(Gate::denies('kategori_umkm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategoriUmkmResource($kategoriUmkm);
    }

    public function update(UpdateKategoriUmkmRequest $request, KategoriUmkm $kategoriUmkm)
    {
        $kategoriUmkm->update($request->validated());

        return (new KategoriUmkmResource($kategoriUmkm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KategoriUmkm $kategoriUmkm)
    {
        abort_if(Gate::denies('kategori_umkm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategoriUmkm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKotaRequest;
use App\Http\Requests\UpdateKotaRequest;
use App\Http\Resources\Admin\KotaResource;
use App\Models\Kota;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KotaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kota_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KotaResource(Kota::with(['provinsi'])->get());
    }

    public function store(StoreKotaRequest $request)
    {
        $kota = Kota::create($request->validated());

        return (new KotaResource($kota))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Kota $kota)
    {
        abort_if(Gate::denies('kota_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KotaResource($kota->load(['provinsi']));
    }

    public function update(UpdateKotaRequest $request, Kota $kota)
    {
        $kota->update($request->validated());

        return (new KotaResource($kota))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Kota $kota)
    {
        abort_if(Gate::denies('kota_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kota->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

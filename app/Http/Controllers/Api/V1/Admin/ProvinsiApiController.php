<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProvinsiRequest;
use App\Http\Requests\UpdateProvinsiRequest;
use App\Http\Resources\Admin\ProvinsiResource;
use App\Models\Provinsi;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProvinsiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('provinsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProvinsiResource(Provinsi::all());
    }

    public function store(StoreProvinsiRequest $request)
    {
        $provinsi = Provinsi::create($request->validated());

        return (new ProvinsiResource($provinsi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Provinsi $provinsi)
    {
        abort_if(Gate::denies('provinsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProvinsiResource($provinsi);
    }

    public function update(UpdateProvinsiRequest $request, Provinsi $provinsi)
    {
        $provinsi->update($request->validated());

        return (new ProvinsiResource($provinsi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Provinsi $provinsi)
    {
        abort_if(Gate::denies('provinsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinsi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

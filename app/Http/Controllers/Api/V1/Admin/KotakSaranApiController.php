<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKotakSaranRequest;
use App\Http\Requests\UpdateKotakSaranRequest;
use App\Http\Resources\Admin\KotakSaranResource;
use App\Models\KotakSaran;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KotakSaranApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kotak_saran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KotakSaranResource(KotakSaran::all());
    }

    public function store(StoreKotakSaranRequest $request)
    {
        $kotakSaran = KotakSaran::create($request->validated());

        return (new KotakSaranResource($kotakSaran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KotakSaran $kotakSaran)
    {
        abort_if(Gate::denies('kotak_saran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KotakSaranResource($kotakSaran);
    }

    public function update(UpdateKotakSaranRequest $request, KotakSaran $kotakSaran)
    {
        $kotakSaran->update($request->validated());

        return (new KotakSaranResource($kotakSaran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KotakSaran $kotakSaran)
    {
        abort_if(Gate::denies('kotak_saran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kotakSaran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

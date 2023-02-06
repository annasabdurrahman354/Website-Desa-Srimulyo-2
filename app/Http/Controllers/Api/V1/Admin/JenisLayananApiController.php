<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJenisLayananRequest;
use App\Http\Requests\UpdateJenisLayananRequest;
use App\Http\Resources\Admin\JenisLayananResource;
use App\Models\JenisLayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenisLayananApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_layanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisLayananResource(JenisLayanan::with(['syaratLayanan'])->get());
    }

    public function store(StoreJenisLayananRequest $request)
    {
        $jenisLayanan = JenisLayanan::create($request->validated());
        $jenisLayanan->syaratLayanan()->sync($request->input('syaratLayanan', []));

        return (new JenisLayananResource($jenisLayanan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JenisLayanan $jenisLayanan)
    {
        abort_if(Gate::denies('jenis_layanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisLayananResource($jenisLayanan->load(['syaratLayanan']));
    }

    public function update(UpdateJenisLayananRequest $request, JenisLayanan $jenisLayanan)
    {
        $jenisLayanan->update($request->validated());
        $jenisLayanan->syaratLayanan()->sync($request->input('syaratLayanan', []));

        return (new JenisLayananResource($jenisLayanan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JenisLayanan $jenisLayanan)
    {
        abort_if(Gate::denies('jenis_layanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisLayanan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

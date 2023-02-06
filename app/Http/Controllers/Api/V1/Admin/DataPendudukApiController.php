<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreDataPendudukRequest;
use App\Http\Requests\UpdateDataPendudukRequest;
use App\Http\Resources\Admin\DataPendudukResource;
use App\Models\DataPenduduk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DataPendudukApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('data_penduduk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataPendudukResource(DataPenduduk::all());
    }

    public function store(StoreDataPendudukRequest $request)
    {
        $dataPenduduk = DataPenduduk::create($request->validated());

        if ($request->input('data_penduduk_berkas_data', false)) {
            $dataPenduduk->addMedia(storage_path('tmp/uploads/' . basename($request->input('data_penduduk_berkas_data'))))->toMediaCollection('data_penduduk_berkas_data');
        }

        return (new DataPendudukResource($dataPenduduk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataPenduduk $dataPenduduk)
    {
        abort_if(Gate::denies('data_penduduk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataPendudukResource($dataPenduduk);
    }

    public function update(UpdateDataPendudukRequest $request, DataPenduduk $dataPenduduk)
    {
        $dataPenduduk->update($request->validated());

        if ($request->input('data_penduduk_berkas_data', false)) {
            if (!$dataPenduduk->data_penduduk_berkas_data || $request->input('data_penduduk_berkas_data') !== $dataPenduduk->data_penduduk_berkas_data->file_name) {
                if ($dataPenduduk->data_penduduk_berkas_data) {
                    $dataPenduduk->data_penduduk_berkas_data->delete();
                }
                $dataPenduduk->addMedia(storage_path('tmp/uploads/' . basename($request->input('data_penduduk_berkas_data'))))->toMediaCollection('data_penduduk_berkas_data');
            }
        } elseif ($dataPenduduk->data_penduduk_berkas_data) {
            $dataPenduduk->data_penduduk_berkas_data->delete();
        }

        return (new DataPendudukResource($dataPenduduk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataPenduduk $dataPenduduk)
    {
        abort_if(Gate::denies('data_penduduk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataPenduduk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

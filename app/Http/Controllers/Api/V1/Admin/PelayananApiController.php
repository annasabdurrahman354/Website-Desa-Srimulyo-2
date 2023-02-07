<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StorePelayananRequest;
use App\Http\Requests\UpdatePelayananRequest;
use App\Http\Resources\Admin\PelayananResource;
use App\Models\Pelayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PelayananApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('pelayanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PelayananResource(Pelayanan::with(['pemohon', 'jenisLayanan'])->get());
    }

    public function store(StorePelayananRequest $request)
    {
        $pelayanan = Pelayanan::create($request->validated());

        foreach ($request->input('pelayanan_berkas_hasil', []) as $file) {
            $pelayanan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pelayanan_berkas_hasil');
        }

        return (new PelayananResource($pelayanan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pelayanan $pelayanan)
    {
        abort_if(Gate::denies('pelayanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PelayananResource($pelayanan->load(['pemohon', 'jenisLayanan']));
    }

    public function update(UpdatePelayananRequest $request, Pelayanan $pelayanan)
    {
        $pelayanan->update($request->validated());

        if (count($pelayanan->pelayanan_berkas_hasil) > 0) {
            foreach ($pelayanan->pelayanan_berkas_hasil as $media) {
                if (!in_array($media->file_name, $request->input('pelayanan_berkas_hasil', []))) {
                    $media->delete();
                }
            }
        }
        $media = $pelayanan->pelayanan_berkas_hasil->pluck('file_name')->toArray();
        foreach ($request->input('pelayanan_berkas_hasil', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $pelayanan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pelayanan_berkas_hasil');
            }
        }

        return (new PelayananResource($pelayanan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pelayanan $pelayanan)
    {
        abort_if(Gate::denies('pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelayanan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

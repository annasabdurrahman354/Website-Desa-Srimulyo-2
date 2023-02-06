<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use App\Http\Resources\Admin\ArtikelResource;
use App\Models\Artikel;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtikelApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('artikel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArtikelResource(Artikel::with(['penulis', 'kategori'])->get());
    }

    public function store(StoreArtikelRequest $request)
    {
        $artikel = Artikel::create($request->validated());

        if ($request->input('artikel_gambar', false)) {
            $artikel->addMedia(storage_path('tmp/uploads/' . basename($request->input('artikel_gambar'))))->toMediaCollection('artikel_gambar');
        }

        return (new ArtikelResource($artikel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArtikelResource($artikel->load(['penulis', 'kategori']));
    }

    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $artikel->update($request->validated());

        if ($request->input('artikel_gambar', false)) {
            if (!$artikel->artikel_gambar || $request->input('artikel_gambar') !== $artikel->artikel_gambar->file_name) {
                if ($artikel->artikel_gambar) {
                    $artikel->artikel_gambar->delete();
                }
                $artikel->addMedia(storage_path('tmp/uploads/' . basename($request->input('artikel_gambar'))))->toMediaCollection('artikel_gambar');
            }
        } elseif ($artikel->artikel_gambar) {
            $artikel->artikel_gambar->delete();
        }

        return (new ArtikelResource($artikel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artikel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

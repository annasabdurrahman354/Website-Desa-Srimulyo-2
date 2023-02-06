<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtikelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('artikel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artikel.index');
    }

    public function create()
    {
        abort_if(Gate::denies('artikel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artikel.create');
    }

    public function edit(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artikel.edit', compact('artikel'));
    }

    public function show(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artikel->load('penulis', 'kategori');

        return view('admin.artikel.show', compact('artikel'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['artikel_create', 'artikel_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }
        if (request()->has('max_width') || request()->has('max_height')) {
            $this->validate(request(), [
                'file' => sprintf(
                'image|dimensions:max_width=%s,max_height=%s',
                request()->input('max_width', 100000),
                request()->input('max_height', 100000)
                ),
            ]);
        }

        $model                     = new Artikel();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

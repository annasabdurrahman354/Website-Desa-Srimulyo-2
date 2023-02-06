<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenUmum;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DokumenUmumController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dokumen_umum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dokumen-umum.index');
    }

    public function create()
    {
        abort_if(Gate::denies('dokumen_umum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dokumen-umum.create');
    }

    public function edit(DokumenUmum $dokumenUmum)
    {
        abort_if(Gate::denies('dokumen_umum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dokumen-umum.edit', compact('dokumenUmum'));
    }

    public function show(DokumenUmum $dokumenUmum)
    {
        abort_if(Gate::denies('dokumen_umum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dokumen-umum.show', compact('dokumenUmum'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['dokumen_umum_create', 'dokumen_umum_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new DokumenUmum();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

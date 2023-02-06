<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PelayananController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pelayanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pelayanan.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pelayanan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pelayanan.create');
    }

    public function edit(Pelayanan $pelayanan)
    {
        abort_if(Gate::denies('pelayanan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pelayanan.edit', compact('pelayanan'));
    }

    public function show(Pelayanan $pelayanan)
    {
        abort_if(Gate::denies('pelayanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelayanan->load('pemohon', 'jenisLayanan');

        return view('admin.pelayanan.show', compact('pelayanan'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['pelayanan_create', 'pelayanan_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new Pelayanan();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

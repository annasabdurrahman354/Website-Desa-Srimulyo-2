<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerkasPelayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BerkasPelayananController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('berkas_pelayanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.berkas-pelayanan.index');
    }

    public function create()
    {
        abort_if(Gate::denies('berkas_pelayanan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.berkas-pelayanan.create');
    }

    public function edit(BerkasPelayanan $berkasPelayanan)
    {
        abort_if(Gate::denies('berkas_pelayanan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.berkas-pelayanan.edit', compact('berkasPelayanan'));
    }

    public function show(BerkasPelayanan $berkasPelayanan)
    {
        abort_if(Gate::denies('berkas_pelayanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasPelayanan->load('pelayanan', 'syaratLayanan');

        return view('admin.berkas-pelayanan.show', compact('berkasPelayanan'));
    }

    public function storeMedia(Request $request)
    {
        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new BerkasPelayanan();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UmkmController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('umkm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.umkm.index');
    }

    public function create()
    {
        abort_if(Gate::denies('umkm_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.umkm.create');
    }

    public function edit(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.umkm.edit', compact('umkm'));
    }

    public function show(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $umkm->load('pemilik', 'kategori');

        return view('admin.umkm.show', compact('umkm'));
    }

    public function storeMedia(Request $request)
    {
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

        $model                     = new Umkm();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

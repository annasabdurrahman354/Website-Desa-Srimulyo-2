<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SyaratLayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SyaratLayananController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('syarat_layanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.syarat-layanan.index');
    }

    public function create()
    {
        abort_if(Gate::denies('syarat_layanan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.syarat-layanan.create');
    }

    public function edit(SyaratLayanan $syaratLayanan)
    {
        abort_if(Gate::denies('syarat_layanan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.syarat-layanan.edit', compact('syaratLayanan'));
    }

    public function show(SyaratLayanan $syaratLayanan)
    {
        abort_if(Gate::denies('syarat_layanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.syarat-layanan.show', compact('syaratLayanan'));
    }

    public function storeMedia(Request $request)
    {
        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new SyaratLayanan();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

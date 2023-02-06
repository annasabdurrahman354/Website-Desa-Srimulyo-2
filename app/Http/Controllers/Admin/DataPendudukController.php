<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DataPendudukController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('data_penduduk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data-penduduk.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_penduduk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data-penduduk.create');
    }

    public function edit(DataPenduduk $dataPenduduk)
    {
        abort_if(Gate::denies('data_penduduk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data-penduduk.edit', compact('dataPenduduk'));
    }

    public function show(DataPenduduk $dataPenduduk)
    {
        abort_if(Gate::denies('data_penduduk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data-penduduk.show', compact('dataPenduduk'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['data_penduduk_create', 'data_penduduk_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new DataPenduduk();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

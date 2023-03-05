<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdukController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('produk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk.index');
    }

    public function create()
    {
        abort_if(Gate::denies('produk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk.create');
    }

    public function edit(Produk $produk)
    {
        abort_if(Gate::denies('produk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk.edit', compact('produk'));
    }

    public function show(Produk $produk)
    {
        abort_if(Gate::denies('produk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produk->load('umkm', 'satuan', 'kategori');

        return view('admin.produk.show', compact('produk'));
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

        $model                     = new Produk();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

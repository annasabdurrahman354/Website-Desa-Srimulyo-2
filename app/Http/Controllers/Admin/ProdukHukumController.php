<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukHukum;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdukHukumController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('produk_hukum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk-hukum.index');
    }

    public function create()
    {
        abort_if(Gate::denies('produk_hukum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk-hukum.create');
    }

    public function edit(ProdukHukum $produkHukum)
    {
        abort_if(Gate::denies('produk_hukum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk-hukum.edit', compact('produkHukum'));
    }

    public function show(ProdukHukum $produkHukum)
    {
        abort_if(Gate::denies('produk_hukum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.produk-hukum.show', compact('produkHukum'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['produk_hukum_create', 'produk_hukum_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new ProdukHukum();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}

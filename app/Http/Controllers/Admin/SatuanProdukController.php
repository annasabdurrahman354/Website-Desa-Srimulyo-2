<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SatuanProduk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SatuanProdukController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('satuan_produk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuan-produk.index');
    }

    public function create()
    {
        abort_if(Gate::denies('satuan_produk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuan-produk.create');
    }

    public function edit(SatuanProduk $satuanProduk)
    {
        abort_if(Gate::denies('satuan_produk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuan-produk.edit', compact('satuanProduk'));
    }

    public function show(SatuanProduk $satuanProduk)
    {
        abort_if(Gate::denies('satuan_produk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuan-produk.show', compact('satuanProduk'));
    }
}

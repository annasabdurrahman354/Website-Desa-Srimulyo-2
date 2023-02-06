<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriProdukController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_produk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-produk.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kategori_produk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-produk.create');
    }

    public function edit(KategoriProduk $kategoriProduk)
    {
        abort_if(Gate::denies('kategori_produk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-produk.edit', compact('kategoriProduk'));
    }

    public function show(KategoriProduk $kategoriProduk)
    {
        abort_if(Gate::denies('kategori_produk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-produk.show', compact('kategoriProduk'));
    }
}

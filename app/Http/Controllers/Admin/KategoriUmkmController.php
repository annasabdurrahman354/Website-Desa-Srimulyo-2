<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriUmkm;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriUmkmController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_umkm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-umkm.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kategori_umkm_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-umkm.create');
    }

    public function edit(KategoriUmkm $kategoriUmkm)
    {
        abort_if(Gate::denies('kategori_umkm_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-umkm.edit', compact('kategoriUmkm'));
    }

    public function show(KategoriUmkm $kategoriUmkm)
    {
        abort_if(Gate::denies('kategori_umkm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-umkm.show', compact('kategoriUmkm'));
    }
}

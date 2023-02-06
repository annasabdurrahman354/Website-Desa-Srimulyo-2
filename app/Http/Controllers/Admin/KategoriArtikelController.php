<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriArtikel;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriArtikelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategori_artikel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-artikel.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kategori_artikel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-artikel.create');
    }

    public function edit(KategoriArtikel $kategoriArtikel)
    {
        abort_if(Gate::denies('kategori_artikel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-artikel.edit', compact('kategoriArtikel'));
    }

    public function show(KategoriArtikel $kategoriArtikel)
    {
        abort_if(Gate::denies('kategori_artikel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategori-artikel.show', compact('kategoriArtikel'));
    }
}

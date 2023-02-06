<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenisLayananController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_layanan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenis-layanan.index');
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_layanan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenis-layanan.create');
    }

    public function edit(JenisLayanan $jenisLayanan)
    {
        abort_if(Gate::denies('jenis_layanan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenis-layanan.edit', compact('jenisLayanan'));
    }

    public function show(JenisLayanan $jenisLayanan)
    {
        abort_if(Gate::denies('jenis_layanan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisLayanan->load('syaratLayanan');

        return view('admin.jenis-layanan.show', compact('jenisLayanan'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProvinsiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('provinsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinsi.index');
    }

    public function create()
    {
        abort_if(Gate::denies('provinsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinsi.create');
    }

    public function edit(Provinsi $provinsi)
    {
        abort_if(Gate::denies('provinsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinsi.edit', compact('provinsi'));
    }

    public function show(Provinsi $provinsi)
    {
        abort_if(Gate::denies('provinsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.provinsi.show', compact('provinsi'));
    }
}

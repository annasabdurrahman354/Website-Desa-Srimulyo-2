<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KotaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kota_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kota.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kota_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kota.create');
    }

    public function edit(Kota $kota)
    {
        abort_if(Gate::denies('kota_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kota.edit', compact('kota'));
    }

    public function show(Kota $kota)
    {
        abort_if(Gate::denies('kota_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kota->load('provinsi');

        return view('admin.kota.show', compact('kota'));
    }
}

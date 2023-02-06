<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KontakController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kontak_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kontak.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kontak_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kontak.create');
    }

    public function edit(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kontak.edit', compact('kontak'));
    }

    public function show(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kontak.show', compact('kontak'));
    }
}

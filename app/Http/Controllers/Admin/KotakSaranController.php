<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KotakSaran;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KotakSaranController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kotak_saran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kotak-saran.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kotak_saran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kotak-saran.create');
    }

    public function edit(KotakSaran $kotakSaran)
    {
        abort_if(Gate::denies('kotak_saran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kotak-saran.edit', compact('kotakSaran'));
    }

    public function show(KotakSaran $kotakSaran)
    {
        abort_if(Gate::denies('kotak_saran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kotak-saran.show', compact('kotakSaran'));
    }
}

@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.kontak.title_singular') }}:
                    {{ trans('cruds.kontak.fields.id') }}
                    {{ $kontak->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.kontak.fields.id') }}
                            </th>
                            <td>
                                {{ $kontak->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kontak.fields.nama') }}
                            </th>
                            <td>
                                {{ $kontak->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kontak.fields.kontak') }}
                            </th>
                            <td>
                                {{ $kontak->kontak }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kontak.fields.jenis_kontak') }}
                            </th>
                            <td>
                                {{ $kontak->jenis_kontak_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('kontak_edit')
                    <a href="{{ route('admin.kontaks.edit', $kontak) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.kontaks.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
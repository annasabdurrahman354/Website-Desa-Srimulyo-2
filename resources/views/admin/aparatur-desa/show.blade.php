@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.aparaturDesa.title_singular') }}:
                    {{ trans('cruds.aparaturDesa.fields.id') }}
                    {{ $aparaturDesa->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.aparaturDesa.fields.id') }}
                            </th>
                            <td>
                                {{ $aparaturDesa->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.aparaturDesa.fields.nama') }}
                            </th>
                            <td>
                                {{ $aparaturDesa->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.aparaturDesa.fields.foto') }}
                            </th>
                            <td>
                                @foreach($aparaturDesa->foto as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.aparaturDesa.fields.posisi') }}
                            </th>
                            <td>
                                {{ $aparaturDesa->posisi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.aparaturDesa.fields.is_aktif') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $aparaturDesa->is_aktif ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('aparatur_desa_edit')
                    <a href="{{ route('admin.aparatur-desas.edit', $aparaturDesa) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.aparatur-desas.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
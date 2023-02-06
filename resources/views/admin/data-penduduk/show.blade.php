@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.dataPenduduk.title_singular') }}:
                    {{ trans('cruds.dataPenduduk.fields.id') }}
                    {{ $dataPenduduk->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.id') }}
                            </th>
                            <td>
                                {{ $dataPenduduk->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.judul') }}
                            </th>
                            <td>
                                {{ $dataPenduduk->judul }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.slug') }}
                            </th>
                            <td>
                                {{ $dataPenduduk->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.tahun_pembaruan') }}
                            </th>
                            <td>
                                {{ $dataPenduduk->tahun_pembaruan }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $dataPenduduk->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.berkas_data') }}
                            </th>
                            <td>
                                @foreach($dataPenduduk->berkas_data as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.is_grafik') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dataPenduduk->is_grafik ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.is_tabel') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dataPenduduk->is_tabel ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataPenduduk.fields.is_aktif') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dataPenduduk->is_aktif ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('data_penduduk_edit')
                    <a href="{{ route('admin.data-penduduks.edit', $dataPenduduk) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.data-penduduks.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
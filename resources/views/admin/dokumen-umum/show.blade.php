@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.dokumenUmum.title_singular') }}:
                    {{ trans('cruds.dokumenUmum.fields.id') }}
                    {{ $dokumenUmum->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.dokumenUmum.fields.id') }}
                            </th>
                            <td>
                                {{ $dokumenUmum->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dokumenUmum.fields.judul') }}
                            </th>
                            <td>
                                {{ $dokumenUmum->judul }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dokumenUmum.fields.slug') }}
                            </th>
                            <td>
                                {{ $dokumenUmum->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dokumenUmum.fields.tahun_terbit') }}
                            </th>
                            <td>
                                {{ $dokumenUmum->tahun_terbit }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dokumenUmum.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $dokumenUmum->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dokumenUmum.fields.berkas_dokumen') }}
                            </th>
                            <td>
                                @foreach($dokumenUmum->berkas_dokumen as $key => $entry)
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
                                {{ trans('cruds.dokumenUmum.fields.is_aktif') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dokumenUmum->is_aktif ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('dokumen_umum_edit')
                    <a href="{{ route('admin.dokumen-umums.edit', $dokumenUmum) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.dokumen-umums.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
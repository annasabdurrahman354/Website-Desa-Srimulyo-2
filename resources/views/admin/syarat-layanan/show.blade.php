@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.syaratLayanan.title_singular') }}:
                    {{ trans('cruds.syaratLayanan.fields.id') }}
                    {{ $syaratLayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.syaratLayanan.fields.id') }}
                            </th>
                            <td>
                                {{ $syaratLayanan->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.syaratLayanan.fields.nama') }}
                            </th>
                            <td>
                                {{ $syaratLayanan->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.syaratLayanan.fields.jenis_berkas') }}
                            </th>
                            <td>
                                {{ $syaratLayanan->jenis_berkas_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.syaratLayanan.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $syaratLayanan->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.syaratLayanan.fields.berkas_formulir') }}
                            </th>
                            <td>
                                @foreach($syaratLayanan->berkas_formulir as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('syarat_layanan_edit')
                    <a href="{{ route('admin.syarat-layanans.edit', $syaratLayanan) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.syarat-layanans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
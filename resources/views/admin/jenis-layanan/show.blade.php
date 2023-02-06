@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.jenisLayanan.title_singular') }}:
                    {{ trans('cruds.jenisLayanan.fields.id') }}
                    {{ $jenisLayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.jenisLayanan.fields.id') }}
                            </th>
                            <td>
                                {{ $jenisLayanan->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.jenisLayanan.fields.nama') }}
                            </th>
                            <td>
                                {{ $jenisLayanan->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.jenisLayanan.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $jenisLayanan->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.jenisLayanan.fields.biaya') }}
                            </th>
                            <td>
                                {{ $jenisLayanan->biaya }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.jenisLayanan.fields.pelayanan_online') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $jenisLayanan->pelayanan_online ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.jenisLayanan.fields.syarat_layanan') }}
                            </th>
                            <td>
                                @foreach($jenisLayanan->syaratLayanan as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->nama }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('jenis_layanan_edit')
                    <a href="{{ route('admin.jenis-layanans.edit', $jenisLayanan) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.jenis-layanans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
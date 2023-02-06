@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.berkasPelayanan.title_singular') }}:
                    {{ trans('cruds.berkasPelayanan.fields.id') }}
                    {{ $berkasPelayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.berkasPelayanan.fields.id') }}
                            </th>
                            <td>
                                {{ $berkasPelayanan->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.berkasPelayanan.fields.pelayanan') }}
                            </th>
                            <td>
                                @if($berkasPelayanan->pelayanan)
                                    <span class="badge badge-relationship">{{ $berkasPelayanan->pelayanan->kode ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.berkasPelayanan.fields.syarat_layanan') }}
                            </th>
                            <td>
                                @if($berkasPelayanan->syaratLayanan)
                                    <span class="badge badge-relationship">{{ $berkasPelayanan->syaratLayanan->nama ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.berkasPelayanan.fields.teks_syarat') }}
                            </th>
                            <td>
                                {{ $berkasPelayanan->teks_syarat }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.berkasPelayanan.fields.berkas_syarat') }}
                            </th>
                            <td>
                                @foreach($berkasPelayanan->berkas_syarat as $key => $entry)
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
                                {{ trans('cruds.berkasPelayanan.fields.status') }}
                            </th>
                            <td>
                                {{ $berkasPelayanan->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.berkasPelayanan.fields.catatan_reviewer') }}
                            </th>
                            <td>
                                {{ $berkasPelayanan->catatan_reviewer }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('berkas_pelayanan_edit')
                    <a href="{{ route('admin.berkas-pelayanans.edit', $berkasPelayanan) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.berkas-pelayanans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.pelayanan.title_singular') }}:
                    {{ trans('cruds.pelayanan.fields.id') }}
                    {{ $pelayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.id') }}
                            </th>
                            <td>
                                {{ $pelayanan->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.pemohon') }}
                            </th>
                            <td>
                                @if($pelayanan->pemohon)
                                    <span class="badge badge-relationship">{{ $pelayanan->pemohon->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.jenis_layanan') }}
                            </th>
                            <td>
                                @if($pelayanan->jenisLayanan)
                                    <span class="badge badge-relationship">{{ $pelayanan->jenisLayanan->nama ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.kode') }}
                            </th>
                            <td>
                                {{ $pelayanan->kode }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.catatan_pemohon') }}
                            </th>
                            <td>
                                {{ $pelayanan->catatan_pemohon }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.catatan_reviewer') }}
                            </th>
                            <td>
                                {{ $pelayanan->catatan_reviewer }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.status') }}
                            </th>
                            <td>
                                {{ $pelayanan->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.berkas_hasil') }}
                            </th>
                            <td>
                                @foreach($pelayanan->berkas_hasil as $key => $entry)
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
                                {{ trans('cruds.pelayanan.fields.rating') }}
                            </th>
                            <td>
                                {{ $pelayanan->rating_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pelayanan.fields.penilaian_pemohon') }}
                            </th>
                            <td>
                                {{ $pelayanan->penilaian_pemohon }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('pelayanan_edit')
                    <a href="{{ route('admin.pelayanans.edit', $pelayanan) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.pelayanans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.umkm.title_singular') }}:
                    {{ trans('cruds.umkm.fields.id') }}
                    {{ $umkm->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.id') }}
                            </th>
                            <td>
                                {{ $umkm->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.pemilik') }}
                            </th>
                            <td>
                                @if($umkm->pemilik)
                                    <span class="badge badge-relationship">{{ $umkm->pemilik->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.nama_umkm') }}
                            </th>
                            <td>
                                {{ $umkm->nama_umkm }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.slug') }}
                            </th>
                            <td>
                                {{ $umkm->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.carousel') }}
                            </th>
                            <td>
                                @foreach($umkm->carousel as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $umkm->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.nomor_telepon') }}
                            </th>
                            <td>
                                {{ $umkm->nomor_telepon }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.alamat') }}
                            </th>
                            <td>
                                {{ $umkm->alamat }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.latitude') }}
                            </th>
                            <td>
                                {{ $umkm->latitude }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.longitude') }}
                            </th>
                            <td>
                                {{ $umkm->longitude }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.waktu_keterlihatan') }}
                            </th>
                            <td>
                                {{ $umkm->waktu_keterlihatan }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.kategori') }}
                            </th>
                            <td>
                                @if($umkm->kategori)
                                    <span class="badge badge-relationship">{{ $umkm->kategori->kategori ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.is_aktif') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $umkm->is_aktif ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.umkm.fields.is_terverifikasi') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $umkm->is_terverifikasi ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('umkm_edit')
                    <a href="{{ route('admin.umkms.edit', $umkm) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.umkms.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
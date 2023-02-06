@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.kota.title_singular') }}:
                    {{ trans('cruds.kota.fields.id') }}
                    {{ $kota->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.kota.fields.id') }}
                            </th>
                            <td>
                                {{ $kota->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kota.fields.provinsi') }}
                            </th>
                            <td>
                                @if($kota->provinsi)
                                    <span class="badge badge-relationship">{{ $kota->provinsi->nama ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kota.fields.nama') }}
                            </th>
                            <td>
                                {{ $kota->nama }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('kota_edit')
                    <a href="{{ route('admin.kota.edit', $kota) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.kotakSaran.title_singular') }}:
                    {{ trans('cruds.kotakSaran.fields.id') }}
                    {{ $kotakSaran->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.kotakSaran.fields.id') }}
                            </th>
                            <td>
                                {{ $kotakSaran->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kotakSaran.fields.pengirim') }}
                            </th>
                            <td>
                                {{ $kotakSaran->pengirim }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kotakSaran.fields.nomor_telepon') }}
                            </th>
                            <td>
                                {{ $kotakSaran->nomor_telepon }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kotakSaran.fields.isi') }}
                            </th>
                            <td>
                                {{ $kotakSaran->isi }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('kotak_saran_edit')
                    <a href="{{ route('admin.kotak-sarans.edit', $kotakSaran) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.kotak-sarans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.kategoriUmkm.title_singular') }}:
                    {{ trans('cruds.kategoriUmkm.fields.id') }}
                    {{ $kategoriUmkm->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.kategoriUmkm.fields.id') }}
                            </th>
                            <td>
                                {{ $kategoriUmkm->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kategoriUmkm.fields.kategori') }}
                            </th>
                            <td>
                                {{ $kategoriUmkm->kategori }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('kategori_umkm_edit')
                    <a href="{{ route('admin.kategori-umkms.edit', $kategoriUmkm) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.kategori-umkms.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.satuanProduk.title_singular') }}:
                    {{ trans('cruds.satuanProduk.fields.id') }}
                    {{ $satuanProduk->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.satuanProduk.fields.id') }}
                            </th>
                            <td>
                                {{ $satuanProduk->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.satuanProduk.fields.satuan') }}
                            </th>
                            <td>
                                {{ $satuanProduk->satuan }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('satuan_produk_edit')
                    <a href="{{ route('admin.satuan-produks.edit', $satuanProduk) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.satuan-produks.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
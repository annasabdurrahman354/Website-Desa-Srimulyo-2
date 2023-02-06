@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.kategoriProduk.title_singular') }}:
                    {{ trans('cruds.kategoriProduk.fields.id') }}
                    {{ $kategoriProduk->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.kategoriProduk.fields.id') }}
                            </th>
                            <td>
                                {{ $kategoriProduk->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kategoriProduk.fields.kategori') }}
                            </th>
                            <td>
                                {{ $kategoriProduk->kategori }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('kategori_produk_edit')
                    <a href="{{ route('admin.kategori-produks.edit', $kategoriProduk) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.kategori-produks.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.kategoriArtikel.title_singular') }}:
                    {{ trans('cruds.kategoriArtikel.fields.id') }}
                    {{ $kategoriArtikel->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.kategoriArtikel.fields.id') }}
                            </th>
                            <td>
                                {{ $kategoriArtikel->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.kategoriArtikel.fields.kategori') }}
                            </th>
                            <td>
                                {{ $kategoriArtikel->kategori }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('kategori_artikel_edit')
                    <a href="{{ route('admin.kategori-artikels.edit', $kategoriArtikel) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.kategori-artikels.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
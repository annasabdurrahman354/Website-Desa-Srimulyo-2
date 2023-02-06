@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.produkHukum.title_singular') }}:
                    {{ trans('cruds.produkHukum.fields.id') }}
                    {{ $produkHukum->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.produkHukum.fields.id') }}
                            </th>
                            <td>
                                {{ $produkHukum->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produkHukum.fields.judul') }}
                            </th>
                            <td>
                                {{ $produkHukum->judul }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produkHukum.fields.slug') }}
                            </th>
                            <td>
                                {{ $produkHukum->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produkHukum.fields.jenis') }}
                            </th>
                            <td>
                                {{ $produkHukum->jenis_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produkHukum.fields.tahun') }}
                            </th>
                            <td>
                                {{ $produkHukum->tahun }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produkHukum.fields.berkas_dokumen') }}
                            </th>
                            <td>
                                @foreach($produkHukum->berkas_dokumen as $key => $entry)
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
                                {{ trans('cruds.produkHukum.fields.is_aktif') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produkHukum->is_aktif ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('produk_hukum_edit')
                    <a href="{{ route('admin.produk-hukums.edit', $produkHukum) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.produk-hukums.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
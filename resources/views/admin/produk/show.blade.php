@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.produk.title_singular') }}:
                    {{ trans('cruds.produk.fields.id') }}
                    {{ $produk->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.id') }}
                            </th>
                            <td>
                                {{ $produk->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.umkm') }}
                            </th>
                            <td>
                                @if($produk->umkm)
                                    <span class="badge badge-relationship">{{ $produk->umkm->nama_umkm ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.nama') }}
                            </th>
                            <td>
                                {{ $produk->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.slug') }}
                            </th>
                            <td>
                                {{ $produk->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.foto') }}
                            </th>
                            <td>
                                @foreach($produk->foto as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $produk->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.harga') }}
                            </th>
                            <td>
                                {{ $produk->harga }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.satuan') }}
                            </th>
                            <td>
                                @if($produk->satuan)
                                    <span class="badge badge-relationship">{{ $produk->satuan->satuan ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.kategori') }}
                            </th>
                            <td>
                                @if($produk->kategori)
                                    <span class="badge badge-relationship">{{ $produk->kategori->kategori ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.is_tersedia') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produk->is_tersedia ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.produk.fields.is_tampilkan') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produk->is_tampilkan ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('produk_edit')
                    <a href="{{ route('admin.produks.edit', $produk) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.produks.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
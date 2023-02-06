@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.artikel.title_singular') }}:
                    {{ trans('cruds.artikel.fields.id') }}
                    {{ $artikel->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.id') }}
                            </th>
                            <td>
                                {{ $artikel->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.judul') }}
                            </th>
                            <td>
                                {{ $artikel->judul }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.slug') }}
                            </th>
                            <td>
                                {{ $artikel->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.gambar') }}
                            </th>
                            <td>
                                @foreach($artikel->gambar as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.penulis') }}
                            </th>
                            <td>
                                @if($artikel->penulis)
                                    <span class="badge badge-relationship">{{ $artikel->penulis->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.rangkuman') }}
                            </th>
                            <td>
                                {{ $artikel->rangkuman }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.konten') }}
                            </th>
                            <td>
                                {{ $artikel->konten }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.jumlah_pembaca') }}
                            </th>
                            <td>
                                {{ $artikel->jumlah_pembaca }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.kategori') }}
                            </th>
                            <td>
                                @if($artikel->kategori)
                                    <span class="badge badge-relationship">{{ $artikel->kategori->kategori ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artikel.fields.is_diterbitkan') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $artikel->is_diterbitkan ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('artikel_edit')
                    <a href="{{ route('admin.artikels.edit', $artikel) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.artikels.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.carousel.title_singular') }}:
                    {{ trans('cruds.carousel.fields.id') }}
                    {{ $carousel->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.carousel.fields.id') }}
                            </th>
                            <td>
                                {{ $carousel->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.carousel.fields.judul') }}
                            </th>
                            <td>
                                {{ $carousel->judul }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.carousel.fields.gambar') }}
                            </th>
                            <td>
                                @foreach($carousel->gambar as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.carousel.fields.link_tujuan') }}
                            </th>
                            <td>
                                {{ $carousel->link_tujuan }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.carousel.fields.is_aktif') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $carousel->is_aktif ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('carousel_edit')
                    <a href="{{ route('admin.carousels.edit', $carousel) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.carousels.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
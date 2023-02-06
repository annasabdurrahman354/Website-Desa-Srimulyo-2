@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.satuanProduk.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('satuan_produk_create')
                    <a class="btn btn-indigo" href="{{ route('admin.satuan-produks.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.satuanProduk.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('satuan-produk.index')

    </div>
</div>
@endsection
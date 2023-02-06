@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.berkasPelayanan.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('berkas_pelayanan_create')
                    <a class="btn btn-indigo" href="{{ route('admin.berkas-pelayanans.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.berkasPelayanan.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('admin.berkas-pelayanan.index')

    </div>
</div>
@endsection
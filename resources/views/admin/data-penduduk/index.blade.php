@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.dataPenduduk.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('data_penduduk_create')
                    <a class="btn btn-indigo" href="{{ route('admin.data-penduduks.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.dataPenduduk.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('admin.data-penduduk.index')

    </div>
</div>
@endsection
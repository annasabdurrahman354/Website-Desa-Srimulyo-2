@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.aparaturDesa.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('aparatur_desa_create')
                    <a class="btn btn-indigo" href="{{ route('admin.aparatur-desas.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.aparaturDesa.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('admin.aparatur-desa.index')

    </div>
</div>
@endsection
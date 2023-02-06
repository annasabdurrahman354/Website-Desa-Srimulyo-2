@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.kotakSaran.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('kotak_saran_create')
                    <a class="btn btn-indigo" href="{{ route('admin.kotak-sarans.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.kotakSaran.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('admin.kotak-saran.index')

    </div>
</div>
@endsection
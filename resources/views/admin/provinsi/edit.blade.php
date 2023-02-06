@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.provinsi.title_singular') }}:
                    {{ trans('cruds.provinsi.fields.id') }}
                    {{ $provinsi->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.provinsi.edit', [$provinsi])
        </div>
    </div>
</div>
@endsection
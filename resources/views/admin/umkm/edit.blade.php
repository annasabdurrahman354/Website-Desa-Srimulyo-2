@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.umkm.title_singular') }}:
                    {{ trans('cruds.umkm.fields.id') }}
                    {{ $umkm->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.umkm.edit', [$umkm])
        </div>
    </div>
</div>
@endsection
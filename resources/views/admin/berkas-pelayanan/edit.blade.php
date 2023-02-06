@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.berkasPelayanan.title_singular') }}:
                    {{ trans('cruds.berkasPelayanan.fields.id') }}
                    {{ $berkasPelayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.berkas-pelayanan.edit', [$berkasPelayanan])
        </div>
    </div>
</div>
@endsection
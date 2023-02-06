@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.pelayanan.title_singular') }}:
                    {{ trans('cruds.pelayanan.fields.id') }}
                    {{ $pelayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('pelayanan.edit', [$pelayanan])
        </div>
    </div>
</div>
@endsection
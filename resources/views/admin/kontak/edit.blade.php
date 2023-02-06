@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.kontak.title_singular') }}:
                    {{ trans('cruds.kontak.fields.id') }}
                    {{ $kontak->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.kontak.edit', [$kontak])
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.dokumenUmum.title_singular') }}:
                    {{ trans('cruds.dokumenUmum.fields.id') }}
                    {{ $dokumenUmum->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.dokumen-umum.edit', [$dokumenUmum])
        </div>
    </div>
</div>
@endsection
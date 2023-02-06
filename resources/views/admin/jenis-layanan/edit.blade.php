@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.jenisLayanan.title_singular') }}:
                    {{ trans('cruds.jenisLayanan.fields.id') }}
                    {{ $jenisLayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.jenis-layanan.edit', [$jenisLayanan])
        </div>
    </div>
</div>
@endsection
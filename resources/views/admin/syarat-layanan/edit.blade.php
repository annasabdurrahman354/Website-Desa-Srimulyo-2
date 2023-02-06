@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.syaratLayanan.title_singular') }}:
                    {{ trans('cruds.syaratLayanan.fields.id') }}
                    {{ $syaratLayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.syarat-layanan.edit', [$syaratLayanan])
        </div>
    </div>
</div>
@endsection
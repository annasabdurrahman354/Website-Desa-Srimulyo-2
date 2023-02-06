@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.kategoriUmkm.title_singular') }}:
                    {{ trans('cruds.kategoriUmkm.fields.id') }}
                    {{ $kategoriUmkm->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('kategori-umkm.edit', [$kategoriUmkm])
        </div>
    </div>
</div>
@endsection
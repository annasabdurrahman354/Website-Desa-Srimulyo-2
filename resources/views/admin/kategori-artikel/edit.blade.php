@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.kategoriArtikel.title_singular') }}:
                    {{ trans('cruds.kategoriArtikel.fields.id') }}
                    {{ $kategoriArtikel->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.kategori-artikel.edit', [$kategoriArtikel])
        </div>
    </div>
</div>
@endsection
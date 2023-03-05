@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    Review
                    {{ trans('cruds.berkasPelayanan.title_singular') }}:
                    {{ $berkasPelayanan->syaratLayanan->nama }} Pelayanan oleh
                    {{ $berkasPelayanan->pelayanan->pemohon->name }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.berkas-pelayanan.review', [$berkasPelayanan])
        </div>
    </div>
</div>
@endsection
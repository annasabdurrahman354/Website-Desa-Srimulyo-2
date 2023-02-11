@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    Review
                    {{ trans('cruds.pelayanan.title_singular') }}:
                    {{ trans('cruds.pelayanan.fields.id') }}
                    {{ $pelayanan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('admin.pelayanan.review', [$pelayanan])
        </div>
    </div>
</div>
@endsection
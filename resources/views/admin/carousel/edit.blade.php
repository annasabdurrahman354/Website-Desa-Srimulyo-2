@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.carousel.title_singular') }}:
                    {{ trans('cruds.carousel.fields.id') }}
                    {{ $carousel->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('carousel.edit', [$carousel])
        </div>
    </div>
</div>
@endsection
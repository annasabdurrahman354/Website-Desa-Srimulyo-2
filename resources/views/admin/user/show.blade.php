@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.user.title_singular') }}:
                    {{ trans('cruds.user.fields.id') }}
                    {{ $user->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <td>
                                {{ $user->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.foto_profil') }}
                            </th>
                            <td>
                                @foreach($user->foto_profil as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.nik') }}
                            </th>
                            <td>
                                {{ $user->nik }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.nomor_telepon') }}
                            </th>
                            <td>
                                {{ $user->nomor_telepon }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.jenis_kelamin') }}
                            </th>
                            <td>
                                {{ $user->jenis_kelamin_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.tempat_lahir') }}
                            </th>
                            <td>
                                @if($user->tempatLahir)
                                    <span class="badge badge-relationship">{{ $user->tempatLahir->nama ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.tanggal_lahir') }}
                            </th>
                            <td>
                                {{ $user->tanggal_lahir }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.alamat') }}
                            </th>
                            <td>
                                {{ $user->alamat }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $user->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $user->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.email_verified_at') }}
                            </th>
                            <td>
                                {{ $user->email_verified_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <td>
                                @foreach($user->roles as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.locale') }}
                            </th>
                            <td>
                                {{ $user->locale }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('user_edit')
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('mediaCollections.user_foto_profil') ? 'invalid' : '' }}">
        <label class="form-label" for="foto_profil">{{ trans('cruds.user.fields.foto_profil') }}</label>
        <x-dropzone id="foto_profil" name="foto_profil" action="{{ route('admin.users.storeMedia') }}" collection-name="user_foto_profil" max-file-size="1" max-width="256" max-height="256" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.user_foto_profil') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.foto_profil_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.user.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="user.name">
        <div class="validation-message">
            {{ $errors->first('user.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.nik') ? 'invalid' : '' }}">
        <label class="form-label required" for="nik">{{ trans('cruds.user.fields.nik') }}</label>
        <input class="form-control" type="text" name="nik" id="nik" required wire:model.defer="user.nik">
        <div class="validation-message">
            {{ $errors->first('user.nik') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.nik_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.nomor_telepon') ? 'invalid' : '' }}">
        <label class="form-label required" for="nomor_telepon">{{ trans('cruds.user.fields.nomor_telepon') }}</label>
        <input class="form-control" type="text" name="nomor_telepon" id="nomor_telepon" required wire:model.defer="user.nomor_telepon">
        <div class="validation-message">
            {{ $errors->first('user.nomor_telepon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.nomor_telepon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.jenis_kelamin') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.user.fields.jenis_kelamin') }}</label>
        @foreach($this->listsForFields['jenis_kelamin'] as $key => $value)
            <label class="radio-label"><input type="radio" name="jenis_kelamin" wire:model="user.jenis_kelamin" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('user.jenis_kelamin') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.jenis_kelamin_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.tempat_lahir_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="tempat_lahir">{{ trans('cruds.user.fields.tempat_lahir') }}</label>
        <x-select-list class="form-control" required id="tempat_lahir" name="tempat_lahir" :options="$this->listsForFields['tempat_lahir']" wire:model="user.tempat_lahir_id" />
        <div class="validation-message">
            {{ $errors->first('user.tempat_lahir_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.tempat_lahir_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.tanggal_lahir') ? 'invalid' : '' }}">
        <label class="form-label required" for="tanggal_lahir">{{ trans('cruds.user.fields.tanggal_lahir') }}</label>
        <x-date-picker class="form-control" required wire:model="user.tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir" picker="date" />
        <div class="validation-message">
            {{ $errors->first('user.tanggal_lahir') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.tanggal_lahir_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.alamat') ? 'invalid' : '' }}">
        <label class="form-label required" for="alamat">{{ trans('cruds.user.fields.alamat') }}</label>
        <input class="form-control" type="text" name="alamat" id="alamat" required wire:model.defer="user.alamat">
        <div class="validation-message">
            {{ $errors->first('user.alamat') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.alamat_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.email') ? 'invalid' : '' }}">
        <label class="form-label required" for="email">{{ trans('cruds.user.fields.email') }}</label>
        <input class="form-control" type="email" name="email" id="email" required wire:model.defer="user.email">
        <div class="validation-message">
            {{ $errors->first('user.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.password') ? 'invalid' : '' }}">
        <label class="form-label required" for="password">{{ trans('cruds.user.fields.password') }}</label>
        <input class="form-control" type="password" name="password" id="password" required wire:model.defer="password">
        <div class="validation-message">
            {{ $errors->first('user.password') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.password_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('roles') ? 'invalid' : '' }}">
        <label class="form-label required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
        <x-select-list class="form-control" required id="roles" name="roles" wire:model="roles" :options="$this->listsForFields['roles']" multiple />
        <div class="validation-message">
            {{ $errors->first('roles') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.roles_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.locale') ? 'invalid' : '' }}">
        <label class="form-label" for="locale">{{ trans('cruds.user.fields.locale') }}</label>
        <input class="form-control" type="text" name="locale" id="locale" wire:model.defer="user.locale">
        <div class="validation-message">
            {{ $errors->first('user.locale') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.locale_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
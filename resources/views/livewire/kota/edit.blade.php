<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('kota.provinsi_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="provinsi">{{ trans('cruds.kota.fields.provinsi') }}</label>
        <x-select-list class="form-control" required id="provinsi" name="provinsi" :options="$this->listsForFields['provinsi']" wire:model="kota.provinsi_id" />
        <div class="validation-message">
            {{ $errors->first('kota.provinsi_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kota.fields.provinsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('kota.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.kota.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model.defer="kota.nama">
        <div class="validation-message">
            {{ $errors->first('kota.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kota.fields.nama_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
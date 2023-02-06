<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('provinsi.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.provinsi.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model.defer="provinsi.nama">
        <div class="validation-message">
            {{ $errors->first('provinsi.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.provinsi.fields.nama_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.provinsis.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
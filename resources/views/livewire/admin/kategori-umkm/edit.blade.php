<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('kategoriUmkm.kategori') ? 'invalid' : '' }}">
        <label class="form-label required" for="kategori">{{ trans('cruds.kategoriUmkm.fields.kategori') }}</label>
        <input class="form-control" type="text" name="kategori" id="kategori" required wire:model.defer="kategoriUmkm.kategori">
        <div class="validation-message">
            {{ $errors->first('kategoriUmkm.kategori') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kategoriUmkm.fields.kategori_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.kategori-umkms.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
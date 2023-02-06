<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('kategoriArtikel.kategori') ? 'invalid' : '' }}">
        <label class="form-label required" for="kategori">{{ trans('cruds.kategoriArtikel.fields.kategori') }}</label>
        <input class="form-control" type="text" name="kategori" id="kategori" required wire:model.defer="kategoriArtikel.kategori">
        <div class="validation-message">
            {{ $errors->first('kategoriArtikel.kategori') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kategoriArtikel.fields.kategori_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.kategori-artikels.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
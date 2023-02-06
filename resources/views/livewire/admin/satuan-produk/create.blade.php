<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('satuanProduk.satuan') ? 'invalid' : '' }}">
        <label class="form-label required" for="satuan">{{ trans('cruds.satuanProduk.fields.satuan') }}</label>
        <input class="form-control" type="text" name="satuan" id="satuan" required wire:model.defer="satuanProduk.satuan">
        <div class="validation-message">
            {{ $errors->first('satuanProduk.satuan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.satuanProduk.fields.satuan_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.satuan-produks.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
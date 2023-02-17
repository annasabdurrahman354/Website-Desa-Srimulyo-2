<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('aparaturDesa.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.aparaturDesa.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model.defer="aparaturDesa.nama">
        <div class="validation-message">
            {{ $errors->first('aparaturDesa.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.aparaturDesa.fields.nama_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.aparatur_desa_foto') ? 'invalid' : '' }}">
        <label class="form-label required" for="foto">{{ trans('cruds.aparaturDesa.fields.foto') }}</label>
        <x-dropzone-image id="foto" name="foto" action="{{ route('admin.aparatur-desas.storeMedia') }}" collection-name="aparatur_desa_foto" max-file-size="2" ratio="2/3" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.aparatur_desa_foto') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.aparaturDesa.fields.foto_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('aparaturDesa.posisi') ? 'invalid' : '' }}">
        <label class="form-label required" for="posisi">{{ trans('cruds.aparaturDesa.fields.posisi') }}</label>
        <input class="form-control" type="text" name="posisi" id="posisi" required wire:model.defer="aparaturDesa.posisi">
        <div class="validation-message">
            {{ $errors->first('aparaturDesa.posisi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.aparaturDesa.fields.posisi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('aparaturDesa.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="aparaturDesa.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.aparaturDesa.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('aparaturDesa.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.aparaturDesa.fields.is_aktif_helper') }}
        </div>
    </div>

    <div class="form-group" wire:loading.remove>
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.aparatur-desas.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
    <div class="form-group" wire:loading>
        <x-loading/>
    </div>
</form>
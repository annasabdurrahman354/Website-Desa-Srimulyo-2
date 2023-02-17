<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('carousel.judul') ? 'invalid' : '' }}">
        <label class="form-label required" for="judul">{{ trans('cruds.carousel.fields.judul') }}</label>
        <input class="form-control" type="text" name="judul" id="judul" required wire:model.defer="carousel.judul">
        <div class="validation-message">
            {{ $errors->first('carousel.judul') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.carousel.fields.judul_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.carousel_gambar') ? 'invalid' : '' }}">
        <label class="form-label required" for="gambar">{{ trans('cruds.carousel.fields.gambar') }}</label>
        <x-dropzone-image id="gambar" name="gambar" action="{{ route('admin.carousels.storeMedia') }}" collection-name="carousel_gambar" ratio="3/1" max-file-size="2" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.carousel_gambar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.carousel.fields.gambar_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('carousel.link_tujuan') ? 'invalid' : '' }}">
        <label class="form-label" for="link_tujuan">{{ trans('cruds.carousel.fields.link_tujuan') }}</label>
        <input class="form-control" type="text" name="link_tujuan" id="link_tujuan" wire:model.defer="carousel.link_tujuan">
        <div class="validation-message">
            {{ $errors->first('carousel.link_tujuan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.carousel.fields.link_tujuan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('carousel.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="carousel.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.carousel.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('carousel.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.carousel.fields.is_aktif_helper') }}
        </div>
    </div>

    <div class="form-group" wire:loading.remove>
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.carousels.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
    <div class="form-group" wire:loading>
        <x-loading/>
    </div>
</form>
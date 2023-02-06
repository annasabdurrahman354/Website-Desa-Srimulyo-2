<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('dokumenUmum.judul') ? 'invalid' : '' }}">
        <label class="form-label required" for="judul">{{ trans('cruds.dokumenUmum.fields.judul') }}</label>
        <input class="form-control" type="text" name="judul" id="judul" required wire:model="judul">
        <div class="validation-message">
            {{ $errors->first('dokumenUmum.judul') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dokumenUmum.fields.judul_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dokumenUmum.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.dokumenUmum.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model="dokumenUmum.slug" disabled>
        <div class="validation-message">
            {{ $errors->first('dokumenUmum.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dokumenUmum.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dokumenUmum.tahun_terbit') ? 'invalid' : '' }}">
        <label class="form-label required" for="tahun_terbit">{{ trans('cruds.dokumenUmum.fields.tahun_terbit') }}</label>
        <input class="form-control" type="number" name="tahun_terbit" id="tahun_terbit" required wire:model.defer="dokumenUmum.tahun_terbit" step="1">
        <div class="validation-message">
            {{ $errors->first('dokumenUmum.tahun_terbit') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dokumenUmum.fields.tahun_terbit_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dokumenUmum.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label required" for="deskripsi">{{ trans('cruds.dokumenUmum.fields.deskripsi') }}</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" required wire:model.defer="dokumenUmum.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('dokumenUmum.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dokumenUmum.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.dokumen_umum_berkas_dokumen') ? 'invalid' : '' }}">
        <label class="form-label required" for="berkas_dokumen">{{ trans('cruds.dokumenUmum.fields.berkas_dokumen') }}</label>
        <x-dropzone id="berkas_dokumen" name="berkas_dokumen" action="{{ route('admin.dokumen-umums.storeMedia') }}" collection-name="dokumen_umum_berkas_dokumen" max-file-size="10" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.dokumen_umum_berkas_dokumen') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dokumenUmum.fields.berkas_dokumen_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dokumenUmum.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="dokumenUmum.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.dokumenUmum.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('dokumenUmum.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dokumenUmum.fields.is_aktif_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.dokumen-umums.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('umkm.pemilik_id') ? 'invalid' : '' }}">
        <label class="form-label" for="pemilik">{{ trans('cruds.umkm.fields.pemilik') }}</label>
        <x-select-list class="form-control" id="pemilik" name="pemilik" :options="$this->listsForFields['pemilik']" wire:model="umkm.pemilik_id" />
        <div class="validation-message">
            {{ $errors->first('umkm.pemilik_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.pemilik_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.nama_umkm') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama_umkm">{{ trans('cruds.umkm.fields.nama_umkm') }}</label>
        <input class="form-control" type="text" name="nama_umkm" id="nama_umkm" required wire:model.defer="umkm.nama_umkm">
        <div class="validation-message">
            {{ $errors->first('umkm.nama_umkm') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.nama_umkm_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.umkm.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model.defer="umkm.slug">
        <div class="validation-message">
            {{ $errors->first('umkm.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.umkm_carousel') ? 'invalid' : '' }}">
        <label class="form-label required" for="carousel">{{ trans('cruds.umkm.fields.carousel') }}</label>
        <x-dropzone id="carousel" name="carousel" action="{{ route('admin.umkms.storeMedia') }}" collection-name="umkm_carousel" max-file-size="2" max-width="2048" max-height="1024" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.umkm_carousel') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.carousel_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label required" for="deskripsi">{{ trans('cruds.umkm.fields.deskripsi') }}</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" required wire:model.defer="umkm.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('umkm.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.nomor_telepon') ? 'invalid' : '' }}">
        <label class="form-label required" for="nomor_telepon">{{ trans('cruds.umkm.fields.nomor_telepon') }}</label>
        <input class="form-control" type="text" name="nomor_telepon" id="nomor_telepon" required wire:model.defer="umkm.nomor_telepon">
        <div class="validation-message">
            {{ $errors->first('umkm.nomor_telepon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.nomor_telepon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.alamat') ? 'invalid' : '' }}">
        <label class="form-label required" for="alamat">{{ trans('cruds.umkm.fields.alamat') }}</label>
        <input class="form-control" type="text" name="alamat" id="alamat" required wire:model.defer="umkm.alamat">
        <div class="validation-message">
            {{ $errors->first('umkm.alamat') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.alamat_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.latitude') ? 'invalid' : '' }}">
        <label class="form-label" for="latitude">{{ trans('cruds.umkm.fields.latitude') }}</label>
        <input class="form-control" type="text" name="latitude" id="latitude" wire:model.defer="umkm.latitude">
        <div class="validation-message">
            {{ $errors->first('umkm.latitude') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.latitude_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.longitude') ? 'invalid' : '' }}">
        <label class="form-label" for="longitude">{{ trans('cruds.umkm.fields.longitude') }}</label>
        <input class="form-control" type="text" name="longitude" id="longitude" wire:model.defer="umkm.longitude">
        <div class="validation-message">
            {{ $errors->first('umkm.longitude') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.longitude_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.waktu_keterlihatan') ? 'invalid' : '' }}">
        <label class="form-label" for="waktu_keterlihatan">{{ trans('cruds.umkm.fields.waktu_keterlihatan') }}</label>
        <x-date-picker class="form-control" wire:model="umkm.waktu_keterlihatan" id="waktu_keterlihatan" name="waktu_keterlihatan" />
        <div class="validation-message">
            {{ $errors->first('umkm.waktu_keterlihatan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.waktu_keterlihatan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.kategori_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="kategori">{{ trans('cruds.umkm.fields.kategori') }}</label>
        <x-select-list class="form-control" required id="kategori" name="kategori" :options="$this->listsForFields['kategori']" wire:model="umkm.kategori_id" />
        <div class="validation-message">
            {{ $errors->first('umkm.kategori_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.kategori_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="umkm.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.umkm.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('umkm.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.is_aktif_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.is_terverifikasi') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_terverifikasi" id="is_terverifikasi" wire:model.defer="umkm.is_terverifikasi">
        <label class="form-label inline ml-1" for="is_terverifikasi">{{ trans('cruds.umkm.fields.is_terverifikasi') }}</label>
        <div class="validation-message">
            {{ $errors->first('umkm.is_terverifikasi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.is_terverifikasi_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.umkms.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
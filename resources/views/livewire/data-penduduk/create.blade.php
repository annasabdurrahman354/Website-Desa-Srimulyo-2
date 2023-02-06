<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('dataPenduduk.judul') ? 'invalid' : '' }}">
        <label class="form-label required" for="judul">{{ trans('cruds.dataPenduduk.fields.judul') }}</label>
        <input class="form-control" type="text" name="judul" id="judul" required wire:model.defer="dataPenduduk.judul">
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.judul') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.judul_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dataPenduduk.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.dataPenduduk.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model.defer="dataPenduduk.slug">
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dataPenduduk.tahun_pembaruan') ? 'invalid' : '' }}">
        <label class="form-label required" for="tahun_pembaruan">{{ trans('cruds.dataPenduduk.fields.tahun_pembaruan') }}</label>
        <input class="form-control" type="number" name="tahun_pembaruan" id="tahun_pembaruan" required wire:model.defer="dataPenduduk.tahun_pembaruan" step="1">
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.tahun_pembaruan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.tahun_pembaruan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dataPenduduk.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label required" for="deskripsi">{{ trans('cruds.dataPenduduk.fields.deskripsi') }}</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" required wire:model.defer="dataPenduduk.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.data_penduduk_berkas_data') ? 'invalid' : '' }}">
        <label class="form-label required" for="berkas_data">{{ trans('cruds.dataPenduduk.fields.berkas_data') }}</label>
        <x-dropzone id="berkas_data" name="berkas_data" action="{{ route('admin.data-penduduks.storeMedia') }}" collection-name="data_penduduk_berkas_data" max-file-size="10" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.data_penduduk_berkas_data') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.berkas_data_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dataPenduduk.is_grafik') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_grafik" id="is_grafik" wire:model.defer="dataPenduduk.is_grafik">
        <label class="form-label inline ml-1" for="is_grafik">{{ trans('cruds.dataPenduduk.fields.is_grafik') }}</label>
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.is_grafik') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.is_grafik_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dataPenduduk.is_tabel') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_tabel" id="is_tabel" wire:model.defer="dataPenduduk.is_tabel">
        <label class="form-label inline ml-1" for="is_tabel">{{ trans('cruds.dataPenduduk.fields.is_tabel') }}</label>
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.is_tabel') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.is_tabel_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('dataPenduduk.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="dataPenduduk.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.dataPenduduk.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('dataPenduduk.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.dataPenduduk.fields.is_aktif_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.data-penduduks.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
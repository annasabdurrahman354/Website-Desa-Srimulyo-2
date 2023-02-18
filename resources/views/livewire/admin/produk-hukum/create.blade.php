<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('produkHukum.judul') ? 'invalid' : '' }}">
        <label class="form-label required" for="judul">{{ trans('cruds.produkHukum.fields.judul') }}</label>
        <input class="form-control" type="text" name="judul" id="judul" required wire:model="judul">
        <div class="validation-message">
            {{ $errors->first('produkHukum.judul') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produkHukum.fields.judul_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produkHukum.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.produkHukum.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model="produkHukum.slug">
        <div class="validation-message">
            {{ $errors->first('produkHukum.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produkHukum.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produkHukum.jenis') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.produkHukum.fields.jenis') }}</label>
        <select class="form-control" wire:model="produkHukum.jenis">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['jenis'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('produkHukum.jenis') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produkHukum.fields.jenis_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produkHukum.tahun') ? 'invalid' : '' }}">
        <label class="form-label required" for="tahun">{{ trans('cruds.produkHukum.fields.tahun') }}</label>
        <input class="form-control" type="number" name="tahun" id="tahun" required wire:model.defer="produkHukum.tahun" step="1">
        <div class="validation-message">
            {{ $errors->first('produkHukum.tahun') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produkHukum.fields.tahun_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.produk_hukum_berkas_dokumen') ? 'invalid' : '' }}">
        <label class="form-label required" for="berkas_dokumen">{{ trans('cruds.produkHukum.fields.berkas_dokumen') }}</label>
        <x-dropzone id="berkas_dokumen" name="berkas_dokumen" action="{{ route('admin.produk-hukums.storeMedia') }}" collection-name="produk_hukum_berkas_dokumen" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.produk_hukum_berkas_dokumen') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produkHukum.fields.berkas_dokumen_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produkHukum.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="produkHukum.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.produkHukum.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('produkHukum.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produkHukum.fields.is_aktif_helper') }}
        </div>
    </div>

    <div class="form-group" wire:loading.remove>
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.produk-hukums.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
    <div class="form-group" wire:loading>
        <x-loading/>
    </div>
</form>
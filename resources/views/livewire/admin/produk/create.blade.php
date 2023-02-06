<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('produk.umkm_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="umkm">{{ trans('cruds.produk.fields.umkm') }}</label>
        <x-select-list class="form-control" required id="umkm" name="umkm" :options="$this->listsForFields['umkm']" wire:model="produk.umkm_id" />
        <div class="validation-message">
            {{ $errors->first('produk.umkm_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.umkm_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.produk.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model="nama">
        <div class="validation-message">
            {{ $errors->first('produk.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.nama_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.produk.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model="produk.slug" disabled>
        <div class="validation-message">
            {{ $errors->first('produk.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.produk_foto') ? 'invalid' : '' }}">
        <label class="form-label required" for="foto">{{ trans('cruds.produk.fields.foto') }}</label>
        <x-dropzone id="foto" name="foto" action="{{ route('admin.produks.storeMedia') }}" collection-name="produk_foto" max-file-size="2" max-width="800" max-height="600" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.produk_foto') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.foto_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label required" for="deskripsi">{{ trans('cruds.produk.fields.deskripsi') }}</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" required wire:model.defer="produk.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('produk.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.harga') ? 'invalid' : '' }}">
        <label class="form-label required" for="harga">{{ trans('cruds.produk.fields.harga') }}</label>
        <input class="form-control" type="number" name="harga" id="harga" required wire:model.defer="produk.harga" step="0.01">
        <div class="validation-message">
            {{ $errors->first('produk.harga') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.harga_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.satuan_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="satuan">{{ trans('cruds.produk.fields.satuan') }}</label>
        <x-select-list class="form-control" required id="satuan" name="satuan" :options="$this->listsForFields['satuan']" wire:model="produk.satuan_id" />
        <div class="validation-message">
            {{ $errors->first('produk.satuan_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.satuan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.kategori_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="kategori">{{ trans('cruds.produk.fields.kategori') }}</label>
        <x-select-list class="form-control" required id="kategori" name="kategori" :options="$this->listsForFields['kategori']" wire:model="produk.kategori_id" />
        <div class="validation-message">
            {{ $errors->first('produk.kategori_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.kategori_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.is_tersedia') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_tersedia" id="is_tersedia" wire:model.defer="produk.is_tersedia">
        <label class="form-label inline ml-1" for="is_tersedia">{{ trans('cruds.produk.fields.is_tersedia') }}</label>
        <div class="validation-message">
            {{ $errors->first('produk.is_tersedia') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.is_tersedia_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('produk.is_tampilkan') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_tampilkan" id="is_tampilkan" wire:model.defer="produk.is_tampilkan">
        <label class="form-label inline ml-1" for="is_tampilkan">{{ trans('cruds.produk.fields.is_tampilkan') }}</label>
        <div class="validation-message">
            {{ $errors->first('produk.is_tampilkan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.produk.fields.is_tampilkan_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.produks.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
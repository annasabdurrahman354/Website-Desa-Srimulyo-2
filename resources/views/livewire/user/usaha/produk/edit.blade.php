<form wire:submit.prevent="submit">
    <div class="relative">

        <div class="form-group {{ $errors->has('produk.nama') ? 'invalid' : '' }}">
            <label class="form-label required" for="nama">{{ trans('cruds.produk.fields.nama') }}</label>
            <input type="text" class="input-text" name="nama" id="nama" required wire:model="nama">
            <div class="validation-message">
                {{ $errors->first('produk.nama') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.produk.fields.nama_helper') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mediaCollections.produk_foto') ? 'invalid' : '' }}">
            <label class="form-label required" for="foto">{{ trans('cruds.produk.fields.foto') }}</label>
            <x-dropzone-image id="foto" name="foto" action="{{ route('admin.produks.storeMedia') }}" collection-name="produk_foto" ratio="4/3" max-files="1" />
            <div class="validation-message">
                {{ $errors->first('mediaCollections.produk_foto') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.produk.fields.foto_helper') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('produk.deskripsi') ? 'invalid' : '' }}">
            <label class="form-label required" for="deskripsi">{{ trans('cruds.produk.fields.deskripsi') }}</label>
            <textarea class="input-textarea" name="deskripsi" id="deskripsi" required wire:model.defer="produk.deskripsi" rows="4"></textarea>
            <div class="validation-message">
                {{ $errors->first('produk.deskripsi') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.produk.fields.deskripsi_helper') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('produk.harga') ? 'invalid' : '' }}">
            <label class="form-label required" for="harga">{{ trans('cruds.produk.fields.harga') }}</label>
            <input class="input-text" type="number" name="harga" id="harga" required wire:model.defer="produk.harga" step="500">
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
            <input class="input-checkbox" type="checkbox" name="is_tersedia" id="is_tersedia" wire:model.defer="produk.is_tersedia">
            <label class="input-label" for="is_tersedia">Apakah produk tersedia?</label>
            <div class="validation-message">
                {{ $errors->first('produk.is_tersedia') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('produk.is_tampilkan') ? 'invalid' : '' }}">
            <input class="input-checkbox" type="checkbox" name="is_tampilkan" id="is_tampilkan" wire:model.defer="produk.is_tampilkan">
            <label class="input-label" for="is_tampilkan">Tampilkan produk?</label>
            <div class="help-block">
                Centang untuk menampilkan produk pada etalase
            </div>
            <div class="validation-message">
                {{ $errors->first('produk.is_tampilkan') }}
            </div>
        </div>

        <div class="form-group">
            <div wire:loading >
                <div class="flex justify-start">
                    <x-loading class="m-auto"/> 
                    <p class="m-auto">Loading</p>
                </div>
            </div>
            <div wire:loading.remove>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
                <a href="{{ route('user.usaha.index') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Batal</a>
            </div>
        </div>   
    </div>
</form>

<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('artikel.judul') ? 'invalid' : '' }}">
        <label class="form-label required" for="judul">{{ trans('cruds.artikel.fields.judul') }}</label>
        <input class="form-control" type="text" name="judul" id="judul" required wire:model.defer="artikel.judul">
        <div class="validation-message">
            {{ $errors->first('artikel.judul') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.judul_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.artikel.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model.defer="artikel.slug">
        <div class="validation-message">
            {{ $errors->first('artikel.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.artikel_gambar') ? 'invalid' : '' }}">
        <label class="form-label required" for="gambar">{{ trans('cruds.artikel.fields.gambar') }}</label>
        <x-dropzone id="gambar" name="gambar" action="{{ route('admin.artikels.storeMedia') }}" collection-name="artikel_gambar" max-file-size="2" max-width="1536" max-height="1024" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.artikel_gambar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.gambar_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.penulis_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="penulis">{{ trans('cruds.artikel.fields.penulis') }}</label>
        <x-select-list class="form-control" required id="penulis" name="penulis" :options="$this->listsForFields['penulis']" wire:model="artikel.penulis_id" />
        <div class="validation-message">
            {{ $errors->first('artikel.penulis_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.penulis_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.rangkuman') ? 'invalid' : '' }}">
        <label class="form-label required" for="rangkuman">{{ trans('cruds.artikel.fields.rangkuman') }}</label>
        <input class="form-control" type="text" name="rangkuman" id="rangkuman" required wire:model.defer="artikel.rangkuman">
        <div class="validation-message">
            {{ $errors->first('artikel.rangkuman') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.rangkuman_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.konten') ? 'invalid' : '' }}">
        <label class="form-label required" for="konten">{{ trans('cruds.artikel.fields.konten') }}</label>
        <textarea class="form-control" name="konten" id="konten" required wire:model.defer="artikel.konten" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('artikel.konten') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.konten_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.jumlah_pembaca') ? 'invalid' : '' }}">
        <label class="form-label required" for="jumlah_pembaca">{{ trans('cruds.artikel.fields.jumlah_pembaca') }}</label>
        <input class="form-control" type="number" name="jumlah_pembaca" id="jumlah_pembaca" required wire:model.defer="artikel.jumlah_pembaca" step="1">
        <div class="validation-message">
            {{ $errors->first('artikel.jumlah_pembaca') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.jumlah_pembaca_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.kategori_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="kategori">{{ trans('cruds.artikel.fields.kategori') }}</label>
        <x-select-list class="form-control" required id="kategori" name="kategori" :options="$this->listsForFields['kategori']" wire:model="artikel.kategori_id" />
        <div class="validation-message">
            {{ $errors->first('artikel.kategori_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.kategori_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.is_diterbitkan') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_diterbitkan" id="is_diterbitkan" wire:model.defer="artikel.is_diterbitkan">
        <label class="form-label inline ml-1" for="is_diterbitkan">{{ trans('cruds.artikel.fields.is_diterbitkan') }}</label>
        <div class="validation-message">
            {{ $errors->first('artikel.is_diterbitkan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.is_diterbitkan_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.artikels.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('syaratLayanan.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.syaratLayanan.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model.defer="syaratLayanan.nama">
        <div class="validation-message">
            {{ $errors->first('syaratLayanan.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.syaratLayanan.fields.nama_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('syaratLayanan.jenis_berkas') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.syaratLayanan.fields.jenis_berkas') }}</label>
        <select class="form-control" wire:model="syaratLayanan.jenis_berkas">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['jenis_berkas'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('syaratLayanan.jenis_berkas') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.syaratLayanan.fields.jenis_berkas_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('syaratLayanan.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label" for="deskripsi">{{ trans('cruds.syaratLayanan.fields.deskripsi') }}</label>
        <input class="form-control" type="text" name="deskripsi" id="deskripsi" wire:model.defer="syaratLayanan.deskripsi">
        <div class="validation-message">
            {{ $errors->first('syaratLayanan.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.syaratLayanan.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.syarat_layanan_berkas_formulir') ? 'invalid' : '' }}">
        <label class="form-label" for="berkas_formulir">{{ trans('cruds.syaratLayanan.fields.berkas_formulir') }}</label>
        <x-dropzone id="berkas_formulir" name="berkas_formulir" action="{{ route('admin.syarat-layanans.storeMedia') }}" collection-name="syarat_layanan_berkas_formulir" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.syarat_layanan_berkas_formulir') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.syaratLayanan.fields.berkas_formulir_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.syarat-layanans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
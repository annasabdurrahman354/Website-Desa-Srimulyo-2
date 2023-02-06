<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('berkasPelayanan.pelayanan_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="pelayanan">{{ trans('cruds.berkasPelayanan.fields.pelayanan') }}</label>
        <x-select-list class="form-control" required id="pelayanan" name="pelayanan" :options="$this->listsForFields['pelayanan']" wire:model="berkasPelayanan.pelayanan_id" />
        <div class="validation-message">
            {{ $errors->first('berkasPelayanan.pelayanan_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.berkasPelayanan.fields.pelayanan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('berkasPelayanan.syarat_layanan_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="syarat_layanan">{{ trans('cruds.berkasPelayanan.fields.syarat_layanan') }}</label>
        <x-select-list class="form-control" required id="syarat_layanan" name="syarat_layanan" :options="$this->listsForFields['syarat_layanan']" wire:model="berkasPelayanan.syarat_layanan_id" />
        <div class="validation-message">
            {{ $errors->first('berkasPelayanan.syarat_layanan_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.berkasPelayanan.fields.syarat_layanan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('berkasPelayanan.teks_syarat') ? 'invalid' : '' }}">
        <label class="form-label" for="teks_syarat">{{ trans('cruds.berkasPelayanan.fields.teks_syarat') }}</label>
        <input class="form-control" type="text" name="teks_syarat" id="teks_syarat" wire:model.defer="berkasPelayanan.teks_syarat">
        <div class="validation-message">
            {{ $errors->first('berkasPelayanan.teks_syarat') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.berkasPelayanan.fields.teks_syarat_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.berkas_pelayanan_berkas_syarat') ? 'invalid' : '' }}">
        <label class="form-label" for="berkas_syarat">{{ trans('cruds.berkasPelayanan.fields.berkas_syarat') }}</label>
        <x-dropzone id="berkas_syarat" name="berkas_syarat" action="{{ route('admin.berkas-pelayanans.storeMedia') }}" collection-name="berkas_pelayanan_berkas_syarat" max-file-size="5" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.berkas_pelayanan_berkas_syarat') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.berkasPelayanan.fields.berkas_syarat_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('berkasPelayanan.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.berkasPelayanan.fields.status') }}</label>
        @foreach($this->listsForFields['status'] as $key => $value)
            <label class="radio-label"><input type="radio" name="status" wire:model="berkasPelayanan.status" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('berkasPelayanan.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.berkasPelayanan.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('berkasPelayanan.catatan_reviewer') ? 'invalid' : '' }}">
        <label class="form-label required" for="catatan_reviewer">{{ trans('cruds.berkasPelayanan.fields.catatan_reviewer') }}</label>
        <input class="form-control" type="text" name="catatan_reviewer" id="catatan_reviewer" required wire:model.defer="berkasPelayanan.catatan_reviewer">
        <div class="validation-message">
            {{ $errors->first('berkasPelayanan.catatan_reviewer') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.berkasPelayanan.fields.catatan_reviewer_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.berkas-pelayanans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
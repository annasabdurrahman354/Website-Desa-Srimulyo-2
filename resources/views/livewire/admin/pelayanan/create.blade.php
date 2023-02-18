<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('pelayanan.pemohon_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="pemohon">{{ trans('cruds.pelayanan.fields.pemohon') }}</label>
        <x-select-list class="form-control" required id="pemohon" name="pemohon" :options="$this->listsForFields['pemohon']" wire:model="pelayanan.pemohon_id" />
        <div class="validation-message">
            {{ $errors->first('pelayanan.pemohon_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.pemohon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.jenis_layanan_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="jenis_layanan">{{ trans('cruds.pelayanan.fields.jenis_layanan') }}</label>
        <x-select-list class="form-control" required id="jenis_layanan" name="jenis_layanan" :options="$this->listsForFields['jenis_layanan']" wire:model="pelayanan.jenis_layanan_id" />
        <div class="validation-message">
            {{ $errors->first('pelayanan.jenis_layanan_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.jenis_layanan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.kode') ? 'invalid' : '' }}">
        <label class="form-label required" for="kode">{{ trans('cruds.pelayanan.fields.kode') }}</label>
        <input class="form-control" type="text" name="kode" id="kode" required wire:model.defer="pelayanan.kode">
        <div class="validation-message">
            {{ $errors->first('pelayanan.kode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.kode_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.catatan_pemohon') ? 'invalid' : '' }}">
        <label class="form-label" for="catatan_pemohon">{{ trans('cruds.pelayanan.fields.catatan_pemohon') }}</label>
        <input class="form-control" type="text" name="catatan_pemohon" id="catatan_pemohon" wire:model.defer="pelayanan.catatan_pemohon">
        <div class="validation-message">
            {{ $errors->first('pelayanan.catatan_pemohon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.catatan_pemohon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.catatan_reviewer') ? 'invalid' : '' }}">
        <label class="form-label" for="catatan_reviewer">{{ trans('cruds.pelayanan.fields.catatan_reviewer') }}</label>
        <input class="form-control" type="text" name="catatan_reviewer" id="catatan_reviewer" wire:model.defer="pelayanan.catatan_reviewer">
        <div class="validation-message">
            {{ $errors->first('pelayanan.catatan_reviewer') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.catatan_reviewer_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.pelayanan.fields.status') }}</label>
        <select class="form-control" wire:model="pelayanan.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('pelayanan.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.pelayanan_berkas_hasil') ? 'invalid' : '' }}">
        <label class="form-label" for="berkas_hasil">{{ trans('cruds.pelayanan.fields.berkas_hasil') }}</label>
        <x-dropzone id="berkas_hasil" name="berkas_hasil" action="{{ route('admin.pelayanans.storeMedia') }}" collection-name="pelayanan_berkas_hasil" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.pelayanan_berkas_hasil') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.berkas_hasil_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.rating') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.pelayanan.fields.rating') }}</label>
        <x-rating wire:model="pelayanan.rating"/>
        <div class="validation-message">
            {{ $errors->first('pelayanan.rating') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.rating_helper') }}
        </div>
    </div>
    <br>
    <div class="form-group {{ $errors->has('pelayanan.penilaian_pemohon') ? 'invalid' : '' }}">
        <label class="form-label" for="penilaian_pemohon">{{ trans('cruds.pelayanan.fields.penilaian_pemohon') }}</label>
        <textarea class="form-control" name="penilaian_pemohon" id="penilaian_pemohon" wire:model.defer="pelayanan.penilaian_pemohon" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('pelayanan.penilaian_pemohon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.penilaian_pemohon_helper') }}
        </div>
    </div>

    <div class="form-group" wire:loading.remove>
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.pelayanans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
    <div class="form-group" wire:loading>
        <x-loading/>
    </div>
</form>
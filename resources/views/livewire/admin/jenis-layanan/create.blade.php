<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('jenisLayanan.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.jenisLayanan.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model.defer="jenisLayanan.nama">
        <div class="validation-message">
            {{ $errors->first('jenisLayanan.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.jenisLayanan.fields.nama_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('jenisLayanan.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label required" for="deskripsi">{{ trans('cruds.jenisLayanan.fields.deskripsi') }}</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" required wire:model.defer="jenisLayanan.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('jenisLayanan.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.jenisLayanan.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('jenisLayanan.biaya') ? 'invalid' : '' }}">
        <label class="form-label required" for="biaya">{{ trans('cruds.jenisLayanan.fields.biaya') }}</label>
        <input class="form-control" type="number" name="biaya" id="biaya" required wire:model.defer="jenisLayanan.biaya" step="0.01">
        <div class="validation-message">
            {{ $errors->first('jenisLayanan.biaya') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.jenisLayanan.fields.biaya_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('jenisLayanan.pelayanan_online') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="pelayanan_online" id="pelayanan_online" wire:model.defer="jenisLayanan.pelayanan_online">
        <label class="form-label inline ml-1" for="pelayanan_online">{{ trans('cruds.jenisLayanan.fields.pelayanan_online') }}</label>
        <div class="validation-message">
            {{ $errors->first('jenisLayanan.pelayanan_online') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.jenisLayanan.fields.pelayanan_online_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('syarat_layanan') ? 'invalid' : '' }}">
        <label class="form-label" for="syarat_layanan">{{ trans('cruds.jenisLayanan.fields.syarat_layanan') }}</label>
        <x-select-list class="form-control" id="syarat_layanan" name="syarat_layanan" wire:model="syarat_layanan" :options="$this->listsForFields['syarat_layanan']" multiple />
        <div class="validation-message">
            {{ $errors->first('syarat_layanan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.jenisLayanan.fields.syarat_layanan_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.jenis-layanans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
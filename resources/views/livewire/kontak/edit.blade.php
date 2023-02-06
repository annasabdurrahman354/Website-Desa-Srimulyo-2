<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('kontak.nama') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama">{{ trans('cruds.kontak.fields.nama') }}</label>
        <input class="form-control" type="text" name="nama" id="nama" required wire:model.defer="kontak.nama">
        <div class="validation-message">
            {{ $errors->first('kontak.nama') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kontak.fields.nama_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('kontak.kontak') ? 'invalid' : '' }}">
        <label class="form-label required" for="kontak">{{ trans('cruds.kontak.fields.kontak') }}</label>
        <input class="form-control" type="text" name="kontak" id="kontak" required wire:model.defer="kontak.kontak">
        <div class="validation-message">
            {{ $errors->first('kontak.kontak') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kontak.fields.kontak_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('kontak.jenis_kontak') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.kontak.fields.jenis_kontak') }}</label>
        <select class="form-control" wire:model="kontak.jenis_kontak">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['jenis_kontak'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('kontak.jenis_kontak') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kontak.fields.jenis_kontak_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.kontaks.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
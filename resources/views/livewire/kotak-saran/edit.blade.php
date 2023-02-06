<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('kotakSaran.pengirim') ? 'invalid' : '' }}">
        <label class="form-label" for="pengirim">{{ trans('cruds.kotakSaran.fields.pengirim') }}</label>
        <input class="form-control" type="text" name="pengirim" id="pengirim" wire:model.defer="kotakSaran.pengirim">
        <div class="validation-message">
            {{ $errors->first('kotakSaran.pengirim') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kotakSaran.fields.pengirim_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('kotakSaran.nomor_telepon') ? 'invalid' : '' }}">
        <label class="form-label" for="nomor_telepon">{{ trans('cruds.kotakSaran.fields.nomor_telepon') }}</label>
        <input class="form-control" type="text" name="nomor_telepon" id="nomor_telepon" wire:model.defer="kotakSaran.nomor_telepon">
        <div class="validation-message">
            {{ $errors->first('kotakSaran.nomor_telepon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kotakSaran.fields.nomor_telepon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('kotakSaran.isi') ? 'invalid' : '' }}">
        <label class="form-label required" for="isi">{{ trans('cruds.kotakSaran.fields.isi') }}</label>
        <textarea class="form-control" name="isi" id="isi" required wire:model.defer="kotakSaran.isi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('kotakSaran.isi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.kotakSaran.fields.isi_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.kotak-sarans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
<div class="relative">
    <form wire:submit.prevent="submit">
        <div class="form-group {{ $errors->has('pelayanan.jenis_layanan_id') ? 'invalid' : '' }}">
            <label class="form-label required" for="jenis_layanan">{{ trans('cruds.pelayanan.fields.jenis_layanan') }}</label>
            <x-select-list class="form-control" required id="jenis_layanan" name="jenis_layanan" :options="$this->listsForFields['jenis_layanan']" wire:model="jenis" />
            <div class="validation-message">
                {{ $errors->first('pelayanan.jenis_layanan_id') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.pelayanan.fields.jenis_layanan_helper') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('pelayanan.catatan_pemohon') ? 'invalid' : '' }}">
            <label class="form-label" for="catatan_pemohon">Sisipkan Catatan</label>
            <input type="text" name="catatan_pemohon" id="catatan_pemohon" class="user-input-text" placeholder="Tuliskan catatan Anda untuk petugas" wire:model.defer="pelayanan.catatan_pemohon">
            <div class="validation-message">
                {{ $errors->first('pelayanan.catatan_pemohon') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.pelayanan.fields.catatan_pemohon_helper') }}
            </div>
        </div>
        @if ($jenis)
        <div class="form-group {{ $errors->has('pelayanan.berkas_syarat') ? 'invalid' : '' }}">
            <label class="form-label" for="pelayanan.berkas_syarat">Unggah Persyaratan</label>
            @foreach ( $semuaBerkas as $berkas)
                <livewire:input-berkas-syarat :berkas="$berkas" :semuaError="$semuaError">
            @endforeach
        </div>
        @endif

        <div class="form-group">
            <button type="button" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" {{!$semuaError ? "" : "disabled"}}>Ajukan</button>
            <a href="{{ route('user.pelayanan') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Batal</a>
        </div>
    </form>
</div>
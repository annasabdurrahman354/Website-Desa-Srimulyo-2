<h2>
    <div class="flex items-center justify-between w-full p-2 font-medium text-left border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white" >
    <span class="flex items-center">                
        <svg class="w-5 h-5 mr-2 shrink-0"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="9" y1="7" x2="10" y2="7" />  <line x1="9" y1="13" x2="15" y2="13" />  <line x1="13" y1="17" x2="15" y2="17" /></svg>
        {{ $berkas_pelayanan->syaratLayanan->nama }}
        </span>
    </div>
</h2>
<div >
    <div class="p-5 font-light border border-t-0 border-gray-200 dark:border-gray-700">
        @if($berkas_pelayanan->syaratLayanan->deskripsi != "" || !is_null($berkas_pelayanan->syaratLayanan->deskripsi))
        <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $berkas_pelayanan->syaratLayanan->deskripsi }}</p>
        @endif

        @if(!$berkas_pelayanan->syaratLayanan->berkas_formulir->isEmpty())
        @foreach($berkas_pelayanan->syaratLayanan->berkas_formulir as $key => $entry)
            <a class="link-light-blue" href="{{ $entry['url'] }}">
                <i class="far fa-file">
                </i>
                {{ $entry['file_name'] }}
            </a>
        @endforeach
        @endif

        @if($berkas_pelayanan->syaratLayanan->jenis_berkas === 'Teks'){
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
        }
        @else{
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
        }
        @endif
    </div>
</div>
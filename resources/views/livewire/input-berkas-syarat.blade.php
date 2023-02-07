<h2>
    <div class="flex items-center justify-between w-full p-2 font-medium text-left border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white" >
    <span class="flex items-center">                
        <svg class="w-5 h-5 mr-2 shrink-0"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="9" y1="7" x2="10" y2="7" />  <line x1="9" y1="13" x2="15" y2="13" />  <line x1="13" y1="17" x2="15" y2="17" /></svg>
        {{ $berkas->syaratLayanan->nama }}
        </span>
    </div>
</h2>
<div >
    <div class="p-5 font-light border border-t-0 border-gray-200 dark:border-gray-700">
        @if($berkas->syaratLayanan->deskripsi != "" || !is_null($berkas->syaratLayanan->deskripsi))
        <p class="mb-3 font-light text-gray-500 dark:text-gray-400">{{ $berkas->syaratLayanan->deskripsi }}</p>
        @endif

        @if(!$berkas->syaratLayanan->berkas_formulir->isEmpty())
        @foreach($berkas->syaratLayanan->berkas_formulir as $key => $entry)
            <a class="link-light-blue mb-2" href="{{ $entry['url'] }}">
                <i class="far fa-file">
                </i>
                Formulir pengisian : {{ $entry['file_name'] }}
            </a>
        @endforeach
        @endif

        @if($berkas->syaratLayanan->jenis_berkas === 'Teks')
            <div class="form-group {{ $errors->has('berkas.teks_syarat') ? 'invalid' : '' }}">
                <label class="form-label" for="teks_syarat">{{ trans('cruds.berkas.fields.teks_syarat') }}</label>
                <input class="form-control" type="text" name="teks" id="teks" wire:model="berkas.teks_syarat">
                <div class="validation-message">
                    {{ $errors->first('berkas.teks_syarat') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.berkas.fields.teks_syarat_helper') }}
                </div>
            </div>
        @elseif($berkas->syaratLayanan->jenis_berkas === 'Dokumen')
            <div class="form-group {{ $errors->has('file') ? 'invalid' : '' }}" >
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Pilih Berkas</label>
                <input wire:model="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file" name="file" type="file" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .pdf">
                <div class="validation-message">
                    {{ $errors->first('file') }}
                </div>
            </div>
        @elseif($berkas->syaratLayanan->jenis_berkas === 'Foto')
            <div class="form-group {{ $errors->has('file') ? 'invalid' : '' }}">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Pilih Foto</label>
                <input wire:model="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file" name="file" type="file" accept="image/png, image/jpeg">
                <div class="validation-message">
                    {{ $errors->first('file') }}
                </div>
            </div>
        @endif
    </div>
</div>

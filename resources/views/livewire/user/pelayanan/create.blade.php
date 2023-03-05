<div>
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
            <a href="{{route('user.home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Dashboard
            </a>
            </li>
            <li>
            <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <a href="{{route('user.pelayanan.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Pelayanan</a>
            </div>
            </li>
            <li aria-current="page">
            <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Pelayanan Baru</span>
            </div>
            </li>
        </ol>
    </nav>
    <div class="relative">
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
        @if ($jenis)
        <div class="form-group">
            <label class="form-label" for="catatan_pemohon">Deskripsi Layanan</label>
            <div class="border-2 border-gray-300 border-dashed w-full h-fit p-2 rounded-md">
                <p>
                    {{$pelayanan->jenisLayanan->deskripsi}}
                </p>
            </div>
        </div>
         @endif
        <div class="form-group {{ $errors->has('pelayanan.catatan_pemohon') ? 'invalid' : '' }}">
            <label class="form-label" for="catatan_pemohon">Sisipkan Catatan</label>
            <input type="text" name="catatan_pemohon" id="catatan_pemohon" class="input-textarea" placeholder="Tuliskan catatan Anda untuk petugas" wire:model.defer="pelayanan.catatan_pemohon">
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
            @foreach ( $this->syarats as $index => $syarat)
            <div :key="syarat_{{ $index }}">
                <h6>
                    <div class="flex items-center justify-between w-full p-2 font-medium text-left border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white" >
                        <span class="flex items-center @error('inputs.' . $index) {{'text-red-500'}} @enderror">                
                            <svg class="w-5 h-5 mr-2 shrink-0"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="9" y1="7" x2="10" y2="7" />  <line x1="9" y1="13" x2="15" y2="13" />  <line x1="13" y1="17" x2="15" y2="17" /></svg>
                            {{ $syarat['nama'] }}
                        </span>
                    </div>
                </h6>
                <div >
                    <div class="p-5 font-light border border-t-0 border-gray-200 dark:border-gray-700">
                        @if($syarat['deskripsi'] != "" || !is_null($syarat['deskripsi']))
                        <p class="mb-3 font-light text-gray-500 dark:text-gray-400">{{ $syarat['deskripsi'] }}</p>
                        @endif

                        @if(!$syarat->berkas_formulir->isEmpty())
                            @foreach($syarat['berkas_formulir'] as $key => $entry)
                            <x-message info>
                                <x-slot:title>
                                    Berkas Formulir
                                </x-slot>
                                <div>
                                    <strong>Isi formulir berikut lalu upload!</strong>
                                </div> 
                                <div>
                                <a class="link-light-blue mb-4 mt-2 text-base" href="{{ $entry['url'] }}">
                                    <i class="far fa-file">
                                    </i>
                                    Formulir: {{ $entry['file_name'] }}
                                </a>
                                </div>
                            </x-message>   
                            @endforeach
                        @endif
                        <div class="form-group">
                            @if($syarat['jenis_berkas'] === 'Teks')
                                <label class="form-label" for="teks_syarat_{{$index}}">{{ trans('cruds.berkasPelayanan.fields.teks_syarat') }}</label>
                                <input wire:model.defer="inputs.{{ $index }}" :key="syarat_{{ $index }}_input" class="input-text" type="text" name="teks" id="teks">
                            @elseif($syarat['jenis_berkas'] === 'Dokumen')
                                <label class="form-label" for="file">Pilih Berkas</label>
                                <input wire:model.defer="inputs.{{ $index }}" :key="syarat_{{ $index }}_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file" name="file" type="file" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .pdf">
                            @elseif($syarat['jenis_berkas'] === 'Foto')
                                <label class="form-label" for="file">Pilih Foto</label>
                                <input wire:model.defer="inputs.{{ $index }}" :key="syarat_{{ $index }}_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file" name="file" type="file" accept="image/png, image/jpeg">
                            @endif
                            @error('inputs.' . $index) <span class="error input-error">{{ str_replace('inputs.' . $index, $syarat['nama'], $message) }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
        @endif
        <div class="form-group">
            <div wire:loading >
                <div class="flex justify-start">
                    <x-loading class="m-auto"/> 
                    <p class="m-auto">Loading</p>
                </div>
            </div>
            <div wire:loading.remove>
                <button type="button" wire:click="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ajukan</button>
                <a href="{{ route('user.pelayanan.index') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Batal</a>
            </div>
        </div>       
    </div>
</div>


<div class="relative">
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
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{$pelayanan->kode}}</span>
            </div>
            </li>
        </ol>
    </nav>
    <div>
        <div class="form-group flex flex-wrap justify-between">
            <h4>
                {{"Layanan "}}{{$pelayanan->jenisLayanan->nama." ".$pelayanan->kode}} 
            </h4>
            @if ($pelayanan->status_label == "Selesai" && $pelayanan->rating == null)
                <button data-modal-target="penilaian-modal" data-modal-toggle="penilaian-modal" type="button" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Berikan Penilaian
                </button>

            @elseif($pelayanan->status_label == "Selesai" && $pelayanan->rating)
                <x-rating disabled value="{{$pelayanan->rating}}"/>
            @endif
        </div>
        <div class="form-group">
           <div class="border-2 border-gray-300 border-dashed w-full h-fit p-2 rounded-md">
                <p>
                    {{$pelayanan->jenisLayanan->deskripsi}}
                </p>
           </div>
        </div>

        @if ($pelayanan->status_label == "Revisi")
            <div class="form-group">
                <x-message error>
                    <x-slot:title>
                        Terdapat Kesalahan
                    </x-slot>
                    <strong>Whoops!</strong> Beberapa berkas perlu direvisi!
                </x-message>
            </div>
        @elseif ($pelayanan->status_label == "Selesai")
            <div class="form-group">
                <x-message success>
                    <x-slot:title>
                        Pelayanan Selesai
                    </x-slot>
                     @if($pelayanan->berkas_hasil->isNotEmpty())
                        @foreach($pelayanan->berkas_hasil as $key => $entry)
                            Anda bisa mengunduh berkas permohonan Anda berikut:
                            <a class="link-light-blue mx-auto text-sm font-semibold" href="{{ $entry['url'] }}">
                                <i class="far fa-file">
                                </i>
                                {{ $entry['file_name'] }}
                            </a>
                        @endforeach
                        @elseif($pelayanan->status_label == "Selesai" && $pelayanan->berkas_hasil->isEmpty())
                            @if($pelayanan->catatan_reviewer)
                                {{$pelayanan->catatan_reviewer}}
                            @else
                                Silahkan ambil berkas di kantor desa!
                            @endif
                        @endif
                </x-message>
            </div>
        @elseif ($pelayanan->status_label == "Dibatalkan")
            <div class="form-group">
                <x-message info>
                    <x-slot:title>
                        Pelayanan Dibatalkan
                    </x-slot>
                        Permohonan pelayanan Anda telah dibatalkan!
                </x-message>
            </div>
        @elseif ($pelayanan->status_label == "Terkirim")
            <div class="form-group">
                <x-message info>
                    <x-slot:title>
                        Permohonan Terkirim
                    </x-slot>
                        Mohon tunggu petugas untuk melakukan verifikasi!
                </x-message>
            </div>
        @elseif (!$pelayanan->isBerkasRevisi() && $pelayanan->status_label != "Terkirim" && !$pelayanan->isAllBerkasDiterima())
            <div class="form-group">
                <x-message info>
                    <x-slot:title>
                        Tahap Verifikasi
                    </x-slot>
                        Syarat pelayanan Anda saat ini sedang diverfikasi!
                </x-message>
            </div>
        @elseif ($pelayanan->isAllBerkasDiterima() && $pelayanan->status_label != "Selesai")
            <div class="form-group">
                <x-message info>
                    <x-slot:title>
                        Tahap Pengerjaan
                    </x-slot>
                        Mohon tunggu untuk proses pengerjaan berkas Anda!
                </x-message>
            </div>
        @endif
        
        @if ($pelayanan->catatan_pemohon != "")
            <div class="form-group {{ $errors->has('pelayanan.catatan_pemohon') ? 'invalid' : '' }}">
                <label class="form-label" for="catatan_pemohon">Catatan Anda</label>
                <input type="text" name="catatan_pemohon" id="catatan_pemohon" class="input-textarea" placeholder="{{$pelayanan->catatan_pemohon}}" disabled>
            </div>
        @endif

        <div class="form-group">
            <label class="form-label" for="pelayanan.berkas_jenis">Berkas Persyaratan</label>
            @foreach ( $berkasPelayananByType as $index => $jenis)
            <div class="form-group">
                <div :key="jenis_{{ $index }}">
                    <div >
                        <div class="flex items-center justify-between w-full p-2 font-medium text-left border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white" >
                            <span class="flex items-center">                
                                <svg class="w-5 h-5 mr-2 shrink-0"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="9" y1="7" x2="10" y2="7" />  <line x1="9" y1="13" x2="15" y2="13" />  <line x1="13" y1="17" x2="15" y2="17" /></svg>
                                {{ $jenis['nama'] }}
                                @if ($jenis['perlu_revisi'] == true)
                                    <span class="badge-red-bordered items-center ml-2">Perlu Revisi</span>
                                @endif
                            </span>
                            @if ($jenis['perlu_revisi'] == true)
                            <a href="{{ route('user.pelayanan.revisi', ['pelayanan' => $pelayanan, 'syaratLayanan' => $jenis['jenis']]) }}" class="button-yellow-extrasmall rounded"> Revisi</a>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-hidden border">
                        <div class="overflow-x-auto">
                            <table class="table table-index w-full">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">
                                            Waktu Upload
                                        </th>

                                        @if ($jenis['jenis_berkas'] == "Teks")
                                        <th style="text-align:center">
                                            Input
                                        </th>
                                        @else
                                        <th style="text-align:center">
                                            {{ trans('cruds.berkasPelayanan.fields.berkas_syarat') }}
                                        </th>
                                        @endif
                                        <th style="text-align:center">
                                            {{ trans('cruds.berkasPelayanan.fields.catatan_reviewer') }}
                                        </th>
                                        <th style="text-align:center">
                                            {{ trans('cruds.berkasPelayanan.fields.status') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jenis['berkas'] as $berkasPelayanan)
                                        <tr>
                                            <td class="w-fit whitespace-nowrap text-center justify-center">
                                               {{\Carbon\Carbon::parse($berkasPelayanan->created_at)->format('d-m-Y H:i')}}
                                            </td>
                                            @if ($jenis['jenis_berkas'] == "Teks")
                                                <td class="text-center justify-center">
                                                    {{ $berkasPelayanan->teks_syarat }}
                                                </td>
                                            @else
                                                <td class="flex justify-center">
                                                    @foreach($berkasPelayanan->berkas_syarat as $key => $entry)
                                                    <div>
                                                        <a class="link-light-blue mx-auto" href="{{ $entry['url'] }}">
                                                            <i class="far fa-file">
                                                            </i>
                                                            {{ $entry['file_name'] }}
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </td>
                                            @endif
                                            <td class="text-center justify-center">
                                                {{ $berkasPelayanan->catatan_reviewer }}
                                            </td>
                                             <td class="text-center justify-center">
                                                @if ($berkasPelayanan->status_label == "Verifikasi" && $pelayanan->status_label == "Terkirim" )
                                                    Menunggu Verifikasi
                                                @else
                                                    {{ $berkasPelayanan->status_label }}
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10">Tidak ada data ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
    @if ($pelayanan->status_label == "Verifikasi")
        
    @endif

    @if ($pelayanan->status_label == "Selesai" && $pelayanan->rating == null)
        <!-- Main modal -->
        <div id="penilaian-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="penilaian-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Berikan Penilaian Anda</h3>
                        <div class="space-y-6">
                            <div class="form-group {{ $errors->has('pelayanan.rating') ? 'invalid' : '' }}">
                                <label class="form-label required">{{ trans('cruds.pelayanan.fields.rating') }}</label>
                                <x-rating disabled value="{{$pelayanan->rating}}" wire:model.defer="pelayanan.rating"/>
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
                                <textarea class="input-textarea" name="penilaian_pemohon" id="penilaian_pemohon" wire:model.defer="pelayanan.penilaian_pemohon" rows="4"></textarea>
                                <div class="validation-message">
                                    {{ $errors->first('pelayanan.penilaian_pemohon') }}
                                </div>
                                <div class="help-block">
                                    {{ trans('cruds.pelayanan.fields.penilaian_pemohon_helper') }}
                                </div>
                            </div>
                            <button wire:click="nilai" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endif
</div>


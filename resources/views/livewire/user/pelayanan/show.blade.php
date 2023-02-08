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
                <a href="{{route('user.pelayanan')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Pelayanan</a>
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
        <div class="form-group">
            <h4>
                {{$pelayanan->jenisLayanan->nama}}
            </h4>
        </div>
        <div class="form-group">
           <div class="border-2 border-gray-300 border-dashed w-full h-fit p-2 rounded-md">
                <p>
                    {{$pelayanan->jenisLayanan->deskripsi}}
                </p>
           </div>
        </div>
        @if ($pelayanan->catatan_pemohon != "")
        <div class="form-group {{ $errors->has('pelayanan.catatan_pemohon') ? 'invalid' : '' }}">
            <label class="form-label" for="catatan_pemohon">Catatan Anda</label>
            <input type="text" name="catatan_pemohon" id="catatan_pemohon" class="input-textarea" placeholder="Tuliskan catatan Anda untuk petugas" disabled value="{{$pelayanan->catatan_pemohon}}">
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
                                                {{ $berkasPelayanan->status_label }}
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
</div>


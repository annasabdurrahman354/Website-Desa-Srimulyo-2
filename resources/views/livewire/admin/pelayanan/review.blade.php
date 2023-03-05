<div class="pt-3">
    <div class="form-group {{ $errors->has('pelayanan.pemohon_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="pemohon">{{ trans('cruds.pelayanan.fields.pemohon') }}</label>
        <input class="form-control" type="text" name="pemohon" id="pemohon" placeholder="{{$pelayanan->pemohon->name}}" disabled>
        <div class="validation-message">
            {{ $errors->first('pelayanan.pemohon_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.pemohon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.jenis_layanan_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="jenis_layanan">{{ trans('cruds.pelayanan.fields.jenis_layanan') }}</label>
        <input class="form-control" type="text" name="jenis_layanan" id="jenis_layanan" placeholder="{{$pelayanan->jenisLayanan->nama}}" disabled>
        <div class="validation-message">
            {{ $errors->first('pelayanan.jenis_layanan_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.jenis_layanan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.kode') ? 'invalid' : '' }}">
        <label class="form-label required" for="kode">{{ trans('cruds.pelayanan.fields.kode') }}</label>
        <input class="form-control" type="text" name="kode" id="kode" placeholder="{{$pelayanan->kode}}" disabled>
        <div class="validation-message">
            {{ $errors->first('pelayanan.kode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.kode_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('pelayanan.catatan_pemohon') ? 'invalid' : '' }}">
        <label class="form-label" for="catatan_pemohon">{{ trans('cruds.pelayanan.fields.catatan_pemohon') }}</label>
        <input class="form-control" type="text" name="catatan_pemohon" id="catatan_pemohon" placeholder="{{$pelayanan->catatan_pemohon ? $pelayanan->catatan_pemohon : "Tidak ada catatan" }}" disabled>
        <div class="validation-message">
            {{ $errors->first('pelayanan.catatan_pemohon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.pelayanan.fields.catatan_pemohon_helper') }}
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="pelayanan.berkas_jenis">Berkas Persyaratan</label>
        @foreach ( $berkasPelayananByType as $index => $jenis)
        <div class="form-group">
            <div :key="jenis_{{ $index }}">
                <div >
                    <div class="md:flex md:flex-nowrap space-y-2 md:space-y-0 items-center justify-between w-full p-2 font-medium text-left border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white" >
                        <span class="flex items-center">                
                            <svg class="w-5 h-5 mr-2 shrink-0"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="9" y1="7" x2="10" y2="7" />  <line x1="9" y1="13" x2="15" y2="13" />  <line x1="13" y1="17" x2="15" y2="17" /></svg>
                            {{ $jenis['nama'] }}
                            @if ($jenis['status'] == "Revisi")
                                <span class="bg-blue-300 border-blue-600 border rounded-full py-0.5 px-2 ml-2 text-gray-800">Menunggu Revisi</span>
                            @endif
                            @if ($jenis['status'] == "Verifikasi")
                                <span class="bg-yellow-300 border-yellow-600 border rounded-full py-0.5 px-2 ml-2 text-gray-800">Perlu Verifikasi</span>
                            @endif
                        </span>
                        @if ($jenis['status'] == 'Verifikasi')
                        <a href="{{ route('admin.berkas-pelayanans.review', ['berkasPelayanan' => $jenis['berkas'][0]['id']]) }}" class="btn btn-primary">Verifikasi</a>
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
                                            {{\Carbon\Carbon::parse($berkasPelayanan['created_at'])->format('d-m-Y H:i')}}
                                        </td>
                                        @if ($jenis['jenis_berkas'] == "Teks")
                                            <td class="text-center justify-center">
                                                {{ $berkasPelayanan['teks_syarat'] }}
                                            </td>
                                        @else
                                            <td class="flex justify-center">
                                                @foreach($berkasPelayanan['berkas_syarat'] as $key => $entry)
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
                                            {{ $berkasPelayanan['catatan_reviewer'] }}
                                        </td>
                                            <td class="text-center justify-center">
                                            @if ($berkasPelayanan['status'] == "Verifikasi" && $pelayanan['status'] == "Terkirim" )
                                                Menunggu Verifikasi
                                            @else
                                                {{ $berkasPelayanan['status'] }}
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
    
    @if ($pelayanan->isAllBerkasDiterima())
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
    @endif
    
    <div class="{{$pelayanan->status_label == "Selesai" ? "visible" : "hidden"}}">
        <div class="form-group {{ $errors->has('pelayanan.catatan_reviewer') ? 'invalid' : '' }}">
            <label class="form-label required" for="catatan_reviewer">{{ trans('cruds.pelayanan.fields.catatan_reviewer') }}</label>
            <input required class="form-control" type="text" name="catatan_reviewer" id="catatan_reviewer" wire:model.defer="pelayanan.catatan_reviewer">
            <div class="validation-message">
                {{ $errors->first('pelayanan.catatan_reviewer') }}
            </div>
            <div class="help-block">
                Tuliskan catatan untuk pengirim permohonan pelayanan!
            </div>
        </div>
        <div class="{{$pelayanan->jenisLayanan->pelayanan_online ? "visible" : "hidden"}} form-group {{ $errors->has('mediaCollections.pelayanan_berkas_hasil') ? 'invalid' : '' }}">
            <label class="form-label required" for="berkas_hasil">{{ trans('cruds.pelayanan.fields.berkas_hasil') }}</label>
            <x-dropzone id="berkas_hasil" name="berkas_hasil" action="{{ route('admin.pelayanans.storeMedia') }}" collection-name="pelayanan_berkas_hasil" />
            <div class="validation-message">
                {{ $errors->first('mediaCollections.pelayanan_berkas_hasil') }}
            </div>
            <div class="help-block">
                Unggah berkas digital yang diminta!
            </div>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2 {{$pelayanan->status_label == "Selesai" ? "visible" : "hidden"}}" type="button" wire:click="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.pelayanans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</div>
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Pelayanan</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="card-controls sm:flex sm:justify-between">
        <div class="flex items-center grow ">   
            <label for="simple-search" class="sr-only">Cari</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model.debounce.300ms="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari">
            </div>
        </div>
        <div wire:loading.delay class="m-auto ml-2">
            <x-loading/>
        </div>
        <a href="{{route("user.pelayanan.create")}}" type="button" class="font-bold mt-2 sm:my-auto sm:ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Permohonan</a>
    </div>
    
    <div class="mt-4 overflow-hidden rounded-md border border-gray-300">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th style="text-align:center">
                            {{ trans('cruds.pelayanan.fields.kode') }}
                            @include('components.table.sort', ['field' => 'kode'])
                        </th>
                        <th style="text-align:center">
                            {{ trans('cruds.pelayanan.fields.jenis_layanan') }}
                            @include('components.table.sort', ['field' => 'jenis_layanan.nama'])
                        </th>
                        <th style="text-align:center">
                            Layanan Digital
                            @include('components.table.sort', ['field' => 'jenis_layanan.pelayanan_online'])
                        </th>
                        <th style="text-align:center">
                            {{ trans('cruds.pelayanan.fields.catatan_reviewer') }}
                            @include('components.table.sort', ['field' => 'catatan_reviewer'])
                        </th>
                        <th style="text-align:center">
                            Tanggal Pengajuan
                        </th>
                        <th style="text-align:center">
                            Status
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelayanans as $pelayanan)
                        <tr>
                            <td class="w-fit whitespace-nowrap text-center justify-center">
                                <p>{{ $pelayanan->kode }}</p>
                            </td>
                            <td class="text-center justify-center">
                                @if($pelayanan->jenisLayanan)
                                    <span class="badge-blue whitespace-nowrap">{{ $pelayanan->jenisLayanan->nama ?? '' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($pelayanan->jenisLayanan)
                                    @if($pelayanan->berkas_hasil->isNotEmpty())
                                    <div class="mx-auto flex justify-center">
                                        @foreach($pelayanan->berkas_hasil as $key => $entry)
                                            <a class="link-light-blue" href="{{ $entry['url'] }}">
                                                <i class="far fa-file">
                                                </i>
                                                {{ $entry['file_name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                    @elseif($pelayanan->status_label == "Selesai" && $pelayanan->berkas_hasil->isEmpty())
                                    <div class="mx-auto flex justify-center">
                                        <p class="link-light-blue">
                                            Ambil Berkas di Kantor
                                        </p>                                     
                                    </div>
                                    @else
                                    <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $pelayanan->jenisLayanan->pelayanan_online ? 'checked' : '' }}>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center justify-center line-clamp-3">
                                {{ $pelayanan->catatan_reviewer }}
                            </td>
                            <td class="text-center justify-center">
                              {{\Carbon\Carbon::parse($pelayanan->created_at)->format('d-m-Y')}}
                            </td>
                            <td class="text-center justify-center">
                                @if($pelayanan->status_label == "Terkirim" || $pelayanan->status_label == "Verifikasi")
                                    <span class="badge-blue">{{ $pelayanan->status_label }}</span>
                                @endif
                                @if($pelayanan->status_label == "Revisi")
                                    <span class="badge-red">{{ $pelayanan->status_label }}</span>
                                @endif
                                @if($pelayanan->status_label == "Selesai" || $pelayanan->status_label == "Dibatalkan")
                                    <span class="badge-green">{{ $pelayanan->status_label }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center">
                                        @if ($pelayanan->isBerkasRevisi() && !$pelayanan->isPelayananSelesai())
                                            <a class="button-red-small my-auto block" href="{{ route('user.pelayanan.show', $pelayanan) }}">
                                                Revisi
                                            </a>
                                        @elseif(!$pelayanan->isBerkasRevisi() && !$pelayanan->isPelayananSelesai())
                                            <a class="button-blue-small my-auto block" href="{{ route('user.pelayanan.show', $pelayanan) }}">
                                                Lihat
                                            </a>
                                        @elseif($pelayanan->isPelayananSelesai())
                                            <a class="button-green-small my-auto block" href="{{ route('user.pelayanan.show', $pelayanan) }}">
                                                Lihat
                                            </a>
                                        @endif
                                </div>
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

    <div class="card-body">
        <div class="pt-2">
            {{ $pelayanans->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush
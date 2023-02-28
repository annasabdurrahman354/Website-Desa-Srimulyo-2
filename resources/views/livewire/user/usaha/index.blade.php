<div class="relative">
    @if ($umkm)
        <div class="flex h-fit w-full items-center justify-between align-middle">
            <h1 class="text-2xl underline underline-offset-4 decoration-4 decoration-blue-500 tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">{{$umkm->nama_umkm}}</h2>
            <a href="{{route('user.usaha.edit')}}" class="text-white text-sm font-bold bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah Profil UMKM</a>
        </div>
        @if (!$umkm->is_aktif)
            <div class="mt-2">
            <x-message warning>
                <x-slot:title>
                    UMKM Anda tidak Aktif!
                </x-slot>
                <strong>Penting!</strong> Ubah status aktif agar terpublikasi!
            </x-message>
            </div>
        @endif
        <div wire:ignore class="lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-4 mt-4">
            <div id="default-carousel" class="relative basis-full lg:basis-7/12 h-64 lg:h-96 bg-gray-700 rounded-lg shadow" data-carousel="static" wire:ignore>
                <!-- Carousel wrapper -->
                <div  class="relative w-full h-full rounded-md">
                    <div class="relative w-full h-full overflow-hidden rounded-md shadow">
                        @foreach ( $umkm->carousel as $carousel)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{$carousel['url']}}" class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>            
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="sr-only">Sebelumnya</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span class="sr-only">Selanjutnya</span>
                        </span>
                    </button>
                </div>
            </div>
                
            <div class="basis-full w-full overflow-y-auto lg:basis-5/12 h-fit lg:h-96 flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <ul class="flex-none flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                    <li class="mr-2">
                            <button id="bio-tab" data-tabs-target="#bio" type="button" role="tab" aria-controls="bio" aria-selected="true" class="inline-block p-4 text-base font-bold text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">BIO</button>
                    </li>
                    <li class="mr-2">
                            <button id="peta-tab" data-tabs-target="#peta" type="button" role="tab" aria-controls="peta" aria-selected="false" class="inline-block p-4 font-bold text-base hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">PETA</button>
                    </li>
                </ul>

                <div id="defaultTabContent" class="w-full flex-auto">
                    <div class="hidden p-4 relative bg-white rounded-lg dark:bg-gray-800 h-full" id="bio" role="tabpanel" aria-labelledby="bio-tab">
                        <div class="flex flex-col justify-between h-full">
                            <div>
                                <div class="flex space-x-3 items-center align-middle justify-between mb-2">
                                    <div class="flex space-x-3 items-center align-middle">
                                        <img class="w-10 h-10 rounded-full" src="{{$umkm->pemilik->avatar}}" alt="Rounded avatar">
                                        <span class="text-lg font-semibold ">{{$umkm->pemilik->name}}</span>
                                    </div>
                                    <span class="pl-2 text-gray-500 inline-flex items-center leading-none text-sm mt">
                                        <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Terlihat {{" ".$umkm->waktu_keterlihatan->diffForHumans()}}
                                    </span>
                                </div>
                                <hr>
                                <p class="mt-2 mb-3 text-gray-700 font-medium dark:text-gray-400">{{$umkm->deskripsi}}</p>
                            </div>
                         
                            <div class="flex flex-wrap space-x-2">
                                @if ($umkm->url_hubungi != '')
                                <a href="{{$umkm->url_hubungi}}" class="inline-flex items-center w-fit px-3 py-2 text-base font-medium text-center text-green-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="text-green-600 w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                    Hubungi Penjual
                                </a>
                                @endif
                                <a href="{{$umkm->url_arah}}" class="inline-flex items-center w-fit px-3 py-2 text-base font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M413.6 92.1c4.9-11.9 2.1-25.6-7-34.7s-22.8-11.9-34.7-7l-352 144C5.7 200.2-2.3 215.2 .6 230.2s16.1 25.8 31.4 25.8H208V432c0 15.3 10.8 28.4 25.8 31.4s30-5.1 35.8-19.3l144-352z"/></svg>
                                    Petunjuk Arah
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="hidden p-0 bg-white rounded-lg dark:bg-gray-800" id="peta" role="tabpanel" aria-labelledby="peta-tab">
                        <div id="map" class="z-10 h-80 w-full shadow my-auto" wire:ignore></div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-6 text-xl underline underline-offset-4 decoration-4 decoration-blue-500 tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Daftar Produk</h2>

        <div class="card-controls sm:flex sm:justify-between mt-4">
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
            <a href="{{route("user.usaha.produk.create")}}" type="button" class="font-bold mt-2 sm:my-auto sm:ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Produk</a>
        </div>
        
        <div class="mt-4 overflow-hidden rounded-md border border-gray-300">
            <div class="overflow-x-auto">
                <table class="table table-index w-full">
                    <thead>
                        <tr>
                            <th style="text-align:center">
                                {{ trans('cruds.produk.fields.nama') }}
                                @include('components.table.sort', ['field' => 'nama'])
                            </th>
                            <th style="text-align:center">
                                {{ trans('cruds.produk.fields.foto') }}
                            </th>
                            <th style="text-align:center">
                                {{ trans('cruds.produk.fields.deskripsi') }}
                                @include('components.table.sort', ['field' => 'deskripsi'])
                            </th>
                            <th style="text-align:center">
                                {{ trans('cruds.produk.fields.harga') }}
                                @include('components.table.sort', ['field' => 'harga'])
                            </th>
                            <th style="text-align:center">
                                {{ trans('cruds.produk.fields.satuan') }}
                                @include('components.table.sort', ['field' => 'satuan.satuan'])
                            </th>
                            <th style="text-align:center">
                            {{ trans('cruds.produk.fields.kategori') }}
                                @include('components.table.sort', ['field' => 'kategori.kategori'])
                            </th>
                            <th style="text-align:center">
                            {{ trans('cruds.produk.fields.is_tersedia') }}
                                @include('components.table.sort', ['field' => 'is_tersedia'])
                            </th>
                            <th style="text-align:center">
                            {{ trans('cruds.produk.fields.is_tampilkan') }}
                                @include('components.table.sort', ['field' => 'is_tampilkan'])
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $produk)
                            <tr>
                                <td class="w-fit whitespace-nowrap text-center justify-center">
                                    <p>{{ $produk->nama }}</p>
                                </td>
                                <td class="text-center ">
                                    @foreach($produk->foto as $key => $entry)
                                        <a class="link-photo" href="{{ $entry['url'] }}">
                                            <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td class="text-center justify-center">
                                    {{ $produk->deskripsi }}
                                </td>
                                <td class="text-center justify-center">
                                    {{ $produk->harga }}
                                </td>
                                <td class="text-center justify-center">
                                    <span class="badge badge-relationship">{{ $produk->satuan->satuan ?? '' }}</span>
                                </td>
                                <td class="text-center justify-center">
                                @if($produk->kategori)
                                        <span class="badge badge-relationship">{{ $produk->kategori->kategori ?? '' }}</span>
                                    @endif
                                </td>
                                <td class="text-center justify-center">
                                    <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produk->is_tersedia ? 'checked' : '' }}>
                                </td>
                                <td class="text-center justify-center">
                                    <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produk->is_tampilkan ? 'checked' : '' }}>
                                </td>
                            
                                <td>
                                    <div class="flex justify-center">
                                        <a class="button-blue-small my-auto block" href="{{ route('user.usaha.produk.edit', $produk->slug) }}">
                                            Ubah
                                        </a> 
                                        <button class="button-red-small my-auto block ml-2" type="button" wire:click="confirm('delete', {{ $produk->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">Tidak ada produk yang didaftarkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-2">
                {{ $produks->links() }}
            </div>
        </div>
    @else
    <div class="alert flex flex-row items-center border-2 border-blue-300 border-dashed w-full h-fit p-2 bg-blue-50 rounded-md">
        <div class="alert-icon flex items-center bg-blue-100 border-2 border-blue-500 justify-center h-10 w-10 ml-2 flex-shrink-0 rounded-full">
            <span class="text-blue-500">
                <svg fill="currentColor"
                        viewBox="0 0 20 20"
                        class="h-6 w-6">
                    <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                </svg>
            </span>
        </div>
        <div class="alert-content ml-4 flex justify-between items-center align-middle h-full w-full">
            <div class="">
                <div class="alert-title font-semibold text-lg text-blue-800">
                    Anda belum mendaftarkan UMKM!
                </div>
                <div class="alert-description text-sm text-blue-600">
                    <p>Ajukan pendaftaran UMKM dengan klik tombol disamping!</p>
                </div>
            </div>
            <a href="{{route('user.usaha.register')}}" class="text-white text-sm font-bold bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-full px-5 py-2.5 text-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Daftarkan UMKM</a>
        </div>
    </div>
    @endif
    
</div>
@push('styles')
    @once
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <link rel="stylesheet" href="{{asset('vendor/leaflet.awesome-markers/leaflet.awesome-markers.css')}}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
    @endonce
@endpush
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin="" ></script>
    <script type="text/javascript" src="{{ asset('vendor/leaflet.awesome-markers/leaflet.awesome-markers.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script>
		var map = L.map('map').setView([@js($umkm->latitude), @js($umkm->longitude)], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var lc = L.control
			.locate({
				position: "topleft",
				setView: 'untilPanOrZoom',
				flyTo: true,          
				strings: {
					title: "Show me where I am, yo!"
				}
			})
			.addTo(map);

		function onLocationFound(e) {
            var radius = e.accuracy;

			L.marker(e.latlng).addTo(map)
				.bindPopup("Kemungkinan Anda berada " + radius + " meter dari titik ini!").openPopup();
        }

        map.on('locationfound', onLocationFound);

        document.addEventListener('livewire:load', function () {
			marker = new L.marker([@js($umkm->latitude), @js($umkm->longitude)], {icon: L.AwesomeMarkers.icon({icon: @js($umkm->icon), markerColor: @js($umkm->color), prefix: 'fa', iconColor: 'black'}) })
				.bindTooltip(@js($umkm->nama_umkm), 
				{
					direction: 'top',
					offset: [0,-50],
				})
                .on('click', function(e) {
                  window.open(@js($umkm->url_arah))
                });
				map.addLayer(marker);
		})

        document.getElementById("peta-tab").onclick = function() {  
            window.dispatchEvent(new Event('resize'));
            map.invalidateSize();  
        };  
    </script>

    <script>
        Livewire.on('confirm', e => {
            if (!confirm("Anda yakin menghapus produk?")) {
                return
            }
        @this[e.callback](...e.argv)
        })
    </script>
@endpush
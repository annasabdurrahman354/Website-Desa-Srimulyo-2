<div class="container w-full h-full mx-auto dark:bg-gray-900"> 
   <section class="text-gray-600 body-font container px-4 pt-12 pb-12 flex flex-col mx-auto">
      <div>
         <div class="flex flex-col">
            <div class="h-1 rounded overflow-hidden">
               <div class="w-32 h-full bg-blue-500"></div>
            </div>
            <div class="mt-1 flex flex-wrap md:flex-nowrap sm:flex-row mb-4 items-center align-middle justify-between space-y-2">
               <h2 class="text-2xl tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">{{ $umkm->nama_umkm }}</h2>
            </div>
         </div>
      </div>

      <div wire:ignore class="lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-4">
         <div id="default-carousel" class="relative basis-full lg:basis-7/12 h-64 lg:h-96 bg-gray-700 rounded-lg shadow-md" data-carousel="static" wire:ignore>
            <!-- Carousel wrapper -->
            <div  class="relative w-full h-full rounded-md">
               <div class="relative w-full h-full overflow-hidden rounded-md shadow-md">
                     @if (count($umkm->carousel) == 0)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('image/img-fallback-2.1.png')}}" class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div> 
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('image/img-fallback-2.1.png')}}" class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div> 
                     @elseif(count($umkm->carousel) == 1)
                        @foreach ($umkm->carousel as $carousel)
                            <div class="duration-700 ease-in-out">
                                <img src="{{$carousel['url']}}" class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>  
                        @endforeach
                     @else
                        @foreach ($umkm->carousel as $carousel)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{$carousel['url']}}" class="absolute block object-cover w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>            
                        @endforeach
                     @endif
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
            
         <div class="basis-full w-full overflow-y-auto  lg:basis-5/12 h-fit lg:h-96 flex flex-col bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <ul class="flex-none flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
               <li class="mr-2">
                     <button id="bio-tab" data-tabs-target="#bio" type="button" role="tab" aria-controls="bio" aria-selected="true" class="inline-block p-4 text-base font-semibold text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">BIO</button>
               </li>
               <li class="mr-2">
                     <button id="peta-tab" data-tabs-target="#peta" type="button" role="tab" aria-controls="peta" aria-selected="false" class="inline-block p-4 font-semibold text-base hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">PETA</button>
               </li>
            </ul>

            <div id="defaultTabContent" class="w-full flex-auto">
               <div class="hidden p-4 relative bg-white rounded-lg dark:bg-gray-800 overflow-y-auto h-full" id="bio" role="tabpanel" aria-labelledby="bio-tab">
                  <div class="flex flex-col justify-between h-full">
                     <div>
                        <div class="flex space-x-3 items-center align-middle justify-between mb-2">
                           <div class="flex space-x-3 items-center align-middle">
                              <img class="w-10 h-10 rounded-full" src="{{$umkm->pemilik->avatar}}" alt="Rounded avatar">
                              <span class="text-base md:text-lg font-semibold ">{{$umkm->pemilik->name}}</span>
                           </div>
                           <span class="pl-2 text-gray-500 inline-flex items-center leading-none text-sm mt">
                              <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                 <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                 <circle cx="12" cy="12" r="3"></circle>
                              </svg>
                              Aktif {{" ".$umkm->waktu_keterlihatan->diffForHumans()}}
                           </span>
                        </div>
                        <hr>
                        <p class="mt-2 mb-3 text-gray-700 font-medium dark:text-gray-400">{{$umkm->deskripsi}}</p>
                     </div>
                     <div class="flex flex-wrap space-x-2">
                        @if ($umkm->url_hubungi != '')
                           <a href="{{$umkm->url_hubungi}}" class="inline-flex items-center w-fit px-3 py-2 text-sm sm:text-base font-medium text-center text-green-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="text-green-600 w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                              Hubungi Penjual
                           </a>
                        @endif
                        <a href="{{$umkm->url_arah}}" class="inline-flex items-center w-fit px-3 py-2 text-sm sm:text-base font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M413.6 92.1c4.9-11.9 2.1-25.6-7-34.7s-22.8-11.9-34.7-7l-352 144C5.7 200.2-2.3 215.2 .6 230.2s16.1 25.8 31.4 25.8H208V432c0 15.3 10.8 28.4 25.8 31.4s30-5.1 35.8-19.3l144-352z"/></svg>
                           Petunjuk Arah
                        </a>
                     </div>
                  </div>
               </div>
               <div class="hidden p-0 bg-white rounded-lg dark:bg-gray-800" id="peta" role="tabpanel" aria-labelledby="peta-tab">
                  <div id="map" class="z-10 h-80 w-full shadow-md my-auto" wire:ignore></div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="bg-white rounded-md shadow-md mt-4 p-4">
         <div class="flex flex-wrap md:flex-nowrap sm:flex-row mb-4 items-center align-middle text-center justify-between space-y-4 md:space-y-0">
            <h2 class="text-xl underline underline-offset-4 decoration-4 decoration-sky-500 tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Etalase Produk</h2>
            <div class="flex flex-nowrap items-center align-middle space-x-2 w-full h-full md:w-fit justify-between">
               <div class="relative flex-grow md:flex-grow-0">
                  <input type="text" wire:model="search" id="search-dropdown" class="block font-medium rounded-lg text-sm w-full h-fit px-3 py-1.5 z-20 text-gray-900 bg-gray-50 border-gray-300 border-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Cari produk..." required>
                  <div class="absolute top-0 right-0 bottom-0 p-2 text-sm font-medium">
                     <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                     <span class="sr-only">Search</span>
                  </div>
               </div>

               <!-- dropdown button -->
               <button id="dropdownKategoriProdukButton" data-dropdown-toggle="dropdownKategoriProdukRadio" class="whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-full px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  {{$kategoriNama}}
                  <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
               </button>

               <!-- Kategori dropdown radio -->
               <div id="dropdownKategoriProdukRadio" class="z-40 hidden w-fit bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="p-3 space-y-3 text-sm columns-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownKategoriProdukButton">
                     <li>
                        <div class="flex items-center">
                              <input checked id="kategori-all" type="radio" value="" wire:click="setKategori('', 'Semua Kategori')" name="kategori-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                              <label for="default-radio2-2" class="whitespace-nowrap ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Semua</label>
                        </div>
                     </li>
                     @foreach ( $kategoris as $kategori )
                        <li>
                           <div class="flex items-center">
                              <input id="{{'kategori-'.$kategori['kategori']}}" type="radio" value="{{$kategori['id']}}" wire:click="setKategori('{{$kategori['id']}}', '{{$kategori['kategori']}}')" name="kategori-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                              <label for="default-radio2-1" class="whitespace-nowrap ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$kategori['kategori']}}</label>
                           </div>
                        </li>
                     @endforeach
                  </ul>
               </div>
            </div>            
         </div>
         <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 relative">
            @forelse ( $produks as $produk)
            <div class="w-full h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
               <div class="absolute z-30 right-2 top-2 bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-1 rounded-full dark:bg-gray-700 dark:text-gray-400">
                  {{$produk->kategori->kategori}}
               </div>
               <div >
                  <img class="rounded-t-lg w-full" src="{{$produk->getFirstMediaUrl('produk_foto')}}" alt="" />
               </div>
               <div class="p-5 h-full flex flex-col justify-between">
                  <div>
                     <div class="flex flex-nowrap items-center align-middle text-center">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produk->nama}}</h5>
                        @if (!$produk->is_tersedia)
                           <span class="ml-1 badge-red w-fit h-fit">Habis</span>
                        @endif
                     </div>

                     <div class="flex flex-nowrap items-center align-middle text-center mb-2 mt-1">
                        <span class="text-lg font-semibold">Rp</span> <span class="text-blue-700 text-lg font-bold slashed-zero ml-1">{{getHargaRupiah($produk->harga)}}</span><span class="text-xs -mb-2">{{' /'.$produk->satuan->satuan}}</span>
                     </div>
                     <p class="line-clamp-3 mb-3 font-normal text-gray-700 dark:text-gray-400">{{$produk->deskripsi}}</p>
                  </div>
                  <div class="flex justify-between items-center w-full">
                     <a href="{{$produk->is_tersedia ? $produk['url_beli'] : $produk['url_tanya_tersedia']}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-green-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="text-green-600 w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                           @if ($produk->is_tersedia)
                           Beli Sekarang
                           @else
                           Tanya Penjual
                           @endif
                     </a>
                  </div>
               </div>
            </div>
            @empty
            <div class="w-full">
               Tidak ada produk terdaftar!
            </div>
            @endforelse
         </div>
         
         <div class="mt-2">
         {{ $produks->links() }}
         </div>
      </div>
   </section>
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


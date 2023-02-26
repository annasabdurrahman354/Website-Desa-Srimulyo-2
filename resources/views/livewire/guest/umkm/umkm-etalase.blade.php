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
            
         <div class="basis-full w-full lg:basis-5/12 h-fit lg:h-96 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
               <li class="mr-2">
                     <button id="bio-tab" data-tabs-target="#bio" type="button" role="tab" aria-controls="bio" aria-selected="true" class="inline-block p-4 text-base font-semibold text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">BIO</button>
               </li>
               <li class="mr-2">
                     <button id="peta-tab" data-tabs-target="#peta" type="button" role="tab" aria-controls="peta" aria-selected="false" class="inline-block p-4 font-semibold text-base hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">PETA</button>
               </li>
            </ul>

            <div id="defaultTabContent" class="w-full h-full">
               <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="bio" role="tabpanel" aria-labelledby="bio-tab">
                     <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Powering innovation & trust at 200,000+ companies worldwide</h2>
                     <p class="mb-3 text-gray-500 dark:text-gray-400">Empower Developers, IT Ops, and business teams to collaborate at high velocity. Respond to changes and deliver great customer and employee service experiences fast.</p>
                     <a href="#" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        Learn more
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                     </a>
               </div>
               <div class="hidden p-0 bg-white rounded-lg dark:bg-gray-800" id="peta" role="tabpanel" aria-labelledby="peta-tab">
                  <div id="map" class="z-10 h-80 w-full shadow-md my-auto" wire:ignore></div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="bg-white rounded-md shadow-md mt-4 p-4">
         <div class="flex flex-wrap md:flex-nowrap sm:flex-row mb-4 items-center align-middle text-center justify-between space-y-2">
            <h2 class="text-xl underline underline-offset-4 decoration-4 decoration-sky-500 tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Etalase Produk</h2>
            <div class="flex flex-nowrap items-center align-middle space-x-2 w-full h-full md:w-fit justify-between">
               <div class="relative flex-grow md:flex-grow-0">
                  <input type="text" wire:model="search" id="search-dropdown" class="block font-medium rounded-lg text-sm w-full h-fit px-3 py-1.5 z-20 text-gray-900 bg-gray-50 border-gray-300 border-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Cari judul produk..." required>
                  <div class="absolute top-0 right-0 bottom-0 p-2 text-sm font-medium">
                     <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                     <span class="sr-only">Search</span>
                  </div>
               </div>

               <!-- dropdown button -->
               <button id="dropdownKategoriProdukButton" data-dropdown-toggle="dropdownKategoriProdukRadio" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-full px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  {{$kategoriNama}}
                  <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
               </button>

               <!-- Kategori dropdown radio -->
               <div id="dropdownKategoriProdukRadio" class="z-10 hidden w-fit bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
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
                              <input id="{{'kategori-'.$kategori->kategori}}" type="radio" value="{{$kategori->id}}" wire:click="setKategori('{{$kategori->id}}', '{{$kategori->kategori}}')" name="kategori-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                              <label for="default-radio2-1" class="whitespace-nowrap ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$kategori->kategori}}</label>
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
                     <div class="flex flex-wrap divide-x-2 space-x-2 items-center align-middle text-center mb-1">
                        <span class="text-gray-500 inline-flex items-center leading-none text-sm">
                           <svg class="w-4 h-4 mr-1" stroke="currentColor"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                           </svg>
                           {{$produk->umkm->nama_umkm}}
                        </span>
                        <span class="pl-2 text-gray-500 inline-flex items-center leading-none text-sm">
                           <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                           </svg>
                           {{$produk->created_at->diffForHumans()}}
                        </span>
                     </div>
                     <div>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$produk->nama}}</h5>
                     </div>
                     <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$produk->deskripsi}}</p>
                  </div>
                  <div class="flex justify-between items-center w-full">
                     <a href="/www.bing.com" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           Selengkapnya
                           <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
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

@endpush

@push('scripts')
   <script>
		var map = L.map('map').setView([51.505, -0.09], 13);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
         maxZoom: 19,
         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);

      document.getElementById("peta-tab").onclick = function() {  
         window.dispatchEvent(new Event('resize'));
         map.invalidateSize();  
      };  
   </script>
@endpush


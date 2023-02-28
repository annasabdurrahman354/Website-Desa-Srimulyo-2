<div class="container w-full mx-auto dark:bg-gray-900">
   <!-- Umkm section -->
   <section class="text-gray-600 body-font container px-4 pt-12 pb-12 mx-auto">
      <div>
         <div class="flex flex-col">
            <div class="h-1 rounded overflow-hidden">
               <div class="w-32 h-full bg-blue-500"></div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap sm:flex-row mb-4 items-center align-middle justify-between space-y-2">
               <h2 class="text-2xl tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Daftar Umkm {{$kategoriNama == "Semua Kategori" ? "" : $kategoriNama }}</h2>
               
               <div class="flex flex-nowrap items-center space-x-2 w-full md:w-fit justify-between">
                  <div class="relative flex-grow md:flex-grow-0 lg:w-96">
                     <input type="text" wire:model="search" id="search-dropdown" class="block font-medium rounded-lg text-sm w-full h-fit px-3 py-1.5 z-20 text-gray-900 bg-gray-50 border-gray-300 border-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Cari umkm..." required>
                     <div class="absolute top-0 right-0 bottom-0 p-2 text-sm font-medium">
                        <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                     </div>
                  </div>
                  <!-- dropdown button -->
                  <button id="dropdownKategoriUmkmButton" data-dropdown-toggle="dropdownKategoriUmkmRadio" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-full px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                     {{$kategoriNama}}
                     <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                  </button>

                  <!-- Kategori dropdown radio -->
                  <div id="dropdownKategoriUmkmRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                     <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownKategoriUmkmButton">
                        <li>
                           <div class="flex items-center">
                                 <input checked id="kategori-all" type="radio" value="" wire:click="setKategori('', 'Semua Kategori')" name="kategori-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                 <label for="default-radio2-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Semua</label>
                           </div>
                        </li>
                        @foreach ( $kategoris as $kategori )
                           <li>
                              <div class="flex items-center">
                                 <input id="{{'kategori-'.$kategori->kategori}}" type="radio" value="{{$kategori->id}}" wire:click="setKategori('{{$kategori->id}}', '{{$kategori->kategori}}')" name="kategori-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                 <label for="default-radio2-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$kategori->kategori}}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>

               </div>
            </div>
         </div>
      </div>
      
      
      <!-- Umkm list section -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 relative">
         @forelse ( $umkms as $umkm)
            <div class="w-full h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
               <div class="absolute z-30 right-2 top-2 bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-1 rounded-full dark:bg-gray-700 dark:text-gray-400">
                  <span class="mr-1">
                     <i class="fas fa-{{$umkm->icon}}"></i>
                  </span>
                  {{$umkm->kategori->kategori}}
               </div>
               <div >
                  <img class="rounded-t-lg w-full" src="{{$umkm->getFirstMediaUrl('umkm_carousel')}}" alt="" />
               </div>
               <div class="p-5 h-full flex flex-col justify-between">
                  <div>
                     <div class="flex flex-wrap divide-x-2 space-x-2 items-center align-middle text-center mb-1">
                        <span class="text-gray-500 inline-flex items-center leading-none text-sm">
                           <svg class="w-4 h-4 mr-1" stroke="currentColor"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                           </svg>
                           {{$umkm->pemilik->name}}
                        </span>
                        <span class="pl-2 text-gray-500 inline-flex items-center leading-none text-sm">
                           <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                           </svg>
                           Aktif {{" ".$umkm->waktu_keterlihatan->diffForHumans()}}
                        </span>
                     </div>
                     <div>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$umkm->nama_umkm}}</h5>
                     </div>
                     <p class="line-clamp-3 mb-3 font-normal text-gray-700 dark:text-gray-400">{{$umkm->deskripsi}}</p>
                  </div>
                  <div class="flex justify-between items-center w-full">
                     <a href="{{route('guest.umkm.etalase', $umkm->slug)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           Etalase
                           <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                     </a>
                  </div>
               </div>
            </div>
         @empty
         <div class="p-4 w-full">
            Tidak ada UMKM terdaftar!
         </div>
         @endforelse
      </div>
      <div class="mt-2">
      {{ $umkms->links() }}
      </div>
   </section>
</div>
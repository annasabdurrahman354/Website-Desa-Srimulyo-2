<div class="container w-full mx-auto dark:bg-gray-900">
   <!-- Dokumen section -->
   <section class="text-gray-600 body-font container px-4 pt-12 pb-12 mx-auto">
      <div>
         <div class="flex flex-col">
            <div class="h-1 rounded overflow-hidden">
               <div class="w-32 h-full bg-blue-500"></div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap sm:flex-row mb-4 items-center align-middle justify-between space-y-2">
               <h2 class="text-2xl tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Daftar Dokumen {{$tahun == "" ? "" : "Tahun ".$tahun }}</h2>
               
               <div class="flex flex-nowrap items-center space-x-2 w-full md:w-fit justify-between">
                  <div class="relative flex-grow md:flex-grow-0">
                     <input type="text" wire:model="search" id="search-dropdown" class="block font-medium rounded-lg text-sm w-full h-fit px-3 py-1.5 z-20 text-gray-900 bg-gray-50 border-gray-300 border-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Cari judul dokumen..." required>
                     <div class="absolute top-0 right-0 bottom-0 p-2 text-sm font-medium">
                        <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                     </div>
                  </div>
                  <!-- dropdown button -->
                  <button id="dropdownTahunDokumenButton" data-dropdown-toggle="dropdownTahunDokumenRadio" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-full px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                     {{$tahun == "" ? "Tahun Terbit" : $tahun}}
                     <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                  </button>

                  <!-- Tahun dropdown radio -->
                  <div id="dropdownTahunDokumenRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                     <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownTahunDokumenButton">
                        <li>
                           <div class="flex items-center">
                                 <input checked id="tahun-all" type="radio" value="" wire:click="setTahun('{{""}}')" name="tahun-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                 <label for="tahun-all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Semua Tahun</label>
                           </div>
                        </li>
                        @foreach ( $tahuns as $tahun )
                           <li>
                              <div class="flex items-center">
                                 <input id="{{'tahun-'.$tahun}}" type="radio" value="{{$tahun}}" wire:click="setTahun('{{$tahun}}')" name="tahun-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                 <label for="{{'tahun-'.$tahun}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tahun}}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>

               </div>
            </div>
         </div>
      </div>
      
      
      <!-- Dokumen list section -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 relative">
         @forelse ( $dokumenUmums as $dokumenUmum)
            <div class="w-full h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
               <div class="p-5 h-full flex flex-col justify-between">
                  <div>
                     <div class="flex justify-between">
                        <div class="bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-400">Tahun {{" ".$dokumenUmum->tahun_terbit}}</div>
                        <p class="text-sm text-gray-400">{{$dokumenUmum->created_at->diffForHumans()}}</p>
                     </div>
                     <div>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$dokumenUmum->judul}}</h5>
                     </div>
                     <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$dokumenUmum->deskripsi}}</p>
                  </div>
                  <div class="flex justify-between items-center w-full">
                     <a href="{{route('guest.dokumen-umum.show', $dokumenUmum->slug)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           Baca Selengkapnya
                           <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                     </a>
                     
                  </div>
               </div>
            </div>
         @empty
         <div class="p-4 w-full">
            Tidak ada postingan dokumen!
         </div>
         @endforelse
      </div>
      <div class="mt-2">
      {{ $dokumenUmums->links() }}
      </div>
   </section>
</div>
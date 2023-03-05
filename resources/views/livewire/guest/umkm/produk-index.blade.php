<div class="container w-full mx-auto dark:bg-gray-900">
   <!-- Produk section -->
   <section class="text-gray-600 body-font container px-4 pt-12 pb-12 mx-auto">
      <div>
         <div class="flex flex-col">
            <div class="h-1 rounded overflow-hidden">
               <div class="w-32 h-full bg-blue-500"></div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap sm:flex-row mb-4 items-center align-middle justify-between space-y-2">
               <h2 class="text-2xl tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Lapak {{$kategoriNama == "Semua Kategori" ? " Desa" : 'Produk '.$kategoriNama }}</h2>
               
               <div class="flex flex-nowrap items-center space-x-2 w-full md:w-fit justify-between">
                  <div class="relative flex-grow md:flex-grow-0 lg:w-96">
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
                                 <input id="{{'kategori-'.$kategori->kategori}}" type="radio" value="{{$kategori->id}}" wire:click="setKategori('{{$kategori->id}}', '{{$kategori->kategori}}')" name="kategori-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                 <label for="default-radio2-1" class="whitespace-nowrap ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$kategori->kategori}}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>

               </div>
            </div>
         </div>
      </div>
      
      <!-- Produk list section -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 relative">
         @forelse ( $produks as $produk)
            <div class="w-full h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
               <div class="absolute z-30 right-2 top-2 bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-1 rounded-full dark:bg-gray-700 dark:text-gray-400">
                  {{$produk->kategori->kategori}}
               </div>
               <div class="relative w-full h-fit">
                  <img class="rounded-t-lg w-full" src="{{$produk->getFirstMediaUrl('produk_foto')}}" alt="" />
                  <span class="absolute bottom-2 left-2 h-fit  bg-white text-gray-600 w-fit text-sm font-medium py-2 px-3 dark:bg-gray-700 dark:text-gray-400 inline-flex items-center leading-none border rounded-full">
                     <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="3" y1="21" x2="21" y2="21" />  <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />  <path d="M5 21v-10.15" />  <path d="M19 21v-10.15" />  <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" /></svg>
                     {{$produk->umkm->nama_umkm}}
                  </span>
               </div>
               <div class="p-5 h-full flex flex-col justify-between">
                  <div>
                    
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
                     <div class="flex space-x-2 items-center w-full">
                        <a href="{{$produk->is_tersedia ? $produk->url_beli : $produk->url_tanya_tersedia}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-green-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="text-green-600 w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                              @if ($produk->is_tersedia)
                              Beli Sekarang
                              @else
                              Tanya Penjual
                              @endif
                        </a>
                        <a href="{{route('guest.umkm.etalase', $produk->umkm->slug)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           Selengkapnya
                           <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         @empty
         <div class="p-4 w-full">
            Tidak ada produk terdaftar!
         </div>
         @endforelse
      </div>
      <div class="mt-2">
      {{ $produks->links() }}
      </div>
   </section>
</div>
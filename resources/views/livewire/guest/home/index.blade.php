<div class="container w-full mx-auto dark:bg-gray-900">
   <!-- Carousel section -->
   <div id="default-carousel" class="relative w-full" data-carousel="static" wire:ignore>
      <!-- Carousel wrapper -->
      <div class="relative h-56 overflow-hidden md:h-96 rounded-b-md shadow-md">
         @if (count($carousels) == 1)
            <div class="duration-700 ease-in-out">
               <span class="z-30 absolute w-full h-fit pb-6 pt-2 px-6 bottom-0 right-0 left-0 align-middle text-center bg-gray-800/50 backdrop-blur-sm text-white text-lg font-sans font-medium dark:text-gray-800">{{$carousels[0]->judul}}</span>
               @if ($carousels[0]->link_tujuan)
                  <a href="//{{$carousels[0]->link_tujuan}}">
                     <img src="{{$carousels[0]->getFirstMediaUrl('carousel_gambar')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                  </a>
               @else
                  <img src="{{$carousels[0]->getFirstMediaUrl('carousel_gambar')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
               @endisset
            </div>
         @elseif (count($carousels) == 0)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
               <span class="z-30 absolute w-full h-fit pb-6 pt-2 px-6 bottom-0 right-0 left-0 align-middle text-center bg-slate-300/25 backdrop-blur-sm text-white text-base dark:text-gray-800">First Slide</span>
               <img src="{{asset('image/img-fallback1.svg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
               <img src="{{asset('image/img-fallback2.svg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
               <img src="{{asset('image/img-fallback3.svg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
         @else
            @foreach ( $carousels as $carousel)
               <div class="hidden duration-700 ease-in-out" data-carousel-item>
                  <span class="z-30 absolute w-full h-fit pb-6 pt-2 px-6 bottom-0 right-0 left-0 align-middle text-center bg-gray-800/50 backdrop-blur-sm text-white text-lg font-sans font-medium dark:text-gray-800">{{$carousel->judul}}</span>
                  @if ($carousel->link_tujuan)
                     <a href="//{{$carousel->link_tujuan}}">
                        <img src="{{$carousel->getFirstMediaUrl('carousel_gambar')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                     </a>
                  @else
                     <img src="{{$carousel->getFirstMediaUrl('carousel_gambar')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                  @endisset
               </div>
            @endforeach
         @endif   
      </div>
      <!-- Slider indicators -->
      <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-2 left-1/2">
         @forelse (array_keys($carousels->toArray()) as $i)
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="{{$i}}"></button>
         @empty
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
         @endforelse
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
   <!-- Artikel section -->
   <section class="text-gray-600 body-font container px-4 pt-12 pb-12 mx-auto">
      <div>
         <div class="flex flex-col">
            <div class="h-1 rounded overflow-hidden">
               <div class="w-32 h-full bg-blue-500"></div>
            </div>
            <div class="flex flex-wrap sm:flex-row py-1 pb-4 items-center justify-between">
               <h2 class="sm:w-2/5 text-2xl tracking-tighter font-bold text-gray-900 dark:text-white align-middle h-max">Artikel Terkini</h2>
               <div>
                  <!-- Kategori dropdown button -->
                  <button id="dropdownKategoriArtikelButton" data-dropdown-toggle="dropdownKategoriArtikelRadio" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-fit px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                     {{$kategoriNama}}
                     <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                  </button>
                  <a href="{{route('guest.artikel.index')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm h-fit px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                     Artikel Lainnya
                     <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 -mr-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                     </svg>
                  </a>

                  <!-- Kategori dropdown radio -->
                  <div id="dropdownKategoriArtikelRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                     <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownKategoriArtikelButton">
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
      
      <!-- Artikel list section -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 relative">
          @forelse ( $latest_artikel as $artikel)
            <div class="w-full h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
               <div >
                  <img class="rounded-t-lg w-full" src="{{$artikel->getFirstMediaUrl('artikel_gambar')}}" alt="" />
               </div>
               <div class="p-5 h-full flex flex-col justify-between">
                  <div>
                     <div class="flex justify-between">
                        <div class="bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-400">{{$artikel->kategori->kategori}}</div>
                        <p class="text-sm text-gray-400">{{$artikel->created_at->diffForHumans()}}</p>
                     </div>
                     <div>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$artikel->judul}}</h5>
                     </div>
                     <p class="line-clamp-3 mb-3 font-normal text-gray-700 dark:text-gray-400">{{$artikel->rangkuman}}</p>
                  </div>
                  <div class="flex justify-between items-center w-full">
                     <a href="{{route('guest.artikel.show', $artikel->slug)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-blue-500 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                           Baca Selengkapnya
                           <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                     </a>
                     <div>
                        <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                           <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                           </svg>
                           {{$artikel->jumlah_pembaca}}
                        </span>
                        <span class="text-gray-400 inline-flex items-center leading-none text-sm -ml-2">
                           <svg class="w-4 h-4 mr-1" stroke="currentColor"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                           </svg>
                           {{$artikel->penulis->name}}
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         @empty
         <div class="p-4 w-full">
            Tidak ada postingan artikel!
         </div>
         @endforelse

      </div>
   </section>

   <section class="text-gray-600 body-font container px-4 pb-12 mx-auto">

      <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
         <ul class="flex flex-wrap text-lg item font-semibold text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
            <li class="mr-2">
                  <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-tl-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Tentang</button>
            </li>
            <li class="mr-2">
                  <button id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Layanan Digital</button>
            </li>
            <li class="mr-2">
                  <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab" aria-controls="statistics" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">FAQ</button>
            </li>
         </ul>
         <div id="defaultTabContent">
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                  <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Powering innovation & trust at 200,000+ companies worldwide</h2>
                  <p class="mb-3 text-gray-500 dark:text-gray-400">Empower Developers, IT Ops, and business teams to collaborate at high velocity. Respond to changes and deliver great customer and employee service experiences fast.</p>
                  <a href="#" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                     Learn more
                     <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                  </a>
            </div>
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services" role="tabpanel" aria-labelledby="services-tab">
                  <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Kami siap melayani Anda</h2>
                  <!-- List -->
                  <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                     @forelse ($layanans as $layanan)
                        <li class="flex space-x-2">
                           <!-- Icon -->
                           <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                           <span class="font-light leading-tight">{{$layanan->nama}}</span>
                        </li>
                     @empty
                        <li class="flex space-x-2">
                           <!-- Icon -->
                           <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                           <span class="font-light leading-tight">Layanan yang tersedia akan diupdate!</span>
                        </li>
                     @endforelse ()
                     @if (count($layanans) == 10)
                        <li class="flex space-x-2">
                           <!-- Icon -->
                           <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                           <span class="font-light leading-tight">Dan masih banyak lagi..</span>
                        </li>
                     @endif
                  </ul>
            </div>
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                     <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                        <h6 id="accordion-flush-heading-1">
                           <button type="button" class="flex items-center justify-between w-full py-2 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                           <span>Bagaimana cara membuat akun?</span>
                           <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                           </button>
                        </h6>
                        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                           <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                              <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                 <li>
                                    Buka situs web Desa Srimulyo.
                                 </li>
                                 <li>
                                    Klik tombol "Masuk" pada pojok kanan atas.
                                 </li>
                                 <li>
                                    Klik pada tulisan "Daftar".
                                 </li>
                                 <li>
                                    Isi form dengan data yang valid.
                                 </li>
                                 <li>
                                    Klik tombol "Buat Akun".
                                 </li>
                                 <li>
                                    Akun Anda sudah terdaftar. Sekarang Anda bisa mengajukan permohonan layanan atau pendaftaran UMKM.
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <h6 id="accordion-flush-heading-2">
                           <button type="button" class="flex items-center justify-between w-full py-2 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                           <span>Bagaimana cara membuat permohonan pelayanan digital?</span>
                           <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                           </button>
                        </h6>
                        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                           <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                              <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                 <li>
                                    Masuk ke Akun Anda.
                                 </li>
                                 <li>
                                    Lalu buka dashboard User.
                                 </li>
                                 <li>
                                    Masuk ke menu "Pelayanan".
                                 </li>
                                 <li>
                                    Klik tombol "+ Permohonan".
                                 </li>
                                 <li>
                                    Pilih pelayanan yang dikehendaki dan isi catatan jika diperlukan.
                                 </li>
                                 <li>
                                    Isi form berkas syarat sesuai petunjuk.
                                 </li>
                                 <li>
                                    Klik "Ajukan".
                                 </li>
                                 <li>
                                    Permohonan Anda sudah terkirim. Selanjutnya akan diverifikasi oleh petugas.
                                 </li>
                                 <li>
                                    Pantau ajuan permohonan pelayanan Anda melalui notifikasi atau menu pelayanan.
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <h6 id="accordion-flush-heading-3">
                           <button type="button" class="flex items-center justify-between w-full py-2 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                           <span>Bagaimana cara mendaftarkan UMKM di peta digital?</span>
                           <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                           </button>
                        </h6>
                        <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                           <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                              <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                 <li>
                                    Masuk ke Akun Anda.
                                 </li>
                                 <li>
                                    Lalu buka dashboard User.
                                 </li>
                                 <li>
                                    Masuk ke menu "Usaha".
                                 </li>
                                 <li>
                                    Klik tombol "+ Daftarkan UMKM".
                                 </li>
                                 <li>
                                    Isi formulir dengan data yang valid.
                                 </li>
                                 <li>
                                    Cari lokasi UMKM Anda dipeta.
                                 </li>
                                 <li>
                                    Klik "Daftarkan".
                                 </li>
                                 <li>
                                    Pendaftaran UMKM Anda sudah terkirim. Selanjutnya akan diverifikasi oleh petugas.
                                 </li>
                                 <li>
                                    Jika telah terverifikasi, barulah Anda bisa mendaftarkan produk.
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
            </div>
         </div>
      </div>

   </section>
</div>
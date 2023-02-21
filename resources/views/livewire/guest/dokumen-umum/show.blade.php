<div class="container w-full mx-auto dark:bg-gray-900 border-b border-gray-200 dark:border-gray-600">
    <section class="text-gray-600 body-font container px-4 pt-12 pb-12 mx-auto w-full">
      <div class="w-full lg:w-1/2 mx-auto text-center mb-4">
            <p class="font-semibold">{{$dokumenUmum->created_at->isoFormat('dddd, D MMMM Y')}}</p>
            <h2 class="mb-4 font-serif">{{$dokumenUmum->judul}}</h2>
            <p>{{$dokumenUmum->deskripsi}}</p>
      </div>


      <div class="grid grid-flow-row lg:grid-flow-col lg:grid-cols-6 gap-5 relative">

         <div class="border bg-white border-gray-300 rounded-md shadow-sm lg:col-span-4 lg:my-4 w-full h-full">
            <div class="flex flex-col h-full"> 
               <div class="flex justify-between items-center align-middle p-4">
                  <div class="bg-gray-100 text-gray-600 w-fit text-sm font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-400">Tahun Terbit {{" ".$dokumenUmum->tahun_terbit}}</div>
                  <div class="flex gap-2">
                     <button type="button" id="button-share" class="text-center inline-flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-3 py-2 text-xs font-medium dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        <svg  class="w-5 h-5 mr-2 -ml-1"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="6" cy="12" r="3" />  <circle cx="18" cy="6" r="3" />  <circle cx="18" cy="18" r="3" />  <line x1="8.7" y1="10.7" x2="15.3" y2="7.3" />  <line x1="8.7" y1="13.3" x2="15.3" y2="16.7" /></svg>
                        Bagikan
                     </button>
                     <button type="button" id="button-copy-link" class="text-center inline-flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-3 py-2 text-xs font-medium dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 mr-2 -ml-1"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />  <rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                        Salin Link
                     </button>
                  </div>
               </div>
              
               <hr class="flex-1 w-full border border-gray-300 sm:mx-auto dark:border-gray-700" />

               <div class="w-full h-full px-4 py-4 hidden">
                     @if ($dokumenUmum->berkas_dokumen_type == "pdf")
                        <embed  class="w-full h-full border border-gray-500 rounded-md" class="w-full h-full border border-gray-500 rounded-md" src="{{$dokumenUmum->berka_dokumen_url}}" type="application/pdf">
                     @else
                        <iframe
                           src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://infolab.stanford.edu/pub/papers/google.pdf#toolbar=0&scrollbar=0"
                           frameBorder="0"
                           scrolling="auto"
                           height="100%"
                           width="100%"
                        ></iframe>
                     @endif
               </div>

               <div class="w-full h-full px-4 py-4">
                     @if ($dokumenUmum->berkas_dokumen_type == "pdf")
                        <div class="h-full w-full flex flex-col">
                           <div id="results" class="w-full h-fit p-3 border-2 border-dashed border-spacing-1 rounded-md bg-white">
                              <p>Peramban Anda tidak bisa menampilkan berkas. <a class="text-blue-700 hover:text-blue-500 hover:underline" href="{{$dokumenUmum->berka_dokumen_url}}"> Klik disini untuk mengunduh! </a></p>
                           </div>

                           <div id="pdf" class="w-full h-full border border-gray-500"></div>
                        </div>
                     @endif
               </div>
            </div>
         </div>
         <div class="lg:col-span-2 w-full grid grid-flow-row grid-rows-1 gap-6 h-full mt-4">
            <div class="border bg-white border-gray-300 rounded-md shadow-sm p-4">
               <h6 class="mb-2">Cari Artikel</h6>
               <form class="flex items-center">   
                  <label for="simple-search" class="sr-only">Search</label>
                  <div class="relative w-full">
                     <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                           <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                     </div>
                     <input type="text" id="simple-search" wire:model="query" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                  </div>
                  <button type="button" wire:click="search" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                     <span class="sr-only">Search</span>
                  </button>
               </form>
               <h6 class="mt-4 text-base">Kategori Artikel</h6>
               <div class="mt-2 flex flex-row flex-wrap gap-1">
                  @foreach ($kategoris as $kategori)
                     <a href="{{route('guest.artikel.index', ['kategori' => $kategori->id])}}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-blue-400 border border-blue-400">{{$kategori->kategori}}</a>
                  @endforeach
               </div>
            </div>
            <div class="border bg-white border-gray-300 rounded-md shadow-sm p-4">
               <h6 class="mb-2">Artikel Terkini</h6>
               <div class="w-full grid grid-flow-row grid-cols-1 space-y-2 divide-y-2">
                  <hr class="border-gray-300 sm:mx-auto dark:border-gray-700" />
                  @foreach ($artikels as $artikel)
                     <div class="w-full">
                        <div class="h-full w-full bg-white border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                           <div class="p-4">
                              <div class="bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-400">{{$artikel->kategori->kategori}}</div>
                              <div>
                                 <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$artikel->judul}}</h5>
                              </div>
                              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$artikel->rangkuman}}</p>
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
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>


   </section>
</div>

@push('scripts')
      <script>
         document.getElementById('button-share').addEventListener('click', event => {
            if (navigator.share) {
               navigator.share({
                  title: '{!!$artikel->judul!!}',
                  url: window.location.href,
               }).then(() => {
                  console.log('Thanks for sharing! {!!$artikel->judul!!} in '+ window.location.href);
               }).catch(console.error);
            }
         });

         document.getElementById('button-copy-link').addEventListener('click', event => {
            navigator.clipboard.writeText(window.location.href);
         });
      </script> 
@endpush

@push('scripts')
    <script src="https://unpkg.com/pdfobject@2.2.8/pdfobject.min.js"></script>
    <script>
        var options = {
            pdfOpenParams: {
                navpanes: 0,
                toolbar: 0,
                statusbar: 0,
                view: "FitV",
                pagemode: "thumbs",
            },
            forcePDFJS: false,
            PDFJS_URL: "{{ asset('pdfjs/web/viewer.html') }}"
        };

        var myPDF = PDFObject.embed("{{$dokumenUmum->berka_dokumen_url ?? null}}", "#pdf", options);

        var el = document.querySelector("#results");
        el.setAttribute("class", (myPDF) ? "hidden" : "");

        var el = document.querySelector("#pdf");
        el.setAttribute("class", (myPDF) ? "" : "hidden");
    </script>
@endpush
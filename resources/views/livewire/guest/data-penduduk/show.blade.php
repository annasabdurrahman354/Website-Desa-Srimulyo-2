<div class="container w-full mx-auto dark:bg-gray-900">
    <section class="text-gray-600 body-font container px-4 pt-12 pb-12 mx-auto w-full">
      <div class="w-full lg:w-1/2 mx-auto text-center mb-4">
            <p class="font-semibold">{{'Diunggah '.$dataPenduduk->created_at->isoFormat('dddd, D MMMM Y')}}</p>
            <h2 class="mb-4 font-serif">{{$dataPenduduk->judul}}</h2>
            <p>{{$dataPenduduk->deskripsi}}</p>
      </div>


      <div class="grid grid-flow-row lg:grid-flow-col lg:grid-cols-6 gap-5 relative">
         <div class="border bg-white border-gray-300 rounded-md shadow-sm lg:col-span-4 lg:my-4 w-full h-full">
            <div class="flex flex-col h-full w-full overflow-x-hidden"> 
               <div class="md:flex justify-between items-center align-middle p-4 space-y-3 md:space-y-0">
                  <div class="bg-gray-100 text-gray-600 w-fit text-sm font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-400">Tahun Pembaruan {{" ".$dataPenduduk->tahun_pembaruan}}</div>
                  <div class="flex gap-2">
                     <button type="button" id="button-share" class="text-center inline-flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-3 py-2 text-xs font-medium dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        <svg  class="w-5 h-5 mr-2 -ml-1"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="6" cy="12" r="3" />  <circle cx="18" cy="6" r="3" />  <circle cx="18" cy="18" r="3" />  <line x1="8.7" y1="10.7" x2="15.3" y2="7.3" />  <line x1="8.7" y1="13.3" x2="15.3" y2="16.7" /></svg>
                        Bagikan
                     </button>
                     <button type="button" id="button-copy-link" class="hidden md:inline-flex text-center items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-3 py-2 text-xs font-medium dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 mr-2 -ml-1"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" />  <rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                        Salin Link
                     </button>
                     <a href="{{$dataPenduduk->getFirstMediaUrl('data_penduduk_berkas_data')}}" id="button-download" class="text-center inline-flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-3 py-2 text-xs font-medium dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 mr-2 -ml-1"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download
                     </a>
                  </div>
               </div>
               <hr>
               <div class="px-4 py-4 h-96 w-full relative">
                  <canvas id="myChart" class="max-w-full max-h-96" wire:ignore></canvas>
               </div>
               <div id="excel_data" class="mt-5" wire:ignore></div>
            </div>
         </div>
         <div class="lg:col-span-2 w-full grid grid-flow-row grid-rows-1 gap-6 h-full mt-4">
            <div class="space-y-4">
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
                     @forelse ($artikels as $artikel)
                        <div class="w-full">
                           <div class="h-full w-full bg-white border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                              <div class="p-4">
                                 <div class="bg-gray-100 text-gray-600 w-fit text-sm font-medium mb-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-400">{{$artikel->kategori->kategori}}</div>
                                 <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$artikel->judul}}</h5>
                                 </div>
                                 <p class="line-clamp-3 mb-3 font-normal text-gray-700 dark:text-gray-400">{{$artikel->rangkuman}}</p>
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
                     @empty
                     Belum ada postingan artikel!
                     @endforelse
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

@push('styles')
      <link rel="stylesheet" href="https://unpkg.com/excel-viewer@1.0.0/dist/excel/xspreadsheet.css">
@endpush

@push('scripts')
      <script>
         document.getElementById('button-share').addEventListener('click', event => {
            if (navigator.share) {
               navigator.share({
                  title: '{!!$dataPenduduk->judul!!}',
                  url: window.location.href,
               }).then(() => {
                  console.log('Thanks for sharing! {!!$dataPenduduk->judul!!} in '+ window.location.href);
               }).catch(console.error);
            }
         });

         document.getElementById('button-copy-link').addEventListener('click', event => {
            navigator.clipboard.writeText(window.location.href);
         });
      </script> 
@endpush

@push('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
   <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datasource"></script>
   <script src="https://github.com/nagix/chartjs-plugin-colorschemes/releases/download/v0.4.0/chartjs-plugin-colorschemes.js"></script>        
   <script>
      const url = "{{$dataPenduduk->getFirstMediaUrl('data_penduduk_berkas_data')}}";
      fetch(url)
      .then(response => response.arrayBuffer())
      .then(data => {
         var reader = new FileReader();
         reader.onload = function(event){
            var work_book = XLSX.read(new Uint8Array(reader.result), {type:'array'});
            var sheet_name = work_book.SheetNames;
            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});
            if(sheet_data.length > 0)
            {
                  var table_output = '<table class="table table-striped table-bordered w-full overflow-x-scroll border rounded-lg">';
                  for(var row = 0; row < sheet_data.length; row++)
                  {
                     table_output += '<tr>';
                     for(var cell = 0; cell < sheet_data[row].length; cell++)
                     {
                        if(row == 0)
                        {
                           if(sheet_data[row][cell]){
                              table_output += '<th class="text-lg" style="text-align:center">'+sheet_data[row][cell]+'</th>';
                           }
                           else{
                              table_output += '<th class="text-lg" style="text-align:center">'+""+'</th>';
                           }
                        }
                        else
                        {
                           if(sheet_data[row][cell]){
                              table_output += '<td class="text-center justify-center text-sm">'+sheet_data[row][cell]+'</td>';                           
                           }
                           else{
                               table_output += '<td class="text-center justify-center text-sm">'+""+'</td>';
                           }
                           
                        }
                     }
                     table_output += '</tr>';
                  }
                  table_output += '</table>';
                  document.getElementById('excel_data').innerHTML = table_output;
            }
         };
         reader.readAsArrayBuffer(new Blob([data]));
      });
      
   </script>

   <script >
      makeChart()
      function makeChart(){
         var ctx1 = document.getElementById('myChart').getContext('2d');
         var chart1 = new Chart(ctx1, {
            type: 'bar',
            plugins: [ChartDataSource],
            options: { 
               plugins: { 
                  datasource: { url: "{{$dataPenduduk->getFirstMediaUrl('data_penduduk_berkas_data')}}", rowMapping: 'index' }, 
                  colorschemes: { scheme: 'brewer.Paired12'} 
                  },
               responsive: true,
               maintainAspectRatio: false
            }
         });
      }
   </script>
@endpush
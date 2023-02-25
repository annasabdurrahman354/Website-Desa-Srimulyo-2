<div class="container w-full relative mx-auto dark:bg-gray-900">
	<section class="text-gray-600 body-font container flex flex-col px-4 pt-12 pb-12 mx-auto">
		<div>
			<div class="flex flex-col">
				<div class="h-1 rounded overflow-hidden">
					<div class="w-32 h-full bg-blue-500"></div>
				</div>
				<div class="flex flex-wrap md:flex-nowrap sm:flex-row py-1 mb-4 items-center align-middle justify-between space-y-2">
					<h2 class="text-2xl tracking-tighter font-bold text-gray-900 dark:text-white h-full whitespace-nowrap">Peta UMKM Desa Srimulyo</h2>
				</div>
			</div>
		</div>
		<!-- Map section -->
		<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
			<div id="map" class="z-10 min-h-screen-75 w-full rounded-md shadow-md" wire:ignore></div>
		</div>
		
		<div id="modalEl" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full shadow-md" wire:ignore.self>
			<div class="relative w-full h-full max-w-xl md:h-auto">
				<!-- Modal content -->
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full h-fit p-6 mx-auto items-center" wire:loading>
					<x-loading />
				</div>
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700" wire:loading.remove>
					<!-- Modal header -->
					<div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
						<h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
							{{$clickedUmkm['nama_umkm'] ?? ''}}
						</h3>
						<button type="button" onclick="modalToggle()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
						</button>
					</div>
					<!-- Modal body -->
					<div class='w-full min-h-min relative'>
						<img class="w-full" src="{{$clickedUmkm['thumbUrl'] ?? ''}}" alt="" />
					</div>
					<div class="p-4">
						<div class="flex flex-wrap items-center text-center align-middle text-sm"> 
							<div class="py-1 px-3 text-gray-500 w-fit rounded-full border border-gray-200">
								<span class="w-4 h-4 mr-1">
									<i class="fas fa-user"></i>
								</span>
								{{$clickedUmkm['pemilik']['name'] ?? ''}}
							</div>
							<div class="ml-2 py-1 px-3 text-gray-500 w-fit rounded-full border border-gray-200">
								<span class="w-4 h-4 mr-1">
									<i class="fas fa-{{$clickedUmkm['icon'] ?? ''}}"></i>
								</span>
								{{$clickedUmkm['kategori']['kategori']??''}}
							</div>
						</div>
						<div class="mt-2 text-base leading-relaxed text-gray-500 dark:text-gray-400">
							{{$clickedUmkm['deskripsi'] ?? ''}}
						</div>
						<div class="mt-2 text-base leading-none text-blue-800 dark:text-gray-400 border-blue-300 border-dashed border-2 rounded-lg w-full h-fit p-2">
							<div class="form-label">
								Alamat
							</div>
							<div>
								{{$clickedUmkm['alamat'] ?? ''}}
							</div>
						</div>
					</div>
					<!-- Modal footer -->
					<div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
						<div class="inline-flex rounded-md shadow-sm">
						@if ($clickedUmkm != "")
							@if ($clickedUmkm['url_hubungi'] != '')
								<a href="{{$clickedUmkm['url_hubungi'] ?? ''}}" aria-current="page" class="inline-flex items-center px-4 py-2 font-medium text-white bg-green-600 border border-gray-200 rounded-l-lg hover:bg-green-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-green-700 focus:text-green-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-green-500 dark:focus:text-white">
									<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
									Hubungi
								</a>
								<a href="{{$clickedUmkm['url_arah'] ?? ''}}" class="inline-flex items-center px-4 py-2 font-medium text-blue-600 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M413.6 92.1c4.9-11.9 2.1-25.6-7-34.7s-22.8-11.9-34.7-7l-352 144C5.7 200.2-2.3 215.2 .6 230.2s16.1 25.8 31.4 25.8H208V432c0 15.3 10.8 28.4 25.8 31.4s30-5.1 35.8-19.3l144-352z"/></svg>
									Petunjuk Arah
								</a>
							@else
								<a href="{{$clickedUmkm['url_arah'] ?? ''}}" aria-current="page" class="inline-flex items-center px-4 py-2 font-medium text-blue-600 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700  focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-green-500 dark:focus:text-white">
									<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
									Petunjuk Arah
								</a>
							@endif
							<a href="{{route('guest.umkm.etalase', $clickedUmkm['slug'] ?? '')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"/></svg>
								Etalase
							</a>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
</div>

@push('styles')
    @once
    <link rel="stylesheet" href="{{asset('vendor/leaflet.awesome-markers/leaflet.awesome-markers.css')}}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
	<link rel="stylesheet" href="https://rawgit.com/maydemirx/leaflet-tag-filter-button/master/src/leaflet-tag-filter-button.css" />
	<link rel="stylesheet" href="https://rawgit.com/CliffCloud/Leaflet.EasyButton/master/src/easy-button.css" />
	<link rel="stylesheet" href={{asset('vendor/leaflet-search/src/leaflet-search.css')}} />
    @endonce
@endpush

@push('scripts')
	<script type="text/javascript" src="{{ asset('vendor/leaflet.awesome-markers/leaflet.awesome-markers.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
	<script src="https://rawgit.com/CliffCloud/Leaflet.EasyButton/master/src/easy-button.js" charset="utf-8"></script>
    <script src="https://rawgit.com/maydemirx/leaflet-tag-filter-button/master/src/leaflet-tag-filter-button.js" charset="utf-8"></script>
	<script src="{{asset('vendor/leaflet-search/src/leaflet-search.js')}}" charset="utf-8"></script>
	<script>
		const $targetEl = document.getElementById('modalEl');

		const options = {
			placement: 'center',
			backdrop: 'dynamic',
			backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
			closable: true,
			onHide: () => {
				console.log('modal is hidden');
			},
			onShow: () => {
				console.log('modal is shown');
			},
			onToggle: () => {
				console.log('modal has been toggled');
			}
		};

		const modal = new Modal($targetEl, options);
	</script>
    <script>
		var map = L.map('map').setView([-7.4524345217123, 111.08387166008306], 14);
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

		L.control.tagFilterButton({
			data: @js($tags),
			icon: '<i class="fa fa-filter"></i>',
			filterOnEveryClick: true
		}).addTo( map );

		var markersLayer = new L.LayerGroup();	//layer contain searched elements

		map.addLayer(markersLayer);

		var controlSearch = new L.Control.Search({
			position:'topright',		
			layer: markersLayer,
			initial: false,
			zoom: 12,
			marker: false
		});

		map.addControl( controlSearch );

		
		map.invalidateSize();

		function modalToggle(){
			modal.toggle();
		}
    </script>

	<script>
		document.addEventListener('livewire:load', function () {
			let umkms = @js($umkms);
			umkms.forEach(addUmkm);

			function addUmkm(item, index){
				marker = new L.marker([item['latitude'], item['longitude']], {icon: L.AwesomeMarkers.icon({icon: item['icon'], markerColor: item['color'], prefix: 'fa', iconColor: 'black'}), title: item['nama_umkm'], tags: [item['kategori']['kategori']] }).on('click', function(){
					@this.set('clickedUmkm', item);
					modalToggle()
				})
				.bindTooltip(item['nama_umkm'], 
				{
					direction: 'top',
					offset: [0,-50],
				});
				markersLayer.addLayer(marker);
			}
		})
	</script>
@endpush


<form wire:submit.prevent="submit">
    <div class="relative">
        <div class="form-group {{ $errors->has('umkm.nama_umkm') ? 'invalid' : '' }}">
            <label class="form-label required" for="nama_umkm">{{ trans('cruds.umkm.fields.nama_umkm') }}</label>
            <input type="text" class="input-text" name="nama_umkm" id="nama_umkm" required wire:model="nama">
            <div class="validation-message">
                {{ $errors->first('umkm.nama_umkm') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.umkm.fields.nama_umkm_helper') }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('mediaCollections.umkm_carousel') ? 'invalid' : '' }}">
            <label class="form-label required" for="carousel">{{ trans('cruds.umkm.fields.carousel') }}</label>
            <x-dropzone-image id="carousel" name="carousel" action="{{ route('admin.umkms.storeMedia') }}" collection-name="umkm_carousel" ratio="2/1" />
            <div class="validation-message">
                {{ $errors->first('mediaCollections.umkm_carousel') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.umkm.fields.carousel_helper') }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('umkm.deskripsi') ? 'invalid' : '' }}">
            <label class="form-label required" for="deskripsi">{{ trans('cruds.umkm.fields.deskripsi') }}</label>
            <textarea class="input-textarea" name="deskripsi" id="deskripsi" required wire:model.defer="umkm.deskripsi" rows="4"></textarea>
            <div class="validation-message">
                {{ $errors->first('umkm.deskripsi') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.umkm.fields.deskripsi_helper') }}
            </div>
        </div>
        <div class="form-group {{ $errors->has('umkm.nomor_telepon') ? 'invalid' : '' }}">
            <label class="form-label" for="nomor_telepon">{{ trans('cruds.umkm.fields.nomor_telepon') }}</label>
            <input class="input-text" type="text"  name="nomor_telepon" id="nomor_telepon" required wire:model.defer="umkm.nomor_telepon">
            <div class="validation-message">
                {{ $errors->first('umkm.nomor_telepon') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.umkm.fields.nomor_telepon_helper') }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('umkm.alamat') ? 'invalid' : '' }}">
            <label class="form-label required" for="alamat">{{ trans('cruds.umkm.fields.alamat') }}</label>
            <input class="input-text" type="text"  name="alamat" id="alamat" required wire:model.defer="umkm.alamat">
            <div class="validation-message">
                {{ $errors->first('umkm.alamat') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.umkm.fields.alamat_helper') }}
            </div>
        </div>

        <div class="form-group border border-dashed border-spacing-1 border-blue-400 rounded-md p-4">
            <div class="form-group {{ $errors->has('umkm.longitude') || $errors->has('umkm.latitude') ? 'invalid' : '' }} relative" >
                <label class="form-label" for="map">Klik pada lokasi UMKM Anda</label>
                <div id="map" class="w-full h-96 rounded-md shadow-md z-2" wire:ignore></div>
            </div>
            <div class="form-group">
                <label class="form-label contents" for="map">Atau masukkan koordinat secara manual</label>
                <div class="flex items-center gap-4 w-full">
                    <div class="flex-1 {{ $errors->has('umkm.latitude') ? 'invalid' : '' }}">
                        <label class="form-label" for="latitude">{{ trans('cruds.umkm.fields.latitude') }}</label>
                        <input oninput="handleLatitudeInput(this)" class="input-text" type="number" step="any" name="latitude" id="latitude" wire:model="umkm.latitude">
                        <div class="validation-message">
                            {{ $errors->first('umkm.latitude') }}
                        </div>
                    </div>
                    <div class="flex-1 {{ $errors->has('umkm.longitude') ? 'invalid' : '' }}">
                        <label class="form-label" for="longitude">{{ trans('cruds.umkm.fields.longitude') }}</label>
                        <input oninput="handleLongitudeInput(this)" class="input-text" type="number" step="any" name="longitude" id="longitude" wire:model="umkm.longitude">
                        <div class="validation-message">
                            {{ $errors->first('umkm.longitude') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('umkm.kategori_id') ? 'invalid' : '' }}">
            <label class="form-label required" for="kategori">{{ trans('cruds.umkm.fields.kategori') }}</label>
            <x-select-list class="form-control" required id="kategori" name="kategori" :options="$this->listsForFields['kategori']" wire:model="umkm.kategori_id" />
            <div class="validation-message">
                {{ $errors->first('umkm.kategori_id') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.umkm.fields.kategori_helper') }}
            </div>
        </div>

        <div class="form-group">
            <div wire:loading >
                <div class="flex justify-start">
                    <x-loading class="m-auto"/> 
                    <p class="m-auto">Loading</p>
                </div>
            </div>
            <div wire:loading.remove>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Daftarkan</button>
                <a href="{{ route('user.usaha.index') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-semibold rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Batal</a>
            </div>
        </div>   
    </div>
</form>

@push('styles')
    @once
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
    @endonce
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin="" ></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
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
        var markerGroup = L.layerGroup().addTo(map);

        map.invalidateSize();

        function onMapClick(e) {
            markerGroup.clearLayers();
            lc.stop();

            @this.set('umkm.latitude', e.latlng.lat.toString());
            @this.set('umkm.longitude', e.latlng.lng.toString());

            L.marker(e.latlng).addTo(markerGroup)
                .bindPopup("Anda berada di sini!").openPopup();
            map.panTo(L.latLng(e.latlng.lat, e.latlng.lng));
        }

        map.on('click', onMapClick);

        function onLocationFound(e) {
            markerGroup.clearLayers();
            
            @this.set('umkm.latitude', e.latlng.lat.toString());
            @this.set('umkm.longitude', e.latlng.lng.toString());

            var radius = e.accuracy;

            L.marker(e.latlng).addTo(markerGroup)
                .bindPopup("Kemungkinan Anda berada " + radius + " meter dari titik ini!").openPopup();
        }

        map.on('locationfound', onLocationFound);
        
        function handleLatitudeInput(e) {
            @this.set('umkm.latitude', e.value.toString());
            popup
                .setLatLng(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value))
                .setContent("Anda mengklik pada " + L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value).toString())
                .openOn(map);
            map.panTo(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value));
        }

        function handleLatitudeInput(e) {
            @this.set('umkm.latitude', e.value.toString());
            popup
                .setLatLng(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value))
                .setContent("Anda mengklik pada " + L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value).toString())
                .openOn(map);
            map.panTo(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value));
        }

    </script>
@endpush


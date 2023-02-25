<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('umkm.pemilik_id') ? 'invalid' : '' }}">
        <label class="form-label" for="pemilik">{{ trans('cruds.umkm.fields.pemilik') }}</label>
        <x-select-list class="form-control" id="pemilik" name="pemilik" :options="$this->listsForFields['pemilik']" wire:model="umkm.pemilik_id" />
        <div class="validation-message">
            {{ $errors->first('umkm.pemilik_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.pemilik_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.nama_umkm') ? 'invalid' : '' }}">
        <label class="form-label required" for="nama_umkm">{{ trans('cruds.umkm.fields.nama_umkm') }}</label>
        <input class="form-control" type="text" name="nama_umkm" id="nama_umkm" required wire:model="nama">
        <div class="validation-message">
            {{ $errors->first('umkm.nama_umkm') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.nama_umkm_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.umkm.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model="umkm.slug" disabled>
        <div class="validation-message">
            {{ $errors->first('umkm.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.slug_helper') }}
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
        <textarea class="form-control" name="deskripsi" id="deskripsi" required wire:model.defer="umkm.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('umkm.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.nomor_telepon') ? 'invalid' : '' }}">
        <label class="form-label" for="nomor_telepon">{{ trans('cruds.umkm.fields.nomor_telepon') }}</label>
        <input class="form-control" type="text" name="nomor_telepon" id="nomor_telepon" wire:model.defer="umkm.nomor_telepon">
        <div class="validation-message">
            {{ $errors->first('umkm.nomor_telepon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.nomor_telepon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.alamat') ? 'invalid' : '' }}">
        <label class="form-label required" for="alamat">{{ trans('cruds.umkm.fields.alamat') }}</label>
        <input class="form-control" type="text" name="alamat" id="alamat" required wire:model.defer="umkm.alamat">
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
            <div id="map" class="w-full h-96 rounded-md shadow-md" wire:ignore></div>
        </div>
        <div class="form-group">
            <label class="form-label contents" for="map">Atau masukkan koordinat secara manual</label>
            <div class="flex items-center gap-4 w-full">
                <div class="flex-1 {{ $errors->has('umkm.latitude') ? 'invalid' : '' }}">
                    <label class="form-label" for="latitude">{{ trans('cruds.umkm.fields.latitude') }}</label>
                    <input oninput="onHandleLatitudeInput(this)" class="form-control" type="number" step="any" name="latitude" id="latitude" wire:model="umkm.latitude">
                    <div class="validation-message">
                        {{ $errors->first('umkm.latitude') }}
                    </div>
                </div>
                <div class="flex-1 {{ $errors->has('umkm.longitude') ? 'invalid' : '' }}">
                    <label class="form-label" for="longitude">{{ trans('cruds.umkm.fields.longitude') }}</label>
                    <input oninput="onHandleLongitudeInput(this)" class="form-control" type="number" step="any" name="longitude" id="longitude" wire:model="umkm.longitude">
                    <div class="validation-message">
                        {{ $errors->first('umkm.longitude') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('umkm.waktu_keterlihatan') ? 'invalid' : '' }}">
        <label class="form-label" for="waktu_keterlihatan">{{ trans('cruds.umkm.fields.waktu_keterlihatan') }}</label>
        <x-date-picker class="form-control" wire:model="umkm.waktu_keterlihatan" id="waktu_keterlihatan" name="waktu_keterlihatan" />
        <div class="validation-message">
            {{ $errors->first('umkm.waktu_keterlihatan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.waktu_keterlihatan_helper') }}
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
    <div class="form-group {{ $errors->has('umkm.is_aktif') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_aktif" id="is_aktif" wire:model.defer="umkm.is_aktif">
        <label class="form-label inline ml-1" for="is_aktif">{{ trans('cruds.umkm.fields.is_aktif') }}</label>
        <div class="validation-message">
            {{ $errors->first('umkm.is_aktif') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.is_aktif_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('umkm.is_terverifikasi') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_terverifikasi" id="is_terverifikasi" wire:model.defer="umkm.is_terverifikasi">
        <label class="form-label inline ml-1" for="is_terverifikasi">{{ trans('cruds.umkm.fields.is_terverifikasi') }}</label>
        <div class="validation-message">
            {{ $errors->first('umkm.is_terverifikasi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.umkm.fields.is_terverifikasi_helper') }}
        </div>
    </div>

    <div class="form-group" wire:loading.remove>
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.umkms.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
    <div class="form-group" wire:loading>
        <x-loading/>
    </div>
</form>

@push('styles')
    @once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
    @endonce
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script>
        var map = L.map('map').setView([@js($umkm->latitude), @js($umkm->longitude)], 14);

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

        L.marker(L.latLng(@js($umkm->latitude), @js($umkm->longitude))).addTo(markerGroup)
                .bindPopup("Lokasi UMKM Anda berada di sini!").openPopup();
        map.panTo(L.latLng(@js($umkm->latitude), @js($umkm->longitude)));

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

        function onHandleLatitudeInput(e) {
            @this.set('umkm.latitude', e.value.toString());
            popup
                .setLatLng(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value))
                .setContent("Anda mengklik pada " + L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value).toString())
                .openOn(map);
            map.panTo(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value));
        }

        function onHandleLatitudeInput(e) {
            @this.set('umkm.latitude', e.value.toString());
            popup
                .setLatLng(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value))
                .setContent("Anda mengklik pada " + L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value).toString())
                .openOn(map);
            map.panTo(L.latLng(document.getElementById('latitude').value, document.getElementById('longitude').value));
        }
    </script>
@endpush


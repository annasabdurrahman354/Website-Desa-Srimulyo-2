<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('artikel.judul') ? 'invalid' : '' }}">
        <label class="form-label required" for="judul">{{ trans('cruds.artikel.fields.judul') }}</label>
        <input class="form-control" type="text" name="judul" id="judul" required wire:model="judul">
        <div class="validation-message">
            {{ $errors->first('artikel.judul') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.judul_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.artikel.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model="artikel.slug" disabled>
        <div class="validation-message">
            {{ $errors->first('artikel.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.artikel_gambar') ? 'invalid' : '' }}">
        <label class="form-label required" for="gambar">{{ trans('cruds.artikel.fields.gambar') }}</label>
        <x-dropzone-image id="gambar" name="gambar" action="{{ route('admin.artikels.storeMedia') }}" collection-name="artikel_gambar" ratio="3/2" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.artikel_gambar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.gambar_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.penulis_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="penulis">{{ trans('cruds.artikel.fields.penulis') }}</label>
        <x-select-list class="form-control" required id="penulis" name="penulis" :options="$this->listsForFields['penulis']" wire:model="artikel.penulis_id" />
        <div class="validation-message">
            {{ $errors->first('artikel.penulis_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.penulis_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.rangkuman') ? 'invalid' : '' }}">
        <label class="form-label required" for="rangkuman">{{ trans('cruds.artikel.fields.rangkuman') }}</label>
        <input class="form-control" type="text" name="rangkuman" id="rangkuman" required wire:model.defer="artikel.rangkuman">
        <div class="validation-message">
            {{ $errors->first('artikel.rangkuman') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.rangkuman_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.konten') ? 'invalid' : '' }}">
        <label class="form-label required" for="konten">{{ trans('cruds.artikel.fields.konten') }}</label>
        <div wire:ignore>
            <div class="w-full">
                <div class="editor ck-content" name="konten" id="konten" >
                    {!! $artikel->konten !!}
                </div>
            </div>
        </div>
        <div class="validation-message">
            {{ $errors->first('artikel.konten') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.konten_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.jumlah_pembaca') ? 'invalid' : '' }}">
        <label class="form-label required" for="jumlah_pembaca">{{ trans('cruds.artikel.fields.jumlah_pembaca') }}</label>
        <input class="form-control" type="number" name="jumlah_pembaca" id="jumlah_pembaca" required wire:model.defer="artikel.jumlah_pembaca" step="1">
        <div class="validation-message">
            {{ $errors->first('artikel.jumlah_pembaca') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.jumlah_pembaca_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.kategori_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="kategori">{{ trans('cruds.artikel.fields.kategori') }}</label>
        <x-select-list class="form-control" required id="kategori" name="kategori" :options="$this->listsForFields['kategori']" wire:model="artikel.kategori_id" />
        <div class="validation-message">
            {{ $errors->first('artikel.kategori_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.kategori_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artikel.is_diterbitkan') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_diterbitkan" id="is_diterbitkan" wire:model.defer="artikel.is_diterbitkan">
        <label class="form-label inline ml-1" for="is_diterbitkan">{{ trans('cruds.artikel.fields.is_diterbitkan') }}</label>
        <div class="validation-message">
            {{ $errors->first('artikel.is_diterbitkan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artikel.fields.is_diterbitkan_helper') }}
        </div>
    </div>

    <div class="form-group" wire:loading.remove>
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.artikels.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
    <div class="form-group" wire:loading>
        <x-loading/>
    </div>
</form>

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        const watchdog = new CKSource.EditorWatchdog();
        
        window.watchdog = watchdog;
        
        watchdog.setCreator( ( element, config ) => {
            return CKSource.Editor
                .create( element, config )
                .then( editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('artikel.konten', editor.getData());
                        })
                    return editor;
                } )
        } );
        
        watchdog.setDestructor( editor => {
            return editor.destroy();
        } );
        
        watchdog.on( 'error', handleError );
        
        watchdog
            .create( document.querySelector( '.editor' ), {
                licenseKey: '',
            } )
            .catch( handleError );
        
        function handleError( error ) {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: 4xgomjqas0xv-dl2rhexus27m' );
            console.error( error );
        }
        
    </script>
@endpush

@push('styles')
    @once
    <link rel="stylesheet" href="{{asset('vendor/ckeditor/ckeditor.css')}}"/>
    @endonce
@endpush

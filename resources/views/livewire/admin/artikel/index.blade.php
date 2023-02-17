<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('artikel_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Artikel" format="csv" />
                <livewire:excel-export model="Artikel" format="xlsx" />
                <livewire:excel-export model="Artikel" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.artikel.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.judul') }}
                            @include('components.table.sort', ['field' => 'judul'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.slug') }}
                            @include('components.table.sort', ['field' => 'slug'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.gambar') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.penulis') }}
                            @include('components.table.sort', ['field' => 'penulis.name'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.rangkuman') }}
                            @include('components.table.sort', ['field' => 'rangkuman'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.jumlah_pembaca') }}
                            @include('components.table.sort', ['field' => 'jumlah_pembaca'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.kategori') }}
                            @include('components.table.sort', ['field' => 'kategori.kategori'])
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.is_diterbitkan') }}
                            @include('components.table.sort', ['field' => 'is_diterbitkan'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $artikel)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $artikel->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $artikel->id }}
                            </td>
                            <td>
                                {{ $artikel->judul }}
                            </td>
                            <td>
                                {{ $artikel->slug }}
                            </td>
                            <td>
                                @foreach($artikel->gambar as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @if($artikel->penulis)
                                    <span class="badge badge-relationship">{{ $artikel->penulis->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $artikel->rangkuman }}
                            </td>
                            <td>
                                {{ $artikel->jumlah_pembaca }}
                            </td>
                            <td>
                                @if($artikel->kategori)
                                    <span class="badge badge-relationship">{{ $artikel->kategori->kategori ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $artikel->is_diterbitkan ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('artikel_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.artikels.show', $artikel) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('artikel_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.artikels.edit', $artikel) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('artikel_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $artikel->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $artikels->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush
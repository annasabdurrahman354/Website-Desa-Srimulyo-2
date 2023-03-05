<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('produk_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Produk" format="csv" />
                <livewire:excel-export model="Produk" format="xlsx" />
                <livewire:excel-export model="Produk" format="pdf" />
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
                            {{ trans('cruds.produk.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.umkm') }}
                            @include('components.table.sort', ['field' => 'umkm.nama_umkm'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.nama') }}
                            @include('components.table.sort', ['field' => 'nama'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.slug') }}
                            @include('components.table.sort', ['field' => 'slug'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.foto') }}
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.harga') }}
                            @include('components.table.sort', ['field' => 'harga'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.satuan') }}
                            @include('components.table.sort', ['field' => 'satuan.satuan'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.kategori') }}
                            @include('components.table.sort', ['field' => 'kategori.kategori'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.is_tersedia') }}
                            @include('components.table.sort', ['field' => 'is_tersedia'])
                        </th>
                        <th>
                            {{ trans('cruds.produk.fields.is_tampilkan') }}
                            @include('components.table.sort', ['field' => 'is_tampilkan'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $produk->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $produk->id }}
                            </td>
                            <td>
                                @if($produk->umkm)
                                    <span class="badge badge-relationship">{{ $produk->umkm->nama_umkm ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $produk->nama }}
                            </td>
                            <td>
                                {{ $produk->slug }}
                            </td>
                            <td>
                                @foreach($produk->foto as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                            <td class="line-clamp-6">
                                {{ $produk->deskripsi }}
                            </td>
                            <td>
                                {{ $produk->harga }}
                            </td>
                            <td>
                                @if($produk->satuan)
                                    <span class="badge badge-relationship">{{ $produk->satuan->satuan ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($produk->kategori)
                                    <span class="badge badge-relationship">{{ $produk->kategori->kategori ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produk->is_tersedia ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $produk->is_tampilkan ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('produk_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.produks.show', $produk) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('produk_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.produks.edit', $produk) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('produk_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $produk->id }})" wire:loading.attr="disabled">
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
            {{ $produks->links() }}
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
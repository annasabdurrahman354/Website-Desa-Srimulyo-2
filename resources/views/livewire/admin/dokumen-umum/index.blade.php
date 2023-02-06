<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('dokumen_umum_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="DokumenUmum" format="csv" />
                <livewire:excel-export model="DokumenUmum" format="xlsx" />
                <livewire:excel-export model="DokumenUmum" format="pdf" />
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
                            {{ trans('cruds.dokumenUmum.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.dokumenUmum.fields.judul') }}
                            @include('components.table.sort', ['field' => 'judul'])
                        </th>
                        <th>
                            {{ trans('cruds.dokumenUmum.fields.slug') }}
                            @include('components.table.sort', ['field' => 'slug'])
                        </th>
                        <th>
                            {{ trans('cruds.dokumenUmum.fields.tahun_terbit') }}
                            @include('components.table.sort', ['field' => 'tahun_terbit'])
                        </th>
                        <th>
                            {{ trans('cruds.dokumenUmum.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.dokumenUmum.fields.berkas_dokumen') }}
                        </th>
                        <th>
                            {{ trans('cruds.dokumenUmum.fields.is_aktif') }}
                            @include('components.table.sort', ['field' => 'is_aktif'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumenUmums as $dokumenUmum)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $dokumenUmum->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $dokumenUmum->id }}
                            </td>
                            <td>
                                {{ $dokumenUmum->judul }}
                            </td>
                            <td>
                                {{ $dokumenUmum->slug }}
                            </td>
                            <td>
                                {{ $dokumenUmum->tahun_terbit }}
                            </td>
                            <td>
                                {{ $dokumenUmum->deskripsi }}
                            </td>
                            <td>
                                @foreach($dokumenUmum->berkas_dokumen as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $dokumenUmum->is_aktif ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('dokumen_umum_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.dokumen-umums.show', $dokumenUmum) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('dokumen_umum_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.dokumen-umums.edit', $dokumenUmum) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('dokumen_umum_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $dokumenUmum->id }})" wire:loading.attr="disabled">
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
            {{ $dokumenUmums->links() }}
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
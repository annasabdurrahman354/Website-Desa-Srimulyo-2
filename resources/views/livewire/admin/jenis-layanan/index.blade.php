<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('jenis_layanan_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="JenisLayanan" format="csv" />
                <livewire:excel-export model="JenisLayanan" format="xlsx" />
                <livewire:excel-export model="JenisLayanan" format="pdf" />
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
                            {{ trans('cruds.jenisLayanan.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.jenisLayanan.fields.nama') }}
                            @include('components.table.sort', ['field' => 'nama'])
                        </th>
                        <th>
                            {{ trans('cruds.jenisLayanan.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.jenisLayanan.fields.biaya') }}
                            @include('components.table.sort', ['field' => 'biaya'])
                        </th>
                        <th>
                            {{ trans('cruds.jenisLayanan.fields.pelayanan_online') }}
                            @include('components.table.sort', ['field' => 'pelayanan_online'])
                        </th>
                        <th>
                            {{ trans('cruds.jenisLayanan.fields.syarat_layanan') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisLayanans as $jenisLayanan)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $jenisLayanan->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $jenisLayanan->id }}
                            </td>
                            <td>
                                {{ $jenisLayanan->nama }}
                            </td>
                            <td>
                                {{ $jenisLayanan->deskripsi }}
                            </td>
                            <td>
                                {{ $jenisLayanan->biaya }}
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $jenisLayanan->pelayanan_online ? 'checked' : '' }}>
                            </td>
                            <td>
                                @foreach($jenisLayanan->syaratLayanan as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->nama }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('jenis_layanan_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.jenis-layanans.show', $jenisLayanan) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('jenis_layanan_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.jenis-layanans.edit', $jenisLayanan) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('jenis_layanan_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $jenisLayanan->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
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
            {{ $jenisLayanans->links() }}
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
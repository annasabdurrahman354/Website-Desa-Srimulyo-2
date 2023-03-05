<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('syarat_layanan_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="SyaratLayanan" format="csv" />
                <livewire:excel-export model="SyaratLayanan" format="xlsx" />
                <livewire:excel-export model="SyaratLayanan" format="pdf" />
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
                            {{ trans('cruds.syaratLayanan.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.syaratLayanan.fields.nama') }}
                            @include('components.table.sort', ['field' => 'nama'])
                        </th>
                        <th>
                            {{ trans('cruds.syaratLayanan.fields.jenis_berkas') }}
                            @include('components.table.sort', ['field' => 'jenis_berkas'])
                        </th>
                        <th>
                            {{ trans('cruds.syaratLayanan.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.syaratLayanan.fields.berkas_formulir') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($syaratLayanans as $syaratLayanan)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $syaratLayanan->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $syaratLayanan->id }}
                            </td>
                            <td>
                                {{ $syaratLayanan->nama }}
                            </td>
                            <td>
                                {{ $syaratLayanan->jenis_berkas_label }}
                            </td>
                            <td class="line-clamp-6">
                                {{ $syaratLayanan->deskripsi }}
                            </td>
                            <td>
                                @foreach($syaratLayanan->berkas_formulir as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('syarat_layanan_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.syarat-layanans.show', $syaratLayanan) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('syarat_layanan_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.syarat-layanans.edit', $syaratLayanan) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('syarat_layanan_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $syaratLayanan->id }})" wire:loading.attr="disabled">
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
            {{ $syaratLayanans->links() }}
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
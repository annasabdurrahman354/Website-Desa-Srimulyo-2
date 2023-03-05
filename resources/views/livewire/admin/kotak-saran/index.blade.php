<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('kotak_saran_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="KotakSaran" format="csv" />
                <livewire:excel-export model="KotakSaran" format="xlsx" />
                <livewire:excel-export model="KotakSaran" format="pdf" />
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
                            {{ trans('cruds.kotakSaran.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.kotakSaran.fields.pengirim') }}
                            @include('components.table.sort', ['field' => 'pengirim'])
                        </th>
                        <th>
                            {{ trans('cruds.kotakSaran.fields.nomor_telepon') }}
                            @include('components.table.sort', ['field' => 'nomor_telepon'])
                        </th>
                        <th>
                            {{ trans('cruds.kotakSaran.fields.isi') }}
                            @include('components.table.sort', ['field' => 'isi'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kotakSarans as $kotakSaran)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $kotakSaran->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $kotakSaran->id }}
                            </td>
                            <td>
                                {{ $kotakSaran->pengirim }}
                            </td>
                            <td>
                                {{ $kotakSaran->nomor_telepon }}
                            </td>
                            <td class="line-clamp-6">
                                {{ $kotakSaran->isi }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('kotak_saran_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.kotak-sarans.show', $kotakSaran) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('kotak_saran_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.kotak-sarans.edit', $kotakSaran) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('kotak_saran_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $kotakSaran->id }})" wire:loading.attr="disabled">
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
            {{ $kotakSarans->links() }}
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
<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('pelayanan_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Pelayanan" format="csv" />
                <livewire:excel-export model="Pelayanan" format="xlsx" />
                <livewire:excel-export model="Pelayanan" format="pdf" />
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
                            {{ trans('cruds.pelayanan.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.pemohon') }}
                            @include('components.table.sort', ['field' => 'pemohon.name'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.nomor_telepon') }}
                            @include('components.table.sort', ['field' => 'pemohon.nomor_telepon'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.jenis_layanan') }}
                            @include('components.table.sort', ['field' => 'jenis_layanan.nama'])
                        </th>
                        <th>
                            {{ trans('cruds.jenisLayanan.fields.pelayanan_online') }}
                            @include('components.table.sort', ['field' => 'jenis_layanan.pelayanan_online'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.kode') }}
                            @include('components.table.sort', ['field' => 'kode'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.catatan_pemohon') }}
                            @include('components.table.sort', ['field' => 'catatan_pemohon'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.catatan_reviewer') }}
                            @include('components.table.sort', ['field' => 'catatan_reviewer'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.berkas_hasil') }}
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.rating') }}
                            @include('components.table.sort', ['field' => 'rating'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.penilaian_pemohon') }}
                            @include('components.table.sort', ['field' => 'penilaian_pemohon'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelayanans as $pelayanan)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $pelayanan->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $pelayanan->id }}
                            </td>
                            <td>
                                @if($pelayanan->pemohon)
                                    <span class="badge badge-relationship">{{ $pelayanan->pemohon->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($pelayanan->pemohon)
                                    {{ $pelayanan->pemohon->nomor_telepon ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($pelayanan->jenisLayanan)
                                    <span class="badge badge-relationship">{{ $pelayanan->jenisLayanan->nama ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($pelayanan->jenisLayanan)
                                    <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $pelayanan->jenisLayanan->pelayanan_online ? 'checked' : '' }}>
                                @endif
                            </td>
                            <td>
                                {{ $pelayanan->kode }}
                            </td>
                            <td>
                                {{ $pelayanan->catatan_pemohon }}
                            </td>
                            <td>
                                {{ $pelayanan->catatan_reviewer }}
                            </td>
                            <td>
                                {{ $pelayanan->status_label }}
                            </td>
                            <td>
                                @foreach($pelayanan->berkas_hasil as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $pelayanan->rating_label }}
                            </td>
                            <td>
                                {{ $pelayanan->penilaian_pemohon }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('pelayanan_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.pelayanans.review', $pelayanan) }}">
                                            Review
                                        </a>
                                    @endcan
                                    @can('pelayanan_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.pelayanans.show', $pelayanan) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('pelayanan_edit')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.pelayanans.edit', $pelayanan) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('pelayanan_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $pelayanan->id }})" wire:loading.attr="disabled">
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
            {{ $pelayanans->links() }}
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
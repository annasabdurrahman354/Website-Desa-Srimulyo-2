<div>
    <div class="card-controls sm:flex">
        <div class="flex items-center">   
            <label for="simple-search" class="sr-only">Cari</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model.debounce.300ms="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
            </div>
        </div>
    </div>
    <div wire:loading.delay>
        <x-loading/>
    </div>

    <div class="mt-4 overflow-hidden rounded-md border border-gray-300">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.kode') }}
                            @include('components.table.sort', ['field' => 'kode'])
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
                            Catatan Anda
                            @include('components.table.sort', ['field' => 'catatan_pemohon'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.catatan_reviewer') }}
                            @include('components.table.sort', ['field' => 'catatan_reviewer'])
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.berkas_pelayanan') }}
                        </th>
                        <th>
                            {{ trans('cruds.pelayanan.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
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
                                {{ $pelayanan->kode }}
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
                                {{ $pelayanan->catatan_pemohon }}
                            </td>
                            <td>
                                {{ $pelayanan->catatan_reviewer }}
                            </td>
                            <td>
                                @foreach($pelayanan->berkas_pelayanan as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $pelayanan->status_label }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('pelayanan_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.pelayanans.show', $pelayanan) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('pelayanan_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.pelayanans.edit', $pelayanan) }}">
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
        <div class="pt-2">
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
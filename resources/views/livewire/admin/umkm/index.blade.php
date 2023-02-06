<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('umkm_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Umkm" format="csv" />
                <livewire:excel-export model="Umkm" format="xlsx" />
                <livewire:excel-export model="Umkm" format="pdf" />
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
                            {{ trans('cruds.umkm.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.pemilik') }}
                            @include('components.table.sort', ['field' => 'pemilik.name'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.nik') }}
                            @include('components.table.sort', ['field' => 'pemilik.nik'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.nama_umkm') }}
                            @include('components.table.sort', ['field' => 'nama_umkm'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.slug') }}
                            @include('components.table.sort', ['field' => 'slug'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.carousel') }}
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.nomor_telepon') }}
                            @include('components.table.sort', ['field' => 'nomor_telepon'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.alamat') }}
                            @include('components.table.sort', ['field' => 'alamat'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.latitude') }}
                            @include('components.table.sort', ['field' => 'latitude'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.longitude') }}
                            @include('components.table.sort', ['field' => 'longitude'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.waktu_keterlihatan') }}
                            @include('components.table.sort', ['field' => 'waktu_keterlihatan'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.kategori') }}
                            @include('components.table.sort', ['field' => 'kategori.kategori'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.is_aktif') }}
                            @include('components.table.sort', ['field' => 'is_aktif'])
                        </th>
                        <th>
                            {{ trans('cruds.umkm.fields.is_terverifikasi') }}
                            @include('components.table.sort', ['field' => 'is_terverifikasi'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($umkms as $umkm)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $umkm->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $umkm->id }}
                            </td>
                            <td>
                                @if($umkm->pemilik)
                                    <span class="badge badge-relationship">{{ $umkm->pemilik->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($umkm->pemilik)
                                    {{ $umkm->pemilik->nik ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $umkm->nama_umkm }}
                            </td>
                            <td>
                                {{ $umkm->slug }}
                            </td>
                            <td>
                                @foreach($umkm->carousel as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $umkm->deskripsi }}
                            </td>
                            <td>
                                {{ $umkm->nomor_telepon }}
                            </td>
                            <td>
                                {{ $umkm->alamat }}
                            </td>
                            <td>
                                {{ $umkm->latitude }}
                            </td>
                            <td>
                                {{ $umkm->longitude }}
                            </td>
                            <td>
                                {{ $umkm->waktu_keterlihatan }}
                            </td>
                            <td>
                                @if($umkm->kategori)
                                    <span class="badge badge-relationship">{{ $umkm->kategori->kategori ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $umkm->is_aktif ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $umkm->is_terverifikasi ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('umkm_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.umkms.show', $umkm) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('umkm_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.umkms.edit', $umkm) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('umkm_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $umkm->id }})" wire:loading.attr="disabled">
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
            {{ $umkms->links() }}
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
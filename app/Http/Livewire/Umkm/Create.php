<?php

namespace App\Http\Livewire\Umkm;

use App\Models\KategoriUmkm;
use App\Models\Umkm;
use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Umkm $umkm;

    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function mount(Umkm $umkm)
    {
        $this->umkm                   = $umkm;
        $this->umkm->is_aktif         = true;
        $this->umkm->is_terverifikasi = false;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.umkm.create');
    }

    public function submit()
    {
        $this->validate();

        $this->umkm->save();
        $this->syncMedia();

        return redirect()->route('admin.umkms.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->umkm->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'umkm.pemilik_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'umkm.nama_umkm' => [
                'string',
                'required',
            ],
            'umkm.slug' => [
                'string',
                'required',
                'unique:umkms,slug',
            ],
            'mediaCollections.umkm_carousel' => [
                'array',
                'required',
            ],
            'mediaCollections.umkm_carousel.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'umkm.deskripsi' => [
                'string',
                'required',
            ],
            'umkm.nomor_telepon' => [
                'string',
                'required',
            ],
            'umkm.alamat' => [
                'string',
                'required',
            ],
            'umkm.latitude' => [
                'string',
                'nullable',
            ],
            'umkm.longitude' => [
                'string',
                'nullable',
            ],
            'umkm.waktu_keterlihatan' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
            'umkm.kategori_id' => [
                'integer',
                'exists:kategori_umkms,id',
                'required',
            ],
            'umkm.is_aktif' => [
                'boolean',
            ],
            'umkm.is_terverifikasi' => [
                'boolean',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['pemilik']  = User::pluck('name', 'id')->toArray();
        $this->listsForFields['kategori'] = KategoriUmkm::pluck('kategori', 'id')->toArray();
    }
}
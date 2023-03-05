<?php

namespace App\Http\Livewire\User\Usaha;

use App\Models\KategoriUmkm;
use App\Models\Umkm;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class UserUsahaEdit extends Component
{
    public Umkm $umkm;

    public $aaa = "iiiii";

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

    public function mount()
    {
        $this->umkm                    = Umkm::where('pemilik_id', auth()->user()->id)->firstOrFail();
        $this->nama                    = $this->umkm->nama_umkm;
        $this->initListsForFields();
        $this->mediaCollections = [
            'umkm_carousel' => $this->umkm->carousel,
        ];
    }

    public function render()
    {
        return view('livewire.user.usaha.edit')->extends('layouts.user');
    }

    public function submit()
    {
        $this->validate();
        $this->umkm->waktu_keterlihatan = now();
        $this->umkm->save();
        $this->syncMedia();
        return redirect()->route('user.usaha.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->umkm->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        Umkm::where('id', $this->umkm->id)->first()->syncMediaName();
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
                'unique:umkms,slug,' . $this->umkm->id,
            ],
            'mediaCollections.umkm_carousel' => [
                'required',
                'array',
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
                'numeric',
            ],
            'umkm.alamat' => [
                'string',
                'required',
            ],
            'umkm.latitude' => [
                'numeric',
                'min:-90',
                'max:90',
                'required',
            ],
            'umkm.longitude' => [
                'numeric',
                'min:-180',
                'max:180',
                'required',
            ],
            'umkm.waktu_keterlihatan' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
            'umkm.kategori_id' => [
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
        $this->listsForFields['kategori'] = KategoriUmkm::pluck('kategori', 'id')->toArray();
    }
        
    public function generateSlug($nama)
    {
        $baseSlug = Str::slug($nama);
        // Check if the base slug exists in the database
        if(Umkm::where('nama_umkm', $nama)->exists()){
            $counter = 1;
            while (Umkm::where('slug', $slug = "{$baseSlug}-" . ++$counter)->exists()) {}
            return $slug;
        }
        return $baseSlug;
    }

    public $nama;

    public function updatedNama($value)
    {
        $this->umkm->nama_umkm = $value;
        $this->umkm->slug = $this->generateSlug($value);
    }
}

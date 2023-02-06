<?php

namespace App\Http\Livewire\Umkm;

use App\Models\KategoriUmkm;
use App\Models\Umkm;
use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Edit extends Component
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

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(Umkm $umkm)
    {
        $this->umkm = $umkm;
        $this->initListsForFields();
        $this->mediaCollections = [
            'umkm_carousel' => $umkm->carousel,
        ];
    }

    public function render()
    {
        return view('livewire.umkm.edit');
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
                'unique:umkms,slug,' . $this->umkm->id,
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
    
    public function generateSlug($nama)
    {
        if (Umkm::where('slug', $slug = Str::slug($nama))->exists()) {
            $max = Umkm::where('nama', $nama)->latest('id')->value('slug');
            $parts = explode("-", $max);
            $last = end($parts);
            $number = intval($last) + 1;
            if($number == 1){
                $number = $number+1;
            }
            $parts[count($parts) - 1] = strval($number);
            $new_slug = implode("-", $parts);
            return $new_slug; 
        }
        return $slug;
    }

    public $nama;

    public function updatedNama($value)
    {
        $this->umkm->nama = $value;
        $this->umkm->slug = $this->generateSlug($value);
    }
}

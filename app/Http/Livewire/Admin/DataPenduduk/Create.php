<?php

namespace App\Http\Livewire\Admin\DataPenduduk;

use App\Models\DataPenduduk;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Create extends Component
{
    public array $mediaToRemove = [];

    public DataPenduduk $dataPenduduk;

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
        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
    }

    public function mount(DataPenduduk $dataPenduduk)
    {
        $this->dataPenduduk            = $dataPenduduk;
        $this->dataPenduduk->is_grafik = false;
        $this->dataPenduduk->is_tabel  = false;
        $this->dataPenduduk->is_aktif  = true;
    }

    public function render()
    {
        return view('livewire.admin.data-penduduk.create');
    }

    public function submit()
    {
        $this->validate();

        $this->dataPenduduk->save();
        $this->syncMedia();

        return redirect()->route('admin.data-penduduks.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->dataPenduduk->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
    }

    protected function rules(): array
    {
        return [
            'dataPenduduk.judul' => [
                'string',
                'required',
                'unique:data_penduduks,judul',
            ],
            'dataPenduduk.slug' => [
                'string',
                'required',
                'unique:data_penduduks,slug',
            ],
            'dataPenduduk.tahun_pembaruan' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'dataPenduduk.deskripsi' => [
                'string',
                'required',
            ],
            'mediaCollections.data_penduduk_berkas_data' => [
                'array',
                'required',
            ],
            'mediaCollections.data_penduduk_berkas_data.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'dataPenduduk.is_grafik' => [
                'boolean',
            ],
            'dataPenduduk.is_tabel' => [
                'boolean',
            ],
            'dataPenduduk.is_aktif' => [
                'boolean',
            ],
        ];
    }
    
    public function generateSlug($judul)
    {
        $baseSlug = Str::slug($judul);
        // Check if the base slug exists in the database
        if(DataPenduduk::where('judul', $judul)->exists()){
            $counter = 1;
            while (DataPenduduk::where('slug', $slug = "{$baseSlug}-" . ++$counter)->exists()) {}
            return $slug;
        }
        return $baseSlug;
    }

    public $judul;

    public function updatedJudul($value)
    {
        $this->dataPenduduk->judul = $value;
        $this->dataPenduduk->slug = $this->generateSlug($value);
    }
}

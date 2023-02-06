<?php

namespace App\Http\Livewire\Artikel;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Edit extends Component
{
    public Artikel $artikel;

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

    public function mount(Artikel $artikel)
    {
        $this->artikel = $artikel;
        $this->initListsForFields();
        $this->mediaCollections = [
            'artikel_gambar' => $artikel->gambar,
        ];
    }

    public function render()
    {
        return view('livewire.artikel.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->artikel->save();
        $this->syncMedia();

        return redirect()->route('admin.artikels.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->artikel->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'artikel.judul' => [
                'string',
                'min:40',
                'max:70',
                'required',
            ],
            'artikel.slug' => [
                'string',
                'required',
                'unique:artikels,slug,' . $this->artikel->id,
            ],
            'mediaCollections.artikel_gambar' => [
                'array',
                'required',
            ],
            'mediaCollections.artikel_gambar.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'artikel.penulis_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'artikel.rangkuman' => [
                'string',
                'min:50',
                'max:160',
                'required',
            ],
            'artikel.konten' => [
                'string',
                'required',
            ],
            'artikel.jumlah_pembaca' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'artikel.kategori_id' => [
                'integer',
                'exists:kategori_artikels,id',
                'required',
            ],
            'artikel.is_diterbitkan' => [
                'boolean',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['penulis']  = User::pluck('name', 'id')->toArray();
        $this->listsForFields['kategori'] = KategoriArtikel::pluck('kategori', 'id')->toArray();
    }

    
    public function generateSlug($judul)
    {
        $baseSlug = Str::slug($judul);
        // Check if the base slug exists in the database
        if(Artikel::where('judul', $judul)->exists()){
            $counter = 1;
            while (Artikel::where('slug', $slug = "{$baseSlug}-" . ++$counter)->exists()) {}
            return $slug;
        }
        return $baseSlug;
    }

    public $judul;

    public function updatedJudul($value)
    {
        $this->artikel->judul = $value;
        $this->artikel->slug = $this->generateSlug($value);
    }
}

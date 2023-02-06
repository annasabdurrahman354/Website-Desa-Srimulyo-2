<?php

namespace App\Http\Livewire\ProdukHukum;

use App\Models\ProdukHukum;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Create extends Component
{
    public ProdukHukum $produkHukum;

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

    public function mount(ProdukHukum $produkHukum)
    {
        $this->produkHukum           = $produkHukum;
        $this->produkHukum->is_aktif = true;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.produk-hukum.create');
    }

    public function submit()
    {
        $this->validate();

        $this->produkHukum->save();
        $this->syncMedia();

        return redirect()->route('admin.produk-hukums.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->produkHukum->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'produkHukum.judul' => [
                'string',
                'required',
                'unique:produk_hukums,judul',
            ],
            'produkHukum.slug' => [
                'string',
                'required',
                'unique:produk_hukums,slug',
            ],
            'produkHukum.jenis' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['jenis'])),
            ],
            'produkHukum.tahun' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'mediaCollections.produk_hukum_berkas_dokumen' => [
                'array',
                'required',
            ],
            'mediaCollections.produk_hukum_berkas_dokumen.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'produkHukum.is_aktif' => [
                'boolean',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis'] = $this->produkHukum::JENIS_SELECT;
    }

    public function generateSlug($judul)
    {
        $baseSlug = Str::slug($judul);
        // Check if the base slug exists in the database
        if(ProdukHukum::where('judul', $judul)->exists()){
            $counter = 1;
            while (ProdukHukum::where('slug', $slug = "{$baseSlug}-" . ++$counter)->exists()) {}
            return $slug;
        }
        return $baseSlug;
    }

    public $judul;

    public function updatedJudul($value)
    {
        $this->produkHukum->judul = $value;
        $this->produkHukum->slug = $this->generateSlug($value);
    }
}

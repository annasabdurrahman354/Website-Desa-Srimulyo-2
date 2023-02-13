<?php

namespace App\Http\Livewire\Admin\Produk;

use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\SatuanProduk;
use App\Models\Umkm;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Create extends Component
{
    public Produk $produk;

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
        
        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
    }

    public function mount(Produk $produk)
    {
        $this->produk               = $produk;
        $this->produk->is_tersedia  = true;
        $this->produk->is_tampilkan = true;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.admin.produk.create');
    }

    public function submit()
    {
        $this->validate();

        $this->produk->save();
        $this->syncMedia();

        return redirect()->route('admin.produks.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->produk->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        Produk::where('id', $this->produk->id)->first()->syncMediaName();
    }

    protected function rules(): array
    {
        return [
            'produk.umkm_id' => [
                'integer',
                'exists:umkms,id',
                'required',
            ],
            'produk.nama' => [
                'string',
                'required',
            ],
            'produk.slug' => [
                'string',
                'required',
                'unique:produks,slug',
            ],
            'mediaCollections.produk_foto' => [
                'array',
                'required',
            ],
            'mediaCollections.produk_foto.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'produk.deskripsi' => [
                'string',
                'required',
            ],
            'produk.harga' => [
                'numeric',
                'required',
            ],
            'produk.satuan_id' => [
                'integer',
                'exists:satuan_produks,id',
                'required',
            ],
            'produk.kategori_id' => [
                'integer',
                'exists:kategori_produks,id',
                'required',
            ],
            'produk.is_tersedia' => [
                'boolean',
            ],
            'produk.is_tampilkan' => [
                'boolean',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['umkm']     = Umkm::pluck('nama_umkm', 'id')->toArray();
        $this->listsForFields['satuan']   = SatuanProduk::pluck('satuan', 'id')->toArray();
        $this->listsForFields['kategori'] = KategoriProduk::pluck('kategori', 'id')->toArray();
    }

    public function generateSlug($nama)
    {
        $baseSlug = Str::slug($nama);
        // Check if the base slug exists in the database
        if(Produk::where('judul', $nama)->exists()){
            $counter = 1;
            while (Produk::where('slug', $slug = "{$baseSlug}-" . ++$counter)->exists()) {}
            return $slug;
        }
        return $baseSlug;
    }

    public $nama;

    public function updatedNama($value)
    {
        $this->produk->nama = $value;
        $this->produk->slug = $this->generateSlug($value);
    }
}

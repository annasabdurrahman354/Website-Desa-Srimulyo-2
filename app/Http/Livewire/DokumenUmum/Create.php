<?php

namespace App\Http\Livewire\DokumenUmum;

use App\Models\DokumenUmum;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Create extends Component
{
    public DokumenUmum $dokumenUmum;

    public array $mediaToRemove = [];

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

    public function mount(DokumenUmum $dokumenUmum)
    {
        $this->dokumenUmum           = $dokumenUmum;
        $this->dokumenUmum->is_aktif = true;
    }

    public function render()
    {
        return view('livewire.dokumen-umum.create');
    }

    public function submit()
    {
        $this->validate();

        $this->dokumenUmum->save();
        $this->syncMedia();

        return redirect()->route('admin.dokumen-umums.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->dokumenUmum->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'dokumenUmum.judul' => [
                'string',
                'required',
                'unique:dokumen_umums,judul',
            ],
            'dokumenUmum.slug' => [
                'string',
                'required',
                'unique:dokumen_umums,slug',
            ],
            'dokumenUmum.tahun_terbit' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'dokumenUmum.deskripsi' => [
                'string',
                'required',
            ],
            'mediaCollections.dokumen_umum_berkas_dokumen' => [
                'array',
                'required',
            ],
            'mediaCollections.dokumen_umum_berkas_dokumen.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'dokumenUmum.is_aktif' => [
                'boolean',
            ],
        ];
    }
     
    public function generateSlug($judul)
    {
        if (DokumenUmum::where('slug', $slug = Str::slug($judul))->exists()) {
            $max = DokumenUmum::where('judul', $judul)->latest('id')->value('slug');
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

    public $judul;

    public function updatedJudul($value)
    {
        $this->dokumenUmum->judul = $value;
        $this->dokumenUmum->slug = $this->generateSlug($value);
    }
}

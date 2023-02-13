<?php

namespace App\Http\Livewire\Admin\AparaturDesa;

use App\Models\AparaturDesa;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{

    public $rating;

    public array $mediaToRemove = [];

    public AparaturDesa $aparaturDesa;

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

    public function mount(AparaturDesa $aparaturDesa)
    {
        $this->aparaturDesa           = $aparaturDesa;
        $this->aparaturDesa->is_aktif = true;
    }

    public function render()
    {
        return view('livewire.admin.aparatur-desa.create');
    }

    public function submit()
    {
        $this->validate();

        $this->aparaturDesa->save();
        $this->syncMedia();

        return redirect()->route('admin.aparatur-desas.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->aparaturDesa->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        AparaturDesa::where('id', $this->aparaturDesa->id)->first()->syncMediaName();
    }

    protected function rules(): array
    {
        return [
            'aparaturDesa.nama' => [
                'string',
                'required',
            ],
            'mediaCollections.aparatur_desa_foto' => [
                'array',
                'required',
            ],
            'mediaCollections.aparatur_desa_foto.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'aparaturDesa.posisi' => [
                'string',
                'required',
            ],
            'aparaturDesa.is_aktif' => [
                'boolean',
            ],
        ];
    }
}

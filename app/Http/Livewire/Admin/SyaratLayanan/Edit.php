<?php

namespace App\Http\Livewire\Admin\SyaratLayanan;

use App\Models\SyaratLayanan;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public SyaratLayanan $syaratLayanan;

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

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(SyaratLayanan $syaratLayanan)
    {
        $this->syaratLayanan = $syaratLayanan;
        $this->initListsForFields();
        $this->mediaCollections = [
            'syarat_layanan_berkas_formulir' => $syaratLayanan->berkas_formulir,
        ];
    }

    public function render()
    {
        return view('livewire.admin.syarat-layanan.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->syaratLayanan->save();
        $this->syncMedia();

        return redirect()->route('admin.syarat-layanans.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->syaratLayanan->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        SyaratLayanan::where('id', $this->syaratLayanan->id)->first()->syncMediaName();
    }

    protected function rules(): array
    {
        return [
            'syaratLayanan.nama' => [
                'string',
                'required',
                'unique:syarat_layanans,nama,' . $this->syaratLayanan->id,
            ],
            'syaratLayanan.jenis_berkas' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['jenis_berkas'])),
            ],
            'syaratLayanan.deskripsi' => [
                'string',
                'nullable',
            ],
            'mediaCollections.syarat_layanan_berkas_formulir' => [
                'array',
                'nullable',
            ],
            'mediaCollections.syarat_layanan_berkas_formulir.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis_berkas'] = $this->syaratLayanan::JENIS_BERKAS_SELECT;
    }
}

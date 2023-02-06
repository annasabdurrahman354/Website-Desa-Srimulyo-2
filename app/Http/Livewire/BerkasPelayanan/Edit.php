<?php

namespace App\Http\Livewire\BerkasPelayanan;

use App\Models\BerkasPelayanan;
use App\Models\Pelayanan;
use App\Models\SyaratLayanan;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public BerkasPelayanan $berkasPelayanan;

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

    public function mount(BerkasPelayanan $berkasPelayanan)
    {
        $this->berkasPelayanan = $berkasPelayanan;
        $this->initListsForFields();
        $this->mediaCollections = [
            'berkas_pelayanan_berkas_syarat' => $berkasPelayanan->berkas_syarat,
        ];
    }

    public function render()
    {
        return view('livewire.berkas-pelayanan.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->berkasPelayanan->save();
        $this->syncMedia();

        return redirect()->route('admin.berkas-pelayanans.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->berkasPelayanan->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'berkasPelayanan.pelayanan_id' => [
                'integer',
                'exists:pelayanans,id',
                'required',
            ],
            'berkasPelayanan.syarat_layanan_id' => [
                'integer',
                'exists:syarat_layanans,id',
                'required',
            ],
            'berkasPelayanan.teks_syarat' => [
                'string',
                'nullable',
            ],
            'mediaCollections.berkas_pelayanan_berkas_syarat' => [
                'array',
                'nullable',
            ],
            'mediaCollections.berkas_pelayanan_berkas_syarat.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'berkasPelayanan.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'berkasPelayanan.catatan_reviewer' => [
                'string',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['pelayanan']      = Pelayanan::pluck('kode', 'id')->toArray();
        $this->listsForFields['syarat_layanan'] = SyaratLayanan::pluck('nama', 'id')->toArray();
        $this->listsForFields['status']         = $this->berkasPelayanan::STATUS_RADIO;
    }
}

<?php

namespace App\Http\Livewire\Admin\Pelayanan;

use App\Models\JenisLayanan;
use App\Models\Pelayanan;
use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Pelayanan $pelayanan;

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

    public function mount(Pelayanan $pelayanan)
    {
        $this->pelayanan         = $pelayanan;
        $this->pelayanan->status = 'Terkirim';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.admin.pelayanan.create');
    }

    public function submit()
    {
        $this->validate();

        $this->pelayanan->save();
        $this->syncMedia();

        return redirect()->route('admin.pelayanans.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->pelayanan->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
    }

    protected function rules(): array
    {
        return [
            'pelayanan.pemohon_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'pelayanan.jenis_layanan_id' => [
                'integer',
                'exists:jenis_layanans,id',
                'required',
            ],
            'pelayanan.kode' => [
                'string',
                'required',
                'unique:pelayanans,kode',
            ],
            'pelayanan.catatan_pemohon' => [
                'string',
                'nullable',
            ],
            'pelayanan.catatan_reviewer' => [
                'string',
                'nullable',
            ],
            'pelayanan.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'mediaCollections.pelayanan_berkas_hasil' => [
                'array',
                'nullable',
            ],
            'mediaCollections.pelayanan_berkas_hasil.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'pelayanan.rating' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['rating'])),
            ],
            'pelayanan.penilaian_pemohon' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['pemohon']       = User::pluck('name', 'id')->toArray();
        $this->listsForFields['jenis_layanan'] = JenisLayanan::pluck('nama', 'id')->toArray();
        $this->listsForFields['status']        = $this->pelayanan::STATUS_SELECT;
        $this->listsForFields['rating']        = $this->pelayanan::RATING_RADIO;
    }
}

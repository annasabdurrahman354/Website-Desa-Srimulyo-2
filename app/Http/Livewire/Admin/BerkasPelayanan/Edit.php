<?php

namespace App\Http\Livewire\Admin\BerkasPelayanan;

use App\Models\BerkasPelayanan;
use App\Models\Pelayanan;
use App\Models\SyaratLayanan;
use App\Models\User;
use App\Models\UserAlert;
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
        return view('livewire.admin.berkas-pelayanan.edit');
    }

    public function submit()
    {
        if($this->berkasPelayanan->status_label == "Revisi"){
            $this->validateOnly($this->berkasPelayanan->catatan_reviewer, [
                'berkasPelayanan.catatan_reviewer' => 'string|required',
            ]);
        }
        $this->validate();
        $this->sendNotification();
        $this->berkasPelayanan->save();
        $this->syncMedia();

        return redirect()->route('admin.berkas-pelayanans.index');
    }

    protected function sendNotification(){
        if($this->berkasPelayanan->status == "Revisi"){
            $userAlert = new UserAlert();
            $notification = getNotificationMessage('user_syaratPelayanan_revisi', $this->berkasPelayanan->pelayanan->pemohon, $this->berkasPelayanan);
            $userAlert->message = $notification['message'];
            $userAlert->link = $notification['link'];
            $userAlert->save();
            $userAlert->users()->sync(User::where('id', $this->berkasPelayanan->pelayanan->pemohon_id)->get());
        }
        elseif($this->berkasPelayanan->status == "Diterima"){
            $userAlert = new UserAlert();
            $notification = getNotificationMessage('user_syaratPelayanan_diterima', $this->berkasPelayanan->pelayanan->pemohon, $this->berkasPelayanan);
            $userAlert->message = $notification['message'];
            $userAlert->link = $notification['link'];
            $userAlert->save();
            $userAlert->users()->sync(User::where('id', $this->berkasPelayanan->pelayanan->pemohon_id)->get());
        }
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->berkasPelayanan->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        BerkasPelayanan::where('id', $this->berkasPelayanan->id)->first()->syncMediaName();
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
                'nullable',
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

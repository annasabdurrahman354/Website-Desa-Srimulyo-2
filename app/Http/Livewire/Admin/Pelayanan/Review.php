<?php

namespace App\Http\Livewire\Admin\Pelayanan;

use App\Models\JenisLayanan;
use App\Models\Pelayanan;
use App\Models\User;
use App\Models\UserAlert;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Review extends Component
{
    public Pelayanan $pelayanan;
    public $berkasPelayananByType = [];

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

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(Pelayanan $pelayanan)
    {
        if($pelayanan->status == "Terkirim"){
            Pelayanan::where('id', $pelayanan->id)->update(array('status' => 'Verifikasi'));
            $pelayanan->status = "Verifikasi";
        }
        if($pelayanan->isAllBerkasDiterima() && !$pelayanan->status == "Selesai"){
            $pelayanan->status = "Verifikasi";
        }
        $this->pelayanan =  $pelayanan->load('pemohon', 'jenisLayanan');
        $this->berkasPelayananByType =  $pelayanan->berkasPelayananByType();
        $this->initListsForFields();
        $this->mediaCollections = [
            'pelayanan_berkas_hasil' => $pelayanan->berkas_hasil,
        ];
    }

    public function render()
    {
        return view('livewire.admin.pelayanan.review');
    }

    public function submit()
    {
        $this->validate();
        $this->sendNotification();
        $this->pelayanan->save();
        $this->syncMedia();

        return redirect()->route('admin.pelayanans.index');
    }

    protected function sendNotification(){
        if($this->pelayanan->status == "Selesai"){
            $userAlert = new UserAlert();
            if($this->pelayanan->jenisLayanan->pelayanan_online){
                $notification = getNotificationMessage('user_pelayanan_selesai_online', $this->pelayanan->pemohon, $this->pelayanan);
            }
            else{
                $notification = getNotificationMessage('user_pelayanan_selesai_offline', $this->pelayanan->pemohon, $this->pelayanan); 
            }
            $userAlert->message = $notification['message'];
            $userAlert->link = $notification['link'];
            $userAlert->save();
            $userAlert->users()->sync(User::where('id', $this->pelayanan->pemohon_id)->get());
        }
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->pelayanan->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        Pelayanan::where('id', $this->pelayanan->id)->first()->syncMediaName();
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
            ],
            'pelayanan.catatan_pemohon' => [
                'string',
                'nullable',
            ],
            'pelayanan.catatan_reviewer' => [
                'string',
                'required',
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

    public function updated($field)
    {
        if ($field === 'pelayanan.status') {
            if($this->pelayanan->status == "Selesai"){
                if($this->pelayanan->jenisLayanan->pelayanan_online){
                    $this->pelayanan->catatan_reviewer = "Silahkan unduh berkas digital yang terlampir!";  
                }
                else{
                    $this->pelayanan->catatan_reviewer = "Silahkan ambil berkas di kantor desa!";
                }
            } 
            else{
                $this->pelayanan->catatan_reviewer = "";
            }
        }
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['pemohon']       = User::pluck('name', 'id')->toArray();
        $this->listsForFields['status']        = $this->pelayanan::STATUS_SELECT_DITERIMA;
        $this->listsForFields['jenis_layanan'] = JenisLayanan::pluck('nama', 'id')->toArray();
        $this->listsForFields['rating']        = $this->pelayanan::RATING_RADIO;
    }
}

<?php

namespace App\Http\Livewire\User\Profile;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserProfileIndex extends Component
{
    public User $user;
    public $provinsi = null;
    public $kota = null;
    public $semuaProvinsi;
    public $semuaKota;

    public $edit = false;
    public $changePassword = false;

    public string $old_password = '';
    public string $new_password = '';
    public string $confirm_password = '';

    public array $mediaToRemove = [];
    public array $listsForFields = [];
    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function toggleEdit()
    {
        $this->edit = !$this->edit;
        $this->user->refresh();
        $this->provinsi = $this->user->tempatLahir->provinsi_id;
        $this->kota = $this->user->tempat_lahir_id;
    }

    public function toggleChangePassword()
    {
        $this->changePassword = !$this->changePassword;
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

    public function mount()
    {
        $this->user  = auth()->user();
        $this->initListsForFields();
        $this->provinsi = $this->user->tempatLahir->provinsi_id;
        $this->kota = $this->user->tempat_lahir_id;
        $this->semuaProvinsi = Provinsi::all();
        $this->semuaKota = Kota::where('provinsi_id', $this->provinsi)->get();;
        $this->mediaCollections = [
            'user_foto_profil' => $this->user->foto_profil,
        ];
    }

    public function render()
    {
        return view('livewire.user.profile.index')->extends('layouts.user');
    }

    public function submit()
    {
        $this->validate();
        if($this->changePassword){
            $this->user->password = $this->new_password;
        }
        $this->user->save();
        $this->syncMedia();
        $this->edit = false;
        return redirect()->route('user.profile.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->user->id]));

        foreach(Media::whereIn('uuid', $this->mediaToRemove)->get() as $media){
            $media->delete();
        }
        User::where('id', $this->user->id)->first()->syncMediaName();
    }

    protected function rules(): array
    {
        return [
            'mediaCollections.user_foto_profil' => [
                'array',
                'nullable',
            ],
            'mediaCollections.user_foto_profil.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'user.name' => [
                'string',
                'required',
            ],
            'user.nik' => [
                'digits:16',
                'required',
                'numeric'
            ],
            'user.nomor_telepon' => [
                'string',
                'numeric',
                'required',
            ],
            'user.jenis_kelamin' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['jenis_kelamin'])),
            ],
            'user.tempat_lahir_id' => [
                'integer',
                'exists:kota,id',
                'required',
            ],
            'user.tanggal_lahir' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'user.alamat' => [
                'string',
                'required',
            ],
            'user.email' => [
                'email:rfc',
                'required',
                'unique:users,email,' . $this->user->id,
            ],
            'old_password' => [
                'required_if:changePassword,true',
                function ($attribute, $value, $fail) {
                    if (!\Illuminate\Support\Facades\Hash::check($value, auth()->user()->password)) {
                        $fail('Password lama tidak tepat!');
                    }
                },
            ],
            'new_password' => [
                'string',
                'min:8',
                'required_if:changePassword,true',
            ],
            'confirm_password' => [
                'string',
                'min:8',
                'required_if:changePassword,true',
                'same:new_password',
            ],
        ];
    }

    public function updatedProvinsi($provinsi)
    {
        $this->semuaKota = Kota::where('provinsi_id', $provinsi)->get();
        if($this->edit){
            $this->kota = null;
        }
        else{
            $this->kota = $this->user->tempat_lahir_id;
        }
    }

    public function updatedKota($kota)
    {
        $this->user->tempat_lahir_id = $kota;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis_kelamin'] = $this->user::JENIS_KELAMIN_RADIO;
        $this->listsForFields['tempat_lahir']  = Kota::pluck('nama', 'id')->toArray();
    }
}

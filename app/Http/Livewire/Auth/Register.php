<?php

namespace App\Http\Livewire\Auth;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public User $user;

    public $provinsi = null;
    public $kota = null;
    public $semuaProvinsi;
    public $semuaKota;

    public string $password = '';
    public string $konfirmasi_password = '';

    public array $listsForFields = [];
    
    public function mount(User $user)
    {
        $this->user                = $user;
        $this->user->jenis_kelamin = 'Laki-laki';
        $this->initListsForFields();
        $this->semuaProvinsi = Provinsi::all();
        $this->semuaKota = collect();
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }

    public function submit()
    {
        $this->validate();
        $this->user->password = $this->password;
        $this->user->save();
        $this->user->roles()->sync(2);
        event(new Registered($this->user));
        Auth::login($this->user);

        return redirect()->route('user.home');
    }

    protected function rules(): array
    {
        return [
            'user.name' => [
                'string',
                'required',
            ],
            'user.nik' => [
                'string',
                'min:16',
                'max:16',
                'required',
                'numeric'
            ],
            'user.nomor_telepon' => [
                'string',
                'required',
                'numeric'
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
                'unique:users,email',
            ],
            'password' => [
                'string',
                'required',
                'min:8'
            ],
            'konfirmasi_password' => [
                'string',
                'required',
                'same:password'
            ],
        ];
    }

    public function updatedProvinsi($provinsi)
    {
        $this->semuaKota = Kota::where('provinsi_id', $provinsi)->get();
        $this->kota = null;
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

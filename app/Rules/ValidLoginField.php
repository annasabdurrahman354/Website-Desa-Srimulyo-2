<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class ValidLoginField implements Rule
{
    public function passes($attribute, $value)
    {
        $user = User::where('email', $value)
                    ->orWhere('nik', $value)
                    ->orWhere('nomor_telepon', $value)
                    ->first();

        return $user ? true : false;
    }

    public function message()
    {
        return 'NIK/Nomor Telepon/Email tidak ditemukan!';
    }
}
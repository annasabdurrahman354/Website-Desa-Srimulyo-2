<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin 1',
                'nomor_telepon'  => '085786537295',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'locale'         => '',
                'nik'            => '',
                'nomor_telepon'  => '',
                'alamat'         => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Admin 2',
                'nomor_telepon'  => '085786537295',
                'email'          => 'web.srimulyo@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'locale'         => '',
                'nik'            => '',
                'nomor_telepon'  => '',
                'alamat'         => '',
            ],
        ];

        User::insert($users);
    }
}

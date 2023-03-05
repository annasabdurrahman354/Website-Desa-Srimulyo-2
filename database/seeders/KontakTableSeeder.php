<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakTableSeeder extends Seeder
{
    public function run()
    {
        $kontaks = [
            [
                'id'           => '1',
                'nama'           => 'Alamat',
                'kontak'         => 'Srimolyo, Desa Srimulyo, Kecamatan Gondang, Kabupaten Sragen, Jawa Tengah 57254',
                'jenis_kontak'   => 'Kantor',
            ],
            [
                'id'           => '2',
                'nama'           => 'Email',
                'kontak'         => 'web.srimulyo@gmail.com',
                'jenis_kontak'   => 'Pelayanan',
            ],
            [
                'id'           => '3',
                'nama'           => 'Instagram',
                'kontak'         => 'https://www.instagram.com/srimulyo_gondang/',
                'jenis_kontak'   => 'Pelayanan',
            ],
            [
                'id'           => '4',
                'nama'           => 'Facebook',
                'kontak'         => 'https://m.facebook.com/100090581452380/',
                'jenis_kontak'   => 'Pelayanan',
            ],
            [
                'id'           => '5',
                'nama'           => 'Youtube',
                'kontak'         => 'https://www.youtube.com/channel/UCBMKAs0h8RKc6aKl87Mrjvw',
                'jenis_kontak'   => 'Pelayanan',
            ],
            [
                'id'           => '6',
                'nama'           => 'Telepon',
                'kontak'         => '085786537295',
                'jenis_kontak'   => 'Pelayanan',
            ],
            [
                'id'           => '7',
                'nama'           => 'WhatsApp',
                'kontak'         => '085786537295',
                'jenis_kontak'   => 'Pelayanan',
            ],
        ];

        Kontak::insert($kontaks);
    }
}

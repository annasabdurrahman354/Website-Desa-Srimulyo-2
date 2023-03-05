<?php

namespace Database\Seeders;

use App\Models\KategoriArtikel;
use App\Models\KategoriProduk;
use App\Models\KategoriUmkm;
use App\Models\SatuanProduk;
use App\Models\User;
use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    public function run()
    {
        $kategoriArtikels = [
            [
                'kategori'           => 'Berita Desa',
            ],
            [
                'kategori'           => 'Budaya',
            ],
            [
                'kategori'           => 'Program Kerja',
            ],
        ];

        $kategoriProduks = [
            [
                'kategori'           => 'Makanan',
            ],
            [
                'kategori'           => 'Minuman',
            ],
            [
                'kategori'           => 'Sembako',
            ],
            [
                'kategori'           => 'Fashion',
            ],
            [
                'kategori'           => 'Elektronik',
            ],
            [
                'kategori'           => 'Handphone & Aksesoris',
            ],
            [
                'kategori'           => 'Buku & Alat Tulis',
            ],
            [
                'kategori'           => 'Ibu & Bayi',
            ],
            [
                'kategori'           => 'Kesehatan',
            ],
            [
                'kategori'           => 'Perawatan Diri',
            ],
            [
                'kategori'           => 'Olahraga & Outdoor',
            ],
            [
                'kategori'           => 'Otomotif',
            ],
            [
                'kategori'           => 'Perlengkapan Rumah',
            ],
            [
                'kategori'           => 'Mebel',
            ],
            [
                'kategori'           => 'Properti',
            ],
        ];

        $kategoriUmkms = [
            [
                'kategori'           => 'Batu Bata',
            ],
            [
                'kategori'           => 'Rumah Makan',
            ],
            [
                'kategori'           => 'Toko Kelontong',
            ],
            [
                'kategori'           => 'Toko Pakaian',
            ],
            [
                'kategori'           => 'Toko Peralatan Rumah',
            ],
            [
                'kategori'           => 'Toko Elektronik',
            ],
            [
                'kategori'           => 'Toserba',
            ],
            [
                'kategori'           => 'Supermarket',
            ],
            [
                'kategori'           => 'Pom Bensin',
            ],
            [
                'kategori'           => 'Jasa',
            ],
        ];

        
        $satuans = [
            [
                'satuan'           => 'pcs',
            ],
            [
                'satuan'           => 'kg',
            ],
            [
                'satuan'           => 'liter',
            ],
            [
                'satuan'           => 'lembar',
            ],
            [
                'satuan'           => 'lusin',
            ],
            [
                'satuan'           => 'box',
            ],
        ];

        KategoriArtikel::insert($kategoriArtikels);
        KategoriProduk::insert($kategoriProduks);
        KategoriUmkm::insert($kategoriUmkms);
        SatuanProduk::insert($satuans);
    }
}

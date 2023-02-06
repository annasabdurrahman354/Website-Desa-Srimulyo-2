<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 24,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 25,
                'title' => 'provinsi_create',
            ],
            [
                'id'    => 26,
                'title' => 'provinsi_edit',
            ],
            [
                'id'    => 27,
                'title' => 'provinsi_show',
            ],
            [
                'id'    => 28,
                'title' => 'provinsi_delete',
            ],
            [
                'id'    => 29,
                'title' => 'provinsi_access',
            ],
            [
                'id'    => 30,
                'title' => 'kota_create',
            ],
            [
                'id'    => 31,
                'title' => 'kota_edit',
            ],
            [
                'id'    => 32,
                'title' => 'kota_show',
            ],
            [
                'id'    => 33,
                'title' => 'kota_delete',
            ],
            [
                'id'    => 34,
                'title' => 'kota_access',
            ],
            [
                'id'    => 35,
                'title' => 'manajemen_konten_access',
            ],
            [
                'id'    => 36,
                'title' => 'aparatur_desa_create',
            ],
            [
                'id'    => 37,
                'title' => 'aparatur_desa_edit',
            ],
            [
                'id'    => 38,
                'title' => 'aparatur_desa_show',
            ],
            [
                'id'    => 39,
                'title' => 'aparatur_desa_delete',
            ],
            [
                'id'    => 40,
                'title' => 'aparatur_desa_access',
            ],
            [
                'id'    => 41,
                'title' => 'kategori_artikel_create',
            ],
            [
                'id'    => 42,
                'title' => 'kategori_artikel_edit',
            ],
            [
                'id'    => 43,
                'title' => 'kategori_artikel_show',
            ],
            [
                'id'    => 44,
                'title' => 'kategori_artikel_delete',
            ],
            [
                'id'    => 45,
                'title' => 'kategori_artikel_access',
            ],
            [
                'id'    => 46,
                'title' => 'artikel_create',
            ],
            [
                'id'    => 47,
                'title' => 'artikel_edit',
            ],
            [
                'id'    => 48,
                'title' => 'artikel_show',
            ],
            [
                'id'    => 49,
                'title' => 'artikel_delete',
            ],
            [
                'id'    => 50,
                'title' => 'artikel_access',
            ],
            [
                'id'    => 51,
                'title' => 'data_penduduk_create',
            ],
            [
                'id'    => 52,
                'title' => 'data_penduduk_edit',
            ],
            [
                'id'    => 53,
                'title' => 'data_penduduk_show',
            ],
            [
                'id'    => 54,
                'title' => 'data_penduduk_delete',
            ],
            [
                'id'    => 55,
                'title' => 'data_penduduk_access',
            ],
            [
                'id'    => 56,
                'title' => 'produk_hukum_create',
            ],
            [
                'id'    => 57,
                'title' => 'produk_hukum_edit',
            ],
            [
                'id'    => 58,
                'title' => 'produk_hukum_show',
            ],
            [
                'id'    => 59,
                'title' => 'produk_hukum_delete',
            ],
            [
                'id'    => 60,
                'title' => 'produk_hukum_access',
            ],
            [
                'id'    => 61,
                'title' => 'carousel_create',
            ],
            [
                'id'    => 62,
                'title' => 'carousel_edit',
            ],
            [
                'id'    => 63,
                'title' => 'carousel_show',
            ],
            [
                'id'    => 64,
                'title' => 'carousel_delete',
            ],
            [
                'id'    => 65,
                'title' => 'carousel_access',
            ],
            [
                'id'    => 66,
                'title' => 'manajemen_umkm_access',
            ],
            [
                'id'    => 67,
                'title' => 'kategori_umkm_create',
            ],
            [
                'id'    => 68,
                'title' => 'kategori_umkm_edit',
            ],
            [
                'id'    => 69,
                'title' => 'kategori_umkm_show',
            ],
            [
                'id'    => 70,
                'title' => 'kategori_umkm_delete',
            ],
            [
                'id'    => 71,
                'title' => 'kategori_umkm_access',
            ],
            [
                'id'    => 72,
                'title' => 'umkm_create',
            ],
            [
                'id'    => 73,
                'title' => 'umkm_edit',
            ],
            [
                'id'    => 74,
                'title' => 'umkm_show',
            ],
            [
                'id'    => 75,
                'title' => 'umkm_delete',
            ],
            [
                'id'    => 76,
                'title' => 'umkm_access',
            ],
            [
                'id'    => 77,
                'title' => 'satuan_produk_create',
            ],
            [
                'id'    => 78,
                'title' => 'satuan_produk_edit',
            ],
            [
                'id'    => 79,
                'title' => 'satuan_produk_show',
            ],
            [
                'id'    => 80,
                'title' => 'satuan_produk_delete',
            ],
            [
                'id'    => 81,
                'title' => 'satuan_produk_access',
            ],
            [
                'id'    => 82,
                'title' => 'kategori_produk_create',
            ],
            [
                'id'    => 83,
                'title' => 'kategori_produk_edit',
            ],
            [
                'id'    => 84,
                'title' => 'kategori_produk_show',
            ],
            [
                'id'    => 85,
                'title' => 'kategori_produk_delete',
            ],
            [
                'id'    => 86,
                'title' => 'kategori_produk_access',
            ],
            [
                'id'    => 87,
                'title' => 'produk_create',
            ],
            [
                'id'    => 88,
                'title' => 'produk_edit',
            ],
            [
                'id'    => 89,
                'title' => 'produk_show',
            ],
            [
                'id'    => 90,
                'title' => 'produk_delete',
            ],
            [
                'id'    => 91,
                'title' => 'produk_access',
            ],
            [
                'id'    => 92,
                'title' => 'manajemen_layanan_access',
            ],
            [
                'id'    => 93,
                'title' => 'kotak_saran_create',
            ],
            [
                'id'    => 94,
                'title' => 'kotak_saran_edit',
            ],
            [
                'id'    => 95,
                'title' => 'kotak_saran_show',
            ],
            [
                'id'    => 96,
                'title' => 'kotak_saran_delete',
            ],
            [
                'id'    => 97,
                'title' => 'kotak_saran_access',
            ],
            [
                'id'    => 98,
                'title' => 'syarat_layanan_create',
            ],
            [
                'id'    => 99,
                'title' => 'syarat_layanan_edit',
            ],
            [
                'id'    => 100,
                'title' => 'syarat_layanan_show',
            ],
            [
                'id'    => 101,
                'title' => 'syarat_layanan_delete',
            ],
            [
                'id'    => 102,
                'title' => 'syarat_layanan_access',
            ],
            [
                'id'    => 103,
                'title' => 'jenis_layanan_create',
            ],
            [
                'id'    => 104,
                'title' => 'jenis_layanan_edit',
            ],
            [
                'id'    => 105,
                'title' => 'jenis_layanan_show',
            ],
            [
                'id'    => 106,
                'title' => 'jenis_layanan_delete',
            ],
            [
                'id'    => 107,
                'title' => 'jenis_layanan_access',
            ],
            [
                'id'    => 108,
                'title' => 'pelayanan_create',
            ],
            [
                'id'    => 109,
                'title' => 'pelayanan_edit',
            ],
            [
                'id'    => 110,
                'title' => 'pelayanan_show',
            ],
            [
                'id'    => 111,
                'title' => 'pelayanan_delete',
            ],
            [
                'id'    => 112,
                'title' => 'pelayanan_access',
            ],
            [
                'id'    => 113,
                'title' => 'berkas_pelayanan_create',
            ],
            [
                'id'    => 114,
                'title' => 'berkas_pelayanan_edit',
            ],
            [
                'id'    => 115,
                'title' => 'berkas_pelayanan_show',
            ],
            [
                'id'    => 116,
                'title' => 'berkas_pelayanan_delete',
            ],
            [
                'id'    => 117,
                'title' => 'berkas_pelayanan_access',
            ],
            [
                'id'    => 118,
                'title' => 'kontak_create',
            ],
            [
                'id'    => 119,
                'title' => 'kontak_edit',
            ],
            [
                'id'    => 120,
                'title' => 'kontak_show',
            ],
            [
                'id'    => 121,
                'title' => 'kontak_delete',
            ],
            [
                'id'    => 122,
                'title' => 'kontak_access',
            ],
            [
                'id'    => 123,
                'title' => 'dokumen_umum_create',
            ],
            [
                'id'    => 124,
                'title' => 'dokumen_umum_edit',
            ],
            [
                'id'    => 125,
                'title' => 'dokumen_umum_show',
            ],
            [
                'id'    => 126,
                'title' => 'dokumen_umum_delete',
            ],
            [
                'id'    => 127,
                'title' => 'dokumen_umum_access',
            ],
        ];

        Permission::insert($permissions);
    }
}

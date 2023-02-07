<?php

return [
    'userManagement' => [
        'title'          => 'Manajemen User',
        'title_singular' => 'Manajemen User',
    ],
    'permission' => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Nama',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Peranan',
        'title_singular' => 'Peranan',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Nama',
            'title_helper'       => ' ',
            'permissions'        => 'Perizinan',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Nama',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Waktu Verifikasi Email',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Peran',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'locale'                   => 'Locale',
            'locale_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'nik'                      => 'Nomor Induk Kependudukan',
            'nik_helper'               => 'Masukkan 16 digit nomor induk kependudukan',
            'jenis_kelamin'            => 'Jenis Kelamin',
            'jenis_kelamin_helper'     => ' ',
            'tanggal_lahir'            => 'Tanggal Lahir',
            'tanggal_lahir_helper'     => ' ',
            'nomor_telepon'            => 'Nomor Telepon',
            'nomor_telepon_helper'     => 'Nomor WhatsApp lebih diutamakan',
            'alamat'                   => 'Alamat',
            'alamat_helper'            => ' ',
            'tempat_lahir'             => 'Tempat Lahir',
            'tempat_lahir_helper'      => ' ',
            'foto_profil'              => 'Foto Profil',
            'foto_profil_helper'       => 'Rasio foto ialah 1:1 dengan maksimal resolusi 256 x 256 px',
        ],
    ],
    'userAlert' => [
        'title'          => 'Notifikasi Pengguna',
        'title_singular' => 'Notifikasi Pengguna',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'message'           => 'Pesan',
            'message_helper'    => ' ',
            'link'              => 'Link',
            'link_helper'       => ' ',
            'users'             => 'Sasaran Pengguna',
            'users_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Log Audit',
        'title_singular' => 'Log Audit',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Event',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Attributes',
            'properties_helper'   => ' ',
            'host'                => 'IP',
            'host_helper'         => ' ',
            'created_at'          => 'Event time',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'provinsi' => [
        'title'          => 'Provinsi',
        'title_singular' => 'Provinsi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nama'              => 'Nama',
            'nama_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'kota' => [
        'title'          => 'Kota',
        'title_singular' => 'Kota',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'provinsi'          => 'Provinsi',
            'provinsi_helper'   => ' ',
            'nama'              => 'Nama',
            'nama_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'manajemenKonten' => [
        'title'          => 'Manajemen Konten',
        'title_singular' => 'Manajemen Konten',
    ],
    'aparaturDesa' => [
        'title'          => 'Aparatur Desa',
        'title_singular' => 'Aparatur Desa',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nama'              => 'Nama',
            'nama_helper'       => ' ',
            'posisi'            => 'Posisi',
            'posisi_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'is_aktif'          => 'Aktif',
            'is_aktif_helper'   => ' ',
            'foto'              => 'Foto',
            'foto_helper'       => 'Rasio foto ialah 2:3 dengan maksimal ukuran 512 x 768 px',
        ],
    ],
    'kategoriArtikel' => [
        'title'          => 'Kategori Artikel',
        'title_singular' => 'Kategori Artikel',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'kategori'          => 'Kategori',
            'kategori_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'artikel' => [
        'title'          => 'Artikel',
        'title_singular' => 'Artikel',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'judul'                 => 'Judul',
            'judul_helper'          => 'Panjang judul antara 40 - 70 karakter',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'penulis'               => 'Penulis',
            'penulis_helper'        => ' ',
            'rangkuman'             => 'Rangkuman',
            'rangkuman_helper'      => ' ',
            'konten'                => 'Konten',
            'konten_helper'         => ' ',
            'jumlah_pembaca'        => 'Jumlah Pembaca',
            'jumlah_pembaca_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'kategori'              => 'Kategori',
            'kategori_helper'       => ' ',
            'is_diterbitkan'        => 'Diterbitkan',
            'is_diterbitkan_helper' => ' ',
            'gambar'                => 'Gambar',
            'gambar_helper'         => 'Rasio foto ialah 3:2 dengan maksimal ukuran 1536 x 1024 px',
        ],
    ],
    'dataPenduduk' => [
        'title'          => 'Data Penduduk',
        'title_singular' => 'Data Penduduk',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'judul'                  => 'Judul',
            'judul_helper'           => ' ',
            'slug'                   => 'Slug',
            'slug_helper'            => ' ',
            'deskripsi'              => 'Deskripsi',
            'deskripsi_helper'       => ' ',
            'berkas_data'            => 'Berkas Data',
            'berkas_data_helper'     => 'Pilih file excel yang berisi tabel data',
            'is_grafik'              => 'Tampilkan Grafik',
            'is_grafik_helper'       => 'Centang jika ingin menampilkan grafik',
            'is_tabel'               => 'Tampilkan Tabel',
            'is_tabel_helper'        => 'Centang jika ingin menampilkan tabel',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'tahun_pembaruan'        => 'Tahun Pembaruan',
            'tahun_pembaruan_helper' => ' ',
            'is_aktif'               => 'Aktif',
            'is_aktif_helper'        => ' ',
        ],
    ],
    'produkHukum' => [
        'title'          => 'Produk Hukum',
        'title_singular' => 'Produk Hukum',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'judul'                 => 'Judul',
            'judul_helper'          => ' ',
            'jenis'                 => 'Jenis',
            'jenis_helper'          => ' ',
            'tahun'                 => 'Tahun',
            'tahun_helper'          => ' ',
            'berkas_dokumen'        => 'Berkas Dokumen',
            'berkas_dokumen_helper' => 'Unggah pdf berkas produk hukum',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'is_aktif'              => 'Aktif',
            'is_aktif_helper'       => ' ',
        ],
    ],
    'carousel' => [
        'title'          => 'Carousel',
        'title_singular' => 'Carousel',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'judul'              => 'Judul',
            'judul_helper'       => ' ',
            'link_tujuan'        => 'Link Tujuan',
            'link_tujuan_helper' => ' ',
            'is_aktif'           => 'Aktif',
            'is_aktif_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'gambar'             => 'Gambar',
            'gambar_helper'      => 'Rasio gambar ialah 3:1 dengan maksimal ukuran 3072 x 1024 px',
        ],
    ],
    'manajemenUmkm' => [
        'title'          => 'Manajemen UMKM',
        'title_singular' => 'Manajemen UMKM',
    ],
    'kategoriUmkm' => [
        'title'          => 'Kategori UMKM',
        'title_singular' => 'Kategori UMKM',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'kategori'          => 'Kategori',
            'kategori_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'umkm' => [
        'title'          => 'UMKM',
        'title_singular' => 'UMKM',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'pemilik'                   => 'Pemilik',
            'pemilik_helper'            => ' ',
            'nama_umkm'                 => 'Nama UMKM',
            'nama_umkm_helper'          => ' ',
            'slug'                      => 'Slug',
            'slug_helper'               => ' ',
            'deskripsi'                 => 'Deskripsi',
            'deskripsi_helper'          => ' ',
            'nomor_telepon'             => 'Nomor Telepon',
            'nomor_telepon_helper'      => ' ',
            'alamat'                    => 'Alamat',
            'alamat_helper'             => ' ',
            'latitude'                  => 'Latitude',
            'latitude_helper'           => ' ',
            'longitude'                 => 'Longitude',
            'longitude_helper'          => ' ',
            'waktu_keterlihatan'        => 'Waktu Keterlihatan',
            'waktu_keterlihatan_helper' => ' ',
            'is_aktif'                  => 'Aktif',
            'is_aktif_helper'           => ' ',
            'is_terverifikasi'          => 'Terverifikasi',
            'is_terverifikasi_helper'   => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'kategori'                  => 'Kategori',
            'kategori_helper'           => ' ',
            'carousel'                  => 'Carousel',
            'carousel_helper'           => 'Rasio foto ialah 2:1 dengan maksimal ukuran 2048 x 1024 px',
        ],
    ],
    'satuanProduk' => [
        'title'          => 'Satuan Produk',
        'title_singular' => 'Satuan Produk',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'satuan'            => 'Satuan',
            'satuan_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'kategoriProduk' => [
        'title'          => 'Kategori Produk',
        'title_singular' => 'Kategori Produk',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'kategori'          => 'Kategori',
            'kategori_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'produk' => [
        'title'          => 'Produk',
        'title_singular' => 'Produk',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'umkm'                => 'UMKM',
            'umkm_helper'         => ' ',
            'nama'                => 'Nama',
            'nama_helper'         => ' ',
            'slug'                => 'Slug',
            'slug_helper'         => ' ',
            'deskripsi'           => 'Deskripsi',
            'deskripsi_helper'    => ' ',
            'harga'               => 'Harga',
            'harga_helper'        => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'satuan'              => 'Satuan',
            'satuan_helper'       => ' ',
            'kategori'            => 'Kategori',
            'kategori_helper'     => ' ',
            'is_tersedia'         => 'Tersedia',
            'is_tersedia_helper'  => ' ',
            'is_tampilkan'        => 'Tampilkan',
            'is_tampilkan_helper' => ' ',
            'foto'                => 'Foto',
            'foto_helper'         => 'Rasio foto ialah 4:3 dengan maksimal ukuran 800 x 600 px',
        ],
    ],
    'manajemenLayanan' => [
        'title'          => 'Manajemen Layanan',
        'title_singular' => 'Manajemen Layanan',
    ],
    'kotakSaran' => [
        'title'          => 'Kotak Saran',
        'title_singular' => 'Kotak Saran',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'pengirim'             => 'Pengirim',
            'pengirim_helper'      => 'Kosongkan untuk anonim',
            'nomor_telepon'        => 'Nomor Telepon',
            'nomor_telepon_helper' => 'Kosongkan untuk anonim',
            'isi'                  => 'Isi',
            'isi_helper'           => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'syaratLayanan' => [
        'title'          => 'Syarat Layanan',
        'title_singular' => 'Syarat Layanan',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'jenis_berkas'           => 'Jenis Berkas',
            'jenis_berkas_helper'    => ' ',
            'deskripsi'              => 'Deskripsi',
            'deskripsi_helper'       => ' ',
            'berkas_formulir'        => 'Berkas Formulir',
            'berkas_formulir_helper' => 'Unggah template formulir jika dibutuhkan',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'nama'                   => 'Nama',
            'nama_helper'            => ' ',
        ],
    ],
    'jenisLayanan' => [
        'title'          => 'Jenis Layanan',
        'title_singular' => 'Jenis Layanan',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'nama'                    => 'Nama',
            'nama_helper'             => ' ',
            'deskripsi'               => 'Deskripsi',
            'deskripsi_helper'        => ' ',
            'biaya'                   => 'Biaya',
            'biaya_helper'            => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'syarat_layanan'          => 'Syarat Layanan',
            'syarat_layanan_helper'   => ' ',
            'pelayanan_online'        => 'Pelayanan Online',
            'pelayanan_online_helper' => 'Centang jika berkas hasil pelayanan bisa diambil secara online',
        ],
    ],
    'pelayanan' => [
        'title'          => 'Pelayanan',
        'title_singular' => 'Pelayanan',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'pemohon'                  => 'Pemohon',
            'pemohon_helper'           => ' ',
            'jenis_layanan'            => 'Jenis Layanan',
            'jenis_layanan_helper'     => ' ',
            'kode'                     => 'Kode',
            'kode_helper'              => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'catatan_reviewer'         => 'Catatan Reviewer',
            'catatan_reviewer_helper'  => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
            'berkas_hasil'         => 'Berkas Hasil Pelayanan',
            'berkas_hasil_helper'  => 'Unggah berkas hasil pelayanan secara online',
            'catatan_pemohon'          => 'Catatan Pemohon',
            'catatan_pemohon_helper'   => ' ',
            'rating'                   => 'Rating',
            'rating_helper'            => ' ',
            'penilaian_pemohon'        => 'Penilaian Pemohon',
            'penilaian_pemohon_helper' => ' ',
        ],
    ],
    'berkasPelayanan' => [
        'title'          => 'Berkas Pelayanan',
        'title_singular' => 'Berkas Pelayanan',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'pelayanan'               => 'Pelayanan',
            'pelayanan_helper'        => ' ',
            'syarat_layanan'          => 'Syarat Layanan',
            'syarat_layanan_helper'   => ' ',
            'teks_syarat'             => 'Teks Syarat',
            'teks_syarat_helper'      => ' ',
            'berkas_syarat'           => 'Berkas Syarat',
            'berkas_syarat_helper'    => ' ',
            'status'                  => 'Status',
            'status_helper'           => ' ',
            'catatan_reviewer'        => 'Catatan Reviewer',
            'catatan_reviewer_helper' => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'kontak' => [
        'title'          => 'Kontak',
        'title_singular' => 'Kontak',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'nama'                => 'Nama',
            'nama_helper'         => ' ',
            'kontak'              => 'Kontak',
            'kontak_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'jenis_kontak'        => 'Jenis Kontak',
            'jenis_kontak_helper' => ' ',
        ],
    ],
    'dokumenUmum' => [
        'title'          => 'Dokumen Umum',
        'title_singular' => 'Dokumen Umum',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'judul'                 => 'Judul',
            'judul_helper'          => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'tahun_terbit'          => 'Tahun Terbit',
            'tahun_terbit_helper'   => ' ',
            'deskripsi'             => 'Deskripsi',
            'deskripsi_helper'      => ' ',
            'berkas_dokumen'        => 'Berkas Dokumen',
            'berkas_dokumen_helper' => 'Unggah berkas dokumen (doc, pdf, excel, atau ppt)',
            'is_aktif'              => 'Aktif',
            'is_aktif_helper'       => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
];

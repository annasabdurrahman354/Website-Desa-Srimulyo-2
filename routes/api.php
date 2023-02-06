<?php

use App\Http\Controllers\Api\V1\Admin\AparaturDesaApiController;
use App\Http\Controllers\Api\V1\Admin\ArtikelApiController;
use App\Http\Controllers\Api\V1\Admin\BerkasPelayananApiController;
use App\Http\Controllers\Api\V1\Admin\CarouselApiController;
use App\Http\Controllers\Api\V1\Admin\DataPendudukApiController;
use App\Http\Controllers\Api\V1\Admin\DokumenUmumApiController;
use App\Http\Controllers\Api\V1\Admin\JenisLayananApiController;
use App\Http\Controllers\Api\V1\Admin\KategoriArtikelApiController;
use App\Http\Controllers\Api\V1\Admin\KategoriProdukApiController;
use App\Http\Controllers\Api\V1\Admin\KategoriUmkmApiController;
use App\Http\Controllers\Api\V1\Admin\KontakApiController;
use App\Http\Controllers\Api\V1\Admin\KotakSaranApiController;
use App\Http\Controllers\Api\V1\Admin\KotaApiController;
use App\Http\Controllers\Api\V1\Admin\PelayananApiController;
use App\Http\Controllers\Api\V1\Admin\PermissionApiController;
use App\Http\Controllers\Api\V1\Admin\ProdukApiController;
use App\Http\Controllers\Api\V1\Admin\ProdukHukumApiController;
use App\Http\Controllers\Api\V1\Admin\ProvinsiApiController;
use App\Http\Controllers\Api\V1\Admin\RoleApiController;
use App\Http\Controllers\Api\V1\Admin\SatuanProdukApiController;
use App\Http\Controllers\Api\V1\Admin\SyaratLayananApiController;
use App\Http\Controllers\Api\V1\Admin\UmkmApiController;
use App\Http\Controllers\Api\V1\Admin\UserAlertApiController;
use App\Http\Controllers\Api\V1\Admin\UserApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', PermissionApiController::class);

    // Roles
    Route::apiResource('roles', RoleApiController::class);

    // Users
    Route::post('users/media', [UserApiController::class, 'storeMedia'])->name('users.store_media');
    Route::apiResource('users', UserApiController::class);

    // User Alert
    Route::apiResource('user-alerts', UserAlertApiController::class);

    // Provinsi
    Route::apiResource('provinsis', ProvinsiApiController::class);

    // Kota
    Route::apiResource('kota', KotaApiController::class);

    // Aparatur Desa
    Route::post('aparatur-desas/media', [AparaturDesaApiController::class, 'storeMedia'])->name('aparatur_desas.store_media');
    Route::apiResource('aparatur-desas', AparaturDesaApiController::class);

    // Kategori Artikel
    Route::apiResource('kategori-artikels', KategoriArtikelApiController::class);

    // Artikel
    Route::post('artikels/media', [ArtikelApiController::class, 'storeMedia'])->name('artikels.store_media');
    Route::apiResource('artikels', ArtikelApiController::class);

    // Data Penduduk
    Route::post('data-penduduks/media', [DataPendudukApiController::class, 'storeMedia'])->name('data_penduduks.store_media');
    Route::apiResource('data-penduduks', DataPendudukApiController::class);

    // Produk Hukum
    Route::post('produk-hukums/media', [ProdukHukumApiController::class, 'storeMedia'])->name('produk_hukums.store_media');
    Route::apiResource('produk-hukums', ProdukHukumApiController::class);

    // Carousel
    Route::post('carousels/media', [CarouselApiController::class, 'storeMedia'])->name('carousels.store_media');
    Route::apiResource('carousels', CarouselApiController::class);

    // Kategori Umkm
    Route::apiResource('kategori-umkms', KategoriUmkmApiController::class);

    // Umkm
    Route::post('umkms/media', [UmkmApiController::class, 'storeMedia'])->name('umkms.store_media');
    Route::apiResource('umkms', UmkmApiController::class);

    // Satuan Produk
    Route::apiResource('satuan-produks', SatuanProdukApiController::class);

    // Kategori Produk
    Route::apiResource('kategori-produks', KategoriProdukApiController::class);

    // Produk
    Route::post('produks/media', [ProdukApiController::class, 'storeMedia'])->name('produks.store_media');
    Route::apiResource('produks', ProdukApiController::class);

    // Kotak Saran
    Route::apiResource('kotak-sarans', KotakSaranApiController::class);

    // Syarat Layanan
    Route::post('syarat-layanans/media', [SyaratLayananApiController::class, 'storeMedia'])->name('syarat_layanans.store_media');
    Route::apiResource('syarat-layanans', SyaratLayananApiController::class);

    // Jenis Layanan
    Route::apiResource('jenis-layanans', JenisLayananApiController::class);

    // Pelayanan
    Route::post('pelayanans/media', [PelayananApiController::class, 'storeMedia'])->name('pelayanans.store_media');
    Route::apiResource('pelayanans', PelayananApiController::class);

    // Berkas Pelayanan
    Route::post('berkas-pelayanans/media', [BerkasPelayananApiController::class, 'storeMedia'])->name('berkas_pelayanans.store_media');
    Route::apiResource('berkas-pelayanans', BerkasPelayananApiController::class);

    // Kontak
    Route::apiResource('kontaks', KontakApiController::class);

    // Dokumen Umum
    Route::post('dokumen-umums/media', [DokumenUmumApiController::class, 'storeMedia'])->name('dokumen_umums.store_media');
    Route::apiResource('dokumen-umums', DokumenUmumApiController::class);
});

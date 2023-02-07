<?php

use App\Http\Controllers\Admin\AparaturDesaController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\BerkasPelayananController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\DataPendudukController;
use App\Http\Controllers\Admin\DokumenUmumController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JenisLayananController;
use App\Http\Controllers\Admin\KategoriArtikelController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\KategoriUmkmController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\KotakSaranController;
use App\Http\Controllers\Admin\KotaController;
use App\Http\Controllers\Admin\PelayananController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProdukHukumController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SatuanProdukController;
use App\Http\Controllers\Admin\SyaratLayananController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\UserAlertController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\User\TesController;
use App\Http\Livewire\User\Pelayanan\PelayananIndex;
use App\Http\Livewire\User\Pelayanan\PelayananCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::post('users/media', [UserController::class, 'storeMedia'])->name('users.storeMedia');
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // User Alert
    Route::get('user-alerts/seen', [UserAlertController::class, 'seen'])->name('user-alerts.seen');
    Route::resource('user-alerts', UserAlertController::class, ['except' => ['store', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // Provinsi
    Route::resource('provinsis', ProvinsiController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kota
    Route::resource('kota', KotaController::class, ['except' => ['store', 'update', 'destroy']]);

    // Aparatur Desa
    Route::post('aparatur-desas/media', [AparaturDesaController::class, 'storeMedia'])->name('aparatur-desas.storeMedia');
    Route::resource('aparatur-desas', AparaturDesaController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kategori Artikel
    Route::resource('kategori-artikels', KategoriArtikelController::class, ['except' => ['store', 'update', 'destroy']]);

    // Artikel
    Route::post('artikels/media', [ArtikelController::class, 'storeMedia'])->name('artikels.storeMedia');
    Route::resource('artikels', ArtikelController::class, ['except' => ['store', 'update', 'destroy']]);

    // Data Penduduk
    Route::post('data-penduduks/media', [DataPendudukController::class, 'storeMedia'])->name('data-penduduks.storeMedia');
    Route::resource('data-penduduks', DataPendudukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Produk Hukum
    Route::post('produk-hukums/media', [ProdukHukumController::class, 'storeMedia'])->name('produk-hukums.storeMedia');
    Route::resource('produk-hukums', ProdukHukumController::class, ['except' => ['store', 'update', 'destroy']]);

    // Carousel
    Route::post('carousels/media', [CarouselController::class, 'storeMedia'])->name('carousels.storeMedia');
    Route::resource('carousels', CarouselController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kategori Umkm
    Route::resource('kategori-umkms', KategoriUmkmController::class, ['except' => ['store', 'update', 'destroy']]);

    // Umkm
    Route::post('umkms/media', [UmkmController::class, 'storeMedia'])->name('umkms.storeMedia');
    Route::resource('umkms', UmkmController::class, ['except' => ['store', 'update', 'destroy']]);

    // Satuan Produk
    Route::resource('satuan-produks', SatuanProdukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kategori Produk
    Route::resource('kategori-produks', KategoriProdukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Produk
    Route::post('produks/media', [ProdukController::class, 'storeMedia'])->name('produks.storeMedia');
    Route::resource('produks', ProdukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kotak Saran
    Route::resource('kotak-sarans', KotakSaranController::class, ['except' => ['store', 'update', 'destroy']]);

    // Syarat Layanan
    Route::post('syarat-layanans/media', [SyaratLayananController::class, 'storeMedia'])->name('syarat-layanans.storeMedia');
    Route::resource('syarat-layanans', SyaratLayananController::class, ['except' => ['store', 'update', 'destroy']]);

    // Jenis Layanan
    Route::resource('jenis-layanans', JenisLayananController::class, ['except' => ['store', 'update', 'destroy']]);

    // Pelayanan
    Route::post('pelayanans/media', [PelayananController::class, 'storeMedia'])->name('pelayanans.storeMedia');
    Route::resource('pelayanans', PelayananController::class, ['except' => ['store', 'update', 'destroy']]);

    // Berkas Pelayanan
    Route::post('berkas-pelayanans/media', [BerkasPelayananController::class, 'storeMedia'])->name('berkas-pelayanans.storeMedia');
    Route::resource('berkas-pelayanans', BerkasPelayananController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kontak
    Route::resource('kontaks', KontakController::class, ['except' => ['store', 'update', 'destroy']]);

    // Dokumen Umum
    Route::post('dokumen-umums/media', [DokumenUmumController::class, 'storeMedia'])->name('dokumen-umums.storeMedia');
    Route::resource('dokumen-umums', DokumenUmumController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {
    Route::get('/', [TesController::class, 'index'])->name('home');
    Route::get('/pelayanan', PelayananIndex::class)->name('pelayanan');
    Route::get('/pelayanan/create', PelayananCreate::class)->name('pelayanan.create');
});

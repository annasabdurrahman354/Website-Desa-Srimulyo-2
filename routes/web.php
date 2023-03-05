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

use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Guest\Artikel\GuestArtikelIndex;
use App\Http\Livewire\Guest\Artikel\GuestArtikelShow;
use App\Http\Livewire\Guest\Beranda\GuestBeranda;
use App\Http\Livewire\Guest\DataPenduduk\GuestDataPendudukIndex;
use App\Http\Livewire\Guest\DataPenduduk\GuestDataPendudukShow;
use App\Http\Livewire\Guest\DokumenUmum\GuestDokumenUmumIndex;
use App\Http\Livewire\Guest\DokumenUmum\GuestDokumenUmumShow;
use App\Http\Livewire\Guest\KotakSaran\GuestKotakSaran;
use App\Http\Livewire\Guest\ProdukHukum\GuestProdukHukumIndex;
use App\Http\Livewire\Guest\ProdukHukum\GuestProdukHukumShow;
use App\Http\Livewire\Guest\Umkm\GuestPetaUmkm;
use App\Http\Livewire\Guest\Umkm\GuestProdukIndex;
use App\Http\Livewire\Guest\Umkm\GuestUmkmEtalasae;
use App\Http\Livewire\Guest\Umkm\GuestUmkmIndex;
use App\Http\Livewire\User\Home\UserHomeIndex;
use App\Http\Livewire\User\Pelayanan\UserPelayananIndex;
use App\Http\Livewire\User\Pelayanan\UserPelayananCreate;
use App\Http\Livewire\User\Pelayanan\UserPelayananRevisi;
use App\Http\Livewire\User\Pelayanan\UserPelayananShow;
use App\Http\Livewire\User\Profile\UserProfileIndex;
use App\Http\Livewire\User\Usaha\Produk\UserProdukCreate;
use App\Http\Livewire\User\Usaha\Produk\UserProdukEdit;
use App\Http\Livewire\User\Usaha\UserUsahaEdit;
use App\Http\Livewire\User\Usaha\UserUsahaIndex;
use App\Http\Livewire\User\Usaha\UserUsahaRegister;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
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
    Route::resource('umkms', UmkmController::class, ['except' => ['store', 'update', 'destroy']]);

    // Satuan Produk
    Route::resource('satuan-produks', SatuanProdukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kategori Produk
    Route::resource('kategori-produks', KategoriProdukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Produk
    Route::resource('produks', ProdukController::class, ['except' => ['store', 'update', 'destroy']]);

    // Kotak Saran
    Route::resource('kotak-sarans', KotakSaranController::class, ['except' => ['store', 'update', 'destroy']]);

    // Syarat Layanan
    Route::post('syarat-layanans/media', [SyaratLayananController::class, 'storeMedia'])->name('syarat-layanans.storeMedia');
    Route::resource('syarat-layanans', SyaratLayananController::class, ['except' => ['store', 'update', 'destroy']]);

    // Jenis Layanan
    Route::resource('jenis-layanans', JenisLayananController::class, ['except' => ['store', 'update', 'destroy']]);

    // Pelayanan
    Route::resource('pelayanans', PelayananController::class, ['except' => ['store', 'update', 'destroy']]);
    Route::get('pelayanans/review/{pelayanan}', [PelayananController::class, 'review'])->name('pelayanans.review');


    // Berkas Pelayanan
    Route::resource('berkas-pelayanans', BerkasPelayananController::class, ['except' => ['store', 'update', 'destroy']]);
    Route::get('berkas-pelayanans/review/{berkasPelayanan}', [BerkasPelayananController::class, 'review'])->name('berkas-pelayanans.review');

    // Kontak
    Route::resource('kontaks', KontakController::class, ['except' => ['store', 'update', 'destroy']]);

    // Dokumen Umum
    Route::post('dokumen-umums/media', [DokumenUmumController::class, 'storeMedia'])->name('dokumen-umums.storeMedia');
    Route::resource('dokumen-umums', DokumenUmumController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    // Umkm
    Route::post('umkms/media', [UmkmController::class, 'storeMedia'])->name('umkms.storeMedia');

    // Produk
    Route::post('produks/media', [ProdukController::class, 'storeMedia'])->name('produks.storeMedia');

    // Pelayanan
    Route::post('pelayanans/media', [PelayananController::class, 'storeMedia'])->name('pelayanans.storeMedia');

    // Berkas Pelayanan
    Route::post('berkas-pelayanans/media', [BerkasPelayananController::class, 'storeMedia'])->name('berkas-pelayanans.storeMedia');

    // User
    Route::post('users/media', [UserController::class, 'storeMedia'])->name('users.storeMedia');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});

Route::group(['as' => 'guest.'], function () {
    Route::get('/', GuestBeranda::class)->name('home');
    Route::get('/artikel', GuestArtikelIndex::class)->name('artikel.index');
    Route::get('/artikel/{slug}', GuestArtikelShow::class)->name('artikel.show');
    Route::get('/data-penduduk', GuestDataPendudukIndex::class)->name('data-penduduk.index');
    Route::get('/data-penduduk/{slug}', GuestDataPendudukShow::class)->name('data-penduduk.show');
    Route::get('/dokumen-umum', GuestDokumenUmumIndex::class)->name('dokumen-umum.index');
    Route::get('/dokumen-umum/{slug}', GuestDokumenUmumShow::class)->name('dokumen-umum.show');
    Route::get('/produk-hukum', GuestProdukHukumIndex::class)->name('produk-hukum.index');
    Route::get('/produk-hukum/{slug}', GuestProdukHukumShow::class)->name('produk-hukum.show');
    Route::get('/umkm/peta', GuestPetaUmkm::class)->name('umkm.peta');
    Route::get('/umkm', GuestUmkmIndex::class)->name('umkm.index');
    Route::get('/umkm/produk', GuestProdukIndex::class)->name('produk.index');
    Route::get('/umkm/etalase/{slug}', GuestUmkmEtalasae::class)->name('umkm.etalase');
    Route::get('/kotak-saran', GuestKotakSaran::class)->name('kotak-saran.index');
});

Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', Register::class)->name('register');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {
    Route::get('/', UserHomeIndex::class)->name('home');
    Route::get('/pelayanan', UserPelayananIndex::class)->name('pelayanan.index');
    Route::get('/pelayanan/buat', UserPelayananCreate::class)->name('pelayanan.create');
    Route::get('/pelayanan/lihat/{pelayanan}', UserPelayananShow::class)->name('pelayanan.show');
    Route::get('/pelayanan/revisi/{pelayanan}/{syaratLayanan}', UserPelayananRevisi::class)->name('pelayanan.revisi');
    Route::get('/usaha', UserUsahaIndex::class)->name('usaha.index');
    Route::get('/usaha/daftar', UserUsahaRegister::class)->name('usaha.register');
    Route::get('/usaha/edit/', UserUsahaEdit::class)->name('usaha.edit');
    Route::get('/usaha/produk/buat/', UserProdukCreate::class)->name('usaha.produk.create');
    Route::get('/usaha/produk/edit/{slug}', UserProdukEdit::class)->name('usaha.produk.edit');
    Route::get('/profile', UserProfileIndex::class)->name('profile.index');
});

Route::group(['prefix' => 'artisan', 'as' => 'artisan.', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
    
        return "Cache cleared successfully";
    });
    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
    
        return "Storage linked successfully";
    });

    Route::get('/migrate-seed', function () {
        Artisan::call('migrate --seed');
    
        return "Migration and seeding successfully ";
    });
});

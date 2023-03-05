<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
            Admin Panelaa
        </a>
        
        <div class="md:hidden">
            <livewire:admin-notification/>
        </div>

        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            

            <form class="mt-6 mb-4 md:hidden">
                <div class="mb-3 pt-0">
                    @livewire('global-search')
                </div>
            </form>

            <!-- Divider -->
            <div class="flex md:hidden">
                @if(file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/users*")||request()->is("admin/roles*")||request()->is("admin/permissions*")||request()->is("admin/provinsis*")||request()->is("admin/kota/*")||request()->is("admin/kota")||request()->is("admin/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('provinsi_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/provinsis*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.provinsis.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-globe-asia">
                                        </i>
                                        {{ trans('cruds.provinsi.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('kota_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/kota*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.kota.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-globe-asia">
                                        </i>
                                        {{ trans('cruds.kota.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.user-alerts.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-bell">
                                        </i>
                                        {{ trans('cruds.userAlert.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('manajemen_konten_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/aparatur-desas*")||request()->is("admin/artikels*")||request()->is("admin/carousels*")||request()->is("admin/data-penduduks*")||request()->is("admin/dokumen-umums*")||request()->is("admin/produk-hukums*")||request()->is("admin/kontaks*")||request()->is("admin/kategori-artikels*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-desktop">
                            </i>
                            {{ trans('cruds.manajemenKonten.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('aparatur_desa_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/aparatur-desas*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.aparatur-desas.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user-md">
                                        </i>
                                        {{ trans('cruds.aparaturDesa.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('artikel_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/artikels*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.artikels.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-newspaper">
                                        </i>
                                        {{ trans('cruds.artikel.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('carousel_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/carousels*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.carousels.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-images">
                                        </i>
                                        {{ trans('cruds.carousel.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('data_penduduk_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/data-penduduks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.data-penduduks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-table">
                                        </i>
                                        {{ trans('cruds.dataPenduduk.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('dokumen_umum_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/dokumen-umums*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.dokumen-umums.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-contract">
                                        </i>
                                        {{ trans('cruds.dokumenUmum.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('produk_hukum_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/produk-hukums*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.produk-hukums.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-gavel">
                                        </i>
                                        {{ trans('cruds.produkHukum.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('kontak_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/kontaks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.kontaks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-phone">
                                        </i>
                                        {{ trans('cruds.kontak.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('kategori_artikel_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/kategori-artikels*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.kategori-artikels.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-tag">
                                        </i>
                                        {{ trans('cruds.kategoriArtikel.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('manajemen_layanan_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/pelayanans*")||request()->is("admin/berkas-pelayanans*")||request()->is("admin/jenis-layanans*")||request()->is("admin/syarat-layanans*")||request()->is("admin/kotak-sarans*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-handshake">
                            </i>
                            {{ trans('cruds.manajemenLayanan.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('pelayanan_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/pelayanans*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.pelayanans.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-hand-holding-heart">
                                        </i>
                                        {{ trans('cruds.pelayanan.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('berkas_pelayanan_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/berkas-pelayanans*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.berkas-pelayanans.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-copy">
                                        </i>
                                        {{ trans('cruds.berkasPelayanan.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('jenis_layanan_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/jenis-layanans*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.jenis-layanans.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-clipboard-list">
                                        </i>
                                        {{ trans('cruds.jenisLayanan.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('syarat_layanan_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/syarat-layanans*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.syarat-layanans.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-paste">
                                        </i>
                                        {{ trans('cruds.syaratLayanan.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('kotak_saran_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/kotak-sarans*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.kotak-sarans.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-comment">
                                        </i>
                                        {{ trans('cruds.kotakSaran.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('manajemen_umkm_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/umkms*")||request()->is("admin/produks*")||request()->is("admin/kategori-umkms*")||request()->is("admin/kategori-produks*")||request()->is("admin/satuan-produks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-building">
                            </i>
                            {{ trans('cruds.manajemenUmkm.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('umkm_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/umkms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.umkms.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.umkm.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('produk_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/produks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.produks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-concierge-bell">
                                        </i>
                                        {{ trans('cruds.produk.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('kategori_umkm_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/kategori-umkms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.kategori-umkms.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-tag">
                                        </i>
                                        {{ trans('cruds.kategoriUmkm.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('kategori_produk_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/kategori-produks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.kategori-produks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-tag">
                                        </i>
                                        {{ trans('cruds.kategoriProduk.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('satuan_produk_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/satuan-produks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.satuan-produks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-coins">
                                        </i>
                                        {{ trans('cruds.satuanProduk.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('audit_log_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/audit-logs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.audit-logs.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                            </i>
                            {{ trans('cruds.auditLog.title') }}
                        </a>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route("profile.show") }}" class="{{ request()->is("profile") ? "sidebar-nav-active" : "sidebar-nav" }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a class="{{ request()->is("user*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("user.home") }}">
                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                        </i>
                        Dashboard User
                    </a>
                </li>
                <li class="items-center">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
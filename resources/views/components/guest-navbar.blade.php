<nav class="bg-gray-100 px-2 sm:px-4 py-1 dark:bg-gray-900 w-full border-b border-gray-200 dark:border-gray-600 z-50">
  <div class="container flex flex-wrap items-center justify-between mx-auto">
    <a href="{{route('guest.home')}}" class="md:hidden flex items-center">
      <img src="{{ asset('image/logo-sragen.png') }}" class="mr-3 h-9" alt="Flowbite Logo">
      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Desa Srimulyo</span>
    </a>

    <div class="flex md:order-2 items-center">
      @guest
      <a href="{{route('login')}}" type="button" class="h-fit inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm md:text-base px-4 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Masuk
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 -mr-1" viewBox="0 0 24 24">
          <path d="M5 12h14M12 5l7 7-7 7"></path>
        </svg>
      </a>
      @endguest
      
      @auth
      <div class="flex items-center">
          <button type="button" class="flex mr-3 text-sm rounded-full md:mr-0 items-center md:gap-2" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <span class="hidden md:block py-2 pl-3 pr-2 text-blue-500 rounded focus:bg-transparent md:p-0 hover:text-blue-700 md:dark:hover:text-white dark:text-gray-400 dark:hover:text-white">{{auth()->user()->name}}</span>
            <img class="w-8 h-8 rounded-full hover:ring-2 focus:ring-blue-500 dark:focus:ring-gray-600" src="{{ auth()->user()->avatar }}" alt="user photo">
          </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm font-medium text-blue-500 dark:text-white">{{ auth()->user()->name }}</span>
            <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            @if (auth()->user()->is_admin)
            <li>
              <a href="{{route('admin.home')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard Admin</a>
            </li>
            @endif
            <li>
              <a href="{{route("user.home")}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard Pengguna</a>
            </li>
            <li>
              <a href="{{route('user.profile.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profil</a>
            </li>
            <li>
              <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Keluar</a>
            </li>
          </ul>
        </div>
      </div>
      @endauth

      <!-- Jika lebih dari LG -->
      <button data-collapse-toggle="navbar-dropdownLg" type="button" class="inline-flex md:hidden items-center p-2 ml-1 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdownLg" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>

      <button data-collapse-toggle="navbar-dropdownMd" type="button" class="hidden md:inline-flex xl:hidden items-center p-2 ml-3 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdownMd" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>

    </div>
    
    <!-- Jika lebih dari LG -->
    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdownLg">
      <ul class="flex flex-col px-2 pb-2 pt-2 mt-4 border border-gray-100 rounded-lg shadow-md md:shadow-none mb-4 md:mb-0 bg-gray-50 md:flex-row md:space-x-4 lg:space-x-4 xl:space-x-6 md:mt-0 md:font-medium md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="{{route('guest.home')}}" class="{{ request()->is("/") ? "guest-navbar-active" : "guest-navbar" }}">Beranda</a>
        </li>
        <li>
          <a href="{{route('guest.artikel.index')}}" class="{{ request()->is("artikel*") ? "guest-navbar-active" : "guest-navbar" }}">Artikel</a>
        </li>
        <li class="md:hidden xl:inline">
            <a href="{{route('guest.data-penduduk.index')}}" class="{{ request()->is("data-penduduk*") ? "guest-navbar-active" : "guest-navbar" }}">Data Kependudukan</a>
        </li>
        <li class="md:hidden xl:inline">
          <a href="{{route('guest.dokumen-umum.index')}}" class="{{ request()->is("dokumen-umum*") ? "guest-navbar-active" : "guest-navbar" }}">Dokumen Umum</a>
        </li>
        <li class="md:hidden xl:inline">
          <a href="{{route('guest.produk-hukum.index')}}" class="{{ request()->is("produk-hukum*") ? "guest-navbar-active" : "guest-navbar" }}">Produk Hukum</a>
        </li>
        <li>
            <button id="dropdownUmkmLink" data-dropdown-toggle="dropdownUmkm" class="{{ request()->is("umkm*") ? "bg-blue-700 md:bg-transparent text-white md:text-blue-700 md:underline md:decoration-blue-500 md:underline-offset-2 md:decoration-2" : "hover:bg-gray-100" }} flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-700 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
              Usaha Masyarakat 
              <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownUmkm" class="z-50 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="{{route('guest.umkm.peta')}}" class="block px-4 py-2 {{ request()->is("umkm/peta*") ? "text-blue-700 underline decoration-blue-500 underline-offset-2 decoration-2" : "" }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Peta UMKM</a>
                  </li>
                  <li>
                    <a href="{{route('guest.umkm.index')}}" class="block px-4 py-2 {{ request()->is("umkm") ||  request()->is("umkm") ? "text-blue-700 underline decoration-blue-500 underline-offset-2 decoration-2" : "" }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Daftar UMKM</a>
                  </li>
                  <li>
                    <a href="{{route('guest.produk.index')}}" class="block px-4 py-2 {{ request()->is("umkm/produk*") ? "text-blue-700 underline decoration-blue-500 underline-offset-2 decoration-2" : "" }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Produk UMKM</a>
                  </li>
                </ul>
            </div>
        </li>
        <li class="md:hidden xl:inline">
          <a href="{{route('guest.kotak-saran.index')}}" class="{{ request()->is("kotak-saran*") ? "guest-navbar-active" : "guest-navbar" }}">Kotak Saran</a>
        </li>
        <li>
          <a href="#" class="{{ request()->is("profil-desa*") ? "guest-navbar-active" : "guest-navbar" }}">Profil Desa</a>
        </li>
      </ul>
    </div>


    <div class="hidden xl:hidden w-full order-3" id="navbar-dropdownMd">
      <ul class="hidden md:block px-2 pb-2 pt-2 mt-4 border border-gray-100 rounded-lg shadow-md bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mb-4">
        <li>
          <a href="{{route('guest.data-penduduk.index')}}" class="{{ request()->is("data-penduduk*") ? "guest-navbar-active" : "guest-navbar" }}">Data Kependudukan</a>
        </li>
        <li>
          <a href="{{route('guest.dokumen-umum.index')}}" class="{{ request()->is("dokumen-umum*") ? "guest-navbar-active" : "guest-navbar" }}">Dokumen Umum</a>
        </li>
        <li>
          <a href="{{route('guest.produk-hukum.index')}}" class="{{ request()->is("produk-hukum*") ? "guest-navbar-active" : "guest-navbar" }}">Produk Hukum</a>
        </li>
        <li>
          <a href="{{route('guest.kotak-saran.index')}}" class="{{ request()->is("kotak-saran*") ? "guest-navbar-active" : "guest-navbar" }}">Kotak Saran</a>
        </li>
      </ul>
    </div>

  </div>
</nav>
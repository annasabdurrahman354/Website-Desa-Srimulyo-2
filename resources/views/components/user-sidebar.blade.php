
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="{{ route('guest.home') }}" class="flex ml-2 md:mr-24">
          <img src="{{ asset('image/logo-sragen.png') }}" class="h-8 mr-3" alt="Logo Sragen" />
          <span class="self-center text-l font-semibold sm:text-xl whitespace-nowrap dark:text-white">Website Desa Srimulyo</span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ml-3">
            <div class="flex space-x-4 lg:mr-8">
              <livewire:user-notification/>
              <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->avatar }}" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-base uppercase font-semibold text-center text-gray-700 dark:text-white" role="none">
                  {{auth()->user()->name}}
                </p>
                <p class="text-base font-semibold text-center text-gray-700 truncate dark:text-gray-300" role="none">
                   {{auth()->user()->email}}
                </p>
              </div>
              <ul class="py-1" role="none">
                @if (auth()->user()->is_admin)
                  <li>
                    <a href="{{route('admin.home')}}" class="block px-4 py-2 text-base text-gray-700 hover:text-blue-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Admin Panel</a>
                  </li>
                @endif
                <li>
                  <a href="{{route('guest.home')}}" class="block px-4 py-2 text-base text-gray-700  hover:text-blue-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Beranda</a>
                </li>
                <li>
                  <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="block px-4 py-2 text-base text-gray-700  hover:text-blue-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Keluar</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-56 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2">
         <li>
            <a href="{{route("user.home")}}" class="{{ request()->is("user") ? "sidebar-active" : "sidebar" }}">
               <svg class="w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="13" r="2" />  <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />  <path d="M6.4 20a9 9 0 1 1 11.2 0Z" /></svg>
               <span class="flex-1 ml-3 font-semibold whitespace-nowrap">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="{{route("user.pelayanan.index")}}" class="{{ request()->is("user/pelayanan*") ? "sidebar-active" : "sidebar" }}">
               <svg class="w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  <polyline points="14 2 14 8 20 8" />  <line x1="16" y1="13" x2="8" y2="13" />  <line x1="16" y1="17" x2="8" y2="17" />  <polyline points="10 9 9 9 8 9" /></svg>
               <span class="flex-1 ml-3 font-semibold whitespace-nowrap">Pelayanan</span>
            </a>
         </li>
         <li>
            <a href="{{route("user.usaha.index")}}" class="{{ request()->is("user/usaha*") ? "sidebar-active" : "sidebar" }}">
               <svg class="w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="7 10 12 4 17 10" />  <path d="M21 10l-2 8a2 2.5 0 0 1 -2 2h-10a2 2.5 0 0 1 -2 -2l-2 -8Z" />  <circle cx="12" cy="15" r="2" /></svg>
               <span class="flex-1 ml-3 font-semibold whitespace-nowrap">Usaha</span>
            </a>
         </li>
         <li>
            <a href="{{ route('user.profile.index') }}" class="{{ request()->is("user/profile*") ? "sidebar-active" : "sidebar" }}">
               <svg aria-hidden="true" class="w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
               <span class="flex-1 ml-3 font-semibold whitespace-nowrap">Profil</span>
            </a>
         </li>
      </ul>
   </div>
</aside>


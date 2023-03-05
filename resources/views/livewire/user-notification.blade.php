<div>
  <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" type="button" class="relative inline-flex items-center py-0.5 px-1 text-sm font-medium text-center text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
    <span class="sr-only">Notifikasi</span>
    @if ($new_alert_count = auth()->user()->alerts()->wherePivot('seen_at', null)->count())
      <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">{{ $new_alert_count }}</div>
    @endif
  </button>

  <div id="dropdownNotification" class="z-40 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
    <div class="block px-4 py-2 text-base uppercase font-bold text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        Notifikasi
    </div>
    <div class="divide-y divide-gray-100 dark:divide-gray-700">
      @forelse($alerts as $alert)
        @if ($alert->pivot->seen_at == null)
          <button type="button" wire:click="setSeen({{ $alert }})" class="w-full flex px-4 py-3 bg-sky-50 hover:bg-gray-100 dark:hover:bg-gray-700">
            <div class="w-full pl-3 items-start align-middle text-left">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">{!!$alert->message!!}</div>
                <div class="text-xs text-blue-600 dark:text-blue-500">{{$alert->created_at->diffForHumans()}}</div>
            </div>
          </button>
        @else
          <a href="{{$alert->link ?? "#"}}" class="w-full flex px-4 py-3 bg-white hover:bg-gray-100 dark:hover:bg-gray-700">
            <div class="w-full pl-3">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">{!!$alert->message!!}</div>
                <div class="text-xs text-blue-600 dark:text-blue-500">{{$alert->created_at->diffForHumans()}}</div>
            </div>
          </a>
        @endif
      @empty
        <div class="flex p-4 text-base text-blue-800 border border-blue-300 bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Info</span>
          <div>
            Belum ada notifikasi untuk saat ini.
          </div>
        </div>
      @endforelse
    </div>
    <a href="{{route('user.home')}}" class="block py-2 text-base font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
      <div class="inline-flex items-center ">
        <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
          Lihat Semua
      </div>
    </a>
  </div>
</div>
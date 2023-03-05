<div class="relative">
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{route('user.home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Dashboard
                </a>
            </li>
        </ol>
    </nav>
    <div class="relative">
        <div class="w-full flex flex-2 gap-2">

            <div class="basis-1/3 w-full bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Notifikasi</h5>
                </div>
                <div class="flow-root border border-gray-200">
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
                 <div class="mt-2">
                    {{ $alerts->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
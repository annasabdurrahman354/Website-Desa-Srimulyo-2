<div>
  <ul class="items-center md:flex flex-wrap list-none">
      <li class="inline-block relative">
          <a class="text-white block py-1 px-3 cursor-pointer bg-gray-100 md:bg-transparent hover:bg-gray-200 md:hover:bg-transparent rounded-full" onclick="openDropdown(event,'{{ $this->id }}')">
              <i class="fas fa-bell text-green-300 md:text-white"></i>
              @if($new_alert_count = auth()->user()->alerts()->wherePivot('seen_at', null)->count())
                  <span class="absolute -top-1 text-xs font-semibold inline-flex rounded-full h-5 min-w-5 text-white bg-indigo-600 leading-5 justify-center">
                      <span class="px-1">{{ $new_alert_count }}</span>
                  </span>
              @endif
          </a>
          <div id="{{ $this->id }}" data-popper-placement="bottom-start" class="divide-y-2 bg-white text-base z-50 float-left p-2 list-none text-left rounded shadow-lg max-w-48 hidden" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(617px, 58px);">
              @forelse(auth()->user()->alerts()->latest()->take(10)->get() as $alert)
                  @if($alert->link)
                      @if ($alert->pivot->seen_at == null)
                        <button wire:click="setSeen({{ $alert }})" href="{{ $alert->link }}" target="_blank" class="text-left text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-blue-50 hover:bg-blueGray-100 cursor-pointer {{ $alert->pivot->seen_at ? 'text-blueGray-400' : 'text-blueGray-700' }}">
                            <i class="fas fa-link fa-fw mr-1"></i>
                            {!! $alert->message !!}
                            <div class="font-semibold text-blue-600">
                              {{$alert->created_at->diffForHumans()}}
                            </div>
                        </button>
                      @else
                        <a href="{{ $alert->link }}" target="_blank" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-blueGray-100 cursor-pointer {{ $alert->pivot->seen_at ? 'text-blueGray-400' : 'text-blueGray-700' }}">
                            <i class="fas fa-link fa-fw mr-1"></i>
                            {!! $alert->message !!}
                            <div class="font-semibold text-blue-600">
                              {{$alert->created_at->diffForHumans()}}
                            </div>
                        </a>
                      @endif
                  @else
                      <a class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-blueGray-100 cursor-pointer {{ $alert->pivot->seen_at ? 'text-blueGray-400' : 'text-blueGray-700' }}">
                          <i classs="fas fa-bell fa-fw mr-1"></i>
                          {!! $alert->message !!}
                          <div class="font-semibold text-blue-600">
                              {{$alert->created_at->diffForHumans()}}
                          </div>
                      </a>
                  @endif
                  @empty
                  {{ __('global.no_alerts') }}
              @endforelse
          </div>
      </li>
  </ul>
</div>
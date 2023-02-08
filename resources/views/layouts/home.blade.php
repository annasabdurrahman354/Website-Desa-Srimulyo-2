<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <title>{{ trans('panel.site_title') }}</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @livewireStyles
    @stack('styles')
</head>

<body class="text-blueGray-800 bg-gray-50 antialiased h-full">

    <noscript>You need to enable JavaScript to run this app.</noscript>

    <div id="app" class="h-full">
        <x-home-navbar />
        <div class="pt-6 md:pt-4 sm:ml-56 mb-6 h-full">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 mx-4 bg-white">
                @yield('content')
            </div>
        </div>
        @if(session('status'))
            <x-alert message="{{ session('status') }}" variant="indigo" role="alert" />
        @endif
    </div>

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        @livewireScripts
        @yield('scripts')
        @stack('scripts')
        <script>
            function closeAlert(event){
        let element = event.target;
        while(element.nodeName !== "BUTTON"){
          element = element.parentNode;
        }
        element.parentNode.parentNode.removeChild(element.parentNode);
      }
        </script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ trans('panel.site_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @if (request()->is("umkm/*"))
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin="" ></script>
    @endif
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @livewireStyles
    @stack('styles')
</head>

<body class="text-blueGray-800 bg-gray-50 antialiased h-full w-full flex flex-col font-inter">

    <noscript>You need to enable JavaScript to run this app.</noscript>

    <div id="app" class="min-h-screen w-full">
        <x-guest-header/>
        <x-guest-navbar/>
        <div class="min-h-full relative">
            @yield('content')
        </div>
        @if(session('status'))
            <x-alert message="{{ session('status') }}" variant="indigo" role="alert" />
        @endif
    </div>
    <x-guest-footer/>

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
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
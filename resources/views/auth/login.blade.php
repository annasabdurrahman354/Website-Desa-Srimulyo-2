@extends('layouts.auth')

@section('content')

<section class="flex justify-center items-center h-screen w-full">
    <div class="w-2/3 lg:w-1/3 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="w-full text-center text-xl font-bold leading-tight tracking-tight text-blue-700 md:text-2xl dark:text-white">Selamat Datang</h1>
        <form method="POST" class="space-y-6" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="login_field" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK/Nomor Telepon/Email Anda</label>
                <input type="text" name="login_field" id="login_field" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Isikan NIK/Nomor Telepon/Email Anda..." required>
                @error('login_field')
                    <div class="text-red-500">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                @error('password')
                    <span class="text-red-500">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </div>

            <div class="flex items-start">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                </div>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">
                        {{ __('global.forgot_password') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Masuk ke Akun Anda</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                @if(Route::has('register'))
                    Belum memiliki akun? 
                    <a href="{{ route('register') }}" class="text-blue-700 hover:underline dark:text-blue-500">
                        {{ __('global.register') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</section>
@endsection
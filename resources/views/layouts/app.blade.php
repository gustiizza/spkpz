<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">


        <!-- Page Heading -->
        <header class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 shadow-sm flex justify-center items-center">
                <h2 class="font-semibold text-lg text-gray-800 text-center select-none">
                    Sistem Pendukung Keputusan Penentuan Penerima Zakat
                    <br>
                    BAZNAS Kabupaten Mempawah
                </h2>
            </div>
        </header>
        @include('layouts.navigation')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <footer class="footer footer-center p-4 text-base-content bottom-0 mt-auto">
            <div>
                <img src="{{ asset('img/logo.png') }}" alt="Logo"
                    class=" h-24 w-auto sm:items-center object-scale-down" />
                <p>@ 2023 Baznas Kabupaten Mempawah</p>
            </div>
        </footer>
    </div>
</body>

</html>
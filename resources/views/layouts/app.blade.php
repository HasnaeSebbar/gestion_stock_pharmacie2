<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- ✅ Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ✅ Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- ✅ Ton CSS & JS si nécessaire --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .navbar .nav-link.active {
            font-weight: bold;
            color: #0d6efd !important;
        }
    </style>
</head>
<body>
    {{-- ✅ Barre de navigation --}}
    @include('layouts.navigation') {{-- à condition que ce fichier existe --}}

    <nav>
        @auth
            @if(Auth::user()->role === 'chef pharmacie')
                @include('partials.header-chef')
            @elseif(Auth::user()->role === 'pharmacien')
                @include('partials.header-pharmacien')
            @elseif(Auth::user()->role === 'majeur')
                @include('partials.header-majeur')
            @endif
        @endauth
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    {{-- ✅ Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

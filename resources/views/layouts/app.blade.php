<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Inicio') - Trama Educativa</title>
    <meta name="description" content="@yield('meta_description', 'Portal de noticias educativas de Mar del Plata y la region. Cobertura de politica educativa, gremiales, universidad y cultura.')">
    <meta name="keywords" content="educacion, noticias, mar del plata, docentes, universidad, gremiales, politica educativa">
    <meta name="author" content="Cooperativa de Trabajo Minga Ltda">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Inicio') - Trama Educativa">
    <meta property="og:description" content="@yield('meta_description', 'Portal de noticias educativas de Mar del Plata y la region.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:site_name" content="Trama Educativa">
    <meta property="og:locale" content="es_AR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@TramaEducativa">
    <meta name="twitter:title" content="@yield('title', 'Inicio') - Trama Educativa">
    <meta name="twitter:description" content="@yield('meta_description', 'Portal de noticias educativas de Mar del Plata y la region.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Additional meta tags from views -->
    @yield('meta')

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased">
    <!-- Reading Progress Bar -->
    @hasSection('show_progress')
    <div class="reading-progress"></div>
    @endif

    <!-- Header -->
    @include('components.header')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Cookie/Privacy Banner -->
    @include('components.cookie-banner')

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" aria-label="Volver arriba">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    @stack('scripts')
</body>
</html>

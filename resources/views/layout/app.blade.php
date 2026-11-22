<!doctype html>
<html class="dark" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('home.meta_description', ['name' => config('portfolio.owner.name')]) }}">
    <title>{{ __('home.page_title', ['name' => config('portfolio.owner.name')]) }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300;1,9..40,400&family=JetBrains+Mono:wght@400;500;600;700&family=Press+Start+2P&family=Oxanium:wght@500;600;700;800&family=Roboto+Mono:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplex-noise/2.4.0/simplex-noise.min.js" defer></script>
</head>
<body class="bg-[#020617] text-slate-200 overflow-x-hidden">

    {{-- Global noise grain overlay for depth/texture --}}
    <div class="hero-grain fixed inset-0 pointer-events-none z-0 opacity-30"></div>

    @isset($navbar)
        {{ $navbar }}
    @elseif(!request()->is('v2*'))
        <x-layout.navbar></x-layout.navbar>
    @endisset

    <main>
        {{ $slot }}
    </main>

    @if(!request()->is('v2*'))
        <x-layout.footer></x-layout.footer>
    @endif

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    <link rel="icon" type="image/webp" href="{{ Vite::image('icon.webp') }}">

    <tallstackui:script/>
    @livewireStyles
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        //StarterPack
        'vendor/artisanbr/starter-pack/resources/css/starter-pack.css',
        'vendor/artisanbr/starter-pack/resources/js/starter-pack.js'
    ])
    @stack('css')

    {{-- Flatpickr  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
    <script>
        flatpickr.localize(flatpickr.l10ns.pt);
    </script>
</head>
<body class="min-h-screen font-sans antialiased bg-stone-100 dark:bg-stone-800">

{{ $slot }}


{{--  Vendors area --}}
<x-toast/>
<x-ts-toast/>
<x-ts-dialog/>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>
@stack('js')
</body>
</html>

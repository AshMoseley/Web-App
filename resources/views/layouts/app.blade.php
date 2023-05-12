<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forum.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post-show.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div id="app">
        @include('layouts.navigation')

        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-lg-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    </div>
    @livewireScripts
</body>
</html>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Watch shop | eCommers</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    @include('layouts.frontend.css')
    @livewireStyles

</head>

<body>

    {{-- @include('layouts.frontend.navbar') --}}
    @yield('kontent')

    <main class="py-4">
        @yield('content')
        <div class="container-fluid">
            {{ isset($slot) ? $slot : null }}
        </div>
    </main>
    @livewireScripts
    @include('layouts.frontend.js')
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Koperasi Motekar - @yield('title')</title>

    @include('layouts.style')

    @livewireStyles
</head>

<body>

    @yield('content')

    @include('layouts.script')

    @livewireScripts
</body>

</html>
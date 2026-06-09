<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koperasi Motekar - @yield('title')</title>

    @include('layouts.style')

    @livewireStyles

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('layouts.navbar')

        {{-- Authenticated User Sidebar --}}
        @if (auth()->check())
            @if (auth()->user()->role == 'manajemen')
                @include('layouts.sidebar-manajemen')
            @elseif(auth()->user()->role == 'pengawas')
                @include('layouts.sidebar-pengawas')
            @else
                @include('layouts.sidebar-anggota')
            @endif
        @endif
        {{-- Authenticated User Sidebar --}}

        @yield('content')

        @include('layouts.footer')

    </div>

    <!-- jQuery -->
    @include('layouts.script')

    @livewireScripts

    {{-- Pesan Berhasil Login --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Sukses',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    {{-- Pesan Berhasil Login --}}

    {{-- Logout Confirmation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const logoutBtn = document.getElementById('btn-logout');

            if (logoutBtn) {

                logoutBtn.addEventListener('click', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin mau logout?',
                        text: 'Session akan diakhiri',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }

                    });

                });

            }

        });
    </script>
    {{-- Logout Confirmation --}}

</body>

</html>

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
    <script>
    (function () {
        function timeAgoId(ts) {
            var diff = Math.floor(Date.now() / 1000) - ts;
            if (diff < 5)   return 'baru saja';
            if (diff < 60)  return diff + ' detik yang lalu';
            var m = Math.floor(diff / 60);
            if (m < 60)     return m + ' menit yang lalu';
            var h = Math.floor(diff / 3600);
            if (h < 24)     return h + ' jam yang lalu';
            var d = Math.floor(diff / 86400);
            if (d < 30)     return d + ' hari yang lalu';
            var mo = Math.floor(diff / 2592000);
            if (mo < 12)    return mo + ' bulan yang lalu';
            return Math.floor(diff / 31536000) + ' tahun yang lalu';
        }
        function refreshAgo() {
            document.querySelectorAll('[data-timestamp]').forEach(function (el) {
                el.textContent = timeAgoId(parseInt(el.getAttribute('data-timestamp')));
            });
        }
        refreshAgo();
        setInterval(refreshAgo, 1000);
        document.addEventListener('livewire:updated', refreshAgo);
    })();
    </script>
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
    {{-- Global Livewire SweetAlert Event --}}
    <script>
        window.addEventListener('swal', function(e) {
            Swal.fire({
                icon: e.detail.icon ?? 'info',
                title: e.detail.title ?? '',
                text: e.detail.text ?? '',
                timer: (e.detail.icon === 'success') ? 2500 : undefined,
                timerProgressBar: (e.detail.icon === 'success'),
                showConfirmButton: (e.detail.icon !== 'success'),
                confirmButtonColor: '#28a745',
            });
        });
    </script>
    {{-- Logout Confirmation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('btn-logout');
            if (!logoutBtn) return;
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
        });
    </script>
</body>
</html>

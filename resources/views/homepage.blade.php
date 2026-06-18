<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koperasi Motekar</title>
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3/dist/css/adminlte.min.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .hero {
            min-height: 100vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.55),
                    rgba(0, 0, 0, 0.35)),
                url('{{ asset('images/background_motekar.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
        }
        .hero-content {
            width: 450px;
            margin-left: auto;
            margin-right: -200px;
            color: #fff;
        }
        .hero-content h1 {
            font-size: 55px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #fff;
        }
        .hero-content p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 25px;
        }
        .hero-content .btn {
            padding: 12px 25px;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            .hero-content {
                margin: 0 auto;
                text-align: center;
                width: 100%;
            }
            .hero-content h1 {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand font-weight-bold d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo_motekar.png') }}" alt="Koperasi Motekar"
                    style="
            width:40px;
            height:40px;
            object-fit:contain;
            margin-right:10px;
        ">
                Koperasi Motekar
            </a>
            <div class="ml-auto">
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm mr-2">
                    Login
                </a>
                <a href="{{ auth()->check() ? route('menunggu') : route('register') }}" class="btn btn-success btn-sm">
                    Register
                </a>
            </div>
        </div>
    </nav>
    <!-- HERO -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Koperasi Motekar</h1>
                <p>
                    Sistem simpan pinjam modern, cepat, dan transparan untuk
                    mendukung kebutuhan anggota koperasi secara digital.
                </p>
                <a href="{{ auth()->check() ? route('menunggu') : route('register') }}" class="btn btn-success">
                    Daftar Sekarang jadi Anggota
                </a>
            </div>
        </div>
    </section>
</body>
</html>

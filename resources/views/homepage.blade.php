<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koperasi Motekar</title>
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3/dist/css/adminlte.min.css') }}">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            scroll-behavior: smooth;
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
            margin-top: 200px;
            width: 450px;
            color: #fff;
        }
        .hero-content h1 {
            font-size: 55px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #fff;
            white-space: nowrap;
        }
        .hero-content p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 25px;
        }
        .btn-daftar {
            display: inline-block;
            padding: 13px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            background: #28a745;
            color: #fff;
            border: none;
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(40,167,69,0.45);
            transition: background .2s, transform .15s, box-shadow .2s;
            letter-spacing: 0.3px;
        }
        .btn-daftar:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(40,167,69,0.55);
            color: #fff;
            text-decoration: none;
        }
        /* Navbar brand mobile */
        @media (max-width: 576px) {
            .navbar-brand-text {
                font-size: 13px;
            }
            .hero-content h1 {
                white-space: normal;
            }
        }
        @media (max-width: 768px) {
            .hero-content {
                margin: 150px auto 0;
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
                    style="width:36px;height:36px;object-fit:contain;margin-right:8px;">
                <span class="navbar-brand-text" style="font-size:15px;">Koperasi Motekar</span>
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
                <a href="{{ auth()->check() ? route('menunggu') : route('register') }}" class="btn-daftar">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Jadi Anggota
                </a>
            </div>
        </div>
    </section>
</body>
</html>

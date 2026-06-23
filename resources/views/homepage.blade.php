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

        /* ── NAVBAR ── */
        .navbar-brand span {
            font-size: 15px;
            font-weight: 700;
        }

        /* ── HERO (mobile-first: default = mobile) ── */
        .hero {
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(0,0,0,0.60) 0%, rgba(0,0,0,0.30) 100%),
                url('{{ asset('images/background_motekar.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: scroll;
            display: flex;
            align-items: flex-end;
            padding-top: 70px;
            padding-bottom: 100px;
        }
        .hero .container {
            display: flex;
            justify-content: center;
        }
        .hero-content {
            width: 100%;
            color: #fff;
            text-align: center;
            padding: 0 12px;
        }
        .hero-content h1 {
            font-size: 34px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 14px;
            color: #fff;
        }
        .hero-content p {
            font-size: 15px;
            color: rgba(255,255,255,0.88);
            margin-bottom: 26px;
            line-height: 1.65;
        }
        .hero-content .btn-hero {
            display: inline-block;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 50px;
            background: #28a745;
            color: #fff;
            border: none;
            text-decoration: none;
            box-shadow: 0 4px 18px rgba(40,167,69,0.40);
            transition: background .2s, transform .15s, box-shadow .2s;
        }
        .hero-content .btn-hero:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(40,167,69,0.50);
            color: #fff;
            text-decoration: none;
        }

        /* ── DESKTOP override ── */
        @media (min-width: 992px) {
            .hero {
                background-attachment: fixed;
                padding-top: 60px;
                padding-bottom: 60px;
                align-items: flex-end;
            }
            .hero .container {
                justify-content: flex-start;
            }
            .hero-content {
                width: 480px;
                text-align: left;
                padding: 0;
            }
            .hero-content h1 {
                font-size: 50px;
                letter-spacing: -0.5px;
                margin-bottom: 18px;
            }
            .hero-content p {
                font-size: 17px;
                margin-bottom: 30px;
            }
            .hero-content .btn-hero {
                font-size: 16px;
                padding: 13px 32px;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo_motekar.png') }}" alt="Koperasi Motekar"
                    style="width:36px;height:36px;object-fit:contain;margin-right:8px;">
                <span>Koperasi Motekar</span>
            </a>
            <div class="ml-auto d-flex align-items-center" style="gap:8px;">
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-3">
                    Login
                </a>
                <a href="{{ auth()->check() ? route('menunggu') : route('register') }}" class="btn btn-success btn-sm px-3">
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
                    Sistem simpan pinjam modern, cepat, dan transparan
                    untuk mendukung kebutuhan anggota koperasi secara digital.
                </p>
                <a href="{{ auth()->check() ? route('menunggu') : route('register') }}"
                    class="btn-hero">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Jadi Anggota
                </a>
            </div>
        </div>
    </section>
</body>
</html>

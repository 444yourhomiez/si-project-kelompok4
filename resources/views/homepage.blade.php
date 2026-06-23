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

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(0,0,0,0.60) 0%, rgba(0,0,0,0.30) 100%),
                url('{{ asset('images/background_motekar.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: flex-end;
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .hero .container {
            display: flex;
            justify-content: flex-start;
        }
        .hero-content {
            max-width: 480px;
            color: #fff;
            padding: 0;
        }
        .hero-content h1 {
            font-size: 50px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 18px;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .hero-content p {
            font-size: 17px;
            color: rgba(255,255,255,0.88);
            margin-bottom: 30px;
            line-height: 1.65;
        }
        .hero-content .btn-hero {
            display: inline-block;
            padding: 13px 32px;
            font-size: 16px;
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

        /* ── MOBILE ── */
        /* iOS fix: background-attachment fixed tidak didukung */
        @supports (-webkit-touch-callout: none) {
            .hero {
                background-attachment: scroll;
            }
        }

        @media (max-width: 991px) {
            .hero {
                background-attachment: scroll;
                padding-top: 70px;
                padding-bottom: 40px;
                align-items: flex-end;
            }
            .hero .container {
                justify-content: center;
            }
            .hero-content {
                max-width: 100%;
                text-align: center;
                padding: 0 12px;
            }
            .hero-content h1 {
                font-size: 34px;
                letter-spacing: 0;
            }
            .hero-content p {
                font-size: 15px;
            }
            .hero-content .btn-hero {
                font-size: 15px;
                padding: 12px 28px;
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
                <h1>Koperasi<br>Motekar</h1>
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

<div>

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-th-large mr-2"></i>
                            @yield('title')
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-success">

                                <i class="nav-icon fas fa-th-large mr-1"></i>
                                @yield('title')

                            </li>
                        </ol>
                    </div>
                </div>

                <div class="welcome-card mb-2 mt-3">
                    <h4 class="mb-1 font-weight-bold">
                        Selamat Datang, {{ auth()->user()->nama_user }}
                    </h4>
                    <p class="mb-0">
                        Berikut informasi penting terkait pengelolaan Koperasi Motekar
                    </p>
                </div>

            </div><!-- /.container-fluid -->
        </section>

        {{-- CONTENT --}}
        <section class="content">

            {{-- CARD --}}
            <div class="row">

                {{-- TOTAL SIMPANAN --}}
                <div class="col-md-4">

                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT --}}
                            <div>

                                <div class="card-label mb-3">

                                    Total Simpanan

                                </div>

                                <div class="card-number">

                                    Rp {{ number_format($total_simpanan, 0, ',', '.') }}

                                </div>

                            </div>

                            {{-- ICON --}}
                            <div>

                                <a href="{{ route('anggota.simpanan.index') }}">

                                    <div class="img-circle elevation-2 d-flex align-items-center justify-content-center bg-white"
                                        style="width:60px; height:60px;">

                                        <i class="fas fa-wallet text-orange" style="font-size:30px;"></i>

                                    </div>

                                </a>

                            </div>

                        </div>

                        {{-- DETAIL --}}
                        <div class="card-footer p-2">

                            <ul class="nav flex-column">

                                {{-- WAJIB --}}
                                <li class="nav-item">

                                    <a href="{{ route('anggota.simpanan.wajib') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-success mr-2 px-2 py-1">

                                                Wajib

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp {{ number_format($simpanan_wajib, 0, ',', '.') }}

                                        </span>

                                    </a>

                                </li>

                                {{-- POKOK --}}
                                <li class="nav-item">

                                    <a href="{{ route('anggota.simpanan.pokok') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-primary mr-2 px-2 py-1">

                                                Pokok

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp {{ number_format($simpanan_pokok, 0, ',', '.') }}

                                        </span>

                                    </a>

                                </li>

                                {{-- SUKARELA --}}
                                <li class="nav-item">

                                    <a href="{{ route('anggota.simpanan.sukarela') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-info mr-2 px-2 py-1">

                                                Sukarela

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp {{ number_format($simpanan_sukarela, 0, ',', '.') }}

                                        </span>

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

                {{-- TOTAL PINJAMAN --}}
                <div class="col-md-4">

                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT --}}
                            <div>

                                <div class="card-label mb-3">

                                    Total Pinjaman

                                </div>

                                <div class="card-number">

                                    Rp 2.500.000

                                </div>

                            </div>

                            {{-- ICON --}}
                            <div>

                                <a href="{{ route('anggota.pinjaman.index') }}">

                                    <div class="img-circle elevation-2 d-flex align-items-center justify-content-center bg-white"
                                        style="width:60px; height:60px;">

                                        <i class="fas fa-hand-holding-usd text-danger" style="font-size:30px;"></i>

                                    </div>

                                </a>

                            </div>

                        </div>

                        <div class="card-footer p-2">

                            <ul class="nav flex-column">

                                <li class="nav-item">

                                    <a href="{{ route('anggota.pinjaman.pribadi') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-success mr-2 px-2 py-1">

                                                Pribadi

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp 2.000.000

                                        </span>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('anggota.pinjaman.khusus') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-primary mr-2 px-2 py-1">

                                                Khusus

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp 500.000

                                        </span>

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

                {{-- SISA CICILAN --}}
                <div class="col-md-4">

                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT --}}
                            <div>

                                <div class="card-label mb-3">

                                    Sisa Cicilan Pinjaman

                                </div>

                                <div class="card-number">

                                    Rp 1.200.000

                                </div>

                            </div>

                            {{-- ICON --}}
                            <div>

                                <a href="{{ route('anggota.cicilan.index') }}">

                                    <div class="img-circle elevation-2 d-flex align-items-center justify-content-center bg-white"
                                        style="width:60px; height:60px;">

                                        <i class="fas fa-chart-line text-purple" style="font-size:30px;"></i>

                                    </div>

                                </a>

                            </div>

                        </div>

                        <div class="card-footer p-2">

                            <ul class="nav flex-column">

                                <li class="nav-item">

                                    <a href="{{ route('anggota.cicilan.pribadi') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-success mr-2 px-2 py-1">

                                                Pribadi

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp 850.000

                                        </span>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('anggota.cicilan.khusus') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">

                                            <span class="badge bg-primary mr-2 px-2 py-1">

                                                Khusus

                                            </span>

                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">

                                            Rp 350.000

                                        </span>

                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

            {{-- TRANSAKSI --}}
            <div class="card shadow-sm border-0">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0 pt-4">

                    <div>

                        <h4 class="font-weight-bold mb-1">

                            <i class="fas fa-history text-primary mr-2"></i>

                            Riwayat Transaksi Terbaru

                        </h4>

                        <small class="text-muted">

                            Aktivitas simpanan terbaru Anda

                        </small>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover mb-0">

                            <thead class="bg-dark text-white">

                                <tr>

                                    <th>Tanggal</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Status</th>
                                    <th>Nominal</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($transaksi_terbaru as $transaksi)
                                    <tr>

                                        {{-- TANGGAL --}}
                                        <td>

                                            <div class="font-weight-bold">

                                                {{ $transaksi->tanggal->translatedFormat('d M Y') }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $transaksi->created_at->diffForHumans() }}

                                            </small>

                                        </td>

                                        {{-- JENIS --}}
                                        <td>

                                            @if ($transaksi->jenis_simpanan == 'wajib')
                                                <span class="badge badge-success">

                                                    <i class="fas fa-wallet mr-1"></i>

                                                    Simpanan Wajib

                                                </span>
                                            @elseif ($transaksi->jenis_simpanan == 'pokok')
                                                <span class="badge badge-primary">

                                                    <i class="fas fa-wallet mr-1"></i>

                                                    Simpanan Pokok

                                                </span>
                                            @elseif ($transaksi->jenis_simpanan == 'sukarela')
                                                <span class="badge badge-info">

                                                    <i class="fas fa-wallet mr-1"></i>

                                                    Simpanan Sukarela

                                                </span>
                                            @endif

                                        </td>

                                        {{-- STATUS --}}
                                        <td>

                                            <span class="badge badge-success">

                                                <i class="fas fa-check-circle mr-1"></i>

                                                Berhasil

                                            </span>

                                        </td>

                                        {{-- NOMINAL --}}
                                        <td class="font-weight-bold text-dark">

                                            Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center py-5">

                                            <div class="empty-state">

                                                <i class="fas fa-folder-open"></i>

                                                <h5>
                                                    Belum ada transaksi
                                                </h5>

                                                <p>
                                                    Data transaksi terbaru akan tampil di sini
                                                </p>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

    </div>

</div>

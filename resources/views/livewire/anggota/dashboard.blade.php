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
                                    {{ number_format($total_pinjaman, 0, ',', '.') }}
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
                                    <a href="{{ route('anggota.pinjaman.biasa') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">
                                                Biasa
                                            </span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">
                                            {{ number_format($pinjaman_biasa, 0, ',', '.') }}
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
                                            {{ number_format($pinjaman_khusus, 0, ',', '.') }}
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
                                    {{ number_format($total_cicilan, 0, ',', '.') }}
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

                                {{-- BELUM BAYAR --}}
                                <li class="nav-item">
                                    <a href="{{ route('anggota.cicilan.index') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-warning mr-2 px-2 py-1">
                                                Belum Bayar
                                            </span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">
                                            Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}
                                        </span>

                                    </a>
                                </li>

                                {{-- LUNAS --}}
                                <li class="nav-item">
                                    <a href="{{ route('anggota.cicilan.index') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">
                                                Lunas
                                            </span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">
                                            Rp {{ number_format($totalLunas, 0, ',', '.') }}
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
                <div class="card-header bg-white border-bottom py-3">
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
                            <thead class="thead-light">
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

                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($transaksi['tanggal'])->format('d M Y') }}
                                            </div>

                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($transaksi['tanggal'])->diffForHumans() }}
                                            </small>
                                        </td>

                                        <td>

                                            @if (Str::contains($transaksi['jenis'], 'Simpanan'))
                                                <span class="badge badge-primary">
                                                    {{ $transaksi['jenis'] }}
                                                </span>
                                            @elseif(Str::contains($transaksi['jenis'], 'Pinjaman'))
                                                <span class="badge badge-success">
                                                    {{ $transaksi['jenis'] }}
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    {{ $transaksi['jenis'] }}
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if (strtolower($transaksi['status']) == 'aktif')
                                                <span class="badge badge-success">
                                                    {{ $transaksi['status'] }}
                                                </span>
                                            @elseif(strtolower($transaksi['status']) == 'lunas')
                                                <span class="badge badge-primary">
                                                    {{ $transaksi['status'] }}
                                                </span>
                                            @elseif(strtolower($transaksi['status']) == 'pending')
                                                <span class="badge badge-warning">
                                                    {{ $transaksi['status'] }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    {{ $transaksi['status'] }}
                                                </span>
                                            @endif

                                        </td>

                                        <td class="font-weight-bold">
                                            Rp {{ number_format($transaksi['nominal'], 0, ',', '.') }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Belum ada transaksi
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

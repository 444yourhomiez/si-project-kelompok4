<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="row">

                <div class="col-md-3">
                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT (KIRI) --}}
                            <div>
                                <div class="card-label mb-3">Total Anggota</div>
                                <div class="card-number">
                                    {{ $total_anggota }} Orang
                                </div>
                            </div>

                            {{-- ICON (KANAN) --}}
                            <div>
                                <a href="{{ route('manajemen.anggota.index') }}">
                                    <div class="img-circle elevation-2 d-flex align-items-center justify-content-center bg-white"
                                        style="width:60px; height:60px;">
                                        <i class="fas fa-users text-primary" style="font-size:30px;"></i>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <div class="card-footer p-2">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.anggota.disetujui') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">Disetujui</span>
                                        </div>

                                        <span class="font-weight-bold text-dark"
                                            style="font-size:15px;">{{ $anggota_disetujui }}</span>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.anggota.menunggu') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-warning mr-2 px-2 py-1">Menunggu Verifikasi</span>
                                        </div>

                                        <span class="font-weight-bold text-dark"
                                            style="font-size:15px;">{{ $anggota_menunggu }}</span>

                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT (KIRI) --}}
                            <div>
                                <div class="card-label mb-3">Total Simpanan</div>
                                <div class="card-number">Rp
                                    {{ number_format($total_simpanan, 0, ',', '.') }}</div>
                            </div>

                            {{-- ICON (KANAN) --}}
                            <div>
                                <a href="{{ route('manajemen.simpanan.index') }}">
                                    <div class="img-circle elevation-2 d-flex align-items-center justify-content-center bg-white"
                                        style="width:60px; height:60px;">
                                        <i class="fas fa-wallet text-orange" style="font-size:30px;"></i>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <div class="card-footer p-2">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.simpanan.wajib') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">Wajib</span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">
                                            Rp {{ number_format($simpanan_wajib, 0, ',', '.') }}
                                        </span>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.simpanan.pokok') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary mr-2 px-2 py-1">Pokok</span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">
                                            Rp {{ number_format($simpanan_pokok, 0, ',', '.') }}
                                        </span>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.simpanan.sukarela') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-info mr-2 px-2 py-1">Sukarela</span>
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
                <div class="col-md-3">
                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT (KIRI) --}}
                            <div>
                                <div class="card-label mb-3">Total Pinjaman</div>
                                <div class="card-number">Rp 2.500.000</div>
                            </div>

                            {{-- ICON (KANAN) --}}
                            <div>
                                <a href="{{ route('manajemen.pinjaman.index') }}">
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
                                    <a href="{{ route('manajemen.pinjaman.pribadi') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">Pribadi</span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            2.000.000</span>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.pinjaman.khusus') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary mr-2 px-2 py-1">Khusus</span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            500.000</span>

                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-widget widget-user-2">

                        <div class="widget-user-header d-flex align-items-center justify-content-between">

                            {{-- TEXT (KIRI) --}}
                            <div>
                                <div class="card-label mb-3">Transaksi Hari Ini</div>
                                <div class="card-number">Rp 1.200.000</div>
                            </div>

                            {{-- ICON (KANAN) --}}
                            <div>
                                <a href="{{ route('manajemen.rekap.index') }}">
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
                                    <a href="{{ route('manajemen.rekap.dum') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">DUM</span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            850.000</span>

                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('manajemen.rekap.duk') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">

                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger mr-2 px-2 py-1">DUK</span>
                                        </div>

                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            350.000</span>

                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>

                <!-- /.col -->
            </div>

            <!-- CARD BODY -->
            <div class="card shadow-sm border-0">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0 pt-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>

                            <h4 class="font-weight-bold mb-1">

                                <i class="fas fa-history text-primary mr-2"></i>

                                Transaksi Terbaru

                            </h4>

                            <small class="text-muted">

                                Aktivitas simpanan dan pinjaman terbaru

                            </small>

                        </div>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover mb-0">

                            <thead class="bg-dark text-white">

                                <tr>

                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($transaksiTerbaru as $item)
                                    <tr>

                                        {{-- TANGGAL --}}
                                        <td>

                                            <div class="font-weight-bold">

                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}

                                            </div>

                                            <small class="text-muted">

                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}

                                            </small>

                                        </td>

                                        {{-- ID ANGGOTA --}}
                                        <td class="font-weight-bold">

                                            {{ $item->anggota->kode_anggota ?? '-' }}

                                        </td>

                                        {{-- NAMA + NIK --}}
                                        <td>

                                            <div class="font-weight-bold">

                                                {{ $item->anggota->nama_anggota ?? '-' }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $item->anggota->no_ktp ?? '-' }}

                                            </small>

                                        </td>

                                        {{-- JENIS SIMPANAN --}}
                                        <td>

                                            @if ($item->jenis_simpanan == 'pokok')
                                                <span class="badge badge-primary">

                                                    Simpanan Pokok

                                                </span>
                                            @elseif ($item->jenis_simpanan == 'wajib')
                                                <span class="badge badge-success">

                                                    Simpanan Wajib

                                                </span>
                                            @elseif ($item->jenis_simpanan == 'sukarela')
                                                <span class="badge badge-info">

                                                    Simpanan Sukarela

                                                </span>
                                            @endif

                                        </td>

                                        {{-- NOMINAL --}}
                                        <td class="font-weight-bold text-dark">

                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}

                                        </td>

                                        {{-- KETERANGAN --}}
                                        <td>

                                            <small class="text-muted">

                                                Transaksi simpanan {{ $item->jenis_simpanan }}

                                            </small>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="text-center py-5">

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

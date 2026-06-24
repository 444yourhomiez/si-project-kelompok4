<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-th-large mr-2"></i>
                            Dashboard
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-success">
                                <i class="nav-icon fas fa-th-large mr-1"></i>
                                Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="welcome-card mb-3">
                <h4 class="mb-1 font-weight-bold">
                    Selamat Datang, {{ auth()->user()->nama_user }}
                </h4>
                <p class="mb-0">
                    Berikut informasi penting terkait pengelolaan Koperasi Motekar
                </p>
            </div>
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
                                <a href="{{ route('pengawas.anggota.index') }}">
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
                                    <a href="{{ route('pengawas.anggota.disetujui') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">Disetujui</span>
                                        </div>
                                        <span class="font-weight-bold text-dark"
                                            style="font-size:15px;">{{ $anggota_disetujui }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pengawas.anggota.menunggu') }}"
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
                                <a href="{{ route('pengawas.simpanan.index') }}">
                                    <div class="img-circle elevation-2 d-flex align-items-center justify-content-center bg-white"
                                        style="width:60px; height:60px;">
                                        <i class="fas fa-coins text-orange" style="font-size:30px;"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card-footer p-2">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('pengawas.simpanan.wajib') }}"
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
                                    <a href="{{ route('pengawas.simpanan.pokok') }}"
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
                                    <a href="{{ route('pengawas.simpanan.sukarela') }}"
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
                                <div class="card-number">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</div>
                            </div>
                            {{-- ICON (KANAN) --}}
                            <div>
                                <a href="{{ route('pengawas.pinjaman.index') }}">
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
                                    <a href="{{ route('pengawas.pinjaman.biasa') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">Biasa</span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            {{ number_format($pinjamanBiasa, 0, ',', '.') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pengawas.pinjaman.khusus') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary mr-2 px-2 py-1">Khusus</span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            {{ number_format($pinjamanKhusus, 0, ',', '.') }}</span>
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
                                <div class="card-number">Rp {{ number_format($transaksiHariIni, 0, ',', '.') }}</div>
                            </div>
                            {{-- ICON (KANAN) --}}
                            <div>
                                <a href="{{ route('pengawas.rekap.index') }}">
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
                                    <a href="{{ route('pengawas.rekap.index') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">DUM</span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            {{ number_format($totalMasukHariIni, 0, ',', '.') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pengawas.rekap.index') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger mr-2 px-2 py-1">DUK</span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            {{ number_format($totalKeluarHariIni, 0, ',', '.') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            {{-- TRANSAKSI TERBARU --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="font-weight-bold mb-0">
                        <i class="fas fa-history mr-2 text-muted"></i>
                        Transaksi Terbaru
                    </h5>
                    @if ($transaksiTerbaru->count() > 10)
                        <button wire:click="toggleTransaksi" class="btn btn-sm btn-outline-success ml-auto" style="flex-shrink:0;">
                            {{ $showAllTransaksi ? 'Tampilkan Sedikit' : 'Lihat Semua' }}
                        </button>
                    @endif
                </div>
                <div class="card-body pt-2 pb-0">
                    @forelse ($displayedTransaksi as $item)
                        @php
                            $subTipe = $item->sub ?? '';
                            $typeConfig = [
                                'wajib'    => ['icon' => 'fa-wallet',             'bg' => '#e8f5e9', 'color' => '#28a745', 'badge' => 'success', 'label' => 'Wajib'],
                                'pokok'    => ['icon' => 'fa-piggy-bank',          'bg' => '#e3f2fd', 'color' => '#007bff', 'badge' => 'primary', 'label' => 'Pokok'],
                                'sukarela' => ['icon' => 'fa-hand-holding-heart',  'bg' => '#e8eaf6', 'color' => '#5c6bc0', 'badge' => 'info',    'label' => 'Sukarela'],
                                'biasa'    => ['icon' => 'fa-file-invoice-dollar', 'bg' => '#fff8e1', 'color' => '#f97316', 'badge' => 'warning', 'label' => 'Biasa'],
                                'khusus'   => ['icon' => 'fa-star',                'bg' => '#ffebee', 'color' => '#dc3545', 'badge' => 'danger',  'label' => 'Khusus'],
                                'cicilan'  => ['icon' => 'fa-receipt',             'bg' => '#e0f7fa', 'color' => '#00acc1', 'badge' => 'info',    'label' => 'Cicilan'],
                                'masuk'    => ['icon' => 'fa-arrow-circle-down',   'bg' => '#e8f5e9', 'color' => '#28a745', 'badge' => 'success', 'label' => 'Uang Masuk'],
                                'keluar'   => ['icon' => 'fa-arrow-circle-up',     'bg' => '#ffebee', 'color' => '#dc3545', 'badge' => 'danger',  'label' => 'Uang Keluar'],
                            ];
                            $cfg = $typeConfig[$subTipe] ?? ['icon' => 'fa-exchange-alt', 'bg' => '#f5f5f5', 'color' => '#6c757d', 'badge' => 'secondary', 'label' => ucfirst($subTipe)];
                            $statusLower = strtolower($item->status ?? '');

                            if ($item->tipe === 'cicilan' && !empty($item->pinjaman_id)) {
                                $link = route('pengawas.cicilan.detail', $item->pinjaman_id);
                            } elseif ($item->tipe === 'pinjaman') {
                                $link = $subTipe === 'khusus'
                                    ? route('pengawas.pinjaman.khusus')
                                    : route('pengawas.pinjaman.biasa');
                            } else {
                                $routeMap = [
                                    'wajib'    => route('pengawas.simpanan.wajib'),
                                    'pokok'    => route('pengawas.simpanan.pokok'),
                                    'sukarela' => route('pengawas.simpanan.sukarela'),
                                    'masuk'    => route('pengawas.rekap.index'),
                                    'keluar'   => route('pengawas.rekap.index'),
                                ];
                                $link = $routeMap[$subTipe] ?? '#';
                            }
                        @endphp
                        <a href="{{ $link }}" class="d-block text-decoration-none mb-2">
                            <div class="card border shadow-sm" style="border-radius:8px; overflow:hidden;">
                                <div class="p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center" style="gap:12px; flex:1; min-width:0;">
                                            <div class="trx-feed-icon" style="background:{{ $cfg['bg'] }}; flex-shrink:0;">
                                                <i class="fas {{ $cfg['icon'] }}" style="font-size:16px;color:{{ $cfg['color'] }};"></i>
                                            </div>
                                            <div style="min-width:0; overflow:hidden;">
                                                <div class="font-weight-bold text-dark" style="font-size:0.9rem;">
                                                    {{ $item->nama_anggota }}
                                                    @if($item->kode_anggota !== '-')
                                                        <span class="badge badge-dark ml-1" style="font-size:0.6rem;font-weight:600;vertical-align:middle;">{{ $item->kode_anggota }}</span>
                                                    @endif
                                                </div>
                                                <div style="font-size:0.8rem;color:#555;">
                                                    {{ $item->jenis }}
                                                    <span class="badge badge-{{ $cfg['badge'] }} ml-1" style="font-size:0.6rem;vertical-align:middle;">{{ $cfg['label'] }}</span>
                                                </div>
                                                @if(!empty($item->keterangan))
                                                    <small class="text-muted" style="font-size:0.75rem;font-style:italic;">{{ $item->keterangan }}</small>
                                                @endif
                                                <div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right" style="flex-shrink:0;">
                                            <div class="font-weight-bold" style="font-size:0.9rem;color:{{ $cfg['color'] }};">
                                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                            </div>
                                            @if($statusLower === 'aktif' || $statusLower === 'berhasil')
                                                <span class="badge badge-success" style="font-size:0.65rem;">{{ $item->status }}</span>
                                            @elseif($statusLower === 'lunas' || $statusLower === 'dicatat')
                                                <span class="badge badge-primary" style="font-size:0.65rem;">{{ $item->status }}</span>
                                            @elseif($statusLower === 'pending' || $statusLower === 'disetujui')
                                                <span class="badge badge-warning" style="font-size:0.65rem;">{{ $item->status }}</span>
                                            @elseif($statusLower === 'ditolak')
                                                <span class="badge badge-danger" style="font-size:0.65rem;">{{ $item->status }}</span>
                                            @else
                                                <span class="badge badge-secondary" style="font-size:0.65rem;">{{ $item->status ?? '-' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-history fa-2x mb-2 d-block"></i>
                            Belum ada transaksi
                        </div>
                    @endforelse
                </div>
                <div class="card-footer bg-white border-0 py-2"></div>
            </div>
        </section>
    </div>
</div>

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
                                        <i class="fas fa-coins text-orange" style="font-size:30px;"></i>
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
                                <div class="card-number">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</div>
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
                                    <a href="{{ route('manajemen.pinjaman.biasa') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">Biasa</span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            {{ number_format($pinjamanBiasa, 0, ',', '.') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('manajemen.pinjaman.khusus') }}"
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
                                    <a href="{{ route('manajemen.rekap.index') }}"
                                        class="nav-link item-hover d-flex justify-content-between align-items-center rounded">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success mr-2 px-2 py-1">DUM</span>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size:15px;">Rp
                                            {{ number_format($totalMasukHariIni, 0, ',', '.') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('manajemen.rekap.index') }}"
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
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="font-weight-bold mb-0">
                        <i class="fas fa-history mr-2 text-muted"></i>
                        Transaksi Terbaru
                    </h5>
                </div>
                <div class="card-body pt-2 pb-0">
                    @forelse ($transaksiTerbaru as $item)
                        @php
                            $colId     = 'trx-' . $item->tipe . '-' . $item->id;
                            $hasCicilan = $item->tipe == 'pinjaman' && $item->cicilan->count() > 0;
                        @endphp
                        <div class="card border mb-2 shadow-sm" style="border-radius:8px; overflow:hidden;">
                            <div class="card-header bg-white border-bottom-0 p-0">
                                @if($hasCicilan)
                                    <button class="btn btn-link w-100 text-left p-3 collapsed"
                                        data-toggle="collapse" data-target="#{{ $colId }}"
                                        aria-expanded="false" style="text-decoration:none;">
                                @else
                                    <div class="p-3">
                                @endif
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center" style="gap:10px;">
                                                <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                    style="width:38px;height:38px;
                                                    background:{{ $item->tipe == 'simpanan' ? '#e8f5e9' : '#ffebee' }};">
                                                    <i class="fas {{ $item->tipe == 'simpanan' ? 'fa-coins text-success' : 'fa-hand-holding-usd text-danger' }}"
                                                        style="font-size:14px;"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold text-dark" style="font-size:0.9rem;">
                                                        {{ $item->nama_anggota }}
                                                        <small class="text-muted font-weight-normal">({{ $item->kode_anggota }})</small>
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $item->jenis }}
                                                        &bull; {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                                        &bull; {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center" style="gap:10px; flex-shrink:0;">
                                                <div class="text-right">
                                                    <div class="font-weight-bold" style="font-size:0.9rem;">
                                                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                                    </div>
                                                    @php $s = strtolower($item->status ?? '') @endphp
                                                    @if($s == 'aktif' || $s == 'berhasil')
                                                        <span class="badge badge-success" style="font-size:0.7rem;">{{ $item->status }}</span>
                                                    @elseif($s == 'lunas')
                                                        <span class="badge badge-primary" style="font-size:0.7rem;">{{ $item->status }}</span>
                                                    @elseif($s == 'pending')
                                                        <span class="badge badge-warning" style="font-size:0.7rem;">{{ $item->status }}</span>
                                                    @elseif($s == 'ditolak')
                                                        <span class="badge badge-danger" style="font-size:0.7rem;">{{ $item->status }}</span>
                                                    @else
                                                        <span class="badge badge-secondary" style="font-size:0.7rem;">{{ $item->status ?? '-' }}</span>
                                                    @endif
                                                </div>
                                                @if($hasCicilan)
                                                    <i class="fas fa-chevron-down text-muted" style="font-size:0.75rem;"></i>
                                                @endif
                                            </div>
                                        </div>
                                @if($hasCicilan)
                                    </button>
                                @else
                                    </div>
                                @endif
                            </div>

                            @if($hasCicilan)
                                <div id="{{ $colId }}" class="collapse">
                                    <div class="card-body pt-0 px-3 pb-3">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center" style="width:75px;">Cicilan</th>
                                                        <th>Jatuh Tempo</th>
                                                        <th class="text-right">Nominal</th>
                                                        <th class="text-center" style="width:95px;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($item->cicilan as $cicilan)
                                                        @php
                                                            $jt = \Carbon\Carbon::parse($cicilan->jatuh_tempo);
                                                            $terlambat = $cicilan->status == 'belum' && $jt->isPast();
                                                        @endphp
                                                        <tr class="{{ $terlambat ? 'table-danger' : ($cicilan->status == 'lunas' ? 'table-success' : '') }}"
                                                            style="opacity:{{ $cicilan->status == 'lunas' ? '0.8' : '1' }};">
                                                            <td class="text-center">
                                                                <span class="badge badge-info">Ke-{{ $cicilan->cicilan_ke }}</span>
                                                            </td>
                                                            <td>
                                                                <div style="font-size:0.8rem;">{{ $jt->format('d M Y') }}</div>
                                                                <small class="text-muted">{{ $jt->diffForHumans() }}</small>
                                                            </td>
                                                            <td class="text-right font-weight-bold" style="font-size:0.85rem;">
                                                                Rp {{ number_format($cicilan->jumlah_tagihan, 0, ',', '.') }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if($cicilan->status == 'lunas')
                                                                    <span class="badge badge-success"><i class="fas fa-check mr-1"></i>Lunas</span>
                                                                @elseif($terlambat)
                                                                    <span class="badge badge-danger">Terlambat</span>
                                                                @else
                                                                    <span class="badge badge-warning">Belum</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
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

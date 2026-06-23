<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-money-bill-wave mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('anggota.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-success">
                                <i class="nav-icon fas fa-money-bill-wave mr-1"></i>
                                {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- CONTENT --}}
        <section class="content">

            {{-- STAT CARDS --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        {{-- TOTAL TAGIHAN --}}
                        <div class="col-md-4 col-12">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#fff8e1;">
                                    <i class="fas fa-money-bill-wave" style="color:#ffc107;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Total Tagihan</small>
                                    <div class="simpanan-stat-value" style="color:#ffc107;">
                                        Rp {{ number_format($totalTagihan, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- BELUM DIBAYAR --}}
                        <div class="col-md-4 col-6">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#ffebee;">
                                    <i class="fas fa-clock" style="color:#dc3545;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Belum Dibayar</small>
                                    <div class="simpanan-stat-value" style="color:#dc3545;">
                                        Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- SUDAH DIBAYAR --}}
                        <div class="col-md-4 col-6">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#e8f5e9;">
                                    <i class="fas fa-check-circle" style="color:#28a745;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Sudah Dibayar</small>
                                    <div class="simpanan-stat-value" style="color:#28a745;">
                                        Rp {{ number_format($totalLunas, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLE CARD --}}
            <div class="card table-modern border-0 shadow-sm">
                {{-- HEADER --}}
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                Riwayat Cicilan Pinjaman
                            </h4>
                            <small class="text-muted">
                                Klik baris pinjaman untuk melihat detail cicilan
                            </small>
                        </div>
                    </div>
                </div>

                {{-- FILTER --}}
                <div class="card-body pb-0">
                    <div class="row mb-3 align-items-end">
                        {{-- SEARCH --}}
                        <div class="col-lg-4 col-md-6 col-12 mb-2">
                            <label>Cari Pinjaman</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Kode pinjaman...">
                        </div>
                        {{-- FILTER STATUS --}}
                        <div class="col-lg-3 col-md-6 col-6 mb-2">
                            <label>Status Pinjaman</label>
                            <select wire:model.live="filterStatus" class="form-control">
                                <option value="">Semua</option>
                                <option value="aktif">Aktif</option>
                                <option value="lunas">Lunas</option>
                                <option value="pending">Pending</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        {{-- PAGINATION --}}
                        <div class="col-lg-3 col-md-6 col-6 mb-2">
                            <label>Data</label>
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- ACCORDION LIST --}}
                <div class="card-body pt-0">
                    @forelse($pinjamanList as $pinjaman)
                        @php
                            $totalCicilan   = $pinjaman->cicilan->count();
                            $cicilanLunas   = $pinjaman->cicilan->where('status', 'lunas')->count();
                            $totalTagihanPinjaman = $pinjaman->cicilan->sum('jumlah_tagihan');
                            $sudahBayar     = $pinjaman->cicilan->where('status', 'lunas')->sum('jumlah_tagihan');
                            $progressPct    = $totalCicilan > 0 ? round(($cicilanLunas / $totalCicilan) * 100) : 0;
                            $collapseId     = 'cicilan-detail-' . $pinjaman->id;
                        @endphp

                        <div class="card border mb-3 shadow-sm cicilan-pinjaman-card">
                            {{-- PINJAMAN HEADER (clickable) --}}
                            <div class="card-header bg-white border-bottom-0 p-0">
                                <button class="btn btn-link w-100 text-left p-3 collapsed cicilan-toggle"
                                    data-toggle="collapse"
                                    data-target="#{{ $collapseId }}"
                                    aria-expanded="false">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:8px;">
                                        {{-- KIRI: info pinjaman --}}
                                        <div class="d-flex align-items-center" style="gap:12px; min-width:0;">
                                            {{-- ICON JENIS --}}
                                            <div class="cicilan-pinjaman-icon flex-shrink-0
                                                @if($pinjaman->jenis_pinjaman == 'biasa') bg-success-light text-success
                                                @else bg-primary-light text-primary @endif">
                                                <i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <div style="min-width:0;">
                                                <div class="font-weight-bold text-dark" style="font-size:0.95rem;">
                                                    {{ $pinjaman->kode_pinjaman }}
                                                </div>
                                                <div class="text-muted" style="font-size:0.8rem;">
                                                    Pinjaman {{ ucfirst($pinjaman->jenis_pinjaman) }}
                                                    &bull; Tenor {{ $pinjaman->tenor }} bulan
                                                    &bull; Rp {{ number_format($pinjaman->jumlah_disetujui ?? $pinjaman->jumlah_pengajuan, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- KANAN: progress + status --}}
                                        <div class="d-flex align-items-center" style="gap:12px; flex-shrink:0;">
                                            {{-- PROGRESS --}}
                                            @if($totalCicilan > 0)
                                            <div style="min-width:120px;">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <small class="text-muted">{{ $cicilanLunas }}/{{ $totalCicilan }} cicilan</small>
                                                    <small class="font-weight-bold">{{ $progressPct }}%</small>
                                                </div>
                                                <div class="progress" style="height:6px; border-radius:4px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width:{{ $progressPct }}%"></div>
                                                </div>
                                            </div>
                                            @endif

                                            {{-- STATUS BADGE --}}
                                            @if($pinjaman->status == 'aktif')
                                                <span class="badge badge-success px-2 py-1">Aktif</span>
                                            @elseif($pinjaman->status == 'lunas')
                                                <span class="badge badge-primary px-2 py-1">Lunas</span>
                                            @elseif($pinjaman->status == 'pending')
                                                <span class="badge badge-warning px-2 py-1">Pending</span>
                                            @else
                                                <span class="badge badge-danger px-2 py-1">Ditolak</span>
                                            @endif

                                            {{-- CHEVRON --}}
                                            <i class="fas fa-chevron-down cicilan-chevron text-muted" style="font-size:0.8rem;"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            {{-- CICILAN DETAIL (collapse) --}}
                            <div id="{{ $collapseId }}" class="collapse">
                                <div class="card-body pt-0 px-3 pb-3">
                                    {{-- RINGKASAN PEMBAYARAN --}}
                                    <div class="row mb-3">
                                        <div class="col-md-4 col-6 mb-2">
                                            <div class="cicilan-summary-box bg-light rounded p-2">
                                                <small class="text-muted d-block">Total Tagihan</small>
                                                <span class="font-weight-bold text-dark">
                                                    Rp {{ number_format($totalTagihanPinjaman, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2">
                                            <div class="cicilan-summary-box bg-light rounded p-2">
                                                <small class="text-muted d-block">Sudah Dibayar</small>
                                                <span class="font-weight-bold text-success">
                                                    Rp {{ number_format($sudahBayar, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mb-2">
                                            <div class="cicilan-summary-box bg-light rounded p-2">
                                                <small class="text-muted d-block">Sisa Tagihan</small>
                                                <span class="font-weight-bold text-danger">
                                                    Rp {{ number_format($totalTagihanPinjaman - $sudahBayar, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- TABEL CICILAN --}}
                                    @if($pinjaman->cicilan->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center" style="width:90px;">Cicilan</th>
                                                        <th>Jatuh Tempo</th>
                                                        <th>Nominal</th>
                                                        <th class="text-center" style="width:110px;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pinjaman->cicilan as $cicilan)
                                                        @php
                                                            $jatuhTempo = \Carbon\Carbon::parse($cicilan->jatuh_tempo);
                                                            $isLate = $cicilan->status == 'belum' && $jatuhTempo->isPast();
                                                        @endphp
                                                        <tr class="{{ $isLate ? 'table-danger' : ($cicilan->status == 'lunas' ? 'table-success' : '') }}"
                                                            style="opacity:{{ $cicilan->status == 'lunas' ? '0.75' : '1' }};">
                                                            <td class="text-center">
                                                                <span class="badge badge-info">Ke-{{ $cicilan->cicilan_ke }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="font-weight-bold" style="font-size:0.85rem;">
                                                                    {{ $jatuhTempo->format('d M Y') }}
                                                                </div>
                                                                <small class="text-muted">
                                                                    <span data-timestamp="{{ $jatuhTempo->timestamp }}"></span>
                                                                </small>
                                                            </td>
                                                            <td class="font-weight-bold">
                                                                Rp {{ number_format($cicilan->jumlah_tagihan, 0, ',', '.') }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if($cicilan->status == 'lunas')
                                                                    <span class="badge badge-success">
                                                                        <i class="fas fa-check mr-1"></i>Lunas
                                                                    </span>
                                                                @elseif($isLate)
                                                                    <span class="badge badge-danger">
                                                                        <i class="fas fa-exclamation-triangle mr-1"></i>Terlambat
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-warning">
                                                                        <i class="fas fa-clock mr-1"></i>Belum Bayar
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-3 text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Belum ada data cicilan untuk pinjaman ini
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pinjaman</h5>
                            <p class="text-muted">Data cicilan akan muncul setelah Anda memiliki pinjaman aktif</p>
                        </div>
                    @endforelse

                    {{-- PAGINATION --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            Menampilkan {{ $pinjamanList->firstItem() ?? 0 }}–{{ $pinjamanList->lastItem() ?? 0 }}
                            dari {{ $pinjamanList->total() }} pinjaman
                        </small>
                        <div class="modern-pagination">
                            {{ $pinjamanList->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="font-weight-bold">
                            <i class="fas fa-list-ol text-success mr-2"></i>
                            Detail Cicilan
                        </h1>
                        <small class="text-muted">Rincian cicilan pinjaman anggota</small>
                    </div>
                    <a href="{{ route('manajemen.cicilan.index') }}" class="btn btn-light shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                {{-- FLASH --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                {{-- INFO ANGGOTA --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mr-4"
                                style="width:75px;height:75px;font-size:28px;flex-shrink:0;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h4 class="font-weight-bold mb-1">{{ $pinjaman->anggota->nama_anggota }}</h4>
                                <div class="text-muted mb-1">{{ $pinjaman->anggota->kode_anggota }}</div>
                                @if($pinjaman->status === 'lunas')
                                    <span class="badge badge-success px-3 py-1">
                                        <i class="fas fa-check-circle mr-1"></i> Pinjaman Lunas
                                    </span>
                                @else
                                    <span class="badge badge-warning px-3 py-1">
                                        <i class="fas fa-clock mr-1"></i> Pinjaman Aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFO PINJAMAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="font-weight-bold mb-0">
                            <i class="fas fa-info-circle mr-2"></i>
                            Informasi Pinjaman — {{ $pinjaman->kode_pinjaman }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Jenis Pinjaman</small>
                                <strong>
                                    @if($pinjaman->jenis_pinjaman === 'biasa')
                                        <span class="badge badge-success">Biasa</span>
                                    @else
                                        <span class="badge badge-primary">Khusus</span>
                                    @endif
                                </strong>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Jumlah Disetujui</small>
                                <strong>Rp {{ number_format($pinjaman->jumlah_disetujui ?? $pinjaman->jumlah_pengajuan, 0, ',', '.') }}</strong>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Cicilan / Bulan</small>
                                <strong>Rp {{ number_format($pinjaman->cicilan_per_bulan, 0, ',', '.') }}</strong>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Tenor</small>
                                <strong>{{ $pinjaman->tenor }} bulan</strong>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Bunga</small>
                                <strong>{{ $pinjaman->bunga }}%</strong>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Total Pembayaran</small>
                                <strong>Rp {{ number_format($pinjaman->total_pembayaran, 0, ',', '.') }}</strong>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Tanggal Persetujuan</small>
                                <strong>{{ $pinjaman->tanggal_persetujuan ? \Carbon\Carbon::parse($pinjaman->tanggal_persetujuan)->format('d M Y') : '-' }}</strong>
                                @if($pinjaman->tanggal_persetujuan)
                                    <small class="text-muted d-block"><span data-timestamp="{{ \Carbon\Carbon::parse($pinjaman->tanggal_persetujuan)->timestamp }}">{{ \Carbon\Carbon::parse($pinjaman->tanggal_persetujuan)->locale('id')->diffForHumans() }}</span></small>
                                @endif
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <small class="text-muted d-block">Tujuan Pinjaman</small>
                                <strong>{{ $pinjaman->tujuan_pinjaman ?? '-' }}</strong>
                            </div>
                        </div>

                        {{-- PROGRESS --}}
                        @php
                            $allCic    = $pinjaman->cicilan;
                            $lunasCnt  = $allCic->where('status', 'lunas')->count();
                            $belumCnt  = $allCic->where('status', 'belum')->count();
                            $total     = $allCic->count();
                            $progress  = $total > 0 ? round($lunasCnt / $total * 100) : 0;
                        @endphp
                        <div class="mt-2">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="font-weight-bold">Progress Cicilan</small>
                                <small class="text-muted">{{ $lunasCnt }}/{{ $total }} cicilan lunas ({{ $progress }}%)</small>
                            </div>
                            <div class="progress" style="height:10px;border-radius:5px;">
                                <div class="progress-bar bg-success" style="width:{{ $progress }}%"></div>
                            </div>
                            @if($belumCnt > 0)
                                <small class="text-danger mt-1 d-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $belumCnt }} cicilan belum dibayar
                                </small>
                            @else
                                <small class="text-success mt-1 d-block">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Semua cicilan sudah lunas
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $sisaBelum      = $allCic->where('status', 'belum');
                    $jasaPerBulan   = (int) round(($pinjaman->jumlah_disetujui ?? $pinjaman->jumlah_pengajuan) * ($pinjaman->bunga / 100));
                    $pokokPerBulan  = $pinjaman->cicilan_per_bulan - $jasaPerBulan;
                    $totalPelunasan = ($sisaBelum->count() * $pokokPerBulan) + $jasaPerBulan;
                    $sisaPokok      = $sisaBelum->count() * $pokokPerBulan;
                @endphp

                {{-- BANNER PELUNASAN --}}
                @if($sisaBelum->count() > 0 && $pinjaman->status !== 'lunas')
                <div class="card border-0 shadow-sm mb-4" style="border-left: 4px solid #28a745 !important;">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:12px;">
                            <div class="d-flex align-items-center" style="gap:14px;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle"
                                    style="width:48px;height:48px;background:#e8f5e9;flex-shrink:0;">
                                    <i class="fas fa-hand-holding-usd text-success" style="font-size:1.2rem;"></i>
                                </div>
                                <div>
                                    <div class="font-weight-bold text-dark mb-1">Opsi Pelunasan Dipercepat</div>
                                    <div class="d-flex flex-wrap" style="gap:16px;">
                                        <div>
                                            <small class="text-muted d-block">Sisa Cicilan</small>
                                            <span class="font-weight-bold">{{ $sisaBelum->count() }} bulan</span>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Sisa Pokok</small>
                                            <span class="font-weight-bold">Rp {{ number_format($sisaPokok, 0, ',', '.') }}</span>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Jasa (1 bulan)</small>
                                            <span class="font-weight-bold">Rp {{ number_format($jasaPerBulan, 0, ',', '.') }}</span>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Total Bayar</small>
                                            <span class="font-weight-bold text-success" style="font-size:1.05rem;">
                                                Rp {{ number_format($totalPelunasan, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button wire:click="konfirmLunasi"
                                class="btn btn-success px-4 shadow-sm" style="white-space:nowrap;">
                                <i class="fas fa-check-double mr-2"></i> Lunasi Semua
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                {{-- TABEL CICILAN --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="font-weight-bold mb-0">
                            <i class="fas fa-table mr-2"></i>
                            Rincian Cicilan
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width:70px;">Cicilan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Tanggal Bayar</th>
                                        <th class="text-right">Tagihan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width:110px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allCic as $cic)
                                        <tr wire:key="cic-{{ $cic->id }}">
                                            <td class="text-center font-weight-bold">Ke-{{ $cic->cicilan_ke }}</td>
                                            <td>
                                                <div class="font-weight-bold">
                                                    {{ \Carbon\Carbon::parse($cic->jatuh_tempo)->format('d M Y') }}
                                                    @if($cic->status === 'belum' && \Carbon\Carbon::parse($cic->jatuh_tempo)->isPast())
                                                        <span class="badge badge-danger ml-1">Terlambat</span>
                                                    @endif
                                                </div>
                                                <small class="text-muted"><span data-timestamp="{{ \Carbon\Carbon::parse($cic->jatuh_tempo)->timestamp }}">{{ \Carbon\Carbon::parse($cic->jatuh_tempo)->locale('id')->diffForHumans() }}</span></small>
                                            </td>
                                            <td>
                                                @if($cic->tanggal_bayar)
                                                    <div class="font-weight-bold">{{ \Carbon\Carbon::parse($cic->tanggal_bayar)->format('d M Y') }}</div>
                                                    <small class="text-muted"><span data-timestamp="{{ \Carbon\Carbon::parse($cic->tanggal_bayar)->timestamp }}">{{ \Carbon\Carbon::parse($cic->tanggal_bayar)->locale('id')->diffForHumans() }}</span></small>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td class="text-right font-weight-bold">
                                                Rp {{ number_format($cic->jumlah_tagihan, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                @if($cic->status === 'lunas')
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check mr-1"></i>Lunas
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning">Belum Bayar</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($cic->status === 'belum')
                                                    <button wire:click="konfirmBayar({{ $cic->id }})"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-check mr-1"></i> Bayar
                                                    </button>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5">
                                                Belum ada data cicilan untuk pinjaman ini
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if($allCic->count() > 0)
                                    <tfoot>
                                        <tr style="background:#d4edda;" class="font-weight-bold">
                                            <td colspan="3" class="text-right">Total Tagihan</td>
                                            <td class="text-right">
                                                Rp {{ number_format($allCic->sum('jumlah_tagihan'), 0, ',', '.') }}
                                            </td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- MODAL KONFIRMASI BAYAR --}}
    @if($confirmCicilanId)
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius:16px;overflow:hidden;">
                <div class="modal-body p-0">
                    <div style="background:#f0fdf4;padding:20px 20px 16px;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div></div>
                            <button wire:click="batalKonfirmasi" type="button"
                                style="width:32px;height:32px;border-radius:50%;background:#e2e8f0;border:none;font-size:1.1rem;font-weight:bold;color:#475569;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;">&times;</button>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center justify-content-center rounded-circle mb-3"
                                style="width:64px;height:64px;background:#dcfce7;">
                                <i class="fas fa-money-bill-wave text-success" style="font-size:1.6rem;"></i>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">Konfirmasi Pembayaran</h5>
                            <p class="text-muted text-center mb-0" style="font-size:0.9rem;">
                                Tandai cicilan ke-<strong>{{ $confirmCicilanKe }}</strong> sebagai <strong class="text-success">Lunas</strong>?
                            </p>
                        </div>
                    </div>
                    @php $cicilanKonfirm = $pinjaman->cicilan->firstWhere('id', $confirmCicilanId); @endphp
                    @if($cicilanKonfirm)
                    <div class="px-4 py-3">
                        <div class="rounded p-3" style="background:#f8f9fa;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Anggota</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">{{ $pinjaman->anggota->nama_anggota }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Cicilan ke</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">{{ $confirmCicilanKe }} / {{ $pinjaman->tenor }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Jatuh Tempo</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">{{ \Carbon\Carbon::parse($cicilanKonfirm->jatuh_tempo)->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted" style="font-size:0.85rem;">Jumlah Tagihan</span>
                                <span class="font-weight-bold text-success">Rp {{ number_format($cicilanKonfirm->jumlah_tagihan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="d-flex px-4 pb-4" style="gap:10px;">
                        <button wire:click="batalKonfirmasi" class="btn btn-light flex-fill" style="border-radius:10px;">
                            Batal
                        </button>
                        <button wire:click="bayar" class="btn btn-success flex-fill font-weight-bold" style="border-radius:10px;">
                            <i class="fas fa-check mr-1"></i> Ya, Tandai Lunas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- MODAL KONFIRMASI LUNASI SEMUA --}}
    @if($confirmLunasi)
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius:16px;overflow:hidden;">
                <div class="modal-body p-0">
                    <div style="background:#f0fdf4;padding:20px 20px 16px;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div></div>
                            <button wire:click="batalLunasi" type="button"
                                style="width:32px;height:32px;border-radius:50%;background:#e2e8f0;border:none;font-size:1.1rem;font-weight:bold;color:#475569;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;">&times;</button>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center justify-content-center rounded-circle mb-3"
                                style="width:64px;height:64px;background:#dcfce7;">
                                <i class="fas fa-check-double text-success" style="font-size:1.6rem;"></i>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">Lunasi Semua Cicilan?</h5>
                            <p class="text-muted text-center mb-0" style="font-size:0.9rem;">
                                Semua sisa cicilan akan ditandai <strong class="text-success">lunas</strong> sekaligus.
                            </p>
                        </div>
                    </div>
                    <div class="px-4 py-3">
                        <div class="rounded p-3" style="background:#f8f9fa;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Anggota</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">{{ $pinjaman->anggota->nama_anggota }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Sisa Cicilan</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">{{ $sisaBelum->count() }} bulan</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Sisa Pokok</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">Rp {{ number_format($sisaPokok, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:0.85rem;">Jasa (1 bulan)</span>
                                <span class="font-weight-bold" style="font-size:0.85rem;">Rp {{ number_format($jasaPerBulan, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between pt-2" style="border-top:1px solid #dee2e6;">
                                <span class="font-weight-bold" style="font-size:0.9rem;">Total Dibayar</span>
                                <span class="font-weight-bold text-success" style="font-size:1rem;">Rp {{ number_format($totalPelunasan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-3 p-2 rounded" style="background:#fff3cd;border:1px solid #ffc107;">
                            <small class="text-dark">
                                <i class="fas fa-exclamation-triangle text-warning mr-1"></i>
                                Tindakan ini tidak dapat dibatalkan. Pinjaman akan otomatis ditandai lunas.
                            </small>
                        </div>
                    </div>
                    <div class="d-flex px-4 pb-4" style="gap:10px;">
                        <button wire:click="batalLunasi" class="btn btn-light flex-fill" style="border-radius:10px;">
                            Batal
                        </button>
                        <button wire:click="lunasi" class="btn btn-success flex-fill font-weight-bold" style="border-radius:10px;">
                            <i class="fas fa-check-double mr-1"></i> Ya, Lunasi Semua
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

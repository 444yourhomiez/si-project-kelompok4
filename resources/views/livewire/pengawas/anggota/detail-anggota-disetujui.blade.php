<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="font-weight-bold">
                            <i class="fas fa-user-check text-success mr-2"></i>
                            Detail Anggota
                        </h1>
                        <ol class="breadcrumb p-0 bg-transparent mb-0" style="font-size:0.85rem;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('pengawas.dashboard') }}" class="text-muted breadcrumb-green">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pengawas.anggota.disetujui') }}" class="text-muted breadcrumb-green">Anggota Disetujui</a>
                            </li>
                            <li class="breadcrumb-item active text-success">Detail</li>
                        </ol>
                    </div>
                    <a href="{{ route('pengawas.anggota.disetujui') }}" class="btn btn-light shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            <div class="container-fluid">
                {{-- PROFILE CARD --}}
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <div style="background: linear-gradient(135deg, #155724 0%, #28a745 100%); padding: 28px 28px 60px;">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                    style="width:72px;height:72px;">
                                    <span class="text-success font-weight-bold" style="font-size:1.6rem;">
                                        {{ strtoupper(substr($anggota->nama_anggota, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-white">
                                <h4 class="font-weight-bold mb-1">{{ $anggota->nama_anggota }}</h4>
                                <div class="text-white-50 small mb-2">{{ $anggota->kode_anggota }}</div>
                                <span class="badge badge-light text-success px-3 py-1">
                                    <i class="fas fa-check-circle mr-1"></i> Anggota Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:-36px; padding: 0 20px 20px;">
                        <div class="row">
                            <div class="col-md-4 col-6 mb-2">
                                <div class="card border-0 shadow-sm h-100 mb-0">
                                    <div class="card-body py-3 text-center">
                                        <small class="text-muted d-block">Total Simpanan</small>
                                        <div class="font-weight-bold text-success mt-1" style="font-size:1rem;">
                                            Rp {{ number_format($anggota->simpanan->sum('jumlah'), 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-2">
                                <div class="card border-0 shadow-sm h-100 mb-0">
                                    <div class="card-body py-3 text-center">
                                        <small class="text-muted d-block">Pinjaman Aktif</small>
                                        <div class="font-weight-bold text-danger mt-1" style="font-size:1rem;">
                                            Rp {{ number_format($anggota->pinjaman->where('status','aktif')->sum('jumlah_pengajuan'), 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-2">
                                <div class="card border-0 shadow-sm h-100 mb-0">
                                    <div class="card-body py-3 text-center">
                                        <small class="text-muted d-block">Tgl. Bergabung</small>
                                        <div class="font-weight-bold mt-1" style="font-size:0.9rem;">
                                            {{ $anggota->tanggal_daftar_format }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BIODATA --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="font-weight-bold mb-0 text-success">
                            <i class="fas fa-id-card mr-2"></i> Biodata Anggota
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-hashtag mr-1"></i> Kode Anggota</small>
                                <div class="font-weight-bold">{{ $anggota->kode_anggota ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-user mr-1"></i> Nama Lengkap</small>
                                <div class="font-weight-bold">{{ $anggota->nama_anggota }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-envelope mr-1"></i> Email</small>
                                <div class="font-weight-bold">{{ $anggota->user->email }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-phone mr-1"></i> Nomor HP</small>
                                <div class="font-weight-bold">{{ $anggota->no_hp }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-id-badge mr-1"></i> No KTP/NIK</small>
                                <div class="font-weight-bold">{{ $anggota->no_ktp }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</small>
                                <div class="font-weight-bold">{{ $anggota->jenis_kelamin ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-map-marker-alt mr-1"></i> Tempat Lahir</small>
                                <div class="font-weight-bold">{{ $anggota->tempat_lahir ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-birthday-cake mr-1"></i> Tanggal Lahir</small>
                                <div class="font-weight-bold">
                                    {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-' }}
                                    @if($anggota->tanggal_lahir)
                                        <small class="text-muted">({{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->age }} tahun)</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-pray mr-1"></i> Agama</small>
                                <div class="font-weight-bold">{{ $anggota->agama ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-home mr-1"></i> Status Rumah</small>
                                <div class="font-weight-bold">{{ $anggota->status_rumah ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-money-bill-wave mr-1"></i> Penghasilan</small>
                                <div class="font-weight-bold">{{ $anggota->penghasilan ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-female mr-1"></i> Nama Ibu Kandung</small>
                                <div class="font-weight-bold">{{ $anggota->nama_ibu_kandung ?: '-' }}</div>
                            </div>
                            <div class="col-12 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-map-pin mr-1"></i> Alamat</small>
                                <div class="font-weight-bold">{{ $anggota->alamat ?: '-' }}</div>
                            </div>
                        </div>
                        @if ($anggota->nama_ahli_waris)
                            <div class="border-top pt-3 mt-1">
                                <small class="text-muted text-uppercase font-weight-bold d-block mb-2" style="font-size:0.7rem; letter-spacing:0.05em;">
                                    Ahli Waris
                                </small>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Nama</small>
                                        <div class="font-weight-bold">{{ $anggota->nama_ahli_waris }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Hubungan</small>
                                        <div class="font-weight-bold">{{ $anggota->hubungan_ahli_waris ?: '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- RIWAYAT SIMPANAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold mb-0 text-success">
                            <i class="fas fa-wallet mr-2"></i> Riwayat Simpanan
                        </h5>
                        <span class="badge badge-success px-3 py-1">
                            {{ $anggota->simpanan->count() }} Transaksi
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Simpanan</th>
                                    <th class="text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($anggota->simpanan->sortByDesc('tanggal') as $item)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                                            <small class="text-muted"><span data-timestamp="{{ \Carbon\Carbon::parse($item->created_at)->timestamp }}">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->diffForHumans() }}</span></small>
                                        </td>
                                        <td>
                                            @if ($item->jenis_simpanan == 'wajib')
                                                <span class="badge badge-success">Wajib</span>
                                            @elseif ($item->jenis_simpanan == 'pokok')
                                                <span class="badge badge-primary">Pokok</span>
                                            @else
                                                <span class="badge badge-info">Sukarela</span>
                                            @endif
                                        </td>
                                        <td class="text-right font-weight-bold text-success">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                            Belum ada data simpanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($anggota->simpanan->count() > 0)
                                <tfoot>
                                    <tr class="font-weight-bold" style="background:#d4edda;">
                                        <td colspan="2" class="text-right">Total</td>
                                        <td class="text-right text-success">
                                            Rp {{ number_format($anggota->simpanan->sum('jumlah'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>

                {{-- RIWAYAT PINJAMAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold mb-0 text-danger">
                            <i class="fas fa-hand-holding-usd mr-2"></i> Riwayat Pinjaman
                        </h5>
                        <span class="badge badge-danger px-3 py-1">
                            {{ $anggota->pinjaman->count() }} Pinjaman
                        </span>
                    </div>
                    <div class="card-body pt-0">
                        @forelse ($anggota->pinjaman as $pinjaman)
                            @php
                                $totalCicilan = $pinjaman->cicilan->count();
                                $cicilanLunas = $pinjaman->cicilan->where('status', 'lunas')->count();
                                $progressPct  = $totalCicilan > 0 ? round(($cicilanLunas / $totalCicilan) * 100) : 0;
                                $collapseId   = 'pinjaman-detail-' . $pinjaman->id;
                            @endphp
                            <div class="card border mb-2 shadow-sm mt-3">
                                <div class="card-header bg-white border-bottom-0 p-0">
                                    <button class="btn btn-link w-100 text-left p-3 collapsed"
                                        data-toggle="collapse"
                                        data-target="#{{ $collapseId }}"
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:8px;">
                                            <div class="d-flex align-items-center" style="gap:10px;">
                                                <div class="d-flex align-items-center justify-content-center rounded"
                                                    style="width:36px;height:36px;background:{{ $pinjaman->jenis_pinjaman == 'biasa' ? '#e8f5e9' : '#e3f2fd' }};">
                                                    <i class="fas fa-hand-holding-usd" style="color:{{ $pinjaman->jenis_pinjaman == 'biasa' ? '#28a745' : '#007bff' }};"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold text-dark" style="font-size:0.9rem;">
                                                        {{ $pinjaman->kode_pinjaman }}
                                                    </div>
                                                    <small class="text-muted">
                                                        Pinjaman {{ ucfirst($pinjaman->jenis_pinjaman) }}
                                                        &bull; Tenor {{ $pinjaman->tenor }} bln
                                                        &bull; Rp {{ number_format($pinjaman->jumlah_pengajuan, 0, ',', '.') }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center" style="gap:10px; flex-shrink:0;">
                                                @if($totalCicilan > 0)
                                                    <div style="min-width:100px;">
                                                        <div class="d-flex justify-content-between mb-1">
                                                            <small class="text-muted">{{ $cicilanLunas }}/{{ $totalCicilan }}</small>
                                                            <small class="font-weight-bold">{{ $progressPct }}%</small>
                                                        </div>
                                                        <div class="progress" style="height:5px; border-radius:3px;">
                                                            <div class="progress-bar bg-success" style="width:{{ $progressPct }}%"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($pinjaman->status == 'aktif')
                                                    <span class="badge badge-success">Aktif</span>
                                                @elseif($pinjaman->status == 'lunas')
                                                    <span class="badge badge-primary">Lunas</span>
                                                @elseif($pinjaman->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                                <i class="fas fa-chevron-down text-muted" style="font-size:0.75rem;"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                <div id="{{ $collapseId }}" class="collapse">
                                    <div class="card-body pt-0 px-3 pb-3">
                                        <div class="row mb-3">
                                            <div class="col-4 text-center">
                                                <div class="border rounded p-2">
                                                    <small class="text-muted d-block">Dana Cair</small>
                                                    <span class="font-weight-bold text-success" style="font-size:0.85rem;">
                                                        Rp {{ number_format($pinjaman->dana_diterima ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center">
                                                <div class="border rounded p-2">
                                                    <small class="text-muted d-block">Cicilan/Bln</small>
                                                    <span class="font-weight-bold text-primary" style="font-size:0.85rem;">
                                                        Rp {{ number_format($pinjaman->cicilan_per_bulan, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center">
                                                <div class="border rounded p-2">
                                                    <small class="text-muted d-block">Total Bayar</small>
                                                    <span class="font-weight-bold text-danger" style="font-size:0.85rem;">
                                                        Rp {{ number_format($pinjaman->total_pembayaran ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($pinjaman->cicilan->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" style="width:80px;">Cicilan</th>
                                                            <th>Jatuh Tempo</th>
                                                            <th class="text-right">Nominal</th>
                                                            <th class="text-center" style="width:100px;">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($pinjaman->cicilan as $cicilan)
                                                            @php
                                                                $jatuhTempo = \Carbon\Carbon::parse($cicilan->jatuh_tempo);
                                                                $isLate = $cicilan->status == 'belum' && $jatuhTempo->isPast();
                                                            @endphp
                                                            <tr class="{{ $isLate ? 'table-danger' : ($cicilan->status == 'lunas' ? 'table-success' : '') }}"
                                                                style="opacity:{{ $cicilan->status == 'lunas' ? '0.8' : '1' }};">
                                                                <td class="text-center">
                                                                    <span class="badge badge-info">Ke-{{ $cicilan->cicilan_ke }}</span>
                                                                </td>
                                                                <td>
                                                                    <div class="font-weight-bold">{{ $jatuhTempo->format('d M Y') }}</div>
                                                                    <small class="text-muted"><span data-timestamp="{{ $jatuhTempo->timestamp }}">{{ $jatuhTempo->locale('id')->diffForHumans() }}</span></small>
                                                                </td>
                                                                <td class="text-right font-weight-bold">
                                                                    Rp {{ number_format($cicilan->jumlah_tagihan, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($cicilan->status == 'lunas')
                                                                        <span class="badge badge-success"><i class="fas fa-check mr-1"></i>Lunas</span>
                                                                    @elseif($isLate)
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
                                        @else
                                            <div class="text-center py-2 text-muted small">
                                                <i class="fas fa-info-circle mr-1"></i> Belum ada cicilan untuk pinjaman ini
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted mt-3">
                                <i class="fas fa-hand-holding-usd fa-2x mb-2 d-block"></i>
                                Belum ada data pinjaman
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-hand-holding-usd mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="row no-gutters">

                        {{-- TOTAL PINJAMAN --}}
                        <div class="col-md-4 col-12">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#ffebee;">
                                    <i class="fas fa-hand-holding-usd" style="color:#dc3545;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Total Pinjaman</small>
                                    <div class="simpanan-stat-value" style="color:#dc3545;">
                                        Rp {{ number_format($totalPinjaman, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PINJAMAN BIASA --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('anggota.pinjaman.biasa') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
                                    <div class="simpanan-stat-icon" style="background:#e8f5e9;">
                                        <i class="fas fa-file-invoice-dollar" style="color:#28a745;"></i>
                                    </div>
                                    <div class="simpanan-stat-text">
                                        <small>Pinjaman Biasa</small>
                                        <div class="simpanan-stat-value" style="color:#28a745;">
                                            Rp {{ number_format($totalPinjamanBiasa, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- PINJAMAN KHUSUS --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('anggota.pinjaman.khusus') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-bottom">
                                    <div class="simpanan-stat-icon" style="background:#e3f2fd;">
                                        <i class="fas fa-star" style="color:#007bff;"></i>
                                    </div>
                                    <div class="simpanan-stat-text">
                                        <small>Pinjaman Khusus</small>
                                        <div class="simpanan-stat-value" style="color:#007bff;">
                                            Rp {{ number_format($totalPinjamanKhusus, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            {{-- TABLE --}}
            <div class="card table-modern border-0 shadow-sm">
                {{-- HEADER --}}
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                Riwayat Pinjaman
                            </h4>
                            <small class="text-muted">
                                Data transaksi pinjaman
                            </small>
                        </div>
                    </div>
                </div>
                {{-- TABLE --}}
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        {{-- SEARCH --}}
                        <div class="col-lg-3 col-md-6 col-12 mb-2">
                            <label>Cari Pinjaman</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Kode pinjaman atau nominal...">
                        </div>
                        {{-- FILTER JENIS --}}
                        <div class="col-lg-2 col-md-6 col-6 mb-2">
                            <label>Jenis</label>
                            <select wire:model.live="filterJenis" class="form-control">
                                <option value="">Semua</option>
                                <option value="biasa">Biasa</option>
                                <option value="khusus">Khusus</option>
                            </select>
                        </div>
                        {{-- FILTER STATUS --}}
                        <div class="col-lg-2 col-md-6 col-6 mb-2">
                            <label>Status</label>
                            <select wire:model.live="filterStatus" class="form-control">
                                <option value="">Semua</option>
                                <option value="pending">Pending</option>
                                <option value="aktif">Aktif</option>
                                <option value="lunas">Lunas</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        {{-- AJUKAN PINJAMAN --}}
                        <div class="col-lg-3 col-md-12 col-12 mb-2">
                            <button wire:click="$dispatch('openCreate')" class="btn btn-success btn-block"
                                data-toggle="modal" data-target="#createModalPinjaman">
                                <i class="fas fa-plus mr-1"></i>
                                Ajukan Pinjaman
                            </button>
                        </div>
                    </div>

                    {{-- INFO KETERANGAN PINJAMAN --}}
                    @if($bulanBergabung < 6)
                    <div class="alert border-0 mb-3 d-flex align-items-start" style="background:#fff3cd;border-left:4px solid #ffc107 !important;border-radius:10px;gap:12px;">
                        <i class="fas fa-info-circle mt-1" style="color:#f59e0b;flex-shrink:0;"></i>
                        <div style="flex:1;">
                            <div class="font-weight-bold" style="color:#92400e;font-size:0.9rem;">Informasi Syarat Pengajuan</div>
                            <div style="color:#78350f;font-size:0.85rem;">Pinjaman baru dapat diajukan setelah menjadi anggota minimal 6 bulan. Anda baru bergabung {{ $bulanBergabung }} bulan{{ $sisaBulan > 0 ? ', kurang ' . $sisaBulan . ' bulan lagi.' : '.' }}</div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between mb-1" style="font-size:0.8rem;color:#78350f;">
                                    <span>Masa keanggotaan</span>
                                    <span>{{ $bulanBergabung }} / 6 bulan</span>
                                </div>
                                <div class="progress" style="height:8px;border-radius:4px;background:#fde68a;">
                                    <div class="progress-bar" style="width:{{ min(100, round($bulanBergabung / 6 * 100)) }}%;background:#f59e0b;border-radius:4px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($infoPerJenis as $info)
                    <div class="alert border-0 mb-3 d-flex align-items-start" style="background:#fff3cd;border-left:4px solid #ffc107 !important;border-radius:10px;gap:12px;">
                        <i class="fas fa-info-circle mt-1" style="color:#f59e0b;flex-shrink:0;"></i>
                        <div style="flex:1;">
                            <div class="font-weight-bold" style="color:#92400e;font-size:0.9rem;">{{ $info['judul'] }}</div>
                            <div style="color:#78350f;font-size:0.85rem;">{{ $info['pesan'] }}</div>
                            @if(isset($info['progres']))
                            <div class="mt-2">
                                <div class="d-flex justify-content-between mb-1" style="font-size:0.8rem;color:#78350f;">
                                    <span>Progress cicilan</span>
                                    <span>{{ $info['progres'] }}% / 50% yang dibutuhkan</span>
                                </div>
                                <div class="progress" style="height:8px;border-radius:4px;background:#fde68a;">
                                    <div class="progress-bar" style="width:{{ $info['progres'] }}%;background:#f59e0b;border-radius:4px;"></div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Pinjaman</th>
                                    <th>Jenis</th>
                                    <th class="text-right">Nominal</th>
                                    <th class="text-center">Tenor</th>
                                    <th class="text-right">Cicilan/Bln</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted"><span data-timestamp="{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->timestamp }}"></span></small>
                                        </td>
                                        <td class="font-weight-bold">{{ $item->kode_pinjaman }}</td>
                                        <td>
                                            @if ($item->jenis_pinjaman == 'biasa')
                                                <span class="badge badge-success">
                                                    Biasa
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    Khusus
                                                </span>
                                            @endif
                                        </td>
                                        <td class="font-weight-bold">
                                            Rp {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}
                                        </td>
                                        <td class="font-weight-bold">{{ $item->tenor }} Bulan</td>
                                        <td class="font-weight-bold">
                                            Rp {{ number_format($item->cicilan_per_bulan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status == 'pending')
                                                <span class="badge badge-warning">
                                                    Pending
                                                </span>
                                            @elseif($item->status == 'aktif')
                                                <span class="badge badge-success">
                                                    Aktif
                                                </span>
                                            @elseif($item->status == 'lunas')
                                                <span class="badge badge-primary">
                                                    Lunas
                                                </span>
                                            @elseif($item->status == 'ditolak')
                                                <span class="badge badge-danger">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Belum ada data pinjaman
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>{{-- /.table-responsive --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            Menampilkan {{ $pinjaman->firstItem() ?? 0 }}–{{ $pinjaman->lastItem() ?? 0 }}
                            dari {{ $pinjaman->total() }} data
                        </small>
                        <div class="modern-pagination">
                            {{ $pinjaman->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

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
                </div>
            </div>
        </section>

        <section class="content">

            {{-- SUMMARY CARDS --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="row no-gutters">

                        {{-- TOTAL TAGIHAN CICILAN --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('manajemen.cicilan.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
                                    <div class="simpanan-stat-icon" style="background:#fff8e1;">
                                        <i class="fas fa-money-bill-wave" style="color:#ffc107;"></i>
                                    </div>
                                    <div class="simpanan-stat-text">
                                        <small>Total Tagihan</small>
                                        <div class="simpanan-stat-value" style="color:#ffc107;">
                                            Rp {{ number_format($totalCicilan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- BELUM DIBAYAR --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('manajemen.cicilan.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
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
                            </a>
                        </div>

                        {{-- SUDAH DIBAYAR --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('manajemen.cicilan.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
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
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR PEMINJAM --}}
            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div>
                        <h5 class="font-weight-bold mb-0">
                            Daftar Anggota Peminjam
                        </h5>
                        <small class="opacity-75">Klik detail untuk melihat rincian cicilan anggota</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Anggota / Kode</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Nama, kode anggota, kode pinjaman...">
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Jenis Pinjaman</label>
                            <select wire:model.live="filterJenis" class="form-control">
                                <option value="">Semua Jenis</option>
                                <option value="biasa">Biasa</option>
                                <option value="khusus">Khusus</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Status Pinjaman</label>
                            <select wire:model.live="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="lunas">Lunas</option>
                                <option value="disetujui">Disetujui</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Data</label>
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width:40px;">No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis</th>
                                    <th class="text-right">Jumlah Pinjaman</th>
                                    <th class="text-right">Cicilan/Bulan</th>
                                    <th class="text-center">Progress</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width:80px;">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    @php
                                        $totalCic = $item->cicilan->count();
                                        $sudahLunas = $item->cicilan->where('status', 'lunas')->count();
                                        $progress = $totalCic > 0 ? round(($sudahLunas / $totalCic) * 100) : 0;
                                    @endphp
                                    <tr wire:key="pinjaman-{{ $item->id }}">
                                        <td class="text-center">
                                            {{ $loop->iteration + ($pinjaman->currentPage() - 1) * $pinjaman->perPage() }}
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</div>
                                            <small class="text-muted"><span data-timestamp="{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->timestamp }}"></span></small>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $item->anggota->nama_anggota }}</div>
                                            <small class="text-muted">Kode: {{ $item->anggota->kode_anggota }}</small>
                                        </td>
                                        <td>
                                            @if ($item->jenis_pinjaman === 'biasa')
                                                <span class="badge badge-success">Biasa</span>
                                            @else
                                                <span class="badge badge-primary">Khusus</span>
                                            @endif
                                        </td>
                                        <td class="text-right font-weight-bold">
                                            Rp
                                            {{ number_format($item->jumlah_disetujui ?? $item->jumlah_pengajuan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">
                                            Rp {{ number_format($item->cicilan_per_bulan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center" style="min-width:130px;">
                                            <div class="progress" style="height:8px;border-radius:4px;">
                                                <div class="progress-bar bg-success"
                                                    style="width:{{ $progress }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $sudahLunas }}/{{ $totalCic }}
                                                lunas</small>
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status === 'lunas')
                                                <span class="badge badge-success">Lunas</span>
                                            @elseif($item->status === 'aktif')
                                                <span class="badge badge-warning">Aktif</span>
                                            @else
                                                <span class="badge badge-info">{{ ucfirst($item->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('manajemen.cicilan.detail', $item->id) }}"
                                                class="btn btn-sm btn-light shadow-sm" title="Lihat detail cicilan">
                                                <i class="fas fa-eye text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open fa-2x mb-2 d-block text-muted"></i>
                                                <h6 class="text-muted">Belum ada data pinjaman aktif</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

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

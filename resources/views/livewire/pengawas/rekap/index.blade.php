<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-calendar-day mr-2"></i>
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

                        {{-- TOTAL REKAP --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('pengawas.rekap.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
                                    <div class="simpanan-stat-icon" style="background:#f3e5f5;">
                                        <i class="fas fa-calendar-day" style="color:#9c27b0;"></i>
                                    </div>
                                    <div class="simpanan-stat-text">
                                        <small>Total Rekap</small>
                                        <div class="simpanan-stat-value" style="color:#9c27b0;">
                                            Rp {{ number_format($saldo, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- DUM --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('pengawas.rekap.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
                                    <div class="simpanan-stat-icon" style="background:#e8f5e9;">
                                        <i class="fas fa-arrow-circle-down" style="color:#28a745;"></i>
                                    </div>
                                    <div class="simpanan-stat-text">
                                        <small>DUM</small>
                                        <div class="simpanan-stat-value" style="color:#28a745;">
                                            Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- DUK --}}
                        <div class="col-md-4 col-12">
                            <a href="{{ route('pengawas.rekap.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
                                    <div class="simpanan-stat-icon" style="background:#ffebee;">
                                        <i class="fas fa-arrow-circle-up" style="color:#dc3545;"></i>
                                    </div>
                                    <div class="simpanan-stat-text">
                                        <small>DUK</small>
                                        <div class="simpanan-stat-value" style="color:#dc3545;">
                                            Rp {{ number_format($totalKeluar, 0, ',', '.') }}
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
                <div class="card-header bg-white border-bottom py-3">
                    <div>
                        <h5 class="font-weight-bold mb-0">
                            Riwayat Rekapitulasi Harian
                        </h5>
                        <small class="opacity-75">Data uang masuk dan uang keluar</small>
                    </div>
                </div>
                <div class="card-body">
                    {{-- FILTER --}}
                    <div class="row mb-3 align-items-end">
                        <div class="col-lg-3 col-md-12 mb-2">
                            <label>Cari</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Nama, kode, jenis, keterangan...">
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Jenis Transaksi</label>
                            <select wire:model.live="filterJenis" class="form-control">
                                <option value="">Semua</option>
                                <option value="uang_masuk">Uang Masuk</option>
                                <option value="uang_keluar">Uang Keluar</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6 mb-2">
                            <label>Tanggal</label>
                            <input type="date" wire:model.live="tanggal" class="form-control">
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

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama / Petugas</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>DUM</th>
                                    <th>DUK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $item)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($item['tanggal'])->locale('id')->diffForHumans() }}</small>
                                        </td>
                                        <td>{{ $item['kode_anggota'] }}</td>
                                        <td>{{ $item['nama_anggota'] }}</td>
                                        <td>
                                            @if ($item['jenis_key'] === 'uang_masuk')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-arrow-down mr-1"></i> Uang Masuk
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-arrow-up mr-1"></i> Uang Keluar
                                                </span>
                                            @endif
                                            {{ $item['jenis'] }}
                                        </td>
                                        <td>{{ $item['keterangan'] }}</td>
                                        <td class="text-success font-weight-bold">
                                            {{ $item['masuk'] > 0 ? 'Rp ' . number_format($item['masuk'], 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="text-danger font-weight-bold">
                                            {{ $item['keluar'] > 0 ? 'Rp ' . number_format($item['keluar'], 0, ',', '.') : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                                <p>Tidak ada data transaksi</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold bg-light">
                                    <td colspan="5" class="text-right">Saldo</td>
                                    <td class="text-success">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</td>
                                    <td class="text-danger">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="font-weight-bold" style="background:#d4edda;">
                                    <td colspan="5" class="text-right">Total Saldo</td>
                                    <td colspan="2" class="text-dark">Rp {{ number_format($saldo, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            Menampilkan {{ $riwayat->firstItem() ?? 0 }}â€“{{ $riwayat->lastItem() ?? 0 }}
                            dari {{ $riwayat->total() }} data
                        </small>
                        <div class="modern-pagination">
                            {{ $riwayat->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


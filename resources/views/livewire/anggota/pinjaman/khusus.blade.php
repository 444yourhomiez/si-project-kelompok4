<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-star mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- DASHBOARD --}}
                            <li class="breadcrumb-item">
                                <a href="{{ route('anggota.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            {{-- MENU --}}
                            <li class="breadcrumb-item">
                                <a href="{{ route('anggota.pinjaman.index') }}" class="text-muted breadcrumb-green">
                                    <i class="nav-icon fas fa-hand-holding-usd mr-1"></i>
                                    Daftar Pinjaman
                                </a>
                            </li>
                            {{-- ACTIVE --}}
                            <li class="breadcrumb-item active text-success">
                                <i class="nav-icon fas fa-star mr-1"></i>
                                {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            {{-- CARD TOTAL --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div class="simpanan-stat-icon mr-3" style="background:#e3f2fd;">
                            <i class="fas fa-star" style="color:#007bff;"></i>
                        </div>

                        <div class="simpanan-stat-text">
                            <small>Total Pinjaman Khusus Aktif</small>
                            <div class="simpanan-stat-value" style="color:#007bff;">
                                Rp {{ number_format($totalPinjamanKhusus, 0, ',', '.') }}
                            </div>
                            <small class="text-muted">
                                Akumulasi seluruh pinjaman khusus yang masih berjalan
                            </small>
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
                                Riwayat Pinjaman Khusus
                            </h4>
                            <small class="text-muted">
                                Data transaksi pinjaman khusus
                            </small>
                        </div>
                    </div>
                </div>
                {{-- TABLE --}}
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        {{-- SEARCH --}}
                        <div class="col-lg-4 col-md-6 col-12 mb-2">
                            <label>Cari Pinjaman</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Kode pinjaman...">
                        </div>
                        {{-- FILTER STATUS --}}
                        <div class="col-lg-3 col-md-6 col-6 mb-2">
                            <label>Status</label>
                            <select wire:model.live="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="aktif">Aktif</option>
                                <option value="lunas">Lunas</option>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Tenor</th>
                                    <th>Cicilan /Bulan</th>
                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    <tr>
                                        <td>{{ $item->kode_pinjaman }}</td>
                                        <td>
                                            Rp
                                            {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $item->tenor }} Bulan</td>
                                        <td>
                                            Rp
                                            {{ number_format($item->cicilan_per_bulan, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Belum ada pinjaman khusus
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

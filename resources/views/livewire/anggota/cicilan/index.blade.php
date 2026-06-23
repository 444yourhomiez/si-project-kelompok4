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
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="row no-gutters">

                        {{-- TOTAL TAGIHAN CICILAN --}}
                        <div class="col-md-4 col-6">
                            <a href="{{ route('anggota.cicilan.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
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
                            </a>
                        </div>

                        {{-- BELUM DIBAYAR --}}
                        <div class="col-md-4 col-6">
                            <a href="{{ route('anggota.cicilan.index') }}" class="text-decoration-none">
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
                            <a href="{{ route('anggota.cicilan.index') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-bottom">
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
            {{-- TABLE --}}
            <div class="card table-modern border-0 shadow-sm">
                {{-- HEADER --}}
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                Riwayat Cicilan Anggota
                            </h4>
                            <small class="text-muted">
                                Data transaksi cicilan anggota koperasi
                            </small>
                        </div>
                    </div>
                </div>
                {{-- TABLE --}}
                <div class="card-body">
                    {{-- <div class="row mb-3 align-items-end">
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Cicilan</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Cari Cicilan...">
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Urutkan</label>
                            <select wire:model.live="sortBy" class="form-control">
                                <option value="created_at">Terbaru</option>
                                <option value="nama_anggota">Nama</option>
                                <option value="jumlah">Nominal</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Arah</label>
                            <select wire:model.live="sortDirection" class="form-control">
                                <option value="desc">Z - A</option>
                                <option value="asc">A - Z</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Data</label>
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Cicilan</th>
                                    <th>Kode Pinjaman</th>
                                    <th>Jenis Pinjaman</th>
                                    <th>Nominal Tagihan</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cicilan as $item)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-info">
                                                Cicilan Ke-{{ $item->cicilan_ke }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ $item->pinjaman->kode_pinjaman }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->pinjaman->jenis_pinjaman == 'biasa')
                                                <span class="badge badge-success">
                                                    Pinjaman Biasa
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    Pinjaman Khusus
                                                </span>
                                            @endif
                                        </td>
                                        <td class="font-weight-bold text-dark">
                                            Rp {{ number_format($item->jumlah_tagihan, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->jatuh_tempo)->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td>
                                            @if ($item->status == 'lunas')
                                                <span class="badge badge-success">
                                                    Lunas
                                                </span>
                                            @elseif($item->status == 'belum' && \Carbon\Carbon::parse($item->jatuh_tempo)->isPast())
                                                <span class="badge badge-danger">
                                                    Terlambat
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    Belum Bayar
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                                                <p class="mb-0">
                                                    Belum memiliki cicilan pinjaman
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            Menampilkan {{ $cicilan->firstItem() ?? 0 }}–{{ $cicilan->lastItem() ?? 0 }}
                            dari {{ $cicilan->total() }} data
                        </small>
                        <div class="modern-pagination">
                            {{ $cicilan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

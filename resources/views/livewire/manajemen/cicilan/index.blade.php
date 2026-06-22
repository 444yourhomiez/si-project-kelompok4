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
                                <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">
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
            <div class="row mb4">
                {{-- TOTAL ANGGOTA --}}
                <div class="col-md-12 col-sm-6 col-12">
                    <div class="card card-box card-warning-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-warning"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Total Cicilan Pinjaman
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalCicilan, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Seluruh cicilan pinjaman yang diajukan anggota
                                    </small>
                                </div>
                                <a href="{{ route('manajemen.cicilan.index') }}"
                                    class="card-icon bg-warning text-white">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                </a>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-warning" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- CARD --}}
            <div class="row mb-4">
                {{-- CICILAN BIASA --}}
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="card card-box card-success-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-success"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Belum Dibayar
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Sudah diverifikasi manajemen
                                    </small>
                                </div>
                                <a href="{{ route('manajemen.cicilan.index') }}"
                                    class="card-icon bg-success text-white">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                </a>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-success" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- MENUNGGU VERIFIKASI --}}
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="card card-box card-primary-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-primary"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Sudah Dibayar
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalLunas, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Menunggu persetujuan manajemen
                                    </small>
                                </div>
                                <a href="{{ route('manajemen.cicilan.index') }}"
                                    class="card-icon bg-primary text-white">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                </a>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-primary" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TABLE --}}
            <div class="card table-modern border-0 shadow-sm">
                {{-- HEADER --}}
                <div class="card-header bg-success text-white border-0 py-2">
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
                            <thead style="background:#155724;color:#fff;">
                                <tr>
                                    <th>Jatuh Tempo</th>
                                    <th>Kode Pinjaman</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Pinjaman</th>
                                    <th>Cicilan Ke</th>
                                    <th>Tagihan</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cicilan as $item)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->jatuh_tempo)->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td class="font-weight-bold">
                                            {{ $item->pinjaman->kode_pinjaman }}
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ $item->pinjaman->anggota->nama_anggota }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $item->pinjaman->anggota->kode_anggota }}
                                            </small>
                                        </td>
                                        <td>
                                            @if ($item->pinjaman->jenis_pinjaman == 'biasa')
                                                <span class="badge badge-success">
                                                    Biasa
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    Khusus
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            Cicilan Ke-{{ $item->cicilan_ke }}
                                        </td>
                                        <td class="font-weight-bold text-dark">
                                            Rp {{ number_format($item->jumlah_tagihan, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($item->status == 'belum')
                                                <span class="badge badge-warning">
                                                    Belum Bayar
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    Lunas
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'belum')
                                                <button wire:click="bayar({{ $item->id }})"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Bayar
                                                </button>
                                            @else
                                                <span class="badge badge-success">
                                                    Sudah Dibayar
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Belum ada data cicilan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

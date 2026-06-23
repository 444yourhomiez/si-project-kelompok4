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
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('anggota.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-success">
                                <i class="nav-icon fas fa-hand-holding-usd mr-1"></i>
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

                        {{-- TOTAL PINJAMAN --}}
                        <div class="col-md-4 col-6">
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
                        <div class="col-md-4 col-6">
                            <a href="{{ route('manajemen.pinjaman.biasa') }}" class="text-decoration-none">
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
                            <a href="{{ route('manajemen.pinjaman.khusus') }}" class="text-decoration-none">
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
                        {{-- <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Pinjaman</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Cari Pinjaman...">
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
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Data</label>
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>
                            </select>
                        </div> --}}
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <button wire:click="$dispatch('openCreate')" class="btn btn-success btn-block"
                                data-toggle="modal" data-target="#createModalPinjaman">
                                <i class="fas fa-plus mr-1"></i>
                                Ajukan Pinjaman
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Pinjaman</th>
                                    <th>Nominal</th>
                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                        </td>
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
                                        <td>
                                            Rp
                                            {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}
                                        </td>
                                        <td  class="text-center">
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
                                        <td colspan="6" class="text-center">
                                            Belum ada data pinjaman
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $pinjaman->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

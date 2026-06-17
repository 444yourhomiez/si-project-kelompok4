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
            <div class="row mb4">
                {{-- TOTAL ANGGOTA --}}
                <div class="col-md-12 col-sm-6 col-12">
                    <div class="card card-box card-danger-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-danger"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Total Pinjaman
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalPinjaman, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Seluruh keseluruhan pinjaman yang diajukan
                                    </small>
                                </div>
                                <a href="{{ route('anggota.pinjaman.index') }}" class="card-icon bg-danger text-white">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                                </a>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-danger" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- CARD --}}
            <div class="row mb-4">
                {{-- PINJAMAN BIASA --}}
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="card card-box card-success-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-success"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Pinjaman Biasa
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalPinjamanBiasa, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Total pinjaman jenis biasa
                                    </small>
                                </div>
                                <a href="{{ route('anggota.pinjaman.biasa') }}" class="card-icon bg-success text-white">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                                </a>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-success" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- PINJAMAN KHUSUS --}}
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="card card-box card-primary-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-primary"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Pinjaman Khusus
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalPinjamanKhusus, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Total pinjaman jenis khusus
                                    </small>
                                </div>
                                <a href="{{ route('anggota.pinjaman.khusus') }}"
                                    class="card-icon bg-primary text-white">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
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
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                <i class="fas fa-wallet mr-2"></i>
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
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Pinjaman</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Cari Pinjaman...">
                        </div>
                        {{-- SORT BY --}}
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Urutkan</label>
                            <select wire:model.live="sortBy" class="form-control">
                                <option value="created_at">Terbaru</option>
                                <option value="nama_anggota">Nama</option>
                                <option value="jumlah">Nominal</option>
                            </select>
                        </div>
                        {{-- SORT DIRECTION --}}
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Arah</label>
                            <select wire:model.live="sortDirection" class="form-control">
                                <option value="desc">Z - A</option>
                                <option value="asc">A - Z</option>
                            </select>
                        </div>
                        {{-- PAGINATION --}}
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Data</label>
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <button wire:click="$dispatch('openCreate')" class="btn btn-primary btn-block"
                                data-toggle="modal" data-target="#createModalPinjaman">
                                <i class="fas fa-plus mr-1"></i>
                                Ajukan Pinjaman
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
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
                                            {{ $item->anggota->kode_anggota }}
                                        </td>
                                        <td>
                                            {{ $item->anggota->nama_anggota }}
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
                                        <td>
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

<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-hand-holding-usd" mr-2></i>
                            {{ $title }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- DASHBOARD --}}
                            <li class="breadcrumb-item">
                                <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            {{-- MENU --}}
                            <li class="breadcrumb-item">
                                <a href="{{ route('manajemen.pinjaman.index') }}" class="text-muted breadcrumb-green">
                                    <i class="nav-icon fas fa-hand-holding-usd mr-1"></i>
                                    Daftar Pinjaman
                                </a>
                            </li>
                            {{-- ACTIVE --}}
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
            {{-- CARD TOTAL --}}
            <div class="row mb-4">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="card card-box card-primary-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-primary"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">
                                        Total Pinjaman Khusus
                                    </div>
                                    <div class="card-number">
                                        Rp {{ number_format($totalPinjamanKhusus, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">
                                        Akumulasi seluruh pinjaman khusus anggota
                                    </small>
                                </div>
                                <div class="card-icon bg-primary text-white">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                                </div>
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
                                Riwayat Pinjaman Khusus Anggota
                            </h4>
                            <small class="text-muted">
                                Data transaksi pinjaman anggota koperasi
                            </small>
                        </div>
                    </div>
                </div>
                {{-- TABLE --}}
                <div class="card-body">
                    {{-- <div class="row mb-3 align-items-end">
                        <div class="col-lg-4 col-md-12 mb-2">
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
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Pinjaman</th>
                                    <th>Nominal Pengajuan</th>
                                    <th class="text-center" style="width:120px;">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td class="font-weight-bold">
                                            {{ $item->anggota->kode_anggota }}
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ $item->anggota->nama_anggota }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $item->anggota->no_ktp }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                Khusus
                                            </span>
                                        </td>
                                        <td class="font-weight-bold text-dark">
                                            Rp {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge badge-warning">
                                                    Pending
                                                </span>
                                            @elseif($item->status == 'aktif')
                                                <span class="badge badge-success">
                                                    Disetujui
                                                </span>
                                            @elseif($item->status == 'ditolak')
                                                <span class="badge badge-danger">
                                                    Ditolak
                                                </span>
                                            @elseif($item->status == 'lunas')
                                                <span class="badge badge-info">
                                                    Lunas
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada data pinjaman khusus
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

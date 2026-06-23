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
                                <a href="{{ route('pengawas.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pengawas.pinjaman.index') }}" class="text-muted breadcrumb-green">
                                    <i class="nav-icon fas fa-hand-holding-usd mr-1"></i> Daftar Pinjaman
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-success">
                                <i class="nav-icon fas fa-hand-holding-usd mr-1"></i> {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row mb-4">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="card card-box card-primary-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-primary"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">Total Pinjaman Khusus Aktif</div>
                                    <div class="card-number">Rp {{ number_format($totalPinjamanKhusus, 0, ',', '.') }}</div>
                                    <small class="text-muted">Akumulasi seluruh pinjaman khusus yang masih berjalan</small>
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

            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div>
                        <h5 class="font-weight-bold mb-0">
                            <i class="fas fa-wallet mr-2"></i> Riwayat Pinjaman Khusus
                        </h5>
                        <small class="opacity-75">Data transaksi pinjaman khusus anggota koperasi</small>
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
                            <label>Status</label>
                            <select wire:model.live="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="lunas">Lunas</option>
                                <option value="pending">Pending</option>
                                <option value="ditolak">Ditolak</option>
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
                                    <th>Tanggal</th>
                                    <th>Kode Pinjaman</th>
                                    <th>Nama Anggota</th>
                                    <th class="text-right">Nominal</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    <tr wire:key="pinjaman-{{ $item->id }}">
                                        <td class="text-center">{{ $loop->iteration + ($pinjaman->currentPage() - 1) * $pinjaman->perPage() }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->diffForHumans() }}</small>
                                        </td>
                                        <td class="font-weight-bold">{{ $item->kode_pinjaman }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $item->anggota->nama_anggota }}</div>
                                            <small class="text-muted">{{ $item->anggota->kode_anggota }}</small>
                                        </td>
                                        <td class="text-right font-weight-bold">
                                            Rp {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status === 'aktif')
                                                <span class="badge badge-success">Aktif</span>
                                            @elseif ($item->status === 'lunas')
                                                <span class="badge badge-primary">Lunas</span>
                                            @elseif ($item->status === 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open fa-2x mb-2 d-block text-muted"></i>
                                                <h6 class="text-muted">Belum ada data pinjaman khusus</h6>
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

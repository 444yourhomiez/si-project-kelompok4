<div>

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-wallet mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('pengawas.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-success">
                                <i class="fas fa-wallet mr-1"></i>
                                {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="row mb4">
                <div class="col-md-12 col-sm-6 col-12">
                    <div class="card card-box card-orange-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-orange"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">Total Simpanan</div>
                                    <div class="card-number">Rp {{ number_format($total_simpanan, 0, ',', '.') }}</div>
                                    <small class="text-muted">Akumulasi seluruh simpanan</small>
                                </div>
                                <div class="card-icon bg-orange text-white">
                                    <i class="fas fa-coins"></i>
                                </div>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-orange" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card card-box card-success-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-success"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">Simpanan Wajib</div>
                                    <div class="card-number">Rp {{ number_format($wajib, 0, ',', '.') }}</div>
                                    <small class="text-muted">Total simpanan wajib</small>
                                </div>
                                <div class="card-icon bg-success text-white">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-success" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card card-box card-primary-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-primary"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">Simpanan Pokok</div>
                                    <div class="card-number">Rp {{ number_format($pokok, 0, ',', '.') }}</div>
                                    <small class="text-muted">Total simpanan pokok</small>
                                </div>
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-primary" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card card-box card-info-soft h-100">
                        <div class="card-body position-relative overflow-hidden">
                            <div class="card-bg-circle bg-circle-info"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-label mb-2">Simpanan Sukarela</div>
                                    <div class="card-number">Rp {{ number_format($sukarela, 0, ',', '.') }}</div>
                                    <small class="text-muted">Total simpanan sukarela</small>
                                </div>
                                <div class="card-icon bg-info text-white">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="progress card-progress mt-4">
                                <div class="progress-bar bg-info" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card table-modern border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                <i class="fas fa-wallet mr-2"></i>
                                Daftar Simpanan Anggota
                            </h4>
                            <small class="text-muted">Data transaksi simpanan anggota koperasi</small>
                        </div>

                        <div class="d-flex align-items-center">

                            <div class="search-modern mr-2">
                                <i class="fas fa-search search-modern-icon"></i>
                                <input type="text" wire:model.live="search" class="form-control search-modern-input"
                                    placeholder="Cari simpanan...">
                            </div>

                            <div class="d-flex align-items-center mr-2" style="gap:10px;">
                                <div class="position-relative sort-mini-box">
                                    <i class="fas fa-sliders-h sort-mini-icon"></i>
                                    <select wire:model.live="sortBy" class="form-control sort-mini-select">
                                        <option value="created_at">Terbaru</option>
                                        <option value="nama_anggota">Nama</option>
                                        <option value="jenis_simpanan">Jenis</option>
                                        <option value="jumlah">Nominal</option>
                                    </select>
                                </div>
                                <div class="position-relative sort-mini-box" style="max-width:95px;">
                                    <i class="fas fa-arrow-down-short-wide sort-mini-icon"></i>
                                    <select wire:model.live="sortDirection" class="form-control sort-mini-select">
                                        <option value="desc">Z - A</option>
                                        <option value="asc">A - Z</option>
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative pagination-mini-box">
                                <i class="fas fa-table pagination-mini-icon"></i>
                                <select wire:model.live="paginate" class="form-control pagination-mini-select">
                                    <option value="10">10 Data</option>
                                    <option value="25">25 Data</option>
                                    <option value="50">50 Data</option>
                                    <option value="100">100 Data</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-modern-list mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>ID Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Jenis Simpanan</th>
                                <th class="text-center">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($simpanan as $item)
                                <tr>
                                    <td>
                                        <div class="font-weight-bold">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td class="font-weight-bold">
                                        {{ $item->anggota->kode_anggota ?? '-' }}
                                    </td>
                                    <td>
                                        <div class="font-weight-bold">{{ $item->anggota->nama_anggota ?? '-' }}</div>
                                    </td>
                                    <td>
                                        @if ($item->jenis_simpanan == 'wajib')
                                            <span class="badge-status-success">Wajib</span>
                                        @elseif ($item->jenis_simpanan == 'pokok')
                                            <span class="badge-status-primary">Pokok</span>
                                        @else
                                            <span class="badge-status-info">Sukarela</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="badge-nominal">
                                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h5>Belum ada data simpanan</h5>
                                            <p>Data transaksi simpanan akan tampil di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer modern-footer">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="footer-info">
                            <i class="fas fa-wallet mr-1"></i>
                            Menampilkan data simpanan anggota koperasi
                        </div>
                        <div class="modern-pagination">
                            {{ $simpanan->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

</div>

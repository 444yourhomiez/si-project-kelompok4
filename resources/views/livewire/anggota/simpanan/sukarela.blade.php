<div>

    <div class="content-wrapper">

        {{-- HEADER --}}
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

                                <a href="{{ route('anggota.dashboard') }}"
                                    class="text-muted breadcrumb-green">

                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard

                                </a>

                            </li>

                            <li class="breadcrumb-item">

                                <a href="{{ route('anggota.simpanan.sukarela') }}"
                                    class="text-muted breadcrumb-green">

                                    <i class="fas fa-wallet mr-1"></i>
                                    Simpanan Sukarela

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

        {{-- CONTENT --}}
        <section class="content">

            {{-- CARD TOTAL --}}
            <div class="row mb-4">

                <div class="col-md-12 col-sm-12 col-12">

                    <div class="card card-box card-info-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-info"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Total Simpanan Sukarela 
                                    </div>

                                    <div class="card-number">
                                        Rp {{ number_format($total_sukarela, 0, ',', '.') }}
                                    </div>

                                    <small class="text-muted">
                                        Akumulasi simpanan sukarela yang  miliki
                                    </small>

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

            {{-- TABLE --}}
            <div class="card table-modern border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 pb-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="mb-3 mb-md-0">

                            <h4 class="font-weight-bold mb-1">

                                <i class="fas fa-wallet mr-2"></i>
                                Riwayat Simpanan Sukarela 

                            </h4>

                            <small class="text-muted">
                                Riwayat transaksi simpanan sukarela pribadi
                            </small>

                        </div>

                        <div class="d-flex align-items-center">

                            {{-- SEARCH --}}
                            <div class="search-modern mr-2">

                                <i class="fas fa-search search-modern-icon"></i>

                                <input type="text"
                                    wire:model.live="search"
                                    class="form-control search-modern-input"
                                    placeholder="Cari nominal...">

                            </div>

                            {{-- SORT --}}
                            <div class="d-flex align-items-center mr-2" style="gap:10px;">

                                <div class="position-relative sort-mini-box">

                                    <i class="fas fa-sliders-h sort-mini-icon"></i>

                                    <select wire:model.live="sortBy"
                                        class="form-control sort-mini-select">

                                        <option value="created_at">Terbaru</option>
                                        <option value="jumlah">Nominal</option>

                                    </select>

                                </div>

                                <div class="position-relative sort-mini-box"
                                    style="max-width:95px;">

                                    <i class="fas fa-arrow-down-short-wide sort-mini-icon"></i>

                                    <select wire:model.live="sortDirection"
                                        class="form-control sort-mini-select">

                                        <option value="desc">Z - A</option>
                                        <option value="asc">A - Z</option>

                                    </select>

                                </div>

                            </div>

                            {{-- PAGINATION --}}
                            <div class="position-relative pagination-mini-box">

                                <i class="fas fa-table pagination-mini-icon"></i>

                                <select wire:model.live="paginate"
                                    class="form-control pagination-mini-select">

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
                                <th class="text-center">Nominal</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($simpananSukarela as $item)

                                <tr>

                                    <td>

                                        <div class="font-weight-bold">

                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}

                                        </small>

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

                                    <td colspan="2" class="text-center py-5">

                                        <div class="empty-state">

                                            <i class="fas fa-folder-open"></i>

                                            <h5>
                                                Belum ada data simpanan sukarela
                                            </h5>

                                            <p>
                                                Data simpanan sukarela akan tampil di sini
                                            </p>

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
                            Menampilkan riwayat simpanan sukarela pribadi

                        </div>

                        <div class="modern-pagination">

                            {{ $simpananSukarela->links() }}

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

</div>
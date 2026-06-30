<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-hand-holding-heart mr-2"></i>
                            {{ $title }}
                        </h1>
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

                        <div class="simpanan-stat-icon mr-3" style="background:#e8eaf6;">
                            <i class="fas fa-hand-holding-heart" style="color:#5c6bc0;"></i>
                        </div>

                        <div class="simpanan-stat-text">
                            <small>Total Simpanan Sukarela</small>
                            <div class="simpanan-stat-value" style="color:#5c6bc0;">
                                Rp {{ number_format($total_sukarela, 0, ',', '.') }}
                            </div>
                            <small class="text-muted">
                                Akumulasi seluruh simpanan sukarela anggota
                            </small>
                        </div>

                    </div>
                </div>
            </div>
            {{-- TABLE --}}
            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                Riwayat Simpanan Sukarela
                            </h4>
                            <small class="text-muted">
                                Data transaksi simpanan sukarela
                            </small>
                        </div>
                    </div>
                </div>
                {{-- TABLE --}}
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        {{-- SEARCH --}}
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Simpanan</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Jumlah atau tanggal...">
                        </div>
                        {{-- PAGINATION --}}
                        <div class="col-lg-4 col-md-12 mb-2">
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
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpananSukarela as $item)
                                    <tr>
                                        {{-- TANGGAL --}}
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                <span data-timestamp="{{ \Carbon\Carbon::parse($item->tanggal)->timestamp }}"></span>
                                            </small>
                                        </td>
                                        {{-- NOMINAL --}}
                                        <td>
                                            <span class="font-weight-bold text-dark">
                                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open"></i>
                                                <h5>
                                                    Belum ada data simpanan Sukarela
                                                </h5>
                                                <p>
                                                    Data simpanan Sukarela akan tampil di sini
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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

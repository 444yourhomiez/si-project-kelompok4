<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-coins mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            {{-- SUMMARY SIMPANAN --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        {{-- TOTAL --}}
                        <div class="col-md-3 col-12">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#fff3e0;">
                                    <i class="fas fa-coins" style="color:#f97316;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Total Simpanan</small>
                                    <div class="simpanan-stat-value" style="color:#f97316;">
                                        Rp {{ number_format($total_simpanan, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- WAJIB --}}
                        <div class="col-md-3 col-12">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#e8f5e9;">
                                    <i class="fas fa-wallet" style="color:#28a745;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Simp. Wajib</small>
                                    <div class="simpanan-stat-value" style="color:#28a745;">
                                        Rp {{ number_format($wajib, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- POKOK --}}
                        <div class="col-md-3 col-12">
                            <div class="simpanan-stat-box border-right border-bottom">
                                <div class="simpanan-stat-icon" style="background:#e3f2fd;">
                                    <i class="fas fa-piggy-bank" style="color:#007bff;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Simp. Pokok</small>
                                    <div class="simpanan-stat-value" style="color:#007bff;">
                                        Rp {{ number_format($pokok, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- SUKARELA --}}
                        <div class="col-md-3 col-12">
                            <div class="simpanan-stat-box border-bottom">
                                <div class="simpanan-stat-icon" style="background:#e8eaf6;">
                                    <i class="fas fa-hand-holding-heart" style="color:#5c6bc0;"></i>
                                </div>
                                <div class="simpanan-stat-text">
                                    <small>Simp. Sukarela</small>
                                    <div class="simpanan-stat-value" style="color:#5c6bc0;">
                                        Rp {{ number_format($sukarela, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TABEL --}}
            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                Riwayat Simpanan Anggota
                            </h4>
                            <small class="text-muted">
                                Data transaksi simpanan anggota koperasi
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        {{-- SEARCH --}}
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Simpanan</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Jenis, jumlah, atau tanggal...">
                        </div>
                        {{-- PAGINATION --}}
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Data</label>
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpanan as $item)
                                    <tr>
                                        {{-- TANGGAL --}}
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                <span data-timestamp="{{ \Carbon\Carbon::parse($item->created_at)->timestamp }}">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->diffForHumans() }}</span>
                                            </small>
                                        </td>
                                        {{-- JENIS SIMPANAN --}}
                                        <td>
                                            @if ($item->jenis_simpanan == 'wajib')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-wallet mr-1"></i>
                                                    Simpanan Wajib
                                                </span>
                                            @elseif ($item->jenis_simpanan == 'pokok')
                                                <span class="badge badge-primary">
                                                    <i class="fas fa-wallet mr-1"></i>
                                                    Simpanan Pokok
                                                </span>
                                            @elseif ($item->jenis_simpanan == 'sukarela')
                                                <span class="badge badge-info">
                                                    <i class="fas fa-wallet mr-1"></i>
                                                    Simpanan Sukarela
                                                </span>
                                            @endif
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
                                        <td colspan="3" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open"></i>
                                                <h5>
                                                    Belum ada data simpanan
                                                </h5>
                                                <p>
                                                    Riwayat simpanan akan tampil di sini
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
                            Menampilkan riwayat simpanan pribadi
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


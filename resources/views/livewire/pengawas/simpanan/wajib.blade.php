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
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            {{-- CARD TOTAL --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div class="simpanan-stat-icon mr-3" style="background:#e8f5e9;">
                            <i class="fas fa-wallet" style="color:#28a745;"></i>
                        </div>

                        <div class="simpanan-stat-text">
                            <small>Total Simpanan Wajib</small>
                            <div class="simpanan-stat-value" style="color:#28a745;">
                                Rp {{ number_format($total_wajib, 0, ',', '.') }}
                            </div>
                            <small class="text-muted">
                                Akumulasi seluruh simpanan wajib anggota
                            </small>
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
                                Riwayat Simpanan Wajib Anggota
                            </h4>
                            <small class="text-muted">
                                Data transaksi simpanan wajib anggota koperasi
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
                                placeholder="Nama, kode anggota...">
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
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpananWajib as $item)
                                    <tr wire:key="simpanan-{{ $item->id }}">
                                        {{-- TANGGAL --}}
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->diffForHumans() }}
                                            </small>
                                        </td>
                                        {{-- ID ANGGOTA --}}
                                        <td class="font-weight-bold">
                                            {{ $item->anggota->kode_anggota ?? '-' }}
                                        </td>
                                        {{-- NAMA ANGGOTA --}}
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ $item->anggota->nama_anggota ?? '-' }}
                                            </div>
                                            <small class="text-muted">
                                                NIK: {{ $item->anggota->no_ktp ?? '-' }}
                                            </small>
                                        </td>
                                        {{-- NOMINAL --}}
                                        <td class="font-weight-bold text-dark">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open"></i>
                                                <h5>
                                                    Belum ada data simpanan wajib
                                                </h5>
                                                <p>
                                                    Data simpanan wajib akan tampil di sini
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
                            Menampilkan {{ $simpananWajib->firstItem() ?? 0 }}â€“{{ $simpananWajib->lastItem() ?? 0 }}
                            dari {{ $simpananWajib->total() }} data
                        </small>
                        <div class="modern-pagination">
                            {{ $simpananWajib->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


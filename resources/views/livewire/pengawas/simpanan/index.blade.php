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
                            <a href="{{ route('pengawas.simpanan.wajib') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
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
                            </a>
                        </div>
                        {{-- POKOK --}}
                        <div class="col-md-3 col-12">
                            <a href="{{ route('pengawas.simpanan.pokok') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-right border-bottom">
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
                            </a>
                        </div>
                        {{-- SUKARELA --}}
                        <div class="col-md-3 col-12">
                            <a href="{{ route('pengawas.simpanan.sukarela') }}" class="text-decoration-none">
                                <div class="simpanan-stat-box simpanan-stat-link border-bottom">
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
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div>
                        <h5 class="font-weight-bold mb-0">
                            Riwayat Simpanan Anggota
                        </h5>
                        <small class="opacity-75">Data transaksi simpanan anggota koperasi</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Simpanan</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Nama anggota, kode, jenis...">
                        </div>
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
                    <div class="table-responsive" id="pengawas-simpanan-table">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpanan as $item)
                                    <tr wire:key="simpanan-{{ $item->id }}">
                                        {{-- TANGGAL --}}
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                <span data-timestamp="{{ \Carbon\Carbon::parse($item->tanggal)->timestamp }}">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->diffForHumans() }}</span>
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
                                        {{-- JENIS SIMPANAN --}}
                                        <td>
                                            @if ($item->jenis_simpanan == 'wajib')
                                                <span class="badge badge-success">
                                                    Wajib
                                                </span>
                                            @elseif ($item->jenis_simpanan == 'pokok')
                                                <span class="badge badge-primary">
                                                    Pokok
                                                </span>
                                            @else
                                                <span class="badge badge-info">
                                                    Sukarela
                                                </span>
                                            @endif
                                        </td>
                                        {{-- NOMINAL --}}
                                        <td class="font-weight-bold text-dark">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open"></i>
                                                <h5>
                                                    Belum ada data simpanan
                                                </h5>
                                                <p>
                                                    Data transaksi simpanan akan tampil di sini
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
                            Menampilkan {{ $simpanan->firstItem() ?? 0 }}–{{ $simpanan->lastItem() ?? 0 }}
                            dari {{ $simpanan->total() }} data
                        </small>
                        <div class="modern-pagination">
                            {{ $simpanan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

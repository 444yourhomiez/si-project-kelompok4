<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-star mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div class="simpanan-stat-icon mr-3" style="background:#e3f2fd;">
                            <i class="fas fa-star" style="color:#007bff;"></i>
                        </div>

                        <div class="simpanan-stat-text">
                            <small>Total Pinjaman Khusus Aktif</small>
                            <div class="simpanan-stat-value" style="color:#007bff;">
                                Rp {{ number_format($totalPinjamanKhusus, 0, ',', '.') }}
                            </div>
                            <small class="text-muted">
                                Akumulasi seluruh pinjaman khusus yang masih berjalan
                            </small>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div>
                        <h5 class="font-weight-bold mb-0">
                            Riwayat Pinjaman Khusus
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
                                    <th class="text-center" style="width:70px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pinjaman as $item)
                                    <tr wire:key="pinjaman-{{ $item->id }}">
                                        <td class="text-center">
                                            {{ $loop->iteration + ($pinjaman->currentPage() - 1) * $pinjaman->perPage() }}
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                            </div>
                                            <small
                                                class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->locale('id')->diffForHumans() }}</small>
                                        </td>
                                        <td class="font-weight-bold">{{ $item->kode_pinjaman }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $item->anggota->nama_anggota }}</div>
                                            <small class="text-muted">Kode: {{ $item->anggota->kode_anggota }}</small>
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
                                        <td class="text-center">
                                            <button
                                                wire:click="$dispatch('openShow', [{{ $item->id }}])"
                                                onclick="$('#showModalPinjaman').modal('show')"
                                                class="btn btn-sm btn-light shadow-sm"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-primary"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
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

    @livewire('pengawas.pinjaman.show')
</div>

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
                            {{-- DASHBOARD --}}
                            <li class="breadcrumb-item">
                                <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            {{-- MENU --}}
                            <li class="breadcrumb-item">
                                <a href="{{ route('manajemen.simpanan.index') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-wallet mr-1"></i>
                                    Daftar Simpanan
                                </a>
                            </li>
                            {{-- ACTIVE --}}
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
                                        Akumulasi seluruh simpanan sukarela anggota
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
                {{-- HEADER --}}
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                <i class="fas fa-wallet mr-2"></i>
                                Riwayat Simpanan Sukarela Anggota
                            </h4>
                            <small class="text-muted">
                                Data transaksi simpanan sukarela anggota koperasi
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
                                placeholder="Cari simpanan...">
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
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Nominal</th>
                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpananSukarela as $item)
                                    <tr wire:key="simpanan-{{ $item->id }}">
                                        {{-- TANGGAL --}}
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}
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
                                                {{ $item->anggota->no_ktp ?? '-' }}
                                            </small>
                                        </td>
                                        {{-- NOMINAL --}}
                                        <td class="font-weight-bold text-dark">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                        {{-- AKSI --}}
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                {{-- EDIT --}}
                                                <button wire:click="$dispatch('openEdit', { id: {{ $item->id }} })"
                                                    class="btn btn-light table-action-btn mr-1 shadow-sm"
                                                    data-toggle="modal" data-target="#editModalSimpanan"
                                                    title="Edit Simpanan">
                                                    <i class="fas fa-edit text-warning"></i>
                                                </button>
                                                {{-- HAPUS --}}
                                                <button
                                                    wire:click="$dispatch('openDelete', { id: {{ $item->id }} })"
                                                    class="btn btn-light table-action-btn shadow-sm" data-toggle="modal"
                                                    data-target="#deleteModalSimpanan" title="Hapus Simpanan">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
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
                </div>
            </div>
        </section>
    </div>
</div>

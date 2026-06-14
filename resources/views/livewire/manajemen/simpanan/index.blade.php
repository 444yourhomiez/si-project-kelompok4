<div>

    <div class="content-wrapper">

        <!-- Content Header -->
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

                                <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">

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

        <!-- Main Content -->
        <section class="content">

            <div class="row mb4">

                {{-- TOTAL SIMPANAN --}}
                <div class="col-md-12 col-sm-6 col-12">

                    <div class="card card-box card-orange-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-orange"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Total Simpanan
                                    </div>

                                    <div class="card-number">
                                        Rp {{ number_format($total_simpanan, 0, ',', '.') }}
                                    </div>

                                    <small class="text-muted">
                                        Akumulasi seluruh simpanan
                                    </small>

                                </div>

                                <a href="{{ route('manajemen.simpanan.index') }}"
                                    class="card-icon bg-orange text-white">

                                    <i class="fas fa-coins"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-orange" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- CARD -->
            <div class="row mb-4">

                {{-- SIMPANAN WAJIB --}}
                <div class="col-md-4 col-sm-6 col-12">

                    <div class="card card-box card-success-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-success"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Simpanan Wajib
                                    </div>

                                    <div class="card-number">
                                        Rp {{ number_format($wajib, 0, ',', '.') }}
                                    </div>

                                    <small class="text-muted">
                                        Total simpanan wajib
                                    </small>

                                </div>

                                <a href="{{ route('manajemen.simpanan.wajib') }}"
                                    class="card-icon bg-success text-white">

                                    <i class="fas fa-wallet"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-success" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SIMPANAN POKOK --}}
                <div class="col-md-4 col-sm-6 col-12">

                    <div class="card card-box card-primary-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-primary"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Simpanan Pokok
                                    </div>

                                    <div class="card-number">
                                        Rp {{ number_format($pokok, 0, ',', '.') }}
                                    </div>

                                    <small class="text-muted">
                                        Total simpanan pokok
                                    </small>

                                </div>

                                <a href="{{ route('manajemen.simpanan.pokok') }}"
                                    class="card-icon bg-primary text-white">

                                    <i class="fas fa-wallet"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-primary" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SIMPANAN SUKARELA --}}
                <div class="col-md-4 col-sm-6 col-12">

                    <div class="card card-box card-info-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-info"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Simpanan Sukarela
                                    </div>

                                    <div class="card-number">
                                        Rp {{ number_format($sukarela, 0, ',', '.') }}
                                    </div>

                                    <small class="text-muted">
                                        Total simpanan sukarela
                                    </small>

                                </div>

                                <a href="{{ route('manajemen.simpanan.sukarela') }}"
                                    class="card-icon bg-info text-white">

                                    <i class="fas fa-wallet"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-info" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="card table-modern border-0 shadow-sm">

                <!-- HEADER -->
                <div class="card-header bg-white border-0">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h4 class="font-weight-bold mb-1">

                                <i class="fas fa-wallet mr-2"></i>
                                Riwayat Simpanan Anggota

                            </h4>

                            <small class="text-muted">
                                Data transaksi simpanan anggota koperasi
                            </small>

                        </div>

                    </div>

                </div>

                <!-- TABLE -->
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
                        <div class="col-lg-2 col-md-4 col-6 mb-2">

                            <label>Data</label>

                            <select wire:model.live="paginate" class="form-control">

                                <option value="10">10 Data</option>
                                <option value="25">25 Data</option>
                                <option value="50">50 Data</option>
                                <option value="100">100 Data</option>

                            </select>

                        </div>

                        {{-- BUTTON --}}
                        <div class="col-lg-2 col-md-12 col-6 mb-2">

                            <button wire:click="$dispatch('openCreate')" class="btn btn-primary btn-block"
                                data-toggle="modal" data-target="#createModalSimpanan">

                                <i class="fas fa-plus mr-1"></i>
                                Tambah Simpanan

                            </button>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="bg-dark text-white">

                                <tr>

                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Nominal</th>

                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
                                    </th>

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

                                        {{-- AKSI --}}
                                        <td>

                                            <div class="d-flex align-items-center justify-content-center">

                                                {{-- EDIT --}}
                                                <button
                                                    wire:click="$dispatch('openEdit', { id: {{ $item->id }} })"
                                                    class="btn btn-light table-action-btn mr-1 shadow-sm"
                                                    data-toggle="modal" data-target="#editModalSimpanan"
                                                    title="Edit Simpanan">

                                                    <i class="fas fa-edit text-warning"></i>

                                                </button>

                                                {{-- HAPUS --}}
                                                <button
                                                    wire:click="$dispatch('openDelete', { id: {{ $item->id }} })"
                                                    class="btn btn-light table-action-btn shadow-sm"
                                                    data-toggle="modal" data-target="#deleteModalSimpanan"
                                                    title="Hapus Simpanan">

                                                    <i class="fas fa-trash text-danger"></i>

                                                </button>

                                            </div>

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

                </div>

            </div>

        </section>

    </div>

</div>

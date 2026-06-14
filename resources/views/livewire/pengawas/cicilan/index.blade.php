<div>

    <div class="content-wrapper">

        {{-- HEADER --}}
        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1>

                            <i class="nav-icon fas fa-money-bill-wave mr-2"></i>
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

                                <i class="nav-icon fas fa-money-bill-wave mr-1"></i>
                                {{ $title }}

                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </section>

        {{-- CONTENT --}}
        <section class="content">

            <div class="row mb4">

                {{-- TOTAL ANGGOTA --}}
                <div class="col-md-12 col-sm-6 col-12">

                    <div class="card card-box card-warning-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-warning"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Total Cicilan Pinjaman
                                    </div>

                                    <div class="card-number">
                                        Rp 500.000
                                    </div>

                                    <small class="text-muted">
                                        Seluruh Cicilan yang diajukan anggota
                                    </small>

                                </div>

                                <a href="{{ route('pengawas.cicilan.index') }}"
                                    class="card-icon bg-warning text-white">

                                    <i class="nav-icon fas fa-money-bill-wave"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-warning" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="row mb-4">

                {{-- Cicilan PRIBADI --}}
                <div class="col-md-6 col-sm-6 col-12">

                    <div class="card card-box card-success-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-success"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Cicilan Pinjaman Pribadi
                                    </div>

                                    <div class="card-number">
                                        Rp 200.000
                                    </div>

                                    <small class="text-muted">
                                        Sudah diverifikasi pengawas
                                    </small>

                                </div>

                                <a href="{{ route('pengawas.cicilan.pribadi') }}"
                                    class="card-icon bg-success text-white">

                                    <i class="nav-icon fas fa-money-bill-wave"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-success" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- MENUNGGU VERIFIKASI --}}
                <div class="col-md-6 col-sm-6 col-12">

                    <div class="card card-box card-primary-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-primary"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Cicilan Pinjaman Khusus
                                    </div>

                                    <div class="card-number">
                                        Rp 300.000
                                    </div>

                                    <small class="text-muted">
                                        Menunggu persetujuan pengawas
                                    </small>

                                </div>

                                <a href="{{ route('pengawas.cicilan.khusus') }}"
                                    class="card-icon bg-primary text-white">

                                    <i class="nav-icon fas fa-money-bill-wave"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-primary" style="width:100%"></div>

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

                                <i class="fas fa-money-bill-wave mr-2"></i>
                                Riwayat Cicilan Anggota

                            </h4>

                            <small class="text-muted">
                                Data transaksi cicilan anggota koperasi
                            </small>

                        </div>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="card-body">

                    <div class="row mb-3 align-items-end">

                        {{-- SEARCH --}}
                        <div class="col-lg-4 col-md-12 mb-2">

                            <label>Cari Cicilan</label>

                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Cari Cicilan...">

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

                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Cicilan</th>
                                    <th>Nominal</th>

                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>

                                        <div class="font-weight-bold">
                                            15 Jun 2026
                                        </div>

                                        <small class="text-muted">
                                            Hari ini
                                        </small>

                                    </td>

                                    <td class="font-weight-bold">
                                        AG001
                                    </td>

                                    <td>

                                        <div class="font-weight-bold">
                                            Budi Santoso
                                        </div>

                                        <small class="text-muted">
                                            3201234567890123
                                        </small>

                                    </td>

                                    <td>

                                        <span class="badge badge-primary">
                                            Cicilan Khusus
                                        </span>

                                    </td>

                                    <td class="font-weight-bold text-dark">

                                        Rp 500.000

                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <button class="btn btn-light table-action-btn mr-1 shadow-sm">

                                                <i class="fas fa-edit text-warning"></i>

                                            </button>

                                            <button class="btn btn-light table-action-btn shadow-sm">

                                                <i class="fas fa-trash text-danger"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <div class="font-weight-bold">
                                            12 Jun 2026
                                        </div>

                                        <small class="text-muted">
                                            3 hari lalu
                                        </small>

                                    </td>

                                    <td class="font-weight-bold">
                                        AG002
                                    </td>

                                    <td>

                                        <div class="font-weight-bold">
                                            Siti Aminah
                                        </div>

                                        <small class="text-muted">
                                            3201234567890124
                                        </small>

                                    </td>

                                    <td>

                                        <span class="badge badge-primary">
                                            Cicilan Khusus
                                        </span>

                                    </td>

                                    <td class="font-weight-bold text-dark">

                                        Rp 350.000

                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <button class="btn btn-light table-action-btn mr-1 shadow-sm">

                                                <i class="fas fa-edit text-warning"></i>

                                            </button>

                                            <button class="btn btn-light table-action-btn shadow-sm">

                                                <i class="fas fa-trash text-danger"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <div class="font-weight-bold">
                                            10 Jun 2026
                                        </div>

                                        <small class="text-muted">
                                            5 hari lalu
                                        </small>

                                    </td>

                                    <td class="font-weight-bold">
                                        AG003
                                    </td>

                                    <td>

                                        <div class="font-weight-bold">
                                            Andi Saputra
                                        </div>

                                        <small class="text-muted">
                                            3201234567890125
                                        </small>

                                    </td>

                                    <td>

                                        <span class="badge badge-primary">
                                            Cicilan Khusus
                                        </span>

                                    </td>

                                    <td class="font-weight-bold text-dark">

                                        Rp 750.000

                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <button class="btn btn-light table-action-btn mr-1 shadow-sm">

                                                <i class="fas fa-edit text-warning"></i>

                                            </button>

                                            <button class="btn btn-light table-action-btn shadow-sm">

                                                <i class="fas fa-trash text-danger"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

    </div>

</div>

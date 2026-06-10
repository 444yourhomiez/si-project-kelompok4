<div>

    <div class="content-wrapper">

        {{-- HEADER --}}
        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1>

                            <i class="nav-icon fas fa-users mr-2"></i>
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

                                <i class="nav-icon fas fa-users mr-1"></i>
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

                    <div class="card card-box card-primary-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-primary"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Total Anggota
                                    </div>

                                    <div class="card-number">
                                        {{ $totalAnggota }}
                                    </div>

                                    <small class="text-muted">
                                        Seluruh anggota koperasi
                                    </small>

                                </div>

                                <a href="{{ route('pengawas.anggota.index') }}" class="card-icon bg-primary text-white">

                                    <i class="fas fa-users"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-primary" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="row mb-4">

                {{-- ANGGOTA DISETUJUI --}}
                <div class="col-md-6 col-sm-6 col-12">

                    <div class="card card-box card-success-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-success"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Anggota Disetujui
                                    </div>

                                    <div class="card-number">
                                        {{ $anggotaDisetujui }}
                                    </div>

                                    <small class="text-muted">
                                        Sudah diverifikasi pengawas
                                    </small>

                                </div>

                                <a href="{{ route('pengawas.anggota.disetujui') }}"
                                    class="card-icon bg-success text-white">

                                    <i class="fas fa-user-check"></i>

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

                    <div class="card card-box card-warning-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-warning"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Menunggu Verifikasi
                                    </div>

                                    <div class="card-number">
                                        {{ $anggotaMenunggu }}
                                    </div>

                                    <small class="text-muted">
                                        Menunggu persetujuan pengawas
                                    </small>

                                </div>

                                <a href="{{ route('pengawas.anggota.menunggu') }}"
                                    class="card-icon bg-warning text-white">

                                    <i class="fas fa-user-clock"></i>

                                </a>

                            </div>

                            <div class="progress card-progress mt-4">

                                <div class="progress-bar bg-warning" style="width:100%"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="card table-modern border-0 shadow-sm">

                {{-- HEADER --}}
                <div class="card-header bg-white border-0 py-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>

                            <h4 class="mb-1 font-weight-bold">

                                <i class="fas fa-users mr-2"></i>
                                Daftar Anggota

                            </h4>

                            <small class="text-muted">
                                Kelola data anggota koperasi
                            </small>

                        </div>

                        <div class="d-flex align-items-center">

                            {{-- SEARCH --}}
                            <div class="search-modern mr-2">

                                <i class="fas fa-search search-modern-icon"></i>

                                <input type="text" wire:model.live="search" class="form-control search-modern-input"
                                    placeholder="Cari anggota...">

                            </div>

                            {{-- SORT --}}
                            <div class="d-flex align-items-center mr-2" style="gap:10px;">

                                {{-- SORT BY --}}
                                <div class="position-relative sort-mini-box">
                                    <i class="fas fa-sliders-h sort-mini-icon"></i>

                                    <select wire:model.live="sortBy" class="form-control sort-mini-select">

                                        <option value="created_at">Terbaru</option>
                                        <option value="nama_anggota">Nama</option>
                                        <option value="no_ktp">No KTP</option>
                                        <option value="kode_anggota">Kode</option>

                                    </select>
                                </div>

                                {{-- DIRECTION --}}
                                <div class="position-relative sort-mini-box" style="max-width:95px;">
                                    <i class="fas fa-arrow-down-short-wide sort-mini-icon"></i>

                                    <select wire:model.live="sortDirection" class="form-control sort-mini-select">

                                        <option value="desc">Z - A</option>
                                        <option value="asc">A - Z</option>

                                    </select>
                                </div>

                            </div>

                            {{-- PAGINATION --}}
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

                {{-- TABLE --}}
                <div class="table-responsive">

                    <table class="table table-modern-list mb-0">

                        <thead>

                            <tr>
                                <th>ID Anggota</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th class="text-center" style="width:120px;">
                                    <i class="fas fa-cog text-dark"></i>
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($anggota as $item)
                                <tr wire:key="anggota-{{ $item->id }}">

                                    {{-- ID ANGGOTA --}}
                                    <td class="font-weight-bold">

                                        @if ($item->kode_anggota)
                                            {{ $item->kode_anggota }}
                                        @else
                                            <span class="text-muted">

                                                Belum Tersedia

                                            </span>
                                        @endif

                                    </td>

                                    {{-- NAMA --}}
                                    <td>

                                        <div class="table-title">

                                            {{ $item->nama_anggota }}

                                        </div>

                                        <div class="table-subtitle">

                                            {{ $item->no_ktp }}

                                        </div>

                                    </td>

                                    {{-- ALAMAT --}}
                                    <td style="max-width:250px;">

                                        <span class="text-muted">

                                            {{ $item->alamat }}

                                        </span>

                                    </td>

                                    {{-- TELEPON --}}
                                    <td>

                                        <span class="badge-phone">

                                            <i class="fas fa-phone-alt mr-1"></i>

                                            {{ $item->no_hp }}

                                        </span>

                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>

                                        <div class="font-weight-bold">

                                            {{ $item->tanggal_daftar_format }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $item->tanggal_daftar_human }}

                                        </small>

                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        @if ($item->user->status == 'menunggu')
                                            <span class="badge-status-warning">

                                                <i class="fas fa-clock mr-1"></i>
                                                Menunggu Verifikasi

                                            </span>
                                        @elseif ($item->user->status == 'disetujui')
                                            <span class="badge-status-success">

                                                <i class="fas fa-check-circle mr-1"></i>
                                                Disetujui

                                            </span>
                                        @elseif ($item->user->status == 'ditolak')
                                            <span class="badge-status-danger">

                                                <i class="fas fa-times-circle mr-1"></i>
                                                Ditolak

                                            </span>
                                        @else
                                            <span class="badge-status-secondary">

                                                {{ $item->user->status }}

                                            </span>
                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td>

                                        <div class="d-flex align-items-center justify-content-center">

                                            {{-- JIKA MASIH MENUNGGU --}}
                                            @if ($item->user->status == 'menunggu')
                                                {{-- DETAIL --}}
                                                <a href="{{ route('pengawas.anggota.detail-anggota-menunggu', $item->id) }}"
                                                    class="btn btn-light table-action-btn shadow-sm"
                                                    title="Lihat Detail">

                                                    <i class="fas fa-eye text-primary"></i>

                                                </a>
                                            @else
                                                {{-- DETAIL --}}
                                                <a href="{{ route('pengawas.anggota.detail-anggota-disetujui', $item->id) }}"
                                                    class="btn btn-light table-action-btn mr-1 shadow-sm"
                                                    title="Lihat Detail">

                                                    <i class="fas fa-eye text-primary"></i>

                                                </a>
                                            @endif

                                        </div>

                                    </td>
                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <div class="empty-state">

                                            <i class="fas fa-folder-open"></i>

                                            <h5>
                                                Data anggota tidak ditemukan
                                            </h5>

                                            <p>
                                                Coba gunakan kata kunci lain
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer modern-footer">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="footer-info">
                            <i class="fas fa-users mr-1"></i>
                            Menampilkan data anggota koperasi
                        </div>

                        <div class="modern-pagination">
                            {{ $anggota->links() }}
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

</div>

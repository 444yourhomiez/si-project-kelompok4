<div>

    <div class="content-wrapper">

        {{-- HEADER --}}
        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1>

                            <i class="nav-icon fas fa-user-clock mr-2"></i>
                            {{ $title }}

                        </h1>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-right">

                            {{-- DASHBOARD --}}
                            <li class="breadcrumb-item">

                                <a href="{{ route('pengawas.dashboard') }}" class="text-muted breadcrumb-green">

                                    <i class="fas fa-th-large mr-1"></i>
                                    Dashboard

                                </a>

                            </li>

                            {{-- MENU --}}
                            <li class="breadcrumb-item">

                                <a href="{{ route('pengawas.anggota.index') }}" class="text-muted breadcrumb-green">

                                    <i class="fas fa-users mr-1"></i>
                                    Daftar Anggota

                                </a>

                            </li>

                            {{-- ACTIVE --}}
                            <li class="breadcrumb-item active text-success">

                                <i class="fas fa-user-clock mr-1"></i>
                                {{ $title }}

                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </section>

        {{-- CONTENT --}}
        <section class="content">

            {{-- CARD --}}
            <div class="row mb-4">

                <div class="col-md-12 col-sm-12 col-12">

                    <div class="card card-box card-warning-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-warning"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Total Menunggu Verifikasi
                                    </div>

                                    <div class="card-number">
                                        {{ $anggota->total() }}
                                    </div>

                                    <small class="text-muted">
                                        Menunggu persetujuan pengawas
                                    </small>

                                </div>

                                <div class="card-icon bg-warning text-white">

                                    <i class="fas fa-user-clock"></i>

                                </div>

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

                                <i class="fas fa-user-clock mr-2"></i>
                                Daftar Anggota Menunggu Verifikasi

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

                                <th>NIK</th>
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

                                    {{-- NIK --}}
                                    <td class="font-weight-bold">

                                        {{ $item->no_ktp }}

                                    </td>

                                    {{-- NAMA --}}
                                    <td>

                                        <div class="font-weight-bold">

                                            {{ $item->nama_anggota }}

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

                                            {{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d M Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ \Carbon\Carbon::parse($item->tanggal_daftar)->diffForHumans() }}

                                        </small>

                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        <span class="badge-status-warning">

                                            <i class="fas fa-clock mr-1"></i>
                                            Menunggu Verifikasi

                                        </span>

                                    </td>

                                    {{-- AKSI --}}
                                    <td>

                                        <div class="d-flex align-items-center justify-content-center">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('pengawas.anggota.detail-anggota-menunggu', $item->id) }}"
                                                class="btn btn-light table-action-btn mr-1 shadow-sm">

                                                <i class="fas fa-eye text-primary"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="empty-state">

                                            <i class="fas fa-folder-open"></i>

                                            <h5>
                                                Tidak ada data verifikasi
                                            </h5>

                                            <p>
                                                Data akan tampil di sini
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-white border-0">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <small class="text-muted">
                            Menampilkan data anggota menunggu verifikasi
                        </small>

                        <div>

                            {{ $anggota->links() }}

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

</div>

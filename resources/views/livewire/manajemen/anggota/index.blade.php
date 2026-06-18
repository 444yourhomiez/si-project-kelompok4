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
                                <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">
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
                                <a href="{{ route('manajemen.anggota.index') }}"
                                    class="card-icon bg-primary text-white">
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
                                        Sudah diverifikasi manajemen
                                    </small>
                                </div>
                                <a href="{{ route('manajemen.anggota.disetujui') }}"
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
                                        Menunggu persetujuan manajemen
                                    </small>
                                </div>
                                <a href="{{ route('manajemen.anggota.menunggu') }}"
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
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-1">
                                <i class="fas fa-users mr-2"></i>
                                Daftar Anggota
                            </h4>
                            <small class="text-muted">
                                Data anggota koperasi
                            </small>
                        </div>
                    </div>
                </div>
                {{-- TABLE --}}
                <div class="card-body">
                    <div class="row mb-3 align-items-end">
                        {{-- SEARCH --}}
                        <div class="col-lg-4 col-md-12 mb-2">
                            <label>Cari Anggota</label>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Cari Anggota...">
                        </div>
                        {{-- SORT BY --}}
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Urutkan</label>
                            <select wire:model.live="sortBy" class="form-control">
                                <option value="created_at">Terbaru</option>
                                <option value="nama_anggota">Nama</option>
                                <option value="no_ktp">No KTP</option>
                                <option value="kode_anggota">Kode</option>
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
                                    <th>ID Anggota</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width:120px;">
                                        <i class="fas fa-cog"></i>
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
                                            <div class="font-weight-bold">
                                                {{ $item->nama_anggota }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $item->no_ktp }}
                                            </small>
                                        </td>
                                        {{-- ALAMAT --}}
                                        <td style="max-width:250px;">
                                            <div style="white-space:normal; line-height:1.5;">
                                                {{ $item->alamat }}
                                            </div>
                                        </td>
                                        {{-- TELEPON --}}
                                        <td>
                                            <span class="font-weight-bold text-primary">
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
                                            @if ($item->user?->status == 'menunggu')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Menunggu
                                                </span>
                                            @elseif ($item->user?->status == 'disetujui')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Disetujui
                                                </span>
                                            @elseif ($item->user?->status == 'ditolak')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle mr-1"></i>
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        {{-- AKSI --}}
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                @if ($item->user?->status == 'menunggu')
                                                    <a href="{{ route('manajemen.anggota.detail-anggota-menunggu', $item->id) }}"
                                                        class="btn btn-light table-action-btn shadow-sm">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('manajemen.anggota.detail-anggota-disetujui', $item->id) }}"
                                                        class="btn btn-light table-action-btn mr-1 shadow-sm">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </a>
                                                    <button
                                                        wire:click="$dispatch('openEdit', { id: {{ $item->id }} })"
                                                        class="btn btn-light table-action-btn mr-1 shadow-sm"
                                                        data-toggle="modal" data-target="#editModalAnggota">
                                                        <i class="fas fa-edit text-warning"></i>
                                                    </button>
                                                    <button
                                                        wire:click="$dispatch('openDelete', { id: {{ $item->id }} })"
                                                        class="btn btn-light table-action-btn shadow-sm"
                                                        data-toggle="modal" data-target="#deleteModalAnggota">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
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

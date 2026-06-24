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
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">

                        <div class="simpanan-stat-icon mr-3" style="background:#fff8e1;">
                            <i class="fas fa-user-clock" style="color:#ffc107;"></i>
                        </div>

                        <div class="simpanan-stat-text">
                            <small>Total Menunggu Verifikasi</small>
                            <div class="simpanan-stat-value" style="color:#ffc107;">
                                {{ $anggota->total() }}
                            </div>
                            <small class="text-muted">
                                Menunggu persetujuan
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
                                Daftar Anggota Menunggu Verifikasi
                            </h4>
                            <small class="text-muted">
                                Data anggota koperasi yang sedang menunggu verifikasi
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
                                placeholder="Nama, kode anggota, no KTP...">
                        </div>
                        {{-- SORT BY --}}
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <label>Urutkan</label>
                            <select wire:model.live="sortBy" class="form-control">
                                <option value="created_at">Terbaru</option>
                                <option value="nama_anggota">Nama</option>
                                <option value="no_ktp">No KTP/NIK</option>
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
                            <thead class="thead-light">
                                <tr>
                                    <th>NIK</th>
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
                                                {{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                <span data-timestamp="{{ \Carbon\Carbon::parse($item->tanggal_daftar)->timestamp }}"></span>
                                            </small>
                                        </td>
                                        {{-- STATUS --}}
                                        <td>
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock mr-1"></i>
                                                Menunggu Verifikasi
                                            </span>
                                        </td>
                                        {{-- AKSI --}}
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                {{-- DETAIL --}}
                                                <a href="{{ route('pengawas.anggota.detail-anggota-menunggu', $item->id) }}"
                                                    class="btn btn-light table-action-btn shadow-sm"
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye text-primary"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
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


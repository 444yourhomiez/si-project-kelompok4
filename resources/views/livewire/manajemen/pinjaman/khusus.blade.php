<div>

    <div class="content-wrapper">

        {{-- HEADER --}}
        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1>

                            <i class="nav-icon fas fa-hand-holding-usd" mr-2></i>
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

                                <a href="{{ route('manajemen.pinjaman.index') }}" class="text-muted breadcrumb-green">

                                    <i class="nav-icon fas fa-hand-holding-usd mr-1"></i>
                                    Daftar Pinjaman

                                </a>

                            </li>

                            {{-- ACTIVE --}}
                            <li class="breadcrumb-item active text-success">

                                <i class="nav-icon fas fa-hand-holding-usd mr-1"></i>
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

                    <div class="card card-box card-primary-soft h-100">

                        <div class="card-body position-relative overflow-hidden">

                            <div class="card-bg-circle bg-circle-primary"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="card-label mb-2">
                                        Total Pinjaman Khusus
                                    </div>

                                    <div class="card-number">
                                        Rp 200.000
                                    </div>

                                    <small class="text-muted">
                                        Akumulasi seluruh pinjaman khusus anggota
                                    </small>

                                </div>

                                <div class="card-icon bg-primary text-white">

                                    <i class="nav-icon fas fa-hand-holding-usd"></i>

                                </div>

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
                <div class="card-header bg-white border-0 pt-4 pb-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="mb-3 mb-md-0">

                            <h4 class="font-weight-bold mb-1">

                                <i class="nav-icon fas fa-hand-holding-usd mr-2"></i>
                                Daftar Pinjaman Khusus

                            </h4>

                            <small class="text-muted">
                                Data transaksi pinjaman khusus anggota koperasi
                            </small>

                        </div>

                        <div class="d-flex align-items-center">

                            {{-- SEARCH --}}
                            <div class="search-modern mr-2">

                                <i class="fas fa-search search-modern-icon"></i>

                                <input type="text" wire:model.live="search" class="form-control search-modern-input"
                                    placeholder="Cari pinjaman...">

                            </div>

                            {{-- SORT --}}
                            <div class="d-flex align-items-center mr-2" style="gap:10px;">

                                {{-- SORT BY --}}
                                <div class="position-relative sort-mini-box">
                                    <i class="fas fa-sliders-h sort-mini-icon"></i>

                                    <select wire:model.live="sortBy" class="form-control sort-mini-select">

                                        <option value="created_at">Terbaru</option>

                                        <option value="nama_anggota">Nama</option>

                                        <option value="jumlah">Nominal</option>

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

                                <th>Tanggal</th>
                                <th>ID Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Nominal</th>
                                <th class="text-center" style="width:120px;">
                                    <i class="fas fa-cog text-dark"></i>
                                </th>

                            </tr>

                        </thead>

                        {{-- <tbody> --}}

                            {{-- @forelse ($pinjamanKhusus as $item) --}}
                                {{-- <tr> --}}

                                    {{-- TANGGAL --}}
                                    {{-- <td>

                                        <div class="font-weight-bold">

                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}

                                        </small>

                                    </td> --}}

                                    {{-- ID ANGGOTA --}}
                                    {{-- <td class="font-weight-bold">

                                        {{ $item->anggota->kode_anggota ?? '-' }}

                                    </td> --}}

                                    {{-- NAMA --}}
                                    {{-- <td>

                                        <div class="font-weight-bold">

                                            {{ $item->anggota->nama_anggota ?? '-' }}

                                        </div>

                                        <div class="table-subtitle">

                                            {{ $item->no_ktp }}

                                        </div>

                                    </td> --}}

                                    {{-- NOMINAL --}}
                                    {{-- <td>

                                        <span class="badge-nominal">

                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}

                                        </span>

                                    </td> --}}

                                    {{-- AKSI --}}
                                    {{-- <td> --}}

                                        {{-- <div class="d-flex align-items-center justify-content-center"> --}}

                                            {{-- DETAIL --}}
                                            {{-- <a href="#" class="btn btn-light table-action-btn mr-1 shadow-sm">

                                                <i class="fas fa-eye text-primary"></i>

                                            </a> --}}

                                            {{-- EDIT --}}
                                            {{-- <button wire:click="$dispatch('openEdit', { id: {{ $item->id }} })"
                                                class="btn btn-light table-action-btn mr-1 shadow-sm"
                                                data-toggle="modal" data-target="#editModalPinjaman"
                                                title="Edit Anggota">

                                                <i class="fas fa-edit text-warning"></i>

                                            </button> --}}

                                            {{-- HAPUS --}}
                                            {{-- <button wire:click="$dispatch('openDelete', { id: {{ $item->id }} })"
                                                class="btn btn-light table-action-btn shadow-sm" data-toggle="modal"
                                                data-target="#deleteModalPinjaman">

                                                <i class="fas fa-trash text-danger"></i>

                                            </button> --}}

                                        {{-- </div> --}}

                                    {{-- </td> --}}

                                {{-- </tr> --}}

                            {{-- @empty --}}

                                {{-- <tr>

                                    <td colspan="3" class="text-center py-5">

                                        <div class="empty-state">

                                            <i class="fas fa-folder-open"></i>

                                            <h5>
                                                Belum ada data pinjaman khusus
                                            </h5>

                                            <p>
                                                Data pinjaman khusus akan tampil di sini
                                            </p>

                                        </div>

                                    </td>

                                </tr> --}}
                            {{-- @endforelse --}}

                        {{-- </tbody> --}}

                    </table>

                </div>

            </div>

        </section>

        {{-- CREATE MODAL --}}
        {{-- @livewire('manajemen.simpanan.create') --}}

        {{-- CLOSE MODAL CREATE --}}
        {{-- <script>
            document.addEventListener('livewire:init', () => {

                Livewire.on('closeCreateModal', () => {

                    $('#createModal').modal('hide');

                    Swal.fire({
                        title: "Sukses",
                        text: "Pinjaman Khusus Berhasil Ditambah",
                        icon: "primary",
                        confirmButtonText: "OK"
                    });

                });

            });
        </script> --}}

        {{-- EDIT MODAL --}}
        {{-- @livewire('manajemen.simpanan.edit') --}}

        {{-- CLOSE MODAL EDIT --}}
        {{-- <script>
            document.addEventListener('livewire:init', () => {

                Livewire.on('closeEditModal', () => {

                    $('#editModalPinjaman').modal('hide');

                    Swal.fire({
                        title: "Sukses",
                        text: "Pinjaman Khusus Berhasil Diperbarui",
                        icon: "primary",
                        confirmButtonText: "OK"
                    });

                });

            });
        </script> --}}

    </div>

</div>

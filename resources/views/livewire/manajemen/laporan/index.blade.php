<div>

    <div>

        <div class="content-wrapper">

            <!-- Content Header -->
            <section class="content-header">

                <div class="container-fluid">

                    <div class="row mb-2">

                        <div class="col-sm-6">

                            <h1>
                                <i class="nav-icon fas fa-calendar-day mr-2"></i>
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

                                    <i class="fas fa-calendar-day mr-1"></i>
                                    {{ $title }}

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Main content -->
            <section class="content">

                {{-- FILTER LAPORAN --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white">

                        <h5 class="mb-0 font-weight-bold">

                            <i class="fas fa-filter mr-2"></i>
                            Filter Laporan

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            {{-- ANGGOTA --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Anggota</label>

                                    <select class="form-control">

                                        <option>Semua Anggota</option>
                                        <option>AG001 - Budi Santoso</option>
                                        <option>AG002 - Siti Aminah</option>
                                        <option>AG003 - Andi Saputra</option>

                                    </select>

                                </div>

                            </div>

                            {{-- JENIS --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Jenis Transaksi</label>

                                    <select class="form-control">

                                        <option>Semua Transaksi</option>

                                        <option>Simpanan Wajib</option>
                                        <option>Simpanan Pokok</option>
                                        <option>Simpanan Sukarela</option>

                                        <option>Pinjaman Pribadi</option>
                                        <option>Pinjaman Khusus</option>

                                        <option>Cicilan</option>

                                    </select>

                                </div>

                            </div>

                            {{-- DARI --}}
                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Dari Tanggal</label>

                                    <input type="date" class="form-control">

                                </div>

                            </div>

                            {{-- SAMPAI --}}
                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Sampai Tanggal</label>

                                    <input type="date" class="form-control">

                                </div>

                            </div>

                            {{-- TOMBOL --}}
                            <div class="col-md-2">

                                <label>&nbsp;</label>

                                <div class="d-flex">

                                    <button class="btn btn-success mr-2">

                                        <i class="fas fa-search"></i>

                                    </button>

                                    <button class="btn btn-secondary">

                                        <i class="fas fa-sync"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- TABEL LAPORAN --}}
                <div class="card table-modern border-0 shadow-sm">

                    <div class="card-header bg-white">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h4 class="font-weight-bold mb-1">

                                    <i class="fas fa-file-alt mr-2"></i>
                                    Laporan Transaksi

                                </h4>

                                <small class="text-muted">

                                    Rekap seluruh transaksi koperasi

                                </small>

                            </div>

                            <div class="btn-group">

                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">

                                    <i class="fas fa-print mr-1"></i>
                                    Cetak

                                </button>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item text-danger" href="#">

                                        <i class="fas fa-file-pdf mr-1"></i>
                                        Export PDF

                                    </a>

                                    <a class="dropdown-item text-success" href="#">

                                        <i class="fas fa-file-excel mr-1"></i>
                                        Export Excel

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-modern-list mb-0">

                            <thead>

                                <tr>

                                    <th>Tanggal</th>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Uang Masuk</th>
                                    <th>Uang Keluar</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>03 Juni 2026</td>
                                    <td>AG001</td>
                                    <td>Budi Santoso</td>
                                    <td>Simpanan Wajib</td>

                                    <td>

                                        <span class="badge-status-success">
                                            Rp 200.000
                                        </span>

                                    </td>

                                    <td>-</td>

                                </tr>

                                <tr>

                                    <td>04 Juni 2026</td>
                                    <td>AG002</td>
                                    <td>Siti Aminah</td>
                                    <td>Pinjaman Khusus</td>

                                    <td>-</td>

                                    <td>

                                        <span class="badge-status-danger">
                                            Rp 500.000
                                        </span>

                                    </td>

                                </tr>

                                <tr>

                                    <td>05 Juni 2026</td>
                                    <td>AG003</td>
                                    <td>Andi Saputra</td>
                                    <td>Cicilan</td>

                                    <td>

                                        <span class="badge-status-success">
                                            Rp 300.000
                                        </span>

                                    </td>

                                    <td>-</td>

                                </tr>

                            </tbody>

                            <tfoot>

                                <tr class="bg-light">

                                    <th colspan="4" class="text-right">

                                        Total

                                    </th>

                                    <th class="text-success">

                                        Rp 500.000

                                    </th>

                                    <th class="text-danger">

                                        Rp 500.000

                                    </th>

                                </tr>

                                <tr class="bg-white">

                                    <th colspan="4" class="text-right">

                                        Saldo

                                    </th>

                                    <th colspan="2" class="text-primary">

                                        Rp 0

                                    </th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </section>

        </div>

    </div>


</div>

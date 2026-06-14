<div>

    <div>

        <div class="content-wrapper">

            <!-- Content Header -->
            <section class="content-header">

                <div class="container-fluid">

                    <div class="row mb-2">

                        <div class="col-sm-6">

                            <h1>
                                <i class="nav-icon fas fa-arrow-circle-down mr-2"></i>
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

                                    <a href="{{ route('pengawas.rekap.index') }}"
                                        class="text-muted breadcrumb-green">

                                        <i class="nav-icon fas fa-calendar-day mr-1"></i>
                                        Daftar Rekapitulasi Harian

                                    </a>

                                </li>

                                {{-- ACTIVE --}}
                                <li class="breadcrumb-item active text-success">

                                    <i class="nav-icon fas fa-arrow-circle-down mr-1"></i>
                                    {{ $title }}

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row mb4">

                    <div class="col-md-12 col-sm-6 col-12">

                        <div class="card card-box card-success-soft h-100">

                            <div class="card-body position-relative overflow-hidden">

                                <div class="card-bg-circle bg-circle-success"></div>

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <div class="card-label mb-2">
                                            DUM (Data Uang Masuk)
                                        </div>

                                        <div class="card-number">
                                            Rp 500.000
                                        </div>

                                        <small class="text-muted">
                                            Total rekap yang diajukan anggota baik uang masuk maupun uang keluar
                                        </small>

                                    </div>

                                    <a href="{{ route('pengawas.rekap.dum') }}"
                                        class="card-icon bg-success text-white">

                                        <i class="fas fa-arrow-circle-down"></i>

                                    </a>

                                </div>

                                <div class="progress card-progress mt-4">

                                    <div class="progress-bar bg-success" style="width:100%"></div>

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
                                    <i class="fas fa-arrow-circle-down mr-2"></i>
                                    Riwayat DUM (Data Uang Masuk)
                                </h4>

                                <small class="text-muted">
                                    Data uang masuk dan uang keluar
                                </small>
                            </div>

                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-sm btn-warning dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-print mr-1"></i>
                                    Cetak
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-danger" href="#">
                                        <i class="fas fa-file-pdf mr-1"></i>
                                        PDF
                                    </a>
                                    <a class="dropdown-item text-success" href="#">
                                        <i class="fas fa-file-excel mr-1"></i>
                                        Excel
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body">

                        <div class="row mb-4">

                            <div class="col-md-3">

                                <label>Anggota</label>

                                <select class="form-control">

                                    <option>Semua Anggota</option>
                                    <option>AG001 - Budi Santoso</option>
                                    <option>AG002 - Siti Aminah</option>

                                </select>

                            </div>

                            <div class="col-md-3">

                                <label>Jenis Transaksi</label>

                                <select class="form-control">

                                    <option>Semua Transaksi</option>
                                    <option>Simpanan Wajib</option>
                                    <option>Simpanan Pokok</option>
                                    <option>Simpanan Sukarela</option>

                                </select>

                            </div>

                            <div class="col-md-2">

                                <label>Dari</label>

                                <input type="date" class="form-control">

                            </div>

                            <div class="col-md-2">

                                <label>Sampai</label>

                                <input type="date" class="form-control">

                            </div>

                            <div class="col-md-2">

                                <label>&nbsp;</label>

                                <button class="btn btn-success btn-block">

                                    <i class="fas fa-search mr-1"></i>
                                    Tampilkan

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
                                        <th>Jenis Transaksi</th>
                                        <th>Nominal</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>
                                        <td>03 Juni 2026</td>
                                        <td>AG001</td>
                                        <td>Budi Santoso</td>
                                        <td>Simpanan Wajib</td>
                                        <td class="text-success">Rp 200.000</td>
                                    </tr>

                                    <tr>
                                        <td>04 Juni 2026</td>
                                        <td>AG002</td>
                                        <td>Siti Aminah</td>
                                        <td>Simpanan Sukarela</td>
                                        <td class="text-success">Rp 500.000</td>
                                    </tr>

                                    <tr>
                                        <td>05 Juni 2026</td>
                                        <td>AG003</td>
                                        <td>Andi Saputra</td>
                                        <td>Cicilan</td>
                                        <td class="text-success">Rp 350.000</td>
                                    </tr>

                                </tbody>

                                <tfoot>

                                    <tr class="font-weight-bold bg-light">

                                        <td colspan="4" class="text-right">
                                            Total DUM
                                        </td>

                                        <td class="text-success">
                                            Rp 1.050.000
                                        </td>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>


</div>

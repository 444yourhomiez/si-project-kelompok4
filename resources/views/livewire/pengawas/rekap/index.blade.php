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

                                    <a href="{{ route('pengawas.dashboard') }}" class="text-muted breadcrumb-green">

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

                {{-- CARD --}}
                <div class="row mb-4">

                    {{-- DUM (Data Uang Masuk) --}}
                    <div class="col-md-6 col-sm-6 col-12">

                        <div class="card card-box card-success-soft h-100">

                            <div class="card-body position-relative overflow-hidden">

                                <div class="card-bg-circle bg-circle-success"></div>

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <div class="card-label mb-2">
                                            DUM (Data Uang Masuk)
                                        </div>

                                        <div class="card-number">
                                            Rp 200.000
                                        </div>

                                        <small class="text-muted">
                                            Jumlah uang masuk hari ini
                                        </small>

                                    </div>

                                    <a href="#" class="card-icon bg-success text-white">

                                        <i class="nav-icon fas fa-arrow-circle-down text-light"></i>

                                    </a>

                                </div>

                                <div class="progress card-progress mt-4">

                                    <div class="progress-bar bg-success" style="width:100%"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- DUK (Data Uang Keluar) --}}
                    <div class="col-md-6 col-sm-6 col-12">

                        <div class="card card-box card-danger-soft h-100">

                            <div class="card-body position-relative overflow-hidden">

                                <div class="card-bg-circle bg-circle-danger"></div>

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <div class="card-label mb-2">
                                            DUK (Data Uang Keluar)
                                        </div>

                                        <div class="card-number">
                                            Rp 300.000
                                        </div>

                                        <small class="text-muted">
                                            Jumlah uang keluar hari ini
                                        </small>

                                    </div>

                                    <a href="#" class="card-icon bg-danger text-white">

                                        <i class="nav-icon fas fa-arrow-circle-up text-light"></i>

                                    </a>

                                </div>

                                <div class="progress card-progress mt-4">

                                    <div class="progress-bar bg-danger" style="width:100%"></div>

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
                                    <i class="fas fa-calendar-day mr-2"></i>
                                    Daftar Rekapitulasi Harian
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
                                    {{-- <a class="dropdown-item text-success" href="#">
                                        <i class="fas fa-file-excel mr-1"></i>
                                        Excel
                                    </a> --}}
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body">

                        <div class="row">

                            {{-- ================================================= --}}
                            {{-- DUM --}}
                            {{-- ================================================= --}}
                            <div class="col-lg-6">

                                <div class="card border border-success shadow-sm h-100">

                                    <div class="card-header bg-light">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div>

                                                <h5 class="mb-0 font-weight-bold text-success">

                                                    <i class="fas fa-arrow-circle-down mr-2"></i>
                                                    Data Uang Masuk (DUM)

                                                </h5>

                                                <small class="text-muted">
                                                    Riwayat transaksi uang masuk
                                                </small>

                                            </div>

                                            <div class="d-flex">

                                                {{-- TAMBAH --}}
                                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal"
                                                    data-target="#createModalDum">

                                                    <i class="fas fa-plus mr-1"></i>
                                                    Tambah

                                                </button>

                                                {{-- CETAK --}}
                                                <div class="btn-group">

                                                    <button type="button"
                                                        class="btn btn-outline-success btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">

                                                        <i class="fas fa-print mr-1"></i>
                                                        Cetak

                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <a class="dropdown-item text-danger" href="#">
                                                            <i class="fas fa-file-pdf mr-1"></i>
                                                            PDF DUM
                                                        </a>

                                                        {{-- <a class="dropdown-item text-success" href="#">
                                                            <i class="fas fa-file-excel mr-1"></i>
                                                            Excel DUM
                                                        </a> --}}

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="card-body">

                                        {{-- FILTER --}}
                                        <div class="d-flex align-items-center mb-3">

                                            <div class="search-modern mr-2">

                                                <i class="fas fa-search search-modern-icon"></i>

                                                <input type="text" class="form-control search-modern-input"
                                                    placeholder="Cari DUM...">

                                            </div>

                                            <div class="position-relative sort-mini-box mr-2">

                                                <i class="fas fa-sliders-h sort-mini-icon"></i>

                                                <select class="form-control sort-mini-select">

                                                    <option>Terbaru</option>
                                                    <option>Nama</option>
                                                    <option>Nominal</option>

                                                </select>

                                            </div>

                                            <div class="position-relative pagination-mini-box">

                                                <i class="fas fa-table pagination-mini-icon"></i>

                                                <select class="form-control pagination-mini-select">

                                                    <option>10 Data</option>
                                                    <option>25 Data</option>
                                                    <option>50 Data</option>

                                                </select>

                                            </div>

                                        </div>

                                        {{-- TABLE --}}
                                        <div class="table-responsive">

                                            <table class="table table-bordered table-hover">

                                                <thead class="bg-success text-white">

                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>ID Anggota</th>
                                                        <th>Nama Anggota</th>
                                                        <th>Nominal</th>
                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td>03 Juni 2026</td>
                                                        <td>AG001</td>
                                                        <td>Budi Santoso</td>
                                                        <td>Rp 200.000</td>
                                                    </tr>

                                                    <tr>
                                                        <td>04 Juni 2026</td>
                                                        <td>AG002</td>
                                                        <td>Siti Aminah</td>
                                                        <td>Rp 500.000</td>
                                                    </tr>

                                                    <tr>
                                                        <td>05 Juni 2026</td>
                                                        <td>AG003</td>
                                                        <td>Andi Saputra</td>
                                                        <td>Rp 350.000</td>
                                                    </tr>

                                                </tbody>

                                                <tfoot>

                                                    <tr class="font-weight-bold">

                                                        <td colspan="3" class="text-right">
                                                            Total
                                                        </td>

                                                        <td>
                                                            Rp 1.050.000
                                                        </td>

                                                    </tr>

                                                </tfoot>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- ================================================= --}}
                            {{-- DUK --}}
                            {{-- ================================================= --}}
                            <div class="col-lg-6">

                                <div class="card border border-danger shadow-sm h-100">

                                    <div class="card-header bg-light">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div>

                                                <h5 class="mb-0 font-weight-bold text-danger">

                                                    <i class="fas fa-arrow-circle-up mr-2"></i>
                                                    Data Uang Keluar (DUK)

                                                </h5>

                                                <small class="text-muted">
                                                    Riwayat transaksi uang keluar
                                                </small>

                                            </div>

                                            <div class="d-flex">

                                                {{-- TAMBAH --}}
                                                <button class="btn btn-danger btn-sm mr-2" data-toggle="modal"
                                                    data-target="#createModalDuk">

                                                    <i class="fas fa-plus mr-1"></i>
                                                    Tambah

                                                </button>

                                                {{-- CETAK --}}
                                                <div class="btn-group">

                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">

                                                        <i class="fas fa-print mr-1"></i>
                                                        Cetak

                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <a class="dropdown-item text-danger" href="#">
                                                            <i class="fas fa-file-pdf mr-1"></i>
                                                            PDF DUK
                                                        </a>

                                                        {{-- <a class="dropdown-item text-success" href="#">
                                                            <i class="fas fa-file-excel mr-1"></i>
                                                            Excel DUK
                                                        </a> --}}

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="card-body">

                                        {{-- FILTER --}}
                                        <div class="d-flex align-items-center mb-3">

                                            <div class="search-modern mr-2">

                                                <i class="fas fa-search search-modern-icon"></i>

                                                <input type="text" class="form-control search-modern-input"
                                                    placeholder="Cari DUK...">

                                            </div>

                                            <div class="position-relative sort-mini-box mr-2">

                                                <i class="fas fa-sliders-h sort-mini-icon"></i>

                                                <select class="form-control sort-mini-select">

                                                    <option>Terbaru</option>
                                                    <option>Nama</option>
                                                    <option>Nominal</option>

                                                </select>

                                            </div>

                                            <div class="position-relative pagination-mini-box">

                                                <i class="fas fa-table pagination-mini-icon"></i>

                                                <select class="form-control pagination-mini-select">

                                                    <option>10 Data</option>
                                                    <option>25 Data</option>
                                                    <option>50 Data</option>

                                                </select>

                                            </div>

                                        </div>

                                        {{-- TABLE --}}
                                        <div class="table-responsive">

                                            <table class="table table-bordered table-hover">

                                                <thead class="bg-danger text-white">

                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>ID Anggota</th>
                                                        <th>Nama Anggota</th>
                                                        <th>Nominal</th>
                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td>03 Juni 2026</td>
                                                        <td>AG001</td>
                                                        <td>Budi Santoso</td>
                                                        <td>Rp 300.000</td>
                                                    </tr>

                                                    <tr>
                                                        <td>04 Juni 2026</td>
                                                        <td>AG002</td>
                                                        <td>Siti Aminah</td>
                                                        <td>Rp 150.000</td>
                                                    </tr>

                                                    <tr>
                                                        <td>05 Juni 2026</td>
                                                        <td>AG003</td>
                                                        <td>Andi Saputra</td>
                                                        <td>Rp 200.000</td>
                                                    </tr>

                                                </tbody>

                                                <tfoot>

                                                    <tr class="font-weight-bold">

                                                        <td colspan="3" class="text-right">
                                                            Total
                                                        </td>

                                                        <td>
                                                            Rp 650.000
                                                        </td>

                                                    </tr>

                                                </tfoot>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>


</div>

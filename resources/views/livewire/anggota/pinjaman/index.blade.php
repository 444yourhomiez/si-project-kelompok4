<div>
    <div>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <i class="nav-icon fas fa-hand-holding-usd mr-2"></i>
                                @yield('title')
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="nav-icon fas fa-th-large mr-1"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="nav-icon fas fa-hand-holding-usd mr-1"></i>
                                    @yield('title')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="nav-icon fas fa-hand-holding-usd"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pribadi</span>
                                <span class="info-box-number">Rp. 2.500.000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i
                                    class="nav-icon fas fa-hand-holding-usd"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Khusus</span>
                                <span class="info-box-number">Rp. 2.500.000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Pinjaman</span>
                                <span class="info-box-number">Rp. 5.000.000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>

                <!-- CARD BODY -->
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="mb-3">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah Pinjaman
                                </button>
                            </div>

                            <div>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control-sm mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-sm btn-outline-success my-2 my-sm-0"
                                        type="submit">Search</button>
                                </form>
                            </div>

                        </div>
                        <h3 class="card-title mb-3">Daftar Pinjaman Anggota</h3>
                        <div class="table-reponsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Pinjaman</th>
                                        <th>Jumlah Meminjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 April 2026</td>
                                        <td>1234567890123456</td>
                                        <td>Ratna</td>
                                        <td>Pribadi</td>
                                        <td>Rp. 1.000.000</td>
                                    </tr>
                                    <tr>
                                        <td>1 Mei 2026</td>
                                        <td>1234567890123457</td>
                                        <td>Budi</td>
                                        <td>Khusus</td>
                                        <td>Rp. 500.000</td>
                                    </tr>
                                    </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </section>

        </div>

    </div>

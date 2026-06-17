<div>
    <div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <i class="nav-icon fas fa-file-invoice mr-2"></i>
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
                                    <i class="nav-icon fas fa-file-invoice mr-1"></i>
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
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control-sm mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-sm btn-outline-success my-2 my-sm-0"
                                        type="submit">Search</button>
                                </form>
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
                    <!-- CARD BODY -->
                    <div class="card-body">
                        LAPORAN KEUANGAN
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>

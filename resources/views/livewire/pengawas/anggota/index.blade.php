<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                                <a href="#">
                                    <i class="nav-icon fas fa-th-large mr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="nav-icon fas fa-users mr-1"></i>
                                {{ $title }}
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
                        <span class="info-box-icon bg-primary">
                            <i class="nav-icon fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Anggota</span>
                            <span class="info-box-number">10</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success">
                            <i class="nav-icon fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Anggota Aktif</span>
                            <span class="info-box-number">7</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning">
                            <i class="nav-icon fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Anggota Menunggu Verifikasi</span>
                            <span class="info-box-number">3</span>
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
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="col-2">
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input wire:model.live="search" type="text" class="form-control"
                                placeholder="Masukan No KTP/Nama Anggota...">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>No Telepon</th>
                                    <th>Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $item)
                                    <tr>
                                        <td>{{ $item->no_ktp }}</td>
                                        <td>{{ $item->nama_anggota_anggota }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->tanggal_daftar }}</td>
                                    </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                    {{ $anggota->links() }}
                </div>
            </div>

    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

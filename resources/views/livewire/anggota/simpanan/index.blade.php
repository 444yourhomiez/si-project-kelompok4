<div>
    <div>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <i class="nav-icon fas fa-wallet mr-2"></i>
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
                                    <i class="nav-icon fas fa-wallet mr-1"></i>
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
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="nav-icon fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Wajib</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($wajib, 0, ',', '.') }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="nav-icon fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pokok</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($pokok, 0, ',', '.') }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="nav-icon fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sukarela</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($sukarela, 0, ',', '.') }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Simpanan</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($total_simpanan, 0, ',', '.') }}
                                </span>
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
                                <button wire:click="$dispatch('openCreate')" class="btn btn-sm btn-primary"
                                    data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah Simpanan
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
                        <h3 class="card-title mb-3">Daftar Simpanan Anggota</h3>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Jenis Simpanan</th>
                                        <th>Jumlah Setor Simpanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simpanan as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $item->anggota->nama_anggota }}</td>
                                            <td>{{ $item->jenis_simpanan }}</td>
                                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

        </div>

    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->

    {{-- Create Modal --}}
    @livewire('manajemen.simpanan.create')
    {{-- Create Modal --}}

    {{-- Close Modal --}}
    <script>
        Livewire.on('closeCreateModal', () => {
            $('#createModal').modal('hide');

            Swal.fire({
                title: "Sukses",
                text: "Simpanan Berhasil Ditambah",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
    {{-- Close Modal --}}

</div>

</div>

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
                <div class="row mb4">
                    {{-- TOTAL rekap --}}
                    <div class="col-md-12 col-sm-6 col-12">
                        <div class="card card-box card-purple-soft h-100">
                            <div class="card-body position-relative overflow-hidden">
                                <div class="card-bg-circle bg-circle-purple"></div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="card-label mb-2">
                                            Total Rekapitulasi Harian
                                        </div>
                                        <div class="card-number">
                                            Rp {{ number_format($saldo, 0, ',', '.') }}
                                        </div>
                                        <small class="text-muted">
                                            Total rekap yang diajukan anggota baik uang masuk maupun uang keluar
                                        </small>
                                    </div>
                                    <a href="{{ route('pengawas.rekap.index') }}"
                                        class="card-icon bg-purple text-white">
                                        <i class="fas fa-calendar-day"></i>
                                    </a>
                                </div>
                                <div class="progress card-progress mt-4">
                                    <div class="progress-bar bg-purple" style="width:100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- CARD --}}
                <div class="row mb-4">
                    {{-- DUM --}}
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
                                            Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                                        </div>
                                        <small class="text-muted">
                                            Total rekap yang diajukan anggota dan sudah masuk kas
                                        </small>
                                    </div>
                                    <a href="{{ route('pengawas.rekap.index') }}"
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
                    {{-- DUK --}}
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
                                            Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                                        </div>
                                        <small class="text-muted">
                                            Total rekap yang diajukan anggota dan sudah keluar kas
                                        </small>
                                    </div>
                                    <a href="{{ route('pengawas.rekap.index') }}"
                                        class="card-icon bg-danger text-white">
                                        <i class="fas fa-arrow-circle-up"></i>
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
                                    Riwayat Rekapitulasi Harian
                                </h4>
                                <small class="text-muted">
                                    Data uang masuk dan uang keluar
                                </small>
                            </div>
                            {{-- <div class="btn-group dropleft">
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
                            </div> --}}
                        </div>
                    </div>
                    {{-- BODY --}}
                    <div class="card-body">
                        {{-- <div class="row mb-4">
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
                                    <option>Pinjaman Biasa</option>
                                    <option>Pinjaman Khusus</option>
                                    <option>Cicilan</option>
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
                        </div> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>ID Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th>Jenis</th>
                                        <th>DUM</th>
                                        <th>DUK</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($riwayat as $item)
                                        <tr>

                                            <td>
                                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}
                                            </td>

                                            <td>
                                                {{ $item['kode_anggota'] }}
                                            </td>

                                            <td>
                                                {{ $item['nama_anggota'] }}
                                            </td>

                                            <td>
                                                {{ $item['jenis'] }}
                                            </td>

                                            <td class="text-success">

                                                @if ($item['masuk'] > 0)
                                                    Rp {{ number_format($item['masuk'], 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif

                                            </td>

                                            <td class="text-danger">

                                                @if ($item['keluar'] > 0)
                                                    Rp {{ number_format($item['keluar'], 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="6" class="text-center">

                                                Tidak ada transaksi hari ini

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold bg-light">
                                        <td colspan="4" class="text-right">
                                            Saldo
                                        </td>
                                        <td class="text-success">
                                            Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                                        </td>
                                        <td class="text-danger">
                                            Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="font-weight-bold">
                                        <td colspan="4" class="text-right">
                                            Total
                                        </td>
                                        <td colspan="2" class="text-dark">
                                            Rp {{ number_format($saldo, 0, ',', '.') }}
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

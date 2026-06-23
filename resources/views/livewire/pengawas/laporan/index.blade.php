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
                            {{-- JENIS --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Transaksi</label>
                                    <select class="form-control" wire:model.live="jenis">

                                        <option value="simpanan">
                                            Simpanan
                                        </option>

                                        <option value="pinjaman">
                                            Pinjaman
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Bulan</label>

                                    <select class="form-control" wire:model.live="bulan">

                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">
                                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                        @endfor

                                    </select>

                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Tahun</label>

                                    <select class="form-control" wire:model.live="tahun">

                                        @for ($i = now()->year; $i >= 1999; $i--)
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor

                                    </select>

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
                            {{-- <div class="btn-group">

                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">

                                    <i class="fas fa-print mr-1"></i>
                                    Cetak

                                </button>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item text-danger"
                                        href="{{ route('laporan.pdf', [
                                            'jenis' => $jenis,
                                            'bulan' => $bulan,
                                            'tahun' => $tahun,
                                        ]) }}"
                                        target="_blank">

                                        <i class="fas fa-file-pdf mr-1"></i>
                                        Export PDF

                                    </a>

                                    <a class="dropdown-item text-success"
                                        href="{{ route('laporan.excel', [
                                            'jenis' => $jenis,
                                            'bulan' => $bulan,
                                            'tahun' => $tahun,
                                        ]) }}">

                                        <i class="fas fa-file-excel mr-1"></i>
                                        Export Excel

                                    </a>

                                </div>

                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">

                                <thead class="thead-light">
                                    <tr>

                                        <th>No</th>

                                        <th>Kode Anggota</th>

                                        <th>Nama Anggota</th>

                                        @if ($jenis == 'simpanan')
                                            <th>Pokok</th>
                                            <th>Wajib</th>
                                            <th>Sukarela</th>
                                        @elseif($jenis == 'pinjaman')
                                            <th>Biasa</th>
                                            <th>Khusus</th>
                                        @endif

                                        <th>Total</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($data as $item)
                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                {{ $item['kode_anggota'] }}
                                            </td>

                                            <td>
                                                {{ $item['nama_anggota'] }}
                                            </td>

                                            @if ($jenis == 'simpanan')
                                                <td>
                                                    Rp {{ number_format($item['pokok'], 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    Rp {{ number_format($item['wajib'], 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    Rp {{ number_format($item['sukarela'], 0, ',', '.') }}
                                                </td>
                                            @elseif($jenis == 'pinjaman')
                                                <td>
                                                    Rp {{ number_format($item['biasa'], 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    Rp {{ number_format($item['khusus'], 0, ',', '.') }}
                                                </td>
                                            @elseif($jenis == 'cicilan')
                                                <td>
                                                    Rp {{ number_format($item['lunas'], 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    Rp {{ number_format($item['belum'], 0, ',', '.') }}
                                                </td>
                                            @endif

                                            <td class="font-weight-bold">

                                                Rp {{ number_format($item['total'], 0, ',', '.') }}

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="10" class="text-center">

                                                Tidak ada data

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                                <tfoot>

                                    <tr class="font-weight-bold bg-light">

                                        @if ($jenis == 'simpanan')
                                            <td colspan="6" class="text-right">
                                            @elseif($jenis == 'pinjaman')
                                            <td colspan="5" class="text-right">
                                        @endif

                                        Total Laporan

                                        </td>

                                        <td>
                                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
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

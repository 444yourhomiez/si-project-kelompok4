<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="nav-icon fas fa-hand-holding-usd mr-2"></i>
                            {{ $title }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">
                                    <i class="fas fa-th-large mr-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-success">
                                <i class="fas fa-hand-holding-usd mr-1"></i> {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            {{-- FILTER TAHUN --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-md-3 mb-0">
                            <label class="font-weight-bold">Tahun Buku</label>
                            <select wire:model.live="tahun" class="form-control">
                                @foreach($tahunList as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9 mb-0">
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Nilai SHU dihitung otomatis dari total pendapatan biaya jasa pinjaman dan provisi pinjaman yang disetujui pada tahun buku yang dipilih.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INFO CARDS --}}
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon bg-teal elevation-1">
                            <i class="fas fa-hand-holding-usd"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jasa Pinjaman</span>
                            <span class="info-box-number">Rp {{ number_format($totals['total_jasa'], 0, ',', '.') }}</span>
                            <small class="text-muted">Total bunga semua pinjaman</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon bg-orange elevation-1">
                            <i class="fas fa-receipt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Provisi Pinjaman</span>
                            <span class="info-box-number">Rp {{ number_format($totals['total_provisi'], 0, ',', '.') }}</span>
                            <small class="text-muted">Total provisi semua pinjaman</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-coins"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Nilai SHU {{ $tahun }}</span>
                            <span class="info-box-number">Rp {{ number_format($totals['nilai_shu'], 0, ',', '.') }}</span>
                            <small class="text-muted">Jasa + Provisi</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">SHU Dibagikan</span>
                            <span class="info-box-number">Rp {{ number_format($totals['total_shu_dibagikan'], 0, ',', '.') }}</span>
                            <small class="text-muted">Deviden + BJP</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon bg-primary elevation-1">
                            <i class="fas fa-percentage"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Alokasi Deviden (30% SHU)</span>
                            <span class="info-box-number">Rp {{ number_format($totals['alokasi_deviden'], 0, ',', '.') }}</span>
                            <small class="text-muted">Dibagi proporsional berdasarkan simpanan saham anggota</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-percentage"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Alokasi BJP (20% SHU)</span>
                            <span class="info-box-number">Rp {{ number_format($totals['alokasi_bjp'], 0, ',', '.') }}</span>
                            <small class="text-muted">Dibagi proporsional berdasarkan jasa pinjaman anggota</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL SHU --}}
            <div class="card table-modern border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="font-weight-bold mb-1">
                            <i class="fas fa-table mr-2"></i>
                            Pembagian SHU Anggota — Tahun {{ $tahun }}
                        </h4>
                        <small class="text-muted">Deviden = 30% SHU &nbsp;|&nbsp; BJP = 20% SHU</small>
                    </div>
                    @if($rows->count() > 0)
                        <div>
                            <a href="{{ route('shu.pdf', ['tahun' => $tahun]) }}"
                               target="_blank"
                               class="btn btn-danger btn-sm mr-2">
                                <i class="fas fa-file-pdf mr-1"></i> PDF
                            </a>
                            <a href="{{ route('shu.excel', ['tahun' => $tahun]) }}"
                               class="btn btn-success btn-sm">
                                <i class="fas fa-file-excel mr-1"></i> Excel
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @if($totals['nilai_shu'] == 0)
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                            <p>Tidak ada pinjaman yang disetujui pada tahun <strong>{{ $tahun }}</strong>.<br>
                               Nilai SHU tidak dapat dihitung.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead style="background:#155724;color:#fff;">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Anggota</th>
                                        <th class="text-right">Simp. Pokok</th>
                                        <th class="text-right">Simp. Wajib</th>
                                        <th class="text-right">Simp. Sukarela</th>
                                        <th class="text-right">Total Simp. Saham</th>
                                        <th class="text-right">Deviden</th>
                                        <th class="text-right">BJP</th>
                                        <th class="text-right">Jumlah SHU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rows as $i => $row)
                                        <tr>
                                            <td class="text-center">{{ $i + 1 }}</td>
                                            <td>{{ $row['nama_anggota'] }}</td>
                                            <td class="text-right">Rp {{ number_format($row['pokok'], 0, ',', '.') }}</td>
                                            <td class="text-right">Rp {{ number_format($row['wajib'], 0, ',', '.') }}</td>
                                            <td class="text-right">Rp {{ number_format($row['sukarela'], 0, ',', '.') }}</td>
                                            <td class="text-right font-weight-bold">Rp {{ number_format($row['saham'], 0, ',', '.') }}</td>
                                            <td class="text-right text-primary">Rp {{ number_format($row['deviden'], 0, ',', '.') }}</td>
                                            <td class="text-right text-warning">Rp {{ number_format($row['bjp'], 0, ',', '.') }}</td>
                                            <td class="text-right text-success font-weight-bold">Rp {{ number_format($row['shu'], 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-5">
                                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                                Tidak ada data anggota dengan simpanan atau pinjaman pada tahun {{ $tahun }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if($rows->count() > 0)
                                    <tfoot>
                                        <tr class="font-weight-bold bg-light">
                                            <td colspan="2" class="text-right">TOTAL</td>
                                            <td class="text-right">Rp {{ number_format($totals['total_saham'], 0, ',', '.') }}</td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">Rp {{ number_format($totals['total_saham'], 0, ',', '.') }}</td>
                                            <td class="text-right text-primary">Rp {{ number_format($totals['total_deviden'], 0, ',', '.') }}</td>
                                            <td class="text-right text-warning">Rp {{ number_format($totals['total_bjp'], 0, ',', '.') }}</td>
                                            <td class="text-right text-success">Rp {{ number_format($totals['total_shu_dibagikan'], 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </section>
    </div>
</div>

<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-file-invoice mr-2"></i>{{ $title }}</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            {{-- FILTER CARD --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-end">

                        <div class="col-md-3 mb-2">
                            <label class="font-weight-bold">Jenis Laporan</label>
                            <select wire:model.live="jenis_laporan" class="form-control">
                                <option value="bulanan">Laporan Bulanan</option>
                                <option value="tahunan">Laporan Tahunan (SHU)</option>
                            </select>
                        </div>

                        @if($jenis_laporan === 'bulanan')
                            <div class="col-md-2 mb-2">
                                <label class="font-weight-bold">Bulan</label>
                                <select wire:model.live="bulan" class="form-control">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">
                                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        @endif

                        <div class="col-md-2 mb-2">
                            <label class="font-weight-bold">Tahun</label>
                            <select wire:model.live="tahun" class="form-control">
                                @for($i = now()->year; $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="d-block">&nbsp;</label>
                            @if($jenis_laporan === 'bulanan')
                                <a href="{{ route('laporan.pdf', ['jenis_laporan' => 'bulanan', 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                   target="_blank" class="btn btn-success mr-1">
                                    <i class="fas fa-file-pdf mr-1"></i> PDF
                                </a>
                                <a href="{{ route('laporan.excel', ['jenis_laporan' => 'bulanan', 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                   class="btn btn-outline-success">
                                    <i class="fas fa-file-excel mr-1"></i> Excel
                                </a>
                            @else
                                <a href="{{ route('laporan.pdf', ['jenis_laporan' => 'tahunan', 'tahun' => $tahun]) }}"
                                   target="_blank" class="btn btn-success mr-1">
                                    <i class="fas fa-file-pdf mr-1"></i> PDF
                                </a>
                                <a href="{{ route('laporan.excel', ['jenis_laporan' => 'tahunan', 'tahun' => $tahun]) }}"
                                   class="btn btn-outline-success">
                                    <i class="fas fa-file-excel mr-1"></i> Excel
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            {{-- ============================= --}}
            {{-- LAPORAN BULANAN --}}
            {{-- ============================= --}}
            @if($jenis_laporan === 'bulanan')

                @php $periodeBulan = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') . ' ' . $tahun; @endphp

                {{-- SUMMARY --}}
                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Simpanan</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($simpananData->sum('total'), 0, ',', '.') }}</div>
                                <small class="text-muted">{{ $simpananData->count() }} anggota</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pinjaman</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($pinjamanData->sum('total'), 0, ',', '.') }}</div>
                                <small class="text-muted">{{ $pinjamanData->count() }} anggota</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Rekap Uang Masuk</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($rekapData->sum('masuk'), 0, ',', '.') }}</div>
                                <small class="text-muted">{{ $rekapData->where('masuk', '>', 0)->count() }} transaksi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Rekap Uang Keluar</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($rekapData->sum('keluar'), 0, ',', '.') }}</div>
                                <small class="text-muted">{{ $rekapData->where('keluar', '>', 0)->count() }} transaksi</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- I. SIMPANAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 font-weight-bold">
                            <i class="fas fa-piggy-bank mr-2"></i>I. Laporan Simpanan — {{ $periodeBulan }}
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width:40px">No</th>
                                        <th>Kode Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th class="text-right">Simp. Pokok</th>
                                        <th class="text-right">Simp. Wajib</th>
                                        <th class="text-right">Simp. Sukarela</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($simpananData as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item['kode_anggota'] }}</td>
                                            <td>{{ $item['nama_anggota'] }}</td>
                                            <td class="text-right">Rp {{ number_format($item['pokok'], 0, ',', '.') }}</td>
                                            <td class="text-right">Rp {{ number_format($item['wajib'], 0, ',', '.') }}</td>
                                            <td class="text-right">Rp {{ number_format($item['sukarela'], 0, ',', '.') }}</td>
                                            <td class="text-right font-weight-bold">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted py-3">Tidak ada simpanan pada periode ini</td></tr>
                                    @endforelse
                                </tbody>
                                @if($simpananData->count() > 0)
                                    <tfoot>
                                        <tr class="font-weight-bold" style="background:#d4edda;">
                                            <td colspan="6" class="text-right">Total Simpanan</td>
                                            <td class="text-right">Rp {{ number_format($simpananData->sum('total'), 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                {{-- II. PINJAMAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 font-weight-bold">
                            <i class="fas fa-hand-holding-usd mr-2"></i>II. Laporan Pinjaman — {{ $periodeBulan }}
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width:40px">No</th>
                                        <th>Kode Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th class="text-right">Pinjaman Biasa</th>
                                        <th class="text-right">Pinjaman Khusus</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pinjamanData as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item['kode_anggota'] }}</td>
                                            <td>{{ $item['nama_anggota'] }}</td>
                                            <td class="text-right">Rp {{ number_format($item['biasa'], 0, ',', '.') }}</td>
                                            <td class="text-right">Rp {{ number_format($item['khusus'], 0, ',', '.') }}</td>
                                            <td class="text-right font-weight-bold">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-3">Tidak ada pinjaman pada periode ini</td></tr>
                                    @endforelse
                                </tbody>
                                @if($pinjamanData->count() > 0)
                                    <tfoot>
                                        <tr class="font-weight-bold" style="background:#d4edda;">
                                            <td colspan="5" class="text-right">Total Pinjaman</td>
                                            <td class="text-right">Rp {{ number_format($pinjamanData->sum('total'), 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                {{-- III. REKAPITULASI HARIAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 font-weight-bold">
                            <i class="fas fa-calendar-day mr-2"></i>III. Rekapitulasi Harian — {{ $periodeBulan }}
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width:40px">No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Keterangan</th>
                                        <th class="text-right">Uang Masuk (DUM)</th>
                                        <th class="text-right">Uang Keluar (DUK)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekapData as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="font-weight-bold">{{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}</div>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($item['tanggal'])->locale('id')->diffForHumans() }}</small>
                                            </td>
                                            <td>{{ $item['jenis'] }}</td>
                                            <td>{{ $item['keterangan'] }}</td>
                                            <td class="text-right">{{ $item['masuk'] > 0 ? 'Rp '.number_format($item['masuk'],0,',','.') : '-' }}</td>
                                            <td class="text-right">{{ $item['keluar'] > 0 ? 'Rp '.number_format($item['keluar'],0,',','.') : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-3">Tidak ada rekapitulasi harian pada periode ini</td></tr>
                                    @endforelse
                                </tbody>
                                @if($rekapData->count() > 0)
                                    <tfoot>
                                        <tr class="font-weight-bold" style="background:#d4edda;">
                                            <td colspan="4" class="text-right">Total</td>
                                            <td class="text-right">Rp {{ number_format($rekapData->sum('masuk'), 0, ',', '.') }}</td>
                                            <td class="text-right">Rp {{ number_format($rekapData->sum('keluar'), 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td colspan="4" class="text-right">Saldo (DUM − DUK)</td>
                                            <td colspan="2" class="text-right">
                                                Rp {{ number_format($rekapData->sum('masuk') - $rekapData->sum('keluar'), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                {{-- IV. SHU --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0 font-weight-bold">
                                <i class="fas fa-coins mr-2"></i>IV. Pembagian SHU — Tahun {{ $tahun }}
                            </h6>
                            <small>
                                Nilai SHU: Rp {{ number_format($shuData['nilai_shu'], 0, ',', '.') }}
                                &nbsp;|&nbsp; Deviden 30%: Rp {{ number_format($shuData['alokasi_deviden'], 0, ',', '.') }}
                                &nbsp;|&nbsp; BJP 20%: Rp {{ number_format($shuData['alokasi_bjp'], 0, ',', '.') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($shuData['nilai_shu'] == 0)
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-info-circle mr-1"></i>
                                Tidak ada pinjaman aktif/lunas pada tahun {{ $tahun }}.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="width:40px">No</th>
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
                                        @forelse($shuData['rows'] as $i => $row)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $row['nama_anggota'] }}</td>
                                                <td class="text-right">Rp {{ number_format($row['pokok'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['wajib'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['sukarela'], 0, ',', '.') }}</td>
                                                <td class="text-right font-weight-bold">Rp {{ number_format($row['saham'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['deviden'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['bjp'], 0, ',', '.') }}</td>
                                                <td class="text-right font-weight-bold">Rp {{ number_format($row['shu'], 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="9" class="text-center text-muted py-3">Tidak ada data</td></tr>
                                        @endforelse
                                    </tbody>
                                    @if($shuData['rows']->count() > 0)
                                        <tfoot>
                                            <tr class="font-weight-bold" style="background:#d4edda;">
                                                <td colspan="2" class="text-right">TOTAL</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_saham'], 0, ',', '.') }}</td>
                                                <td></td><td></td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_saham'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_deviden'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_bjp'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_shu_dibagikan'], 0, ',', '.') }}</td>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            @endif

            {{-- ============================= --}}
            {{-- LAPORAN TAHUNAN (SHU) --}}
            {{-- ============================= --}}
            @if($jenis_laporan === 'tahunan')

                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jasa Pinjaman</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($shuData['total_jasa'], 0, ',', '.') }}</div>
                                <small class="text-muted">Total bunga semua pinjaman</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Provisi Pinjaman</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($shuData['total_provisi'], 0, ',', '.') }}</div>
                                <small class="text-muted">Total provisi semua pinjaman</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nilai SHU {{ $tahun }}</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($shuData['nilai_shu'], 0, ',', '.') }}</div>
                                <small class="text-muted">Jasa + Provisi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">SHU Dibagikan</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($shuData['total_shu_dibagikan'], 0, ',', '.') }}</div>
                                <small class="text-muted">Deviden + BJP</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alokasi Deviden (30% SHU)</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($shuData['alokasi_deviden'], 0, ',', '.') }}</div>
                                <small class="text-muted">Proporsional berdasarkan simpanan saham anggota</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alokasi BJP (20% SHU)</div>
                                <div class="h6 font-weight-bold mb-0">Rp {{ number_format($shuData['alokasi_bjp'], 0, ',', '.') }}</div>
                                <small class="text-muted">Proporsional berdasarkan jasa pinjaman anggota</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 font-weight-bold">
                            <i class="fas fa-coins mr-2"></i>Pembagian SHU Per Anggota — Tahun {{ $tahun }}
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        @if($shuData['nilai_shu'] == 0)
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                                Tidak ada pinjaman yang disetujui pada tahun <strong>{{ $tahun }}</strong>.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="width:40px">No</th>
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
                                        @forelse($shuData['rows'] as $i => $row)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $row['nama_anggota'] }}</td>
                                                <td class="text-right">Rp {{ number_format($row['pokok'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['wajib'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['sukarela'], 0, ',', '.') }}</td>
                                                <td class="text-right font-weight-bold">Rp {{ number_format($row['saham'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['deviden'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($row['bjp'], 0, ',', '.') }}</td>
                                                <td class="text-right font-weight-bold">Rp {{ number_format($row['shu'], 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="9" class="text-center text-muted py-4">Tidak ada data anggota</td></tr>
                                        @endforelse
                                    </tbody>
                                    @if($shuData['rows']->count() > 0)
                                        <tfoot>
                                            <tr class="font-weight-bold" style="background:#d4edda;">
                                                <td colspan="2" class="text-right">TOTAL</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_saham'], 0, ',', '.') }}</td>
                                                <td></td><td></td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_saham'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_deviden'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_bjp'], 0, ',', '.') }}</td>
                                                <td class="text-right">Rp {{ number_format($shuData['total_shu_dibagikan'], 0, ',', '.') }}</td>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            @endif

        </section>
    </div>
</div>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $jenis_laporan === 'tahunan' ? 'Laporan SHU' : 'Laporan Bulanan' }}</title>
    <style>
        body       { font-family: DejaVu Sans; font-size: 10px; margin: 0; }
        .header    { margin-bottom: 10px; border-bottom: 2px solid #28a745; padding-bottom: 6px; }
        .header-inner { display: table; width: 100%; }
        .header-logo  { display: table-cell; width: 70px; vertical-align: middle; }
        .header-logo img { width: 60px; height: 60px; object-fit: contain; }
        .header-text  { display: table-cell; text-align: center; vertical-align: middle; padding: 0 8px; }
        .header-text h2 { margin: 0 0 2px; font-size: 14px; color: #28a745; }
        .header-text p  { margin: 1px 0; font-size: 10px; }
        .section-title {
            background: #28a745; color: #fff;
            padding: 4px 7px; font-weight: bold; font-size: 10px;
            margin-top: 14px; margin-bottom: 0;
        }
        table { width: 100%; border-collapse: collapse; }
        table th, table td { border: 1px solid #ccc; padding: 3px 5px; }
        table th { background: #28a745; color: #fff; font-size: 10px; }
        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .tfoot td    { background: #d4edda; font-weight: bold; }
        .empty       { text-align: center; color: #888; font-style: italic; padding: 6px; }
        .footer      { margin-top: 28px; text-align: right; font-size: 10px; }
        .info-table  { border: none; width: auto; margin-bottom: 6px; }
        .info-table td { border: none; padding: 1px 10px 1px 0; }
    </style>
</head>
<body>

{{-- HEADER WITH LOGO --}}
<div class="header">
    <div class="header-inner">
        <div class="header-logo">
            @if($logo)
                <img src="{{ $logo }}" alt="Logo Koperasi">
            @endif
        </div>
        <div class="header-text">
            <h2>KOPERASI MOTEKAR</h2>
            @if($jenis_laporan === 'tahunan')
                <p><strong>LAPORAN TAHUNAN — PEMBAGIAN SHU</strong></p>
                <p>Tahun Buku : {{ $tahun }}</p>
            @else
                <p><strong>LAPORAN BULANAN</strong></p>
                <p>Periode : {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}</p>
            @endif
        </div>
        <div style="display:table-cell;width:70px;"></div>{{-- balancer --}}
    </div>
</div>

@if($jenis_laporan === 'bulanan')

    {{-- I. SIMPANAN --}}
    <div class="section-title">I. LAPORAN SIMPANAN</div>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:26px">No</th>
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
                    <td class="text-right">{{ number_format($item['pokok'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($item['wajib'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($item['sukarela'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($item['total'],0,',','.') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">Tidak ada simpanan pada periode ini</td></tr>
            @endforelse
        </tbody>
        @if($simpananData->count() > 0)
            <tfoot>
                <tr class="tfoot">
                    <td colspan="6" class="text-right">Total Simpanan</td>
                    <td class="text-right">{{ number_format($simpananData->sum('total'),0,',','.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    {{-- II. PINJAMAN --}}
    <div class="section-title">II. LAPORAN PINJAMAN</div>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:26px">No</th>
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
                    <td class="text-right">{{ number_format($item['biasa'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($item['khusus'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($item['total'],0,',','.') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Tidak ada pinjaman pada periode ini</td></tr>
            @endforelse
        </tbody>
        @if($pinjamanData->count() > 0)
            <tfoot>
                <tr class="tfoot">
                    <td colspan="5" class="text-right">Total Pinjaman</td>
                    <td class="text-right">{{ number_format($pinjamanData->sum('total'),0,',','.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    {{-- III. REKAPITULASI HARIAN --}}
    <div class="section-title">III. REKAPITULASI HARIAN</div>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:26px">No</th>
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
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['jenis'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                    <td class="text-right">{{ $item['masuk'] > 0 ? number_format($item['masuk'],0,',','.') : '-' }}</td>
                    <td class="text-right">{{ $item['keluar'] > 0 ? number_format($item['keluar'],0,',','.') : '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Tidak ada rekapitulasi harian pada periode ini</td></tr>
            @endforelse
        </tbody>
        @if($rekapData->count() > 0)
            @php $tMasuk = $rekapData->sum('masuk'); $tKeluar = $rekapData->sum('keluar'); @endphp
            <tfoot>
                <tr class="tfoot">
                    <td colspan="4" class="text-right">Total</td>
                    <td class="text-right">{{ number_format($tMasuk,0,',','.') }}</td>
                    <td class="text-right">{{ number_format($tKeluar,0,',','.') }}</td>
                </tr>
                <tr class="tfoot">
                    <td colspan="4" class="text-right">Saldo (DUM − DUK)</td>
                    <td colspan="2" class="text-right">{{ number_format($tMasuk - $tKeluar,0,',','.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    {{-- IV. SHU --}}
    <div class="section-title">IV. PEMBAGIAN SHU — TAHUN {{ $tahun }}</div>
    <table class="info-table">
        <tr><td>Nilai SHU (Jasa + Provisi)</td><td>: Rp {{ number_format($shuData['nilai_shu'],0,',','.') }}</td></tr>
        <tr><td>Alokasi Deviden (30%)</td><td>: Rp {{ number_format($shuData['alokasi_deviden'],0,',','.') }}</td></tr>
        <tr><td>Alokasi BJP (20%)</td><td>: Rp {{ number_format($shuData['alokasi_bjp'],0,',','.') }}</td></tr>
    </table>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:26px">No</th>
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
            @forelse($shuData['rows'] as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row['nama_anggota'] }}</td>
                    <td class="text-right">{{ number_format($row['pokok'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['wajib'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['sukarela'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['saham'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['deviden'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['bjp'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['shu'],0,',','.') }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="empty">Tidak ada pinjaman aktif/lunas pada tahun {{ $tahun }}</td></tr>
            @endforelse
        </tbody>
        @if($shuData['rows']->count() > 0)
            <tfoot>
                <tr class="tfoot">
                    <td colspan="2" class="text-right">TOTAL</td>
                    <td class="text-right">{{ number_format($shuData['total_saham'],0,',','.') }}</td>
                    <td></td><td></td>
                    <td class="text-right">{{ number_format($shuData['total_saham'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($shuData['total_deviden'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($shuData['total_bjp'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($shuData['total_shu_dibagikan'],0,',','.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

@else

    {{-- TAHUNAN / SHU --}}
    <table class="info-table">
        <tr><td>Pendapatan Jasa Pinjaman</td><td>: Rp {{ number_format($shuData['total_jasa'],0,',','.') }}</td></tr>
        <tr><td>Pendapatan Provisi Pinjaman</td><td>: Rp {{ number_format($shuData['total_provisi'],0,',','.') }}</td></tr>
        <tr><td><strong>Nilai SHU</strong></td><td><strong>: Rp {{ number_format($shuData['nilai_shu'],0,',','.') }}</strong></td></tr>
        <tr><td>Alokasi Deviden (30%)</td><td>: Rp {{ number_format($shuData['alokasi_deviden'],0,',','.') }}</td></tr>
        <tr><td>Alokasi BJP (20%)</td><td>: Rp {{ number_format($shuData['alokasi_bjp'],0,',','.') }}</td></tr>
    </table>

    <div class="section-title">PEMBAGIAN SHU PER ANGGOTA — TAHUN {{ $tahun }}</div>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:26px">No</th>
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
            @forelse($shuData['rows'] as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row['nama_anggota'] }}</td>
                    <td class="text-right">{{ number_format($row['pokok'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['wajib'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['sukarela'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['saham'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['deviden'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['bjp'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($row['shu'],0,',','.') }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="empty">Tidak ada pinjaman aktif/lunas pada tahun {{ $tahun }}</td></tr>
            @endforelse
        </tbody>
        @if($shuData['rows']->count() > 0)
            <tfoot>
                <tr class="tfoot">
                    <td colspan="2" class="text-right">TOTAL</td>
                    <td class="text-right">{{ number_format($shuData['total_saham'],0,',','.') }}</td>
                    <td></td><td></td>
                    <td class="text-right">{{ number_format($shuData['total_saham'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($shuData['total_deviden'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($shuData['total_bjp'],0,',','.') }}</td>
                    <td class="text-right">{{ number_format($shuData['total_shu_dibagikan'],0,',','.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

@endif

<div class="footer">
    <p>Cimahi, {{ now()->translatedFormat('d F Y') }}</p>
    <br><br><br>
    <p>____________________</p>
</div>

</body>
</html>

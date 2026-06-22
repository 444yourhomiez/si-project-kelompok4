<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan SHU</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 11px; }
        .header { text-align: center; margin-bottom: 16px; }
        .header h2 { margin: 0; font-size: 14px; }
        .header p { margin: 2px; }
        table { width: 100%; border-collapse: collapse; }
        table th, table td { border: 1px solid #000; padding: 4px 6px; }
        table th { background: #e9ecef; text-align: center; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .info-box { margin-bottom: 10px; font-size: 11px; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>KOPERASI MOTEKAR</h2>
        <p>LAPORAN PEMBAGIAN SHU ANGGOTA</p>
        <p>Tahun Buku {{ $tahun }}</p>
    </div>

    <div class="info-box">
        <table style="width:auto; border:none; margin-bottom:8px;">
            <tr>
                <td style="border:none; padding:1px 8px 1px 0;">Pendapatan Jasa Pinjaman</td>
                <td style="border:none; padding:1px;">: Rp {{ number_format($totals['total_jasa'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 8px 1px 0;">Pendapatan Provisi Pinjaman</td>
                <td style="border:none; padding:1px;">: Rp {{ number_format($totals['total_provisi'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 8px 1px 0;"><strong>Nilai SHU</strong></td>
                <td style="border:none; padding:1px;"><strong>: Rp {{ number_format($totals['nilai_shu'], 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 8px 1px 0;">Alokasi Deviden (30%)</td>
                <td style="border:none; padding:1px;">: Rp {{ number_format($totals['alokasi_deviden'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 8px 1px 0;">Alokasi BJP (20%)</td>
                <td style="border:none; padding:1px;">: Rp {{ number_format($totals['alokasi_bjp'], 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Simp. Pokok</th>
                <th>Simp. Wajib</th>
                <th>Simp. Sukarela</th>
                <th>Total Simp. Saham</th>
                <th>Deviden</th>
                <th>BJP</th>
                <th>Jumlah SHU</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row['nama_anggota'] }}</td>
                    <td class="text-right">{{ number_format($row['pokok'], 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row['wajib'], 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row['sukarela'], 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row['saham'], 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row['deviden'], 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row['bjp'], 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($row['shu'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-right">TOTAL</th>
                <th class="text-right">{{ number_format($totals['total_saham'], 0, ',', '.') }}</th>
                <th></th>
                <th></th>
                <th class="text-right">{{ number_format($totals['total_saham'], 0, ',', '.') }}</th>
                <th class="text-right">{{ number_format($totals['total_deviden'], 0, ',', '.') }}</th>
                <th class="text-right">{{ number_format($totals['total_bjp'], 0, ',', '.') }}</th>
                <th class="text-right">{{ number_format($totals['total_shu_dibagikan'], 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Cimahi, {{ now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p>____________________</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Laporan Koperasi</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            background: #e9ecef;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>

</head>

<body>

    <div class="header">

        <h2>KOPERASI MOTEKAR</h2>

        <p>Laporan {{ ucfirst($jenis) }}</p>

        <p>
            Bulan :
            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
            {{ $tahun }}
        </p>

    </div>

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>Kode Anggota</th>

                <th>Nama Anggota</th>

                @if($jenis == 'simpanan')

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

            @foreach($data as $item)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item['kode_anggota'] }}
                    </td>

                    <td>
                        {{ $item['nama_anggota'] }}
                    </td>

                    @if($jenis == 'simpanan')

                        <td class="text-right">
                            {{ number_format($item['pokok'],0,',','.') }}
                        </td>

                        <td class="text-right">
                            {{ number_format($item['wajib'],0,',','.') }}
                        </td>

                        <td class="text-right">
                            {{ number_format($item['sukarela'],0,',','.') }}
                        </td>

                    @elseif($jenis == 'pinjaman')

                        <td class="text-right">
                            {{ number_format($item['biasa'],0,',','.') }}
                        </td>

                        <td class="text-right">
                            {{ number_format($item['khusus'],0,',','.') }}
                        </td>

                    @endif

                    <td class="text-right">
                        {{ number_format($item['total'],0,',','.') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

        <tfoot>

            <tr>

                @if($jenis == 'simpanan')
                    <th colspan="6" class="text-right">
                @else
                    <th colspan="5" class="text-right">
                @endif

                    Total

                </th>

                <th class="text-right">
                    {{ number_format($grandTotal,0,',','.') }}
                </th>

            </tr>

        </tfoot>

    </table>

    <div class="footer">

        <p>
            Cimahi,
            {{ now()->translatedFormat('d F Y') }}
        </p>

        <br><br><br>

        <p>
            ____________________
        </p>

    </div>

</body>

</html>
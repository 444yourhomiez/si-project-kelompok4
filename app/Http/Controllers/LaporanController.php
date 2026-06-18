<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Anggota;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    private function getLaporanData(
        $jenis,
        $bulan,
        $tahun
    ) {
        $data = collect();

        if ($jenis == 'simpanan') {

            $data = Anggota::with([
                'simpanan' => function ($query) use ($bulan, $tahun) {

                    $query->whereMonth(
                        'tanggal',
                        $bulan
                    )
                        ->whereYear(
                            'tanggal',
                            $tahun
                        );
                }
            ])

                ->whereHas('user', function ($query) {

                    $query->where(
                        'status',
                        'disetujui'
                    );
                })

                ->get()

                ->map(function ($anggota) {

                    $pokok = $anggota->simpanan
                        ->where(
                            'jenis_simpanan',
                            'pokok'
                        )
                        ->sum('jumlah');

                    $wajib = $anggota->simpanan
                        ->where(
                            'jenis_simpanan',
                            'wajib'
                        )
                        ->sum('jumlah');

                    $sukarela = $anggota->simpanan
                        ->where(
                            'jenis_simpanan',
                            'sukarela'
                        )
                        ->sum('jumlah');

                    return [

                        'kode_anggota' =>
                        $anggota->kode_anggota,

                        'nama_anggota' =>
                        $anggota->nama_anggota,

                        'pokok' =>
                        $pokok,

                        'wajib' =>
                        $wajib,

                        'sukarela' =>
                        $sukarela,

                        'total' =>
                        $pokok +
                            $wajib +
                            $sukarela,
                    ];
                })

                ->filter(function ($item) {

                    return $item['total'] > 0;
                });
        }

        if ($jenis == 'pinjaman') {

            $data = Anggota::with([
                'pinjaman' => function ($query) use ($bulan, $tahun) {

                    $query->whereMonth(
                        'tanggal_pengajuan',
                        $bulan
                    )
                        ->whereYear(
                            'tanggal_pengajuan',
                            $tahun
                        );
                }
            ])

                ->whereHas('user', function ($query) {

                    $query->where(
                        'status',
                        'disetujui'
                    );
                })

                ->get()

                ->map(function ($anggota) {

                    $biasa = $anggota->pinjaman
                        ->where(
                            'jenis_pinjaman',
                            'biasa'
                        )
                        ->sum(
                            'jumlah_pengajuan'
                        );

                    $khusus = $anggota->pinjaman
                        ->where(
                            'jenis_pinjaman',
                            'khusus'
                        )
                        ->sum(
                            'jumlah_pengajuan'
                        );

                    return [

                        'kode_anggota' =>
                        $anggota->kode_anggota,

                        'nama_anggota' =>
                        $anggota->nama_anggota,

                        'biasa' =>
                        $biasa,

                        'khusus' =>
                        $khusus,

                        'total' =>
                        $biasa + $khusus,
                    ];
                })

                ->filter(function ($item) {

                    return $item['total'] > 0;
                });
        }

        return [
            'data' => $data,
            'grandTotal' => $data->sum('total')
        ];
    }

    public function pdf(Request $request)
    {
        $jenis = $request->jenis;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $result = $this->getLaporanData(
            $jenis,
            $bulan,
            $tahun
        );

        $data = $result['data'];
        $grandTotal = $result['grandTotal'];

        $pdf = Pdf::loadView(
            'pdf.laporan',
            compact(
                'data',
                'jenis',
                'bulan',
                'tahun',
                'grandTotal'
            )
        );

        return $pdf->stream(
            'laporan-' . $jenis . '.pdf'
        );
    }

    public function excel(Request $request)
    {
        $jenis = $request->jenis;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $result = $this->getLaporanData(
            $jenis,
            $bulan,
            $tahun
        );

        return Excel::download(
            new LaporanExport(
                $result['data'],
                $jenis,
                $bulan,
                $tahun,
                $result['grandTotal']
            ),
            'laporan-' .
                $jenis .
                '-' .
                $bulan .
                '-' .
                $tahun .
                '.xlsx'
        );
    }
}
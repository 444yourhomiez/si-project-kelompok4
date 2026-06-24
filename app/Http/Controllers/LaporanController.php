<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Exports\ShuExport;
use App\Models\Anggota;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\RekapHarian;
use App\Models\Simpanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    private function getLaporanBulanan(int $bulan, int $tahun): array
    {
        $simpananData = Anggota::with([
            'simpanan' => fn($q) => $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun),
        ])
        ->whereHas('user', fn($q) => $q->where('status', 'disetujui'))
        ->get()
        ->map(function ($anggota) {
            $pokok    = $anggota->simpanan->where('jenis_simpanan', 'pokok')->sum('jumlah');
            $wajib    = $anggota->simpanan->where('jenis_simpanan', 'wajib')->sum('jumlah');
            $sukarela = $anggota->simpanan->where('jenis_simpanan', 'sukarela')->sum('jumlah');
            return [
                'kode_anggota' => $anggota->kode_anggota,
                'nama_anggota' => $anggota->nama_anggota,
                'pokok'        => $pokok,
                'wajib'        => $wajib,
                'sukarela'     => $sukarela,
                'total'        => $pokok + $wajib + $sukarela,
            ];
        })
        ->filter(fn($item) => $item['total'] > 0)
        ->values();

        $pinjamanData = Anggota::with([
            'pinjaman' => fn($q) => $q->whereMonth('tanggal_pengajuan', $bulan)->whereYear('tanggal_pengajuan', $tahun),
        ])
        ->whereHas('user', fn($q) => $q->where('status', 'disetujui'))
        ->get()
        ->map(function ($anggota) {
            $biasa  = $anggota->pinjaman->where('jenis_pinjaman', 'biasa')->sum('jumlah_pengajuan');
            $khusus = $anggota->pinjaman->where('jenis_pinjaman', 'khusus')->sum('jumlah_pengajuan');
            return [
                'kode_anggota' => $anggota->kode_anggota,
                'nama_anggota' => $anggota->nama_anggota,
                'biasa'        => $biasa,
                'khusus'       => $khusus,
                'total'        => $biasa + $khusus,
            ];
        })
        ->filter(fn($item) => $item['total'] > 0)
        ->values();

        $simpananRekap = Simpanan::with('anggota')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->map(fn($item) => [
                '_sort'      => $item->tanggal,
                'tanggal'    => $item->tanggal->format('d M Y'),
                'jenis'      => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'keterangan' => $item->anggota->nama_anggota ?? '-',
                'masuk'      => (float) $item->jumlah,
                'keluar'     => 0,
            ]);

        $cicilanRekap = Cicilan::with('pinjaman.anggota')
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->where('status', 'lunas')
            ->get()
            ->map(fn($item) => [
                '_sort'      => $item->tanggal_bayar,
                'tanggal'    => $item->tanggal_bayar->format('d M Y'),
                'jenis'      => 'Cicilan Ke-' . $item->cicilan_ke . ' (' . ucfirst($item->pinjaman?->jenis_pinjaman ?? '') . ')',
                'keterangan' => $item->pinjaman?->anggota?->nama_anggota ?? '-',
                'masuk'      => (float) $item->jumlah_tagihan,
                'keluar'     => 0,
            ]);

        $pinjamanRekap = Pinjaman::with('anggota')
            ->whereMonth('tanggal_persetujuan', $bulan)
            ->whereYear('tanggal_persetujuan', $tahun)
            ->where('status', 'aktif')
            ->get()
            ->map(fn($item) => [
                '_sort'      => $item->tanggal_persetujuan,
                'tanggal'    => $item->tanggal_persetujuan->format('d M Y'),
                'jenis'      => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'keterangan' => $item->anggota->nama_anggota ?? '-',
                'masuk'      => 0,
                'keluar'     => (float) ($item->dana_diterima ?? $item->jumlah_pengajuan),
            ]);

        $manualRekap = RekapHarian::with('user')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->map(fn($item) => [
                '_sort'      => $item->tanggal,
                'tanggal'    => $item->tanggal->format('d M Y'),
                'jenis'      => $item->keterangan ?: ($item->jenis === 'uang_masuk' ? 'Uang Masuk' : 'Uang Keluar'),
                'keterangan' => $item->user->nama_user ?? '-',
                'masuk'      => $item->jenis === 'uang_masuk' ? (float) $item->nominal : 0,
                'keluar'     => $item->jenis === 'uang_keluar' ? (float) $item->nominal : 0,
            ]);

        $rekapData = $simpananRekap->concat($cicilanRekap)->concat($pinjamanRekap)->concat($manualRekap)
            ->sortBy('_sort')
            ->map(fn($item) => collect($item)->except('_sort')->all())
            ->values();

        return compact('simpananData', 'pinjamanData', 'rekapData');
    }

    private function logoBase64(): string
    {
        $path = public_path('images/logo_motekar.png');
        return file_exists($path)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($path))
            : '';
    }

    public function pdf(Request $request)
    {
        $jenisLaporan = $request->get('jenis_laporan', 'bulanan');
        $logo         = $this->logoBase64();

        if ($jenisLaporan === 'tahunan') {
            $request->validate(['tahun' => 'required|integer|min:2000|max:2100']);
            $tahun   = (int) $request->tahun;
            $shuData = $this->getShuData($tahun);
            $pdf     = Pdf::loadView('pdf.laporan', compact('shuData', 'tahun', 'logo') + ['jenis_laporan' => 'tahunan'])
                ->setPaper('a4', 'landscape');
            return $pdf->stream('laporan-shu-' . $tahun . '.pdf');
        }

        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $bulan   = (int) $request->bulan;
        $tahun   = (int) $request->tahun;
        $data    = $this->getLaporanBulanan($bulan, $tahun);
        $shuData = $this->getShuData($tahun);

        $pdf = Pdf::loadView('pdf.laporan', array_merge($data, compact('bulan', 'tahun', 'shuData', 'logo')) + ['jenis_laporan' => 'bulanan'])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-bulanan-' . $bulan . '-' . $tahun . '.pdf');
    }

    public function shuPdf(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $tahun   = (int) $request->tahun;
        $shuData = $this->getShuData($tahun);

        $pdf = Pdf::loadView('pdf.shu', [
            'rows'   => $shuData['rows'],
            'totals' => $shuData,
            'tahun'  => $tahun,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-shu-' . $tahun . '.pdf');
    }

    public function shuExcel(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $tahun   = (int) $request->tahun;
        $shuData = $this->getShuData($tahun);

        return Excel::download(
            new ShuExport($shuData['rows'], $tahun, $shuData),
            'laporan-shu-' . $tahun . '.xlsx'
        );
    }

    private function getShuData(int $tahun): array
    {
        $pinjamanTahun = Pinjaman::whereYear('tanggal_persetujuan', $tahun)
            ->whereIn('status', ['aktif', 'lunas', 'disetujui'])
            ->get();

        $totalJasa    = $pinjamanTahun->sum(fn($p) =>
            (float) $p->total_pembayaran - (float) ($p->jumlah_disetujui ?? $p->jumlah_pengajuan)
        );
        $totalProvisi = $pinjamanTahun->sum(fn($p) => (float) $p->provisi);
        $nilaiShu     = $totalJasa + $totalProvisi;

        $alokasiDeviden = $nilaiShu * 0.30;
        $alokasiBjp     = $nilaiShu * 0.20;

        $anggotaList = Anggota::with([
            'simpanan' => fn($q) => $q->whereYear('tanggal', $tahun),
            'pinjaman' => fn($q) => $q->whereYear('tanggal_persetujuan', $tahun)
                ->whereIn('status', ['aktif', 'lunas', 'disetujui']),
        ])
        ->whereHas('user', fn($q) => $q->where('status', 'disetujui'))
        ->get();

        $totalSimpananSaham = 0;
        $totalBungaPinjaman = 0;

        $rows = $anggotaList->map(function ($anggota) use (&$totalSimpananSaham, &$totalBungaPinjaman) {
            $pokok    = $anggota->simpanan->where('jenis_simpanan', 'pokok')->sum('jumlah');
            $wajib    = $anggota->simpanan->where('jenis_simpanan', 'wajib')->sum('jumlah');
            $sukarela = $anggota->simpanan->where('jenis_simpanan', 'sukarela')->sum('jumlah');
            $saham    = $pokok + $wajib + $sukarela;
            $bunga    = $anggota->pinjaman->sum(fn($p) =>
                (float) $p->total_pembayaran - (float) ($p->jumlah_disetujui ?? $p->jumlah_pengajuan)
            );
            $totalSimpananSaham += $saham;
            $totalBungaPinjaman += $bunga;
            return compact('pokok', 'wajib', 'sukarela', 'saham', 'bunga') + [
                'nama_anggota' => $anggota->nama_anggota,
                'deviden' => 0.0, 'bjp' => 0.0, 'shu' => 0.0,
            ];
        });

        $nilaiDevidenPerRupiah = $totalSimpananSaham > 0 ? $alokasiDeviden / $totalSimpananSaham : 0;
        $nilaiBjpPerRupiah     = $totalBungaPinjaman > 0 ? $alokasiBjp / $totalBungaPinjaman : 0;

        $rows = $rows->map(function ($row) use ($nilaiDevidenPerRupiah, $nilaiBjpPerRupiah) {
            $row['deviden'] = round($row['saham'] * $nilaiDevidenPerRupiah);
            $row['bjp']     = round($row['bunga'] * $nilaiBjpPerRupiah);
            $row['shu']     = $row['deviden'] + $row['bjp'];
            return $row;
        })->filter(fn($r) => $r['saham'] > 0 || $r['bunga'] > 0)->values();

        return [
            'rows'                => $rows,
            'nilai_shu'           => $nilaiShu,
            'total_jasa'          => $totalJasa,
            'total_provisi'       => $totalProvisi,
            'alokasi_deviden'     => $alokasiDeviden,
            'alokasi_bjp'         => $alokasiBjp,
            'total_saham'         => $rows->sum('saham'),
            'total_deviden'       => $rows->sum('deviden'),
            'total_bjp'           => $rows->sum('bjp'),
            'total_shu_dibagikan' => $rows->sum('shu'),
        ];
    }

    public function excel(Request $request)
    {
        $jenisLaporan = $request->get('jenis_laporan', 'bulanan');

        if ($jenisLaporan === 'tahunan') {
            $request->validate(['tahun' => 'required|integer|min:2000|max:2100']);
            $tahun   = (int) $request->tahun;
            $shuData = $this->getShuData($tahun);
            return Excel::download(
                new ShuExport($shuData['rows'], $tahun, $shuData),
                'laporan-shu-' . $tahun . '.xlsx'
            );
        }

        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $bulan   = (int) $request->bulan;
        $tahun   = (int) $request->tahun;
        $data    = $this->getLaporanBulanan($bulan, $tahun);
        $shuData = $this->getShuData($tahun);

        return Excel::download(
            new LaporanExport($data['simpananData'], $data['pinjamanData'], $data['rekapData'], $shuData, $bulan, $tahun),
            'laporan-bulanan-' . $bulan . '-' . $tahun . '.xlsx'
        );
    }
}
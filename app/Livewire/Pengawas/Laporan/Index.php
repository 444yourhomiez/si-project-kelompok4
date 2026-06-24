<?php

namespace App\Livewire\Pengawas\Laporan;

use App\Models\Anggota;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\RekapHarian;
use App\Models\Simpanan;
use Livewire\Component;

class Index extends Component
{
    public string $jenis_laporan = 'bulanan';
    public int    $bulan;
    public int    $tahun;

    public function mount(): void
    {
        $this->bulan = now()->month;
        $this->tahun = now()->year;
    }

    private function getBulananData(): array
    {
        $bulan = $this->bulan;
        $tahun = $this->tahun;

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
        ->filter(fn($i) => $i['total'] > 0)
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
        ->filter(fn($i) => $i['total'] > 0)
        ->values();

        $simpananRekap = Simpanan::with('anggota')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->map(fn($item) => [
                'tanggal'    => $item->tanggal,
                'jenis'      => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'keterangan' => $item->anggota->nama_anggota ?? '-',
                'masuk'      => (float) $item->jumlah,
                'keluar'     => 0,
                'sumber'     => 'simpanan',
            ]);

        $cicilanRekap = Cicilan::with('pinjaman.anggota')
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->where('status', 'lunas')
            ->get()
            ->map(fn($item) => [
                'tanggal'    => $item->tanggal_bayar,
                'jenis'      => 'Cicilan Ke-' . $item->cicilan_ke . ' (' . ucfirst($item->pinjaman?->jenis_pinjaman ?? '') . ')',
                'keterangan' => $item->pinjaman?->anggota?->nama_anggota ?? '-',
                'masuk'      => (float) $item->jumlah_tagihan,
                'keluar'     => 0,
                'sumber'     => 'cicilan',
            ]);

        $pinjamanRekap = Pinjaman::with('anggota')
            ->whereMonth('tanggal_persetujuan', $bulan)
            ->whereYear('tanggal_persetujuan', $tahun)
            ->where('status', 'aktif')
            ->get()
            ->map(fn($item) => [
                'tanggal'    => $item->tanggal_persetujuan,
                'jenis'      => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'keterangan' => $item->anggota->nama_anggota ?? '-',
                'masuk'      => 0,
                'keluar'     => (float) ($item->dana_diterima ?? $item->jumlah_pengajuan),
                'sumber'     => 'pinjaman',
            ]);

        $manualRekap = RekapHarian::with('user')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->map(fn($item) => [
                'tanggal'    => $item->tanggal,
                'jenis'      => $item->keterangan ?: ($item->jenis === 'uang_masuk' ? 'Uang Masuk' : 'Uang Keluar'),
                'keterangan' => $item->user->nama_user ?? '-',
                'masuk'      => $item->jenis === 'uang_masuk' ? (float) $item->nominal : 0,
                'keluar'     => $item->jenis === 'uang_keluar' ? (float) $item->nominal : 0,
                'sumber'     => 'manual',
            ]);

        $rekapData = $simpananRekap->concat($cicilanRekap)->concat($pinjamanRekap)->concat($manualRekap)
            ->sortBy('tanggal')
            ->values();

        $shuData = $this->hitungShu($tahun);

        return compact('simpananData', 'pinjamanData', 'rekapData', 'shuData');
    }

    private function getTahunanData(): array
    {
        $shuData = $this->hitungShu($this->tahun);
        return compact('shuData');
    }

    private function hitungShu(int $tahun): array
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
        $alokasiBjp    = $nilaiShu * 0.20;

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

        $rDevidenPerRupiah = $totalSimpananSaham > 0 ? $alokasiDeviden / $totalSimpananSaham : 0;
        $rBjpPerRupiah     = $totalBungaPinjaman > 0 ? $alokasiBjp / $totalBungaPinjaman : 0;

        $rows = $rows->map(function ($row) use ($rDevidenPerRupiah, $rBjpPerRupiah) {
            $row['deviden'] = round($row['saham'] * $rDevidenPerRupiah);
            $row['bjp']     = round($row['bunga'] * $rBjpPerRupiah);
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

    public function render()
    {
        $data = $this->jenis_laporan === 'bulanan'
            ? $this->getBulananData()
            : $this->getTahunanData();

        return view('livewire.pengawas.laporan.index', array_merge(
            ['title' => 'Laporan'],
            $data,
            [
                'simpananData' => $data['simpananData'] ?? collect(),
                'pinjamanData' => $data['pinjamanData'] ?? collect(),
                'rekapData'    => $data['rekapData']    ?? collect(),
                'shuData'      => $data['shuData']      ?? ['rows' => collect(), 'nilai_shu' => 0, 'total_jasa' => 0, 'total_provisi' => 0, 'alokasi_deviden' => 0, 'alokasi_bjp' => 0, 'total_saham' => 0, 'total_deviden' => 0, 'total_bjp' => 0, 'total_shu_dibagikan' => 0],
            ]
        ));
    }
}

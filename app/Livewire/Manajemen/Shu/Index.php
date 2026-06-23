<?php

namespace App\Livewire\Manajemen\Shu;

use App\Models\Anggota;
use App\Models\Pinjaman;
use Livewire\Component;

class Index extends Component
{
    public int $tahun = 0;

    public function mount(): void
    {
        $this->tahun = now()->year;
    }

    private function hitungShu(): array
    {
        $tahun = $this->tahun;

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

            $bunga = $anggota->pinjaman->sum(fn($p) =>
                (float) $p->total_pembayaran - (float) ($p->jumlah_disetujui ?? $p->jumlah_pengajuan)
            );

            $totalSimpananSaham += $saham;
            $totalBungaPinjaman += $bunga;

            return [
                'nama_anggota' => $anggota->nama_anggota,
                'pokok'        => $pokok,
                'wajib'        => $wajib,
                'sukarela'     => $sukarela,
                'saham'        => $saham,
                'bunga'        => $bunga,
                'deviden'      => 0.0,
                'bjp'          => 0.0,
                'shu'          => 0.0,
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
            'rows'   => $rows,
            'totals' => [
                'nilai_shu'           => $nilaiShu,
                'total_jasa'          => $totalJasa,
                'total_provisi'       => $totalProvisi,
                'alokasi_deviden'     => $alokasiDeviden,
                'alokasi_bjp'         => $alokasiBjp,
                'total_pokok'         => $rows->sum('pokok'),
                'total_wajib'         => $rows->sum('wajib'),
                'total_sukarela'      => $rows->sum('sukarela'),
                'total_saham'         => $rows->sum('saham'),
                'total_deviden'       => $rows->sum('deviden'),
                'total_bjp'           => $rows->sum('bjp'),
                'total_shu_dibagikan' => $rows->sum('shu'),
            ],
        ];
    }

    public function render()
    {
        $hasil = $this->hitungShu();

        return view('livewire.manajemen.shu.index', [
            'title'     => 'Laporan SHU',
            'rows'      => $hasil['rows'],
            'totals'    => $hasil['totals'],
            'tahunList' => range(now()->year, 2000),
        ]);
    }
}

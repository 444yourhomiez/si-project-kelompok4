<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromArray, WithStyles, ShouldAutoSize, WithEvents, WithDrawings
{
    public function __construct(
        protected $simpananData,
        protected $pinjamanData,
        protected $rekapData,
        protected array $shuData,
        protected int $bulan,
        protected int $tahun
    ) {}

    public function drawings(): Drawing|array
    {
        $path = public_path('images/logo_motekar.png');
        if (! file_exists($path)) {
            return [];
        }
        $drawing = new Drawing();
        $drawing->setName('Logo Koperasi');
        $drawing->setDescription('Logo Koperasi Motekar');
        $drawing->setPath($path);
        $drawing->setHeight(55);
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);
        $drawing->setCoordinates('A1');
        return $drawing;
    }

    public function array(): array
    {
        $out = [];
        $periode = Carbon::create()->month($this->bulan)->translatedFormat('F') . ' ' . $this->tahun;

        // Baris 1-4: header (logo ditempatkan di A1, baris ini berfungsi sebagai spacer + judul)
        $out[] = [''];                                       // row 1 — logo overlap
        $out[] = ['KOPERASI MOTEKAR'];                      // row 2
        $out[] = ['LAPORAN BULANAN'];                        // row 3
        $out[] = ['PERIODE ' . strtoupper($periode)];        // row 4
        $out[] = [];                                         // row 5

        // ---- I. SIMPANAN ----
        $out[] = ['I. LAPORAN SIMPANAN'];
        $out[] = ['No', 'Kode Anggota', 'Nama Anggota', 'Simp. Pokok', 'Simp. Wajib', 'Simp. Sukarela', 'Total'];
        foreach ($this->simpananData->values() as $i => $row) {
            $out[] = [$i + 1, $row['kode_anggota'], $row['nama_anggota'], $row['pokok'], $row['wajib'], $row['sukarela'], $row['total']];
        }
        if ($this->simpananData->isEmpty()) {
            $out[] = ['', '', 'Tidak ada data', '', '', '', ''];
        }
        $out[] = ['', '', '', '', '', 'Total Simpanan', $this->simpananData->sum('total')];
        $out[] = [];

        // ---- II. PINJAMAN ----
        $out[] = ['II. LAPORAN PINJAMAN'];
        $out[] = ['No', 'Kode Anggota', 'Nama Anggota', 'Pinjaman Biasa', 'Pinjaman Khusus', 'Total'];
        foreach ($this->pinjamanData->values() as $i => $row) {
            $out[] = [$i + 1, $row['kode_anggota'], $row['nama_anggota'], $row['biasa'], $row['khusus'], $row['total']];
        }
        if ($this->pinjamanData->isEmpty()) {
            $out[] = ['', '', 'Tidak ada data', '', '', ''];
        }
        $out[] = ['', '', '', '', 'Total Pinjaman', $this->pinjamanData->sum('total')];
        $out[] = [];

        // ---- III. REKAPITULASI HARIAN ----
        $out[] = ['III. REKAPITULASI HARIAN'];
        $out[] = ['No', 'Tanggal', 'Jenis', 'Keterangan', 'Uang Masuk (DUM)', 'Uang Keluar (DUK)'];
        foreach ($this->rekapData->values() as $i => $row) {
            $out[] = [$i + 1, $row['tanggal'], $row['jenis'], $row['keterangan'], $row['masuk'] ?: '', $row['keluar'] ?: ''];
        }
        if ($this->rekapData->isEmpty()) {
            $out[] = ['', '', '', 'Tidak ada data', '', ''];
        }
        $tMasuk  = $this->rekapData->sum('masuk');
        $tKeluar = $this->rekapData->sum('keluar');
        $out[] = ['', '', '', 'Total', $tMasuk, $tKeluar];
        $out[] = ['', '', '', 'Saldo (DUM - DUK)', $tMasuk - $tKeluar, ''];
        $out[] = [];

        // ---- IV. SHU ----
        $out[] = ['IV. PEMBAGIAN SHU — TAHUN ' . $this->tahun];
        $out[] = ['Nilai SHU (Jasa + Provisi)', 'Rp ' . number_format($this->shuData['nilai_shu'], 0, ',', '.')];
        $out[] = ['Alokasi Deviden (30%)', 'Rp ' . number_format($this->shuData['alokasi_deviden'], 0, ',', '.')];
        $out[] = ['Alokasi BJP (20%)', 'Rp ' . number_format($this->shuData['alokasi_bjp'], 0, ',', '.')];
        $out[] = [];
        $out[] = ['No', 'Nama Anggota', 'Simp. Pokok', 'Simp. Wajib', 'Simp. Sukarela', 'Total Simp. Saham', 'Deviden', 'BJP', 'Jumlah SHU'];
        foreach ($this->shuData['rows']->values() as $i => $row) {
            $out[] = [$i + 1, $row['nama_anggota'], $row['pokok'], $row['wajib'], $row['sukarela'], $row['saham'], $row['deviden'], $row['bjp'], $row['shu']];
        }
        if ($this->shuData['rows']->isEmpty()) {
            $out[] = ['', 'Tidak ada data', '', '', '', '', '', '', ''];
        }
        $out[] = ['', 'TOTAL', $this->shuData['total_saham'], '', '', $this->shuData['total_saham'], $this->shuData['total_deviden'], $this->shuData['total_bjp'], $this->shuData['total_shu_dibagikan']];

        return $out;
    }

    public function styles(Worksheet $sheet): array
    {
        // Baris 1 tinggi untuk logo
        $sheet->getRowDimension(1)->setRowHeight(45);

        return [
            2 => ['font' => ['bold' => true, 'size' => 16]],
            3 => ['font' => ['bold' => true, 'size' => 14]],
            4 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet      = $event->sheet;
                $lastCol    = 'I';
                $highestRow = $sheet->getHighestRow();

                // Merge header rows
                foreach ([2, 3, 4] as $r) {
                    $sheet->mergeCells("A{$r}:{$lastCol}{$r}");
                    $sheet->getStyle("A{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                $green     = 'FF28A745';
                $greenLight = 'FFD4EDDA';

                for ($r = 1; $r <= $highestRow; $r++) {
                    $val = (string) $sheet->getCell('A' . $r)->getValue();

                    // Section header rows
                    foreach (['I. LAPORAN', 'II. LAPORAN', 'III. REKAP', 'IV. PEMBAG'] as $prefix) {
                        if (str_starts_with($val, $prefix)) {
                            $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $green]],
                            ]);
                        }
                    }

                    // Column header rows (No)
                    if ($val === 'No') {
                        $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF28A745']],
                        ]);
                    }

                    // Footer total rows
                    $footerKeywords = ['Total Simpanan', 'Total Pinjaman', 'Total', 'Saldo', 'TOTAL', 'Alokasi'];
                    foreach ($footerKeywords as $kw) {
                        $cellD = (string) $sheet->getCell('D' . $r)->getValue();
                        $cellB = (string) $sheet->getCell('B' . $r)->getValue();
                        if ($cellD === $kw || $cellB === $kw || str_starts_with($val, 'Nilai SHU') || str_starts_with($val, 'Alokasi')) {
                            $sheet->getStyle("A{$r}:{$lastCol}{$r}")->getFont()->setBold(true);
                            break;
                        }
                    }
                }

                $sheet->getDelegate()->getStyle('D:I')->getNumberFormat()->setFormatCode('#,##0');
            },
        ];
    }
}

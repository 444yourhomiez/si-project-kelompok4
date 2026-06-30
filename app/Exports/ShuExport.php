<?php

namespace App\Exports;

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

class ShuExport implements FromArray, WithStyles, ShouldAutoSize, WithEvents, WithDrawings
{
    public function __construct(
        protected $rows,
        protected int $tahun,
        protected array $totals
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

        $out[] = [''];                                          // row 1 — logo spacer
        $out[] = ['KOPERASI MOTEKAR'];                         // row 2
        $out[] = ['LAPORAN TAHUNAN — PEMBAGIAN SHU ANGGOTA'];  // row 3
        $out[] = ['TAHUN BUKU ' . $this->tahun];               // row 4
        $out[] = [];
        $out[] = ['Pendapatan Jasa Pinjaman', 'Rp ' . number_format($this->totals['total_jasa'], 0, ',', '.')];
        $out[] = ['Pendapatan Provisi Pinjaman', 'Rp ' . number_format($this->totals['total_provisi'], 0, ',', '.')];
        $out[] = ['Nilai SHU', 'Rp ' . number_format($this->totals['nilai_shu'], 0, ',', '.')];
        $out[] = ['Alokasi Deviden (30%)', 'Rp ' . number_format($this->totals['alokasi_deviden'], 0, ',', '.')];
        $out[] = ['Alokasi BJP (20%)', 'Rp ' . number_format($this->totals['alokasi_bjp'], 0, ',', '.')];
        $out[] = [];
        $out[] = ['No', 'Nama Anggota', 'Simp. Pokok', 'Simp. Wajib', 'Simp. Sukarela', 'Total Simp. Saham', 'Deviden', 'BJP', 'Jumlah SHU'];

        foreach ($this->rows->values() as $i => $row) {
            $out[] = [$i + 1, $row['nama_anggota'], $row['pokok'], $row['wajib'], $row['sukarela'], $row['saham'], $row['deviden'], $row['bjp'], $row['shu']];
        }

        $out[] = [];
        $out[] = ['', 'TOTAL', $this->totals['total_saham'], '', '', $this->totals['total_saham'], $this->totals['total_deviden'], $this->totals['total_bjp'], $this->totals['total_shu_dibagikan']];

        return $out;
    }

    public function styles(Worksheet $sheet): array
    {
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
                $sheet   = $event->sheet;
                $lastCol = 'I';
                $green   = 'FF28A745';

                foreach ([2, 3, 4] as $r) {
                    $sheet->mergeCells("A{$r}:{$lastCol}{$r}");
                    $sheet->getStyle("A{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                $highestRow = $sheet->getHighestRow();
                for ($r = 1; $r <= $highestRow; $r++) {
                    $val = (string) $sheet->getCell('A' . $r)->getValue();
                    if ($val === 'No') {
                        $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF28A745']],
                        ]);
                    }
                    $cellB = (string) $sheet->getCell('B' . $r)->getValue();
                    if ($cellB === 'TOTAL') {
                        $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                            'font' => ['bold' => true],
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFD4EDDA']],
                        ]);
                    }
                }

                $sheet->getDelegate()->getStyle('C:I')->getNumberFormat()->setFormatCode('#,##0');
            },
        ];
    }
}

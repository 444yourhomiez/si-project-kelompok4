<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements
    FromArray,
    WithStyles,
    ShouldAutoSize,
    WithEvents
{
    protected $data;
    protected $jenis;
    protected $bulan;
    protected $tahun;
    protected $grandTotal;

    public function __construct(
        $data,
        $jenis,
        $bulan,
        $tahun,
        $grandTotal
    ) {
        $this->data = $data;
        $this->jenis = $jenis;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->grandTotal = $grandTotal;
    }

    public function array(): array
    {
        $rows = [];

        $rows[] = ['KOPERASI MOTEKAR'];
        $rows[] = ['LAPORAN ' . strtoupper($this->jenis)];
        $rows[] = ['PERIODE ' . $this->bulan . '/' . $this->tahun];
        $rows[] = [];

        if ($this->jenis == 'simpanan') {

            $rows[] = [
                'No',
                'Kode Anggota',
                'Nama Anggota',
                'Pokok',
                'Wajib',
                'Sukarela',
                'Total'
            ];

            foreach ($this->data->values() as $index => $item) {

                $rows[] = [
                    $index + 1,
                    $item['kode_anggota'],
                    $item['nama_anggota'],
                    $item['pokok'],
                    $item['wajib'],
                    $item['sukarela'],
                    $item['total'],
                ];
            }

            $rows[] = [];

            $rows[] = [
                '',
                '',
                '',
                '',
                '',
                'TOTAL',
                $this->grandTotal
            ];
        }

        if ($this->jenis == 'pinjaman') {

            $rows[] = [
                'No',
                'Kode Anggota',
                'Nama Anggota',
                'Pinjaman Biasa',
                'Pinjaman Khusus',
                'Total'
            ];

            foreach ($this->data->values() as $index => $item) {

                $rows[] = [
                    $index + 1,
                    $item['kode_anggota'],
                    $item['nama_anggota'],
                    $item['biasa'],
                    $item['khusus'],
                    $item['total'],
                ];
            }

            $rows[] = [];

            $rows[] = [
                '',
                '',
                '',
                '',
                'TOTAL',
                $this->grandTotal
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        return [

            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16
                ]
            ],

            2 => [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ]
            ],

            5 => [
                'font' => [
                    'bold' => true
                ]
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $lastColumn =
                    $this->jenis == 'simpanan'
                    ? 'G'
                    : 'F';

                $event->sheet->mergeCells(
                    "A1:{$lastColumn}1"
                );

                $event->sheet->mergeCells(
                    "A2:{$lastColumn}2"
                );

                $event->sheet->mergeCells(
                    "A3:{$lastColumn}3"
                );

                $event->sheet->getStyle(
                    "A1:A3"
                )
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );

                if ($this->jenis == 'simpanan') {

                    $event->sheet
                        ->getDelegate()
                        ->getStyle('D:G')
                        ->getNumberFormat()
                        ->setFormatCode(
                            '#,##0'
                        );
                } else {

                    $event->sheet
                        ->getDelegate()
                        ->getStyle('D:F')
                        ->getNumberFormat()
                        ->setFormatCode(
                            '#,##0'
                        );
                }
            }
        ];
    }
}
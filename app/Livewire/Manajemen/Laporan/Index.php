<?php

namespace App\Livewire\Manajemen\Laporan;

use App\Models\Anggota;
use Livewire\Component;

class Index extends Component
{
    public $jenis = 'simpanan';

    public $bulan;
    public $tahun;

    public function mount()
    {
        $this->bulan = now()->month;
        $this->tahun = now()->year;
    }

    public function render()
    {
        $data = collect();

        if ($this->jenis == 'simpanan') {

            $data = Anggota::with([
                'simpanan' => function ($query) {

                    $query->whereMonth(
                        'tanggal',
                        $this->bulan
                    )
                        ->whereYear(
                            'tanggal',
                            $this->tahun
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
                        ->where('jenis_simpanan', 'pokok')
                        ->sum('jumlah');

                    $wajib = $anggota->simpanan
                        ->where('jenis_simpanan', 'wajib')
                        ->sum('jumlah');

                    $sukarela = $anggota->simpanan
                        ->where('jenis_simpanan', 'sukarela')
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
            $grandTotal = $data->sum('total');
        } elseif ($this->jenis == 'pinjaman') {

            $data = Anggota::with([
                'pinjaman' => function ($query) {

                    $query->whereMonth(
                        'tanggal_pengajuan',
                        $this->bulan
                    )
                        ->whereYear(
                            'tanggal_pengajuan',
                            $this->tahun
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

            $grandTotal = $data->sum('total');
        } 


        return view(
            'livewire.manajemen.laporan.index',
            [
                'title' => 'Laporan',
                'data' => $data,
                'grandTotal' => $grandTotal,
            ]
        );
    }
}

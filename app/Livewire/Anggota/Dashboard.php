<?php

namespace App\Livewire\Anggota;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public bool $showAllTransaksi = false;

    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];

    public function toggleTransaksi()
    {
        $this->showAllTransaksi = !$this->showAllTransaksi;
    }

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN
        |--------------------------------------------------------------------------
        */

        $total_simpanan = Simpanan::where(
            'anggota_id',
            $anggotaId
        )->sum('jumlah');

        $simpanan_wajib = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'wajib'
            )
            ->sum('jumlah');

        $simpanan_pokok = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'pokok'
            )
            ->sum('jumlah');

        $simpanan_sukarela = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'sukarela'
            )
            ->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | PINJAMAN
        |--------------------------------------------------------------------------
        */

        $total_pinjaman = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $pinjaman_biasa = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_pinjaman',
                'biasa'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $pinjaman_khusus = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_pinjaman',
                'khusus'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        /*
        |--------------------------------------------------------------------------
        | CICILAN
        |--------------------------------------------------------------------------
        */

        $total_cicilan = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {
                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )->sum('jumlah_tagihan');

        $totalBelumBayar = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {
                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )
            ->where(
                'status',
                'belum'
            )
            ->sum('jumlah_tagihan');

        $totalLunas = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {
                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )
            ->where(
                'status',
                'lunas'
            )
            ->sum('jumlah_tagihan');

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $transaksiSimpanan = Simpanan::where('anggota_id', $anggotaId)
            ->whereDate('created_at', $today)
            ->latest()
            ->get()
            ->map(fn($item) => [
                'tipe'       => 'simpanan',
                'id'         => $item->id,
                'tanggal'    => $item->created_at,
                'jenis'      => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'sub'        => $item->jenis_simpanan,
                'status'     => 'Tersimpan',
                'nominal'    => $item->jumlah,
                'keterangan' => null,
                'cicilan'    => collect(),
            ]);

        $transaksiPinjaman = Pinjaman::with(['cicilan' => fn($q) => $q->orderBy('cicilan_ke')])
            ->where('anggota_id', $anggotaId)
            ->whereDate('created_at', $today)
            ->latest()
            ->get()
            ->map(fn($item) => [
                'tipe'       => 'pinjaman',
                'id'         => $item->id,
                'tanggal'    => $item->created_at,
                'jenis'      => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'sub'        => $item->jenis_pinjaman,
                'status'     => ucfirst($item->status),
                'nominal'    => $item->jumlah_pengajuan,
                'keterangan' => null,
                'cicilan'    => $item->cicilan,
            ]);

        $transaksiCicilan = Cicilan::with('pinjaman')
            ->whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))
            ->where('status', 'lunas')
            ->whereNotNull('tanggal_bayar')
            ->whereDate('tanggal_bayar', $today)
            ->latest()
            ->get()
            ->map(fn($item) => [
                'tipe'       => 'cicilan',
                'id'         => $item->id,
                'tanggal'    => $item->updated_at,
                'jenis'      => 'Cicilan Ke-' . $item->cicilan_ke,
                'sub'        => 'cicilan',
                'status'     => 'Lunas',
                'nominal'    => $item->jumlah_tagihan,
                'keterangan' => null,
                'cicilan'    => collect(),
            ]);

        $transaksi_terbaru = collect()
            ->merge($transaksiSimpanan)
            ->merge($transaksiPinjaman)
            ->merge($transaksiCicilan)
            ->sortByDesc('tanggal');

        $displayedTransaksi = $this->showAllTransaksi
            ? $transaksi_terbaru
            : $transaksi_terbaru->take(10);

        return view(
            'livewire.anggota.dashboard',
            compact(
                'total_simpanan',
                'simpanan_wajib',
                'simpanan_pokok',
                'simpanan_sukarela',

                'total_pinjaman',
                'pinjaman_biasa',
                'pinjaman_khusus',

                'total_cicilan',
                'totalBelumBayar',
                'totalLunas',

                'transaksi_terbaru',
                'displayedTransaksi'
            )
        );
    }
}

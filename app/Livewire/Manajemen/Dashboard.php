<?php

namespace App\Livewire\Manajemen;

use App\Models\Anggota;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];
    public function render()
    {
        $simpananList = Simpanan::with('anggota')
            ->latest()->take(20)->get()
            ->map(fn($item) => (object)[
                'tipe'         => 'simpanan',
                'id'           => $item->id,
                'created_at'   => $item->created_at,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'nominal'      => $item->jumlah,
                'status'       => 'Berhasil',
                'cicilan'      => collect(),
            ]);

        $pinjamanList = Pinjaman::with(['anggota', 'cicilan' => fn($q) => $q->orderBy('cicilan_ke')])
            ->latest()->take(20)->get()
            ->map(fn($item) => (object)[
                'tipe'         => 'pinjaman',
                'id'           => $item->id,
                'created_at'   => $item->created_at,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'nominal'      => $item->jumlah_pengajuan,
                'status'       => ucfirst($item->status),
                'cicilan'      => $item->cicilan,
            ]);

        $transaksiTerbaru = $simpananList
            ->merge($pinjamanList)
            ->sortByDesc('created_at')
            ->take(10);

        $today = Carbon::today();

        $totalPinjaman = Pinjaman::where(
            'status',
            'aktif'
        )->sum('jumlah_pengajuan');

        $pinjamanBiasa = Pinjaman::where(
            'jenis_pinjaman',
            'biasa'
        )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $pinjamanKhusus = Pinjaman::where(
            'jenis_pinjaman',
            'khusus'
        )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $totalMasukHariIni =
            Simpanan::whereDate(
                'tanggal',
                $today
            )->sum('jumlah')

            +

            Cicilan::whereDate(
                'tanggal_bayar',
                $today
            )->sum('jumlah_tagihan');

        $totalKeluarHariIni =
            Pinjaman::whereDate(
                'tanggal_persetujuan',
                $today
            )
            ->where('status', 'aktif')
            ->sum('dana_diterima');

        $transaksiHariIni =
            $totalMasukHariIni +
            $totalKeluarHariIni;
        return view('livewire.manajemen.dashboard', [
            // ANGGOTA
            'total_anggota' => Anggota::count(),
            'anggota_disetujui' => User::where('role', 'anggota')
                ->where('status', 'disetujui')
                ->count(),
            'anggota_menunggu' => User::where('role', 'anggota')
                ->where('status', 'menunggu')
                ->count(),
            // SIMPANAN
            'total_simpanan' => Simpanan::sum('jumlah'),
            'simpanan_wajib' => Simpanan::where('jenis_simpanan', 'wajib')
                ->sum('jumlah'),
            'simpanan_pokok' => Simpanan::where('jenis_simpanan', 'pokok')
                ->sum('jumlah'),
            'simpanan_sukarela' => Simpanan::where('jenis_simpanan', 'sukarela')
                ->sum('jumlah'),

            'totalPinjaman' => $totalPinjaman,

            'pinjamanBiasa' => $pinjamanBiasa,

            'pinjamanKhusus' => $pinjamanKhusus,

            'totalMasukHariIni' => $totalMasukHariIni,

            'totalKeluarHariIni' => $totalKeluarHariIni,

            'transaksiHariIni' => $transaksiHariIni,
            'transaksiTerbaru' => $transaksiTerbaru,
        ]);
    }
}

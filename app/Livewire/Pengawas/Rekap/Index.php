<?php

namespace App\Livewire\Pengawas\Rekap;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\RekapHarian;
use App\Models\Simpanan;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $today = Carbon::today();

        $totalMasuk =
            Simpanan::whereDate('tanggal', $today)->sum('jumlah')
            + Cicilan::whereDate('tanggal_bayar', $today)->sum('jumlah_tagihan')
            + RekapHarian::whereDate('tanggal', $today)->where('jenis', 'uang_masuk')->sum('nominal');

        $totalKeluar =
            Pinjaman::whereDate('tanggal_persetujuan', $today)->where('status', 'aktif')->sum('jumlah_pengajuan')
            + RekapHarian::whereDate('tanggal', $today)->where('jenis', 'uang_keluar')->sum('nominal');

        $saldo = $totalMasuk - $totalKeluar;

        $simpanan = Simpanan::with('anggota')
            ->whereDate('tanggal', $today)
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'masuk'        => $item->jumlah,
                'keluar'       => 0,
                'keterangan'   => '-',
            ]);

        $cicilan = Cicilan::with('pinjaman.anggota')
            ->whereDate('tanggal_bayar', $today)
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal_bayar,
                'kode_anggota' => $item->pinjaman?->anggota?->kode_anggota ?? '-',
                'nama_anggota' => $item->pinjaman?->anggota?->nama_anggota ?? '-',
                'jenis'        => 'Cicilan',
                'masuk'        => $item->jumlah_tagihan,
                'keluar'       => 0,
                'keterangan'   => '-',
            ]);

        $pinjaman = Pinjaman::with('anggota')
            ->whereDate('tanggal_persetujuan', $today)
            ->where('status', 'aktif')
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal_persetujuan,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'masuk'        => 0,
                'keluar'       => $item->jumlah_pengajuan,
                'keterangan'   => '-',
            ]);

        $rekapManual = RekapHarian::with('user')
            ->whereDate('tanggal', $today)
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal,
                'kode_anggota' => '-',
                'nama_anggota' => $item->user->nama_user ?? '-',
                'jenis'        => $item->jenis === 'uang_masuk' ? 'Uang Masuk (Manual)' : 'Uang Keluar (Manual)',
                'masuk'        => $item->jenis === 'uang_masuk' ? $item->nominal : 0,
                'keluar'       => $item->jenis === 'uang_keluar' ? $item->nominal : 0,
                'keterangan'   => $item->keterangan,
            ]);

        $riwayat = $simpanan
            ->merge($cicilan)
            ->merge($pinjaman)
            ->merge($rekapManual)
            ->sortByDesc('tanggal')
            ->values();

        return view('livewire.pengawas.rekap.index', [
            'title'       => 'Rekapitulasi Harian',
            'totalMasuk'  => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo'       => $saldo,
            'riwayat'     => $riwayat,
        ]);
    }
}

<?php

namespace App\Livewire\Pengawas;

use App\Models\Anggota;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\RekapHarian;
use App\Models\Simpanan;
use App\Models\User;
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
        $simpananList = Simpanan::with('anggota')
            ->latest()->get()
            ->map(fn($item) => (object)[
                'tipe'         => 'simpanan',
                'id'           => $item->id,
                'created_at'   => $item->created_at,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'sub'          => $item->jenis_simpanan,
                'nominal'      => $item->jumlah,
                'status'       => 'Berhasil',
                'keterangan'   => null,
                'pinjaman_id'  => null,
            ]);

        $pinjamanList = Pinjaman::with('anggota')
            ->latest()->get()
            ->map(fn($item) => (object)[
                'tipe'         => 'pinjaman',
                'id'           => $item->id,
                'created_at'   => $item->created_at,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'sub'          => $item->jenis_pinjaman,
                'nominal'      => $item->jumlah_pengajuan,
                'status'       => ucfirst($item->status),
                'keterangan'   => null,
                'pinjaman_id'  => null,
            ]);

        $rekapList = RekapHarian::with('user')
            ->latest()->get()
            ->map(fn($item) => (object)[
                'tipe'         => 'rekap',
                'id'           => $item->id,
                'created_at'   => $item->created_at,
                'kode_anggota' => '-',
                'nama_anggota' => $item->user->nama_user ?? 'Manajemen',
                'jenis'        => 'Rekap Manual',
                'sub'          => $item->jenis === 'uang_masuk' ? 'masuk' : 'keluar',
                'nominal'      => $item->nominal,
                'status'       => 'Dicatat',
                'keterangan'   => $item->keterangan,
                'pinjaman_id'  => null,
            ]);

        $cicilanLunasList = Cicilan::with(['pinjaman.anggota'])
            ->where('status', 'lunas')
            ->whereNotNull('tanggal_bayar')
            ->latest()->get()
            ->map(fn($item) => (object)[
                'tipe'         => 'cicilan',
                'id'           => $item->id,
                'pinjaman_id'  => $item->pinjaman_id,
                'created_at'   => $item->updated_at,
                'kode_anggota' => $item->pinjaman?->anggota?->kode_anggota ?? '-',
                'nama_anggota' => $item->pinjaman?->anggota?->nama_anggota ?? '-',
                'jenis'        => 'Cicilan Ke-' . $item->cicilan_ke . ' (' . ucfirst($item->pinjaman?->jenis_pinjaman ?? '') . ')',
                'sub'          => 'cicilan',
                'nominal'      => $item->jumlah_tagihan,
                'status'       => 'Lunas',
                'keterangan'   => null,
            ]);

        $transaksiTerbaru = $simpananList
            ->merge($pinjamanList)
            ->merge($rekapList)
            ->merge($cicilanLunasList)
            ->sortByDesc('created_at');

        $displayedTransaksi = $this->showAllTransaksi
            ? $transaksiTerbaru
            : $transaksiTerbaru->take(10);

        $today = Carbon::today();

        $totalPinjaman  = Pinjaman::where('status', 'aktif')->sum('jumlah_pengajuan');
        $pinjamanBiasa  = Pinjaman::where('jenis_pinjaman', 'biasa')->where('status', 'aktif')->sum('jumlah_pengajuan');
        $pinjamanKhusus = Pinjaman::where('jenis_pinjaman', 'khusus')->where('status', 'aktif')->sum('jumlah_pengajuan');

        $totalMasukHariIni =
            Simpanan::whereDate('tanggal', $today)->sum('jumlah')
            + Cicilan::whereDate('tanggal_bayar', $today)->sum('jumlah_tagihan')
            + RekapHarian::whereDate('tanggal', $today)->where('jenis', 'uang_masuk')->sum('nominal');

        $totalKeluarHariIni =
            Pinjaman::whereDate('tanggal_persetujuan', $today)->where('status', 'aktif')->sum('dana_diterima')
            + RekapHarian::whereDate('tanggal', $today)->where('jenis', 'uang_keluar')->sum('nominal');

        $transaksiHariIni = $totalMasukHariIni + $totalKeluarHariIni;

        return view('livewire.pengawas.dashboard', [
            'total_anggota'      => Anggota::count(),
            'anggota_disetujui'  => User::where('role', 'anggota')->where('status', 'disetujui')->count(),
            'anggota_menunggu'   => User::where('role', 'anggota')->where('status', 'menunggu')->count(),
            'total_simpanan'     => Simpanan::sum('jumlah'),
            'simpanan_wajib'     => Simpanan::where('jenis_simpanan', 'wajib')->sum('jumlah'),
            'simpanan_pokok'     => Simpanan::where('jenis_simpanan', 'pokok')->sum('jumlah'),
            'simpanan_sukarela'  => Simpanan::where('jenis_simpanan', 'sukarela')->sum('jumlah'),
            'totalPinjaman'      => $totalPinjaman,
            'pinjamanBiasa'      => $pinjamanBiasa,
            'pinjamanKhusus'     => $pinjamanKhusus,
            'totalMasukHariIni'  => $totalMasukHariIni,
            'totalKeluarHariIni' => $totalKeluarHariIni,
            'transaksiHariIni'   => $transaksiHariIni,
            'transaksiTerbaru'   => $transaksiTerbaru,
            'displayedTransaksi' => $displayedTransaksi,
        ]);
    }
}

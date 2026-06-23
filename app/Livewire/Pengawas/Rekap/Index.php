<?php

namespace App\Livewire\Pengawas\Rekap;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\RekapHarian;
use App\Models\Simpanan;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search      = '';
    public string $filterJenis = '';
    public string $tanggal     = '';
    public int    $paginate    = 10;

    public function mount(): void
    {
        $this->tanggal = today()->toDateString();
    }

    public function updatingSearch(): void      { $this->resetPage(); }
    public function updatingFilterJenis(): void { $this->resetPage(); }
    public function updatingTanggal(): void     { $this->resetPage(); }
    public function updatingPaginate(): void    { $this->resetPage(); }

    public function render()
    {
        $date = $this->tanggal ? Carbon::parse($this->tanggal) : Carbon::today();

        $simpanan = Simpanan::with('anggota')
            ->whereDate('tanggal', $date)
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Simpanan ' . ucfirst($item->jenis_simpanan),
                'jenis_key'    => 'uang_masuk',
                'masuk'        => $item->jumlah,
                'keluar'       => 0,
                'keterangan'   => '-',
            ]);

        $cicilan = Cicilan::with('pinjaman.anggota')
            ->whereDate('tanggal_bayar', $date)
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal_bayar,
                'kode_anggota' => $item->pinjaman?->anggota?->kode_anggota ?? '-',
                'nama_anggota' => $item->pinjaman?->anggota?->nama_anggota ?? '-',
                'jenis'        => 'Cicilan',
                'jenis_key'    => 'uang_masuk',
                'masuk'        => $item->jumlah_tagihan,
                'keluar'       => 0,
                'keterangan'   => '-',
            ]);

        $pinjaman = Pinjaman::with('anggota')
            ->whereDate('tanggal_persetujuan', $date)
            ->where('status', 'aktif')
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal_persetujuan,
                'kode_anggota' => $item->anggota->kode_anggota ?? '-',
                'nama_anggota' => $item->anggota->nama_anggota ?? '-',
                'jenis'        => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),
                'jenis_key'    => 'uang_keluar',
                'masuk'        => 0,
                'keluar'       => $item->jumlah_pengajuan,
                'keterangan'   => '-',
            ]);

        $rekapManual = RekapHarian::with('user')
            ->whereDate('tanggal', $date)
            ->get()
            ->map(fn($item) => [
                'tanggal'      => $item->tanggal,
                'kode_anggota' => '-',
                'nama_anggota' => '-',
                'jenis'        => $item->keterangan,
                'jenis_key'    => $item->jenis,
                'masuk'        => $item->jenis === 'uang_masuk' ? $item->nominal : 0,
                'keluar'       => $item->jenis === 'uang_keluar' ? $item->nominal : 0,
                'keterangan'   => $item->keterangan,
            ]);

        $semua = $simpanan->concat($cicilan)->concat($pinjaman)->concat($rekapManual);

        $totalMasuk  = $semua->sum('masuk');
        $totalKeluar = $semua->sum('keluar');
        $saldo       = $totalMasuk - $totalKeluar;

        $filtered = $semua
            ->when($this->search, fn($col) => $col->filter(
                fn($item) => str_contains(strtolower($item['nama_anggota']), strtolower($this->search))
                    || str_contains(strtolower($item['kode_anggota']), strtolower($this->search))
                    || str_contains(strtolower($item['jenis']), strtolower($this->search))
                    || str_contains(strtolower($item['keterangan']), strtolower($this->search))
            ))
            ->when($this->filterJenis, fn($col) => $col->filter(
                fn($item) => $item['jenis_key'] === $this->filterJenis
            ))
            ->sortByDesc('tanggal')
            ->values();

        $currentPage = $this->getPage();
        $riwayat = new LengthAwarePaginator(
            $filtered->forPage($currentPage, $this->paginate),
            $filtered->count(),
            $this->paginate,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.pengawas.rekap.index', [
            'title'       => 'Rekapitulasi Harian',
            'totalMasuk'  => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldo'       => $saldo,
            'riwayat'     => $riwayat,
        ]);
    }
}

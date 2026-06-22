<?php
namespace App\Livewire\Anggota\Pinjaman;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Support\Carbon;
use Livewire\Component;
class Create extends Component
{
    public $anggota_id;
    public $jumlah_pengajuan;
    public $tenor = 6;
    public $tujuan_pinjaman;
    public $jaminan;
    public $total_simpanan = 0;
    public $jenis_pinjaman = '';
    public $bunga = 0;
    public $cicilan_per_bulan = 0;
    public $total_pembayaran = 0;
    public $provisi = 0;
    public $kapitalisasi = 0;
    public $dana_perlindungan = 0;
    public $dana_diterima = 0;
    public $jasa_per_bulan = 0;
    public $errorPinjaman = '';
    public function mount()
    {
        $anggota = auth()->user()->anggota;
        $this->anggota_id = $anggota->id;
        $this->total_simpanan = Simpanan::where(
            'anggota_id',
            $anggota->id
        )->sum('jumlah');
    }
    public function updatedJumlahPengajuan()
    {
        $this->hitungPinjaman();
    }
    public function updatedTenor()
    {
        $this->hitungPinjaman();
    }
    public function updatedJenisPinjaman()
    {
        if ($this->jenis_pinjaman == 'biasa') {
            $this->bunga = 0.6;
        } elseif ($this->jenis_pinjaman == 'khusus') {
            $this->bunga = 1.2;
        } else {
            $this->bunga = 0;
        }
        $this->hitungPinjaman();
    }
    private function hitungPinjaman()
    {
        if (
            ! $this->jumlah_pengajuan ||
            ! $this->tenor ||
            ! $this->jenis_pinjaman
        ) {
            return;
        }
        // PROVISI 1.5%
        $this->provisi =
            $this->jumlah_pengajuan * 0.015;
        // KAPITALISASI 1%
        $this->kapitalisasi =
            $this->jumlah_pengajuan * 0.01;
        // DANA PERLINDUNGAN 2%
        $this->dana_perlindungan =
            $this->jumlah_pengajuan * 0.02;
        // DANA DITERIMA ANGGOTA
        $this->dana_diterima =
            $this->jumlah_pengajuan
            - $this->provisi
            - $this->kapitalisasi
            - $this->dana_perlindungan;
        // POKOK CICILAN
        $pokokPerBulan =
            $this->jumlah_pengajuan /
            $this->tenor;
        // JASA PINJAMAN PER BULAN
        $this->jasa_per_bulan =
            $this->jumlah_pengajuan *
            ($this->bunga / 100);
        // CICILAN PER BULAN
        $this->cicilan_per_bulan =
            $pokokPerBulan +
            $this->jasa_per_bulan;
        // TOTAL PEMBAYARAN
        $this->total_pembayaran =
            $this->cicilan_per_bulan *
            $this->tenor;
    }
    public function simpan()
    {
        try {
            if (
                $this->jenis_pinjaman == 'biasa' &&
                $this->jumlah_pengajuan > $this->total_simpanan
            ) {
                $this->errorPinjaman =
                    'Pinjaman biasa tidak boleh melebihi total simpanan anggota.';
                return;
            }
            $this->errorPinjaman = '';
            $anggota = auth()->user()->anggota;
            if (
                Carbon::parse($anggota->tanggal_daftar)
                ->diffInMonths(now()) < 6
            ) {
                $this->addError(
                    'anggota_id',
                    'Pinjaman hanya dapat diajukan setelah menjadi anggota minimal 6 bulan.'
                );
                return;
            }
            $this->validate([
                'anggota_id' => 'required',
                'jenis_pinjaman' => 'required',
                'jumlah_pengajuan' => 'required|numeric|min:100000',
                'tenor' => 'required',
                'tujuan_pinjaman' => 'required',
            ]);
            Pinjaman::create([
                'anggota_id' => $this->anggota_id,
                'jenis_pinjaman' => $this->jenis_pinjaman,
                'jumlah_pengajuan' => $this->jumlah_pengajuan,
                'total_simpanan' => $this->total_simpanan,
                'bunga' => $this->bunga,
                'provisi' => $this->provisi,
                'kapitalisasi' => $this->kapitalisasi,
                'dana_perlindungan' => $this->dana_perlindungan,
                'dana_diterima' => $this->dana_diterima,
                'tenor' => $this->tenor,
                'tujuan_pinjaman' => $this->tujuan_pinjaman,
                'jaminan' => $this->jaminan,
                'cicilan_per_bulan' => $this->cicilan_per_bulan,
                'total_pembayaran' => $this->total_pembayaran,
                'tanggal_pengajuan' => now(),
                'status' => 'pending',
            ]);
            session()->flash(
                'success',
                'Pengajuan pinjaman berhasil'
            );
            return redirect()->route('anggota.pinjaman.index');
        } catch (\Exception $e) {
            logger()->error('Gagal mengajukan pinjaman: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
    public function render()
    {
        return view(
            'livewire.anggota.pinjaman.create',
            [
                'title' => 'Mengajukan Pinjaman',
            ]
        );
    }
}

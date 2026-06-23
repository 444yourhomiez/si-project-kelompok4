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
    public $tujuan_lainnya  = '';
    public $jaminan;
    public $jaminan_lainnya = '';
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
    protected $listeners = ['openCreate' => 'resetCreate'];
    public function mount()
    {
        $anggota = auth()->user()->anggota;
        $this->anggota_id = $anggota->id;
        $this->total_simpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
    }
    public function resetCreate()
    {
        $this->reset([
            'jumlah_pengajuan', 'tujuan_pinjaman', 'tujuan_lainnya', 'jaminan', 'jaminan_lainnya',
            'jenis_pinjaman', 'bunga', 'cicilan_per_bulan', 'total_pembayaran', 'provisi',
            'kapitalisasi', 'dana_perlindungan', 'dana_diterima', 'jasa_per_bulan', 'errorPinjaman',
        ]);
        $this->tenor = 6;
    }
    public function updatedJumlahPengajuan()
    {
        $this->hitungPinjaman();
    }
    public function updatedTenor()
    {
        if ($this->tenor !== null && $this->tenor !== '' && (int) $this->tenor < 6) {
            $this->addError('tenor', 'Tenor minimal 6 bulan.');
            $this->resetSimulasi();
            return;
        }
        $this->resetValidation('tenor');
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
    private function resetSimulasi()
    {
        $this->cicilan_per_bulan = 0;
        $this->total_pembayaran  = 0;
        $this->provisi           = 0;
        $this->kapitalisasi      = 0;
        $this->dana_perlindungan = 0;
        $this->dana_diterima     = 0;
        $this->jasa_per_bulan    = 0;
    }

    private function hitungPinjaman()
    {
        if (! $this->jumlah_pengajuan || ! $this->tenor || ! $this->jenis_pinjaman || (int) $this->tenor < 6) {
            return;
        }
        $this->provisi          = $this->jumlah_pengajuan * 0.015;
        $this->kapitalisasi     = $this->jumlah_pengajuan * 0.01;
        $this->dana_perlindungan = $this->jumlah_pengajuan * 0.02;
        $this->dana_diterima    = $this->jumlah_pengajuan - $this->provisi - $this->kapitalisasi - $this->dana_perlindungan;
        $pokokPerBulan          = $this->jumlah_pengajuan / $this->tenor;
        $this->jasa_per_bulan   = $this->jumlah_pengajuan * ($this->bunga / 100);
        $this->cicilan_per_bulan = $pokokPerBulan + $this->jasa_per_bulan;
        $this->total_pembayaran = $this->cicilan_per_bulan * $this->tenor;
    }
    public function simpan()
    {
        try {
            if ($this->jenis_pinjaman == 'biasa' && $this->jumlah_pengajuan > $this->total_simpanan) {
                $this->errorPinjaman = 'Pinjaman biasa tidak boleh melebihi total simpanan anggota.';
                return;
            }
            $this->errorPinjaman = '';
            $anggota = auth()->user()->anggota;
            if (Carbon::parse($anggota->tanggal_daftar)->diffInMonths(now()) < 6) {
                $this->addError('anggota_id', 'Pinjaman hanya dapat diajukan setelah menjadi anggota minimal 6 bulan.');
                return;
            }
            $this->validate([
                'anggota_id'       => 'required',
                'jenis_pinjaman'   => 'required',
                'jumlah_pengajuan' => 'required|numeric|min:100000',
                'tenor'            => 'required|integer|min:6',
                'tujuan_pinjaman'  => 'required',
                'tujuan_lainnya'   => $this->tujuan_pinjaman === 'Lainnya' ? 'required' : 'nullable',
                'jaminan_lainnya'  => $this->jaminan === 'Lainnya' ? 'required' : 'nullable',
            ], [
                'tenor.min'             => 'Tenor minimal 6 bulan.',
                'tenor.integer'         => 'Tenor harus berupa angka bulan.',
                'tujuan_pinjaman.required' => 'Tujuan pinjaman wajib dipilih.',
                'tujuan_lainnya.required'  => 'Mohon isi tujuan pinjaman.',
                'jaminan_lainnya.required' => 'Mohon isi keterangan jaminan.',
            ]);

            $tujuan = $this->tujuan_pinjaman === 'Lainnya' ? $this->tujuan_lainnya : $this->tujuan_pinjaman;
            $jaminan = $this->jaminan === 'Lainnya' ? $this->jaminan_lainnya : $this->jaminan;

            Pinjaman::create([
                'anggota_id'       => $this->anggota_id,
                'jenis_pinjaman'   => $this->jenis_pinjaman,
                'jumlah_pengajuan' => $this->jumlah_pengajuan,
                'total_simpanan'   => $this->total_simpanan,
                'bunga'            => $this->bunga,
                'provisi'          => $this->provisi,
                'kapitalisasi'     => $this->kapitalisasi,
                'dana_perlindungan' => $this->dana_perlindungan,
                'dana_diterima'    => $this->dana_diterima,
                'tenor'            => $this->tenor,
                'tujuan_pinjaman'  => $tujuan,
                'jaminan'          => $jaminan,
                'cicilan_per_bulan' => $this->cicilan_per_bulan,
                'total_pembayaran' => $this->total_pembayaran,
                'tanggal_pengajuan' => now(),
                'status'           => 'pending',
            ]);
            $this->resetCreate();
            $this->dispatch('closeCreateModal');
            $this->dispatch('dataKoperasiUpdated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            logger()->error('Gagal mengajukan pinjaman: ' . $e->getMessage());
            $this->errorPinjaman = 'Terjadi kesalahan, silakan coba lagi.';
        }
    }
    public function render()
    {
        return view('livewire.anggota.pinjaman.create', ['title' => 'Mengajukan Pinjaman']);
    }
}

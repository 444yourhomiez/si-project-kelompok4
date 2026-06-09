<?php

namespace App\Livewire\Auth;

use App\Models\Anggota;
use App\Models\JadwalWawancara;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterWizard extends Component
{
    // STEP 1
    public $nama_user, $email, $password, $password_confirmation;

    // STEP 2
    public $nama_anggota, $no_hp, $no_ktp, $alamat, $tempat_lahir, $tanggal_lahir;
    public $jenis_kelamin, $agama, $nama_ibu_kandung;
    public $status_rumah, $penghasilan;
    public $tanggal_kawin, $nama_pasangan;
    public $nama_ahli_waris, $hubungan_ahli_waris;

    // STEP 3
    public $tanggal_wawancara;
    public $jadwal_id;

    public $step = 1;

    public function prev()
    {
        $this->step--;
        $this->reset('jadwal_id');
    }

    // ================= STEP 1 =================
    public function saveStep1()
    {
        $this->validate([
            'nama_user' => 'required',

            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',

            'password' => 'required|min:8|confirmed',

            'password_confirmation' => 'required|same:password'

        ], [

            // NAMA
            'nama_user.required' => 'Nama pengguna wajib diisi',

            // EMAIL
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'email.regex' => 'Hanya email @gmail.com yang diperbolehkan',

            // PASSWORD
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',

            // KONFIRMASI PASSWORD
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password'

        ]);

        // ❌ TIDAK SIMPAN KE DATABASE
        $this->step = 2;
    }

    // ================= STEP 2 =================
    public function saveStep2()
    {
        $this->validate([
            'nama_anggota' => 'required',

            'no_ktp' => 'required|digits:16|unique:anggota,no_ktp',

            'no_hp' => 'required|digits_between:10,13|unique:anggota,no_hp',

            'jenis_kelamin' => 'required',

            'alamat' => 'required',

            'tempat_lahir' => 'required',

            'tanggal_lahir' => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),

            'agama' => 'required',

            'nama_ibu_kandung' => 'required',

            'status_rumah' => 'required',

            'penghasilan' => 'required',

            'nama_ahli_waris' => 'required',

            'hubungan_ahli_waris' => 'required',

        ], [

            // NAMA
            'nama_anggota.required' => 'Nama lengkap wajib diisi',

            // KTP
            'no_ktp.required' => 'Nomor KTP wajib diisi',
            'no_ktp.digits' => 'Nomor KTP harus 16 digit',
            'no_ktp.unique' => 'Nomor KTP sudah terdaftar',

            // HP
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.digits_between' => 'Nomor HP harus 10 - 13 digit',
            'no_hp.unique' => 'Nomor HP sudah digunakan',

            // JK
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',

            // ALAMAT
            'alamat.required' => 'Alamat wajib diisi',

            // TEMPAT LAHIR
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',

            // TANGGAL LAHIR
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'tanggal_lahir.before_or_equal' => 'Minimal usia 17 tahun',

            // AGAMA
            'agama.required' => 'Agama wajib dipilih',

            // IBU
            'nama_ibu_kandung.required' => 'Nama ibu kandung wajib diisi',

            // STATUS RUMAH
            'status_rumah.required' => 'Status rumah wajib dipilih',

            // PENGHASILAN
            'penghasilan.required' => 'Penghasilan wajib dipilih',

            // AHLI WARIS
            'nama_ahli_waris.required' => 'Nama ahli waris wajib diisi',

            'hubungan_ahli_waris.required' => 'Hubungan ahli waris wajib dipilih',

        ]);

        // ❌ TIDAK SIMPAN KE DATABASE
        $this->step = 3;
    }

    // ================= JADWAL =================
    public function mount()
    {
        $this->tanggal_wawancara = now()->format('Y-m-d');
    }

    public function pilihJadwal($waktu)
    {
        logger('PILIH: ' . $waktu);
        $this->jadwal_id = $waktu;
    }

    public function updatedTanggalWawancara()
    {
        $this->reset('jadwal_id');
        $this->jadwal_id = null;
    }

    public function getJadwalListProperty()
    {
        if (!$this->tanggal_wawancara) {
            return collect();
        }

        $jadwalList = collect();

        for ($jam = 9; $jam <= 14; $jam++) {

            $start = str_pad($jam, 2, '0', STR_PAD_LEFT) . ':00';

            $jadwal = \App\Models\JadwalWawancara::firstOrCreate(
                [
                    'tanggal' => $this->tanggal_wawancara,
                    'waktu' => $start,
                ],
                [
                    'kuota' => 5,
                    'terisi' => 0
                ]
            );

            // 🔥 tambahkan label ke model
            $jadwal->label =
                \Carbon\Carbon::parse($start)->format('H:i')
                . ' - ' .
                \Carbon\Carbon::parse($start)->addHour()->format('H:i');

            $jadwalList->push($jadwal);
        }

        return $jadwalList;
    }

    // ================= STEP 3 (SAVE SEMUA) =================
    public function saveStep3()
    {
        $this->validate([
            'jadwal_id' => 'required'
        ], [
            'jadwal_id.required' => 'Pilih jadwal terlebih dahulu'
        ]);

        $jadwal = JadwalWawancara::firstOrCreate(
            [
                'tanggal' => $this->tanggal_wawancara,
                'waktu' => $this->jadwal_id,
            ],
            [
                'kuota' => 5,
                'terisi' => 0
            ]
        );

        if ($jadwal->terisi >= $jadwal->kuota) {

            $this->addError(
                'jadwal_id',
                'Slot penuh'
            );

            return;
        }

        DB::transaction(function () use ($jadwal) {

            // BUAT USER
            $user = User::create([

                'email' => $this->email,

                'password' => Hash::make(
                    $this->password
                ),

                'nama_user' => $this->nama_user,

                'role' => 'anggota',

                'status' => 'menunggu'
            ]);

            // BUAT DATA ANGGOTA
            Anggota::create([

                'user_id' => $user->id,

                // KOSONG DULU
                'kode_anggota' => null,

                'nama_anggota' => $this->nama_anggota,

                'no_hp' => $this->no_hp,

                'no_ktp' => $this->no_ktp,

                'alamat' => $this->alamat,

                'tempat_lahir' => $this->tempat_lahir,

                'tanggal_lahir' => $this->tanggal_lahir,

                'jenis_kelamin' => $this->jenis_kelamin,

                'agama' => $this->agama,

                'nama_ibu_kandung' => $this->nama_ibu_kandung,

                'tanggal_kawin' => $this->tanggal_kawin,

                'nama_pasangan' => $this->nama_pasangan,

                'nama_ahli_waris' => $this->nama_ahli_waris,

                'hubungan_ahli_waris' => $this->hubungan_ahli_waris,

                'status_rumah' => $this->status_rumah,

                'penghasilan' => $this->penghasilan,

                'jadwal_id' => $this->jadwal_id,

                'tanggal_daftar' => now(),
            ]);

            // TAMBAH SLOT TERISI
            $jadwal->increment('terisi');

            // LOGIN
            Auth::login($user);
        });

        return redirect()->route('menunggu');
    }
}

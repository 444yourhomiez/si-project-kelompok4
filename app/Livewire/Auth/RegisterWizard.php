<?php
namespace App\Livewire\Auth;
use App\Models\Anggota;
use App\Models\JadwalWawancara;
use App\Models\User;
use App\Notifications\EmailOtpNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
class RegisterWizard extends Component
{
    // STEP 1 - Akun
    public $nama_user;
    public $email;
    public $password;
    public $password_confirmation;
    public string $emailOtpInput = '';
    public bool   $emailOtpSent  = false;
    public bool   $emailVerified = false;
    // STEP 2 - Biodata
    public $nama_anggota;
    public $no_hp;
    public $no_ktp;
    public $alamat;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $agama;
    public $nama_ibu_kandung;
    public $status_rumah;
    public $penghasilan;
    public $tanggal_kawin;
    public $nama_pasangan;
    public $nama_ahli_waris;
    public $hubungan_ahli_waris;
    // STEP 3 - Jadwal
    public $tanggal_wawancara;
    public $jadwal_id;
    public $step = 1;

    public function mount()
    {
        $this->tanggal_wawancara = now()->format('Y-m-d');
    }

    // Reset verifikasi jika email diubah
    public function updatedEmail()
    {
        $this->emailOtpSent  = false;
        $this->emailVerified = false;
        $this->emailOtpInput = '';
        session()->forget(['reg_email_otp', 'reg_email_otp_exp', 'reg_email_verified']);
    }

    public function prev()
    {
        $this->step--;
        $this->reset('jadwal_id');
    }

    // ================= EMAIL OTP =================
    public function sendEmailOtp()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email'    => 'Format email tidak valid',
            'email.unique'   => 'Email sudah terdaftar',
            'email.regex'    => 'Hanya email @gmail.com yang diperbolehkan',
        ]);
        $otp   = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = $this->email;
        session([
            'reg_email_otp'     => $otp,
            'reg_email_otp_exp' => now()->addMinutes(10),
        ]);
        logger()->info("[OTP] method dipanggil, akan kirim ke {$email}");
        dispatch(function () use ($otp, $email) {
            logger()->info("[OTP] closure berjalan untuk {$email}");
            try {
                Notification::route('mail', $email)->notify(new EmailOtpNotification($otp));
                logger()->info("[OTP] Email berhasil dikirim ke {$email}");
            } catch (\Exception $e) {
                logger()->error("[OTP] Email gagal ke {$email}: " . $e->getMessage());
            }
        })->afterResponse();
        $this->emailOtpSent  = true;
        $this->emailVerified = false;
        $this->emailOtpInput = '';
    }

    public function verifyEmailOtp()
    {
        $this->validate([
            'emailOtpInput' => 'required|digits:6',
        ], [
            'emailOtpInput.required' => 'Kode OTP wajib diisi',
            'emailOtpInput.digits'   => 'Kode OTP harus 6 digit angka',
        ]);
        $otp = session('reg_email_otp');
        $exp = session('reg_email_otp_exp');
        if (! $otp || ! $exp || now()->isAfter($exp)) {
            $this->addError('emailOtpInput', 'Kode OTP kedaluwarsa. Silakan kirim ulang.');
            return;
        }
        if ($this->emailOtpInput !== $otp) {
            $this->addError('emailOtpInput', 'Kode OTP tidak valid.');
            return;
        }
        session()->forget(['reg_email_otp', 'reg_email_otp_exp']);
        session(['reg_email_verified' => true]);
        $this->emailVerified = true;
        $this->emailOtpInput = '';
    }

    // ================= STEP 1: AKUN =================
    public function saveStep1()
    {
        $this->validate([
            'nama_user'             => 'required',
            'email'                 => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'nama_user.required'             => 'Nama pengguna wajib diisi',
            'email.required'                 => 'Email wajib diisi',
            'email.email'                    => 'Format email tidak valid',
            'email.unique'                   => 'Email sudah terdaftar',
            'email.regex'                    => 'Hanya email @gmail.com yang diperbolehkan',
            'password.required'              => 'Password wajib diisi',
            'password.min'                   => 'Password minimal 8 karakter',
            'password.confirmed'             => 'Konfirmasi password tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same'     => 'Konfirmasi password harus sama dengan password',
        ]);
        if (! $this->emailVerified) {
            $this->addError('email', 'Verifikasi email terlebih dahulu.');
            return;
        }
        $this->step = 2;
    }

    // ================= STEP 2: BIODATA =================
    public function saveStep2()
    {
        $this->validate([
            'nama_anggota'        => 'required',
            'no_ktp'              => 'required|digits:16|unique:anggota,no_ktp',
            'no_hp'               => 'required|digits_between:10,13|unique:anggota,no_hp',
            'jenis_kelamin'       => 'required',
            'alamat'              => 'required',
            'tempat_lahir'        => 'required',
            'tanggal_lahir'       => 'required|date',
            'agama'               => 'required',
            'nama_ibu_kandung'    => 'required',
            'status_rumah'        => 'required',
            'penghasilan'         => 'required',
            'nama_ahli_waris'     => 'required',
            'hubungan_ahli_waris' => 'required',
        ], [
            'nama_anggota.required'         => 'Nama lengkap wajib diisi',
            'no_ktp.required'               => 'Nomor KTP wajib diisi',
            'no_ktp.digits'                 => 'Nomor KTP harus 16 digit',
            'no_ktp.unique'                 => 'Nomor KTP sudah terdaftar',
            'no_hp.required'                => 'Nomor HP wajib diisi',
            'no_hp.digits_between'          => 'Nomor HP harus 10 - 13 digit',
            'no_hp.unique'                  => 'Nomor HP sudah digunakan',
            'jenis_kelamin.required'        => 'Jenis kelamin wajib dipilih',
            'alamat.required'               => 'Alamat wajib diisi',
            'tempat_lahir.required'         => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required'        => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date'            => 'Format tanggal lahir tidak valid',
            'agama.required'                => 'Agama wajib dipilih',
            'nama_ibu_kandung.required'     => 'Nama ibu kandung wajib diisi',
            'status_rumah.required'         => 'Status rumah wajib dipilih',
            'penghasilan.required'          => 'Penghasilan wajib dipilih',
            'nama_ahli_waris.required'      => 'Nama ahli waris wajib diisi',
            'hubungan_ahli_waris.required'  => 'Hubungan ahli waris wajib dipilih',
        ]);
        $this->step = 3;
    }

    // ================= JADWAL =================
    public function pilihJadwal($id)
    {
        $this->jadwal_id = $id;
    }

    public function updatedTanggalWawancara()
    {
        $this->reset('jadwal_id');
        $this->jadwal_id = null;
    }

    public function getJadwalListProperty()
    {
        if (! $this->tanggal_wawancara) {
            return collect();
        }
        $jadwalList = collect();
        for ($jam = 9; $jam <= 14; $jam++) {
            $start  = str_pad($jam, 2, '0', STR_PAD_LEFT) . ':00';
            $jadwal = JadwalWawancara::firstOrCreate(
                ['tanggal' => $this->tanggal_wawancara, 'waktu' => $start],
                ['kuota' => 5, 'terisi' => 0]
            );
            $jadwal->label =
                Carbon::parse($start)->format('H:i')
                . ' - '
                . Carbon::parse($start)->addHour()->format('H:i');
            $jadwalList->push($jadwal);
        }
        return $jadwalList;
    }

    // ================= STEP 3: SIMPAN SEMUA =================
    public function saveStep3()
    {
        if (! $this->emailVerified || ! session('reg_email_verified')) {
            $this->emailVerified = false;
            $this->step = 1;
            return;
        }
        $this->validate([
            'jadwal_id' => 'required',
        ], [
            'jadwal_id.required' => 'Pilih jadwal terlebih dahulu',
        ]);
        $jadwal = JadwalWawancara::findOrFail($this->jadwal_id);
        if ($jadwal->terisi >= $jadwal->kuota) {
            $this->addError('jadwal_id', 'Slot penuh');
            return;
        }
        DB::transaction(function () use ($jadwal) {
            $user = User::create([
                'email'             => $this->email,
                'password'          => Hash::make($this->password),
                'nama_user'         => $this->nama_user,
                'role'              => 'anggota',
                'status'            => 'menunggu',
                'email_verified_at' => now(),
            ]);
            Anggota::create([
                'user_id'             => $user->id,
                'kode_anggota'        => null,
                'nama_anggota'        => $this->nama_anggota,
                'no_hp'               => $this->no_hp,
                'no_ktp'              => $this->no_ktp,
                'alamat'              => $this->alamat,
                'tempat_lahir'        => $this->tempat_lahir,
                'tanggal_lahir'       => $this->tanggal_lahir,
                'jenis_kelamin'       => $this->jenis_kelamin,
                'agama'               => $this->agama,
                'nama_ibu_kandung'    => $this->nama_ibu_kandung,
                'tanggal_kawin'       => $this->tanggal_kawin,
                'nama_pasangan'       => $this->nama_pasangan,
                'nama_ahli_waris'     => $this->nama_ahli_waris,
                'hubungan_ahli_waris' => $this->hubungan_ahli_waris,
                'status_rumah'        => $this->status_rumah,
                'penghasilan'         => $this->penghasilan,
                'jadwal_id'           => $this->jadwal_id,
                'tanggal_daftar'      => now(),
            ]);
            $jadwal->increment('terisi');
            Auth::login($user);
        });
        session()->forget('reg_email_verified');
        return redirect()->route('menunggu');
    }
}

<?php
namespace App\Livewire\Manajemen\Anggota;
use App\Models\Anggota;
use App\Livewire\Manajemen\Anggota\Index;
use Livewire\Component;
class Edit extends Component
{
    protected $listeners = [
        'refreshAnggota' => 'resetEditState',
        'openEdit'       => 'edit',
        'prosesUpdate'   => 'update',
    ];

    // Identitas
    public ?int    $anggota_id   = null;
    public ?string $kode_anggota = null;
    public ?string $status       = null;

    // Akun
    public ?string $email = null;

    // Biodata
    public ?string $nama_anggota      = null;
    public ?string $no_ktp            = null;
    public ?string $no_hp             = null;
    public ?string $tempat_lahir      = null;
    public ?string $tanggal_lahir     = null;
    public ?string $jenis_kelamin     = null;
    public ?string $agama             = null;
    public ?string $nama_ibu_kandung  = null;
    public ?string $status_rumah      = null;
    public ?string $penghasilan       = null;
    public ?string $tanggal_kawin     = null;
    public ?string $nama_pasangan     = null;
    public ?string $nama_ahli_waris   = null;
    public ?string $hubungan_ahli_waris = null;
    public ?string $alamat            = null;
    public ?string $tanggal_daftar    = null;

    public array $oldData = [];

    public function edit(int $id)
    {
        $anggota = Anggota::with('user')->findOrFail($id);

        $this->anggota_id   = $anggota->id;
        $this->kode_anggota = $anggota->kode_anggota;
        $this->status       = $anggota->user->status ?? '';
        $this->email        = $anggota->user->email  ?? '';

        $this->nama_anggota       = $anggota->nama_anggota;
        $this->no_ktp             = $anggota->no_ktp;
        $this->no_hp              = $anggota->no_hp;
        $this->tempat_lahir       = $anggota->tempat_lahir;
        $this->tanggal_lahir      = $anggota->tanggal_lahir
            ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('Y-m-d')
            : null;
        $this->jenis_kelamin      = $anggota->jenis_kelamin;
        $this->agama              = $anggota->agama;
        $this->nama_ibu_kandung   = $anggota->nama_ibu_kandung;
        $this->status_rumah       = $anggota->status_rumah;
        $this->penghasilan        = $anggota->penghasilan;
        $this->tanggal_kawin      = $anggota->tanggal_kawin
            ? \Carbon\Carbon::parse($anggota->tanggal_kawin)->format('Y-m-d')
            : null;
        $this->nama_pasangan      = $anggota->nama_pasangan;
        $this->nama_ahli_waris    = $anggota->nama_ahli_waris;
        $this->hubungan_ahli_waris = $anggota->hubungan_ahli_waris;
        $this->alamat             = $anggota->alamat;
        $this->tanggal_daftar     = $anggota->tanggal_daftar
            ? \Carbon\Carbon::parse($anggota->tanggal_daftar)->format('Y-m-d')
            : null;

        $this->oldData = [
            'nama_anggota'       => $anggota->nama_anggota,
            'no_ktp'             => $anggota->no_ktp,
            'email'              => $anggota->user->email ?? '',
            'no_hp'              => $anggota->no_hp,
            'tempat_lahir'       => $anggota->tempat_lahir,
            'tanggal_lahir'      => $this->tanggal_lahir,
            'jenis_kelamin'      => $anggota->jenis_kelamin,
            'agama'              => $anggota->agama,
            'nama_ibu_kandung'   => $anggota->nama_ibu_kandung,
            'status_rumah'       => $anggota->status_rumah,
            'penghasilan'        => $anggota->penghasilan,
            'tanggal_kawin'      => $this->tanggal_kawin,
            'nama_pasangan'      => $anggota->nama_pasangan,
            'nama_ahli_waris'    => $anggota->nama_ahli_waris,
            'hubungan_ahli_waris' => $anggota->hubungan_ahli_waris,
            'alamat'             => $anggota->alamat,
            'tanggal_daftar'     => $this->tanggal_daftar,
        ];

        $this->resetValidation();
        $this->dispatch('showEditModal');
    }

    protected function rules()
    {
        $anggota = Anggota::find($this->anggota_id);
        return [
            'nama_anggota'       => 'required',
            'no_ktp'             => 'required|numeric|digits:16|unique:anggota,no_ktp,'.optional($anggota)->id,
            'email'              => 'required|email|unique:users,email,'.optional($anggota?->user)->id,
            'no_hp'              => 'required|numeric|digits_between:10,13|unique:anggota,no_hp,'.optional($anggota)->id,
            'tempat_lahir'       => 'required',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => 'required|in:Laki-laki,Perempuan',
            'agama'              => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'nama_ibu_kandung'   => 'required',
            'status_rumah'       => 'required|in:Milik Sendiri,Milik Keluarga,Milik Perusahaan,Sewa',
            'penghasilan'        => 'required',
            'tanggal_kawin'      => 'nullable|date',
            'nama_pasangan'      => 'nullable',
            'nama_ahli_waris'    => 'required',
            'hubungan_ahli_waris' => 'required',
            'alamat'             => 'required',
            'tanggal_daftar'     => 'required|date',
        ];
    }

    protected function messages()
    {
        return [
            'nama_anggota.required'        => 'Nama anggota wajib diisi',
            'no_ktp.required'              => 'No KTP wajib diisi',
            'no_ktp.numeric'               => 'No KTP harus angka',
            'no_ktp.digits'                => 'No KTP harus 16 digit',
            'no_ktp.unique'                => 'No KTP sudah digunakan',
            'email.required'               => 'Email wajib diisi',
            'email.unique'                 => 'Email sudah digunakan',
            'email.email'                  => 'Format email tidak valid',
            'no_hp.required'               => 'No HP wajib diisi',
            'no_hp.unique'                 => 'No HP sudah digunakan',
            'no_hp.numeric'                => 'No HP harus angka',
            'no_hp.digits_between'         => 'No HP harus 10-13 digit',
            'tempat_lahir.required'        => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required'       => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date'           => 'Format tanggal lahir tidak valid',
            'jenis_kelamin.required'       => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in'             => 'Jenis kelamin tidak valid',
            'agama.required'               => 'Agama wajib dipilih',
            'agama.in'                     => 'Agama tidak valid',
            'nama_ibu_kandung.required'    => 'Nama ibu kandung wajib diisi',
            'status_rumah.required'        => 'Status rumah wajib dipilih',
            'status_rumah.in'              => 'Status rumah tidak valid',
            'penghasilan.required'         => 'Penghasilan wajib dipilih',
            'tanggal_kawin.date'           => 'Format tanggal kawin tidak valid',
            'nama_ahli_waris.required'     => 'Nama ahli waris wajib diisi',
            'hubungan_ahli_waris.required' => 'Hubungan ahli waris wajib dipilih',
            'alamat.required'              => 'Alamat tidak boleh kosong',
            'tanggal_daftar.required'      => 'Tanggal bergabung wajib diisi',
            'tanggal_daftar.date'          => 'Format tanggal bergabung tidak valid',
        ];
    }

    private function formatTanggal(?string $date): string
    {
        return $date ? \Carbon\Carbon::parse($date)->translatedFormat('d F Y') : '-';
    }

    private function changeRow(string $label, $old, $new): string
    {
        return "
            <div style='color:#6c757d'>{$label}</div>
            <div>: {$old} → {$new}</div>
        ";
    }

    public function confirmUpdate()
    {
        $this->validate();
        $o = $this->oldData;
        $changes = [];

        if ($o['nama_anggota']   != $this->nama_anggota)
            $changes[] = $this->changeRow('Nama', $o['nama_anggota'], $this->nama_anggota);
        if ($o['email']          != $this->email)
            $changes[] = $this->changeRow('Email', $o['email'], $this->email);
        if ($o['no_ktp']         != $this->no_ktp)
            $changes[] = $this->changeRow('No KTP', $o['no_ktp'], $this->no_ktp);
        if ($o['no_hp']          != $this->no_hp)
            $changes[] = $this->changeRow('No HP', $o['no_hp'], $this->no_hp);
        if ($o['tempat_lahir']   != $this->tempat_lahir)
            $changes[] = $this->changeRow('Tempat Lahir', $o['tempat_lahir'] ?? '-', $this->tempat_lahir ?? '-');
        if ($o['tanggal_lahir']  != $this->tanggal_lahir)
            $changes[] = $this->changeRow('Tgl Lahir', $this->formatTanggal($o['tanggal_lahir']), $this->formatTanggal($this->tanggal_lahir));
        if ($o['jenis_kelamin']  != $this->jenis_kelamin)
            $changes[] = $this->changeRow('Jenis Kelamin', $o['jenis_kelamin'] ?? '-', $this->jenis_kelamin ?? '-');
        if ($o['agama']          != $this->agama)
            $changes[] = $this->changeRow('Agama', $o['agama'] ?? '-', $this->agama ?? '-');
        if ($o['nama_ibu_kandung'] != $this->nama_ibu_kandung)
            $changes[] = $this->changeRow('Ibu Kandung', $o['nama_ibu_kandung'] ?? '-', $this->nama_ibu_kandung ?? '-');
        if ($o['status_rumah']   != $this->status_rumah)
            $changes[] = $this->changeRow('Status Rumah', $o['status_rumah'] ?? '-', $this->status_rumah ?? '-');
        if ($o['penghasilan']    != $this->penghasilan)
            $changes[] = $this->changeRow('Penghasilan', $o['penghasilan'] ?? '-', $this->penghasilan ?? '-');
        if ($o['tanggal_kawin']  != $this->tanggal_kawin)
            $changes[] = $this->changeRow('Tgl Kawin', $this->formatTanggal($o['tanggal_kawin']), $this->formatTanggal($this->tanggal_kawin));
        if ($o['nama_pasangan']  != $this->nama_pasangan)
            $changes[] = $this->changeRow('Nama Pasangan', $o['nama_pasangan'] ?? '-', $this->nama_pasangan ?? '-');
        if ($o['nama_ahli_waris'] != $this->nama_ahli_waris)
            $changes[] = $this->changeRow('Ahli Waris', $o['nama_ahli_waris'] ?? '-', $this->nama_ahli_waris ?? '-');
        if ($o['hubungan_ahli_waris'] != $this->hubungan_ahli_waris)
            $changes[] = $this->changeRow('Hubungan', $o['hubungan_ahli_waris'] ?? '-', $this->hubungan_ahli_waris ?? '-');
        if ($o['alamat']         != $this->alamat)
            $changes[] = $this->changeRow('Alamat', $o['alamat'] ?? '-', $this->alamat ?? '-');
        if ($o['tanggal_daftar'] != $this->tanggal_daftar)
            $changes[] = $this->changeRow('Tgl Bergabung', $this->formatTanggal($o['tanggal_daftar']), $this->formatTanggal($this->tanggal_daftar));

        $message = empty($changes)
            ? "<div style='grid-column:1 / -1; color:#6c757d;'>Tidak ada perubahan data</div>"
            : implode('', $changes);

        $this->dispatch(
            'show-confirm-update',
            anggota: $this->oldData['nama_anggota'],
            kode:    $this->kode_anggota,
            ktp:     $this->oldData['no_ktp'],
            message: $message
        );
    }

    public function update()
    {
        $this->validate();

        $anggota = Anggota::findOrFail($this->anggota_id);
        $anggota->update([
            'nama_anggota'        => $this->nama_anggota,
            'no_ktp'              => $this->no_ktp,
            'no_hp'               => $this->no_hp,
            'tempat_lahir'        => $this->tempat_lahir,
            'tanggal_lahir'       => $this->tanggal_lahir,
            'jenis_kelamin'       => $this->jenis_kelamin,
            'agama'               => $this->agama,
            'nama_ibu_kandung'    => $this->nama_ibu_kandung,
            'status_rumah'        => $this->status_rumah,
            'penghasilan'         => $this->penghasilan,
            'tanggal_kawin'       => $this->tanggal_kawin ?: null,
            'nama_pasangan'       => $this->nama_pasangan,
            'nama_ahli_waris'     => $this->nama_ahli_waris,
            'hubungan_ahli_waris' => $this->hubungan_ahli_waris,
            'alamat'              => $this->alamat,
            'tanggal_daftar'      => $this->tanggal_daftar,
        ]);

        if ($anggota->user) {
            $anggota->user->update([
                'nama_user' => $this->nama_anggota,
                'email'     => $this->email,
                'status'    => $this->status,
            ]);
        }

        session()->flash('success', 'Data anggota berhasil diperbarui');
        $this->dispatch('refreshAnggota')->to(Index::class);
        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        return view('livewire.manajemen.anggota.edit', [
            'title' => 'Edit Anggota',
        ]);
    }
}

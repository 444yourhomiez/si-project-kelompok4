<?php

namespace App\Livewire\Manajemen\Anggota;

use Livewire\Component;
use App\Models\Anggota;
use App\Livewire\Manajemen\Anggota\Index;

class Edit extends Component
{
    protected $listeners = [
        'openEdit' => 'edit',
        'prosesUpdate' => 'update',
    ];

    public $anggota_id;

    public $kode_anggota;
    public $nama_anggota;
    public $no_ktp;
    public $email;
    public $no_hp;
    public $alamat;
    public $status;

    public $oldData = [];

    public function edit($id)
    {
        $anggota = Anggota::with('user')->findOrFail($id);

        $this->anggota_id = $anggota->id;

        $this->kode_anggota = $anggota->kode_anggota;
        $this->nama_anggota = $anggota->nama_anggota;
        $this->no_ktp = $anggota->no_ktp;

        $this->email = $anggota->user->email ?? '';

        $this->status = $anggota->user->status ?? '';

        $this->no_hp = $anggota->no_hp;
        $this->alamat = $anggota->alamat;

        $this->oldData = [

            'nama_anggota' => $anggota->nama_anggota,

            'no_ktp' => $anggota->no_ktp,

            'email' => $anggota->user->email ?? '',

            'no_hp' => $anggota->no_hp,

            'alamat' => $anggota->alamat,

        ];

        $this->resetValidation();
    }

    protected function rules()
    {
        return [

            'nama_anggota' => 'required',

            'no_ktp' => 'required|numeric|digits:16|unique:anggota,no_ktp,' . optional(
                Anggota::find($this->anggota_id)
            )->id,

            'email' => 'required|email|unique:users,email,' . optional(
                Anggota::find($this->anggota_id)?->user
            )->id,

            'no_hp' => 'required|numeric|digits_between:10,13|unique:anggota,no_hp,' . optional(
                Anggota::find($this->anggota_id)
            )->id,

            'alamat' => 'required',

        ];
    }

    protected function messages()
    {
        return [

            // NAMA
            'nama_anggota.required' =>'Nama anggota wajib diisi',

            // KTP
            'no_ktp.required' => 'No KTP wajib diisi',
            'no_ktp.numeric' => 'No KTP harus angka',
            'no_ktp.digits' => 'No KTP harus 16 digit',
            'no_ktp.unique' => 'No KTP sudah digunakan',

            // EMAIL
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'email.email' => 'Format email tidak valid',

            // NO HP
            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.unique' => 'No HP sudah digunakan',
            'no_hp.numeric' => 'No HP harus angka',
            'no_hp.digits_between' => 'No HP harus 10 - 13 digit',

            // ALAMAT
            'alamat.required' => 'Alamat tidak boleh kosong',

        ];
    }

    public function confirmUpdate()
    {
        $this->validate();

        $changes = [];

        if ($this->oldData['nama_anggota'] != $this->nama_anggota) {

            $changes[] = "
                <div style='color:#6c757d'>Nama</div>
                <div>: {$this->oldData['nama_anggota']} → {$this->nama_anggota}</div>
            ";
        }

        if ($this->oldData['no_ktp'] != $this->no_ktp) {

            $changes[] = "
                <div style='color:#6c757d'>No KTP</div>
                <div>: {$this->oldData['no_ktp']} → {$this->no_ktp}</div>
            ";
        }

        if ($this->oldData['email'] != $this->email) {

            $changes[] = "
                <div style='color:#6c757d'>Email</div>
                <div>: {$this->oldData['email']} → {$this->email}</div>
            ";
        }

        if ($this->oldData['no_hp'] != $this->no_hp) {

            $changes[] = "
                <div style='color:#6c757d'>No HP</div>
                <div>: {$this->oldData['no_hp']} → {$this->no_hp}</div>
            ";
        }

        if ($this->oldData['alamat'] != $this->alamat) {

            $changes[] = "
                <div style='color:#6c757d'>Alamat</div>
                <div>: {$this->oldData['alamat']} → {$this->alamat}</div>
            ";
        }

        $message = empty($changes)

            ?
            "
                <div style='grid-column:1 / -1; color:#6c757d;'>
                    Tidak ada perubahan data
                </div>
            "

            : implode('', $changes);

        $this->dispatch(
            'show-confirm-update',

            anggota: $this->oldData['nama_anggota'],

            kode: $this->kode_anggota,

            ktp: $this->oldData['no_ktp'],

            message: $message
        );
    }

    public function update()
    {
        $this->validate([

            'nama_anggota' => 'required',

            'no_ktp' => 'required|numeric|digits:16|unique:anggota,no_ktp,' . optional(
                Anggota::find($this->anggota_id)
            )->id,

            'email' => 'required|email|unique:users,email,' . optional(
                Anggota::find($this->anggota_id)?->user
            )->id,

            'no_hp' => 'required|numeric|digits_between:10,13|unique:anggota,no_hp,' . optional(
                Anggota::find($this->anggota_id)
            )->id,

            'alamat' => 'required',

        ], [

            'nama_anggota.required' => 'Nama anggota wajib diisi',

            'no_ktp.required' => 'No KTP wajib diisi',
            'no_ktp.numeric' => 'No KTP harus angka',
            'no_ktp.digits' => 'No KTP harus 16 digit',
            'no_ktp.unique' => 'No KTP sudah digunakan',

            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'email.email' => 'Format email tidak valid',

            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.unique' => 'No HP sudah digunakan',
            'no_hp.numeric' => 'No HP harus angka',
            'no_hp.digits_between' => 'No HP harus 10 - 13 digit',

            'alamat.required' => 'Alamat tidak boleh kosong',
        ]);

        $anggota = Anggota::findOrFail($this->anggota_id);

        $anggota->update([
            'nama_anggota' => $this->nama_anggota,
            'no_ktp' => $this->no_ktp,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
        ]);

        if ($anggota->user) {

            $anggota->user->update([
                'nama_user' => $this->nama_anggota,
                'email' => $this->email,
                'status' => $this->status,

            ]);
        }

        session()->flash(
            'success',
            'Data anggota berhasil diperbarui'
        );

        $this->dispatch('refreshAnggota')->to(Index::class);

        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        return view('livewire.manajemen.anggota.edit', [
            'title' => 'Edit Anggota'
        ]);
    }
}

<?php

namespace App\Livewire\Manajemen\Simpanan;

use Livewire\Component;

use App\Models\Anggota;
use App\Models\Simpanan;

class Edit extends Component
{
    protected $listeners = [

        'openEdit' => 'edit',

        'prosesUpdate' => 'update',

    ];

    public $simpanan_id;

    public $anggota_id;

    public $jenis_simpanan;

    public $jumlah;

    // SEARCH
    public $search = '';

    public $selectedAnggota = false;

    public $oldData = [];

    // EDIT
    public function edit($id)
    {
        $simpanan = Simpanan::with('anggota')
            ->findOrFail($id);

        $this->simpanan_id = $simpanan->id;

        $this->anggota_id = $simpanan->anggota_id;

        $this->jenis_simpanan = $simpanan->jenis_simpanan;

        $this->jumlah = (int) $simpanan->jumlah;

        // AUTO FILL SEARCH
        $this->search =
            $simpanan->anggota->nama_anggota
            . ' - ' .
            $simpanan->anggota->no_ktp;

        $this->selectedAnggota = true;

        $this->oldData = [

            'anggota_id' =>
            $simpanan->anggota_id,

            'jenis_simpanan' =>
            $simpanan->jenis_simpanan,

            'jumlah' =>
            (int) $simpanan->jumlah,

        ];

        $this->resetValidation();
    }

    // PILIH ANGGOTA
    public function pilihAnggota($id, $nama, $ktp)
    {
        $this->anggota_id = $id;

        $this->search = $nama . ' - ' . $ktp;

        $this->selectedAnggota = true;
    }

    // RESET ANGGOTA
    public function resetAnggota()
    {
        $this->anggota_id = null;

        $this->search = '';

        $this->selectedAnggota = false;
    }

    // VALIDATION
    protected function rules()
    {
        return [

            'anggota_id' =>
            'required',

            'jenis_simpanan' =>
            'required',

            'jumlah' =>
            'required|numeric|min:1',

        ];
    }

    protected function messages()
    {
        return [

            'anggota_id.required' =>
            'Anggota wajib dipilih',

            'jenis_simpanan.required' =>
            'Jenis simpanan wajib dipilih',

            'jumlah.required' =>
            'Jumlah simpanan wajib diisi',

            'jumlah.numeric' =>
            'Jumlah simpanan harus angka',

            'jumlah.min' =>
            'Jumlah simpanan minimal 1',

        ];
    }

    // CONFIRM UPDATE
    public function confirmUpdate()
    {
        $this->validate();

        $anggotaLama = Anggota::find(
            $this->oldData['anggota_id']
        );

        $anggotaBaru = Anggota::find(
            $this->anggota_id
        );

        $changes = [];

        // ANGGOTA
        if (
            $this->oldData['anggota_id']
            !=
            $this->anggota_id
        ) {

            $changes[] = "

                <div style='color:#6c757d'>
                    Anggota
                </div>

                <div>
                    :
                    {$anggotaLama->nama_anggota}
                    →
                    {$anggotaBaru->nama_anggota}
                </div>

            ";
        }

        // JENIS
        if (
            $this->oldData['jenis_simpanan']
            !=
            $this->jenis_simpanan
        ) {

            $changes[] = "

                <div style='color:#6c757d'>
                    Jenis
                </div>

                <div>
                    :
                    {$this->oldData['jenis_simpanan']}
                    →
                    {$this->jenis_simpanan}
                </div>

            ";
        }

        // JUMLAH
        if (
            $this->oldData['jumlah']
            !=
            $this->jumlah
        ) {

            $changes[] = "

                <div style='color:#6c757d'>
                    Jumlah
                </div>

                <div>
                    :
                    Rp " . number_format(
                (float) $this->oldData['jumlah'],
                0,
                ',',
                '.'
            ) . "

                    →

                    Rp " . number_format(
                (float) $this->jumlah,
                0,
                ',',
                '.'
            ) . "
                </div>

            ";
        }

        $message = empty($changes)

            ?

            "

                <div style='grid-column:1 / -1; color:#6c757d;'>

                    Tidak ada perubahan data

                </div>

            "

            :

            implode('', $changes);

        $this->dispatch(

            'show-confirm-update',

            anggota: $anggotaBaru->nama_anggota,

            kode: $this->oldData['jenis_simpanan'],

            ktp: 'Rp ' . number_format(
                (float) $this->jumlah,
                0,
                ',',
                '.'
            ),

            message: $message

        );
    }

    // UPDATE
    public function update()
    {
        $this->validate();

        $simpanan = Simpanan::findOrFail(
            $this->simpanan_id
        );

        $simpanan->update([

            'anggota_id' =>
            $this->anggota_id,

            'jenis_simpanan' =>
            $this->jenis_simpanan,

            'jumlah' =>
            (int) $this->jumlah,

        ]);

        session()->flash(

            'success',

            'Data simpanan berhasil diperbarui'

        );

        $this->dispatch(
            'dataKoperasiUpdated'
        );

        $this->dispatch('closeEditModal');
    }

    // RENDER
    public function render()
    {
        return view(
            'livewire.manajemen.simpanan.edit',
            [

                'title' => 'Edit Simpanan',

                'anggota' => Anggota::whereHas('user', function ($q) {
                        $q->where('status', 'disetujui');
                    })
                    ->where(function ($query) {
                        $query->where('nama_anggota', 'like', '%' . $this->search . '%')
                            ->orWhere('no_ktp', 'like', '%' . $this->search . '%');
                    })
                    ->limit(5)
                    ->get(),

            ]
        );
    }
}

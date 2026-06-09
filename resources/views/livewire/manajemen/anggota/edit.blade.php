<div>

    <div class="modal fade" wire:ignore.self id="editModalAnggota" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-scrollable">

            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header border-0 bg-white px-4 py-3">

                    <div>

                        <h5 class="modal-title font-weight-bold mb-1 text-dark">

                            <i class="fas fa-user-edit text-warning mr-2"></i>
                            Edit Data Anggota

                        </h5>

                        <small class="text-muted">

                            Perbarui informasi anggota koperasi

                        </small>

                    </div>

                    <button type="button" class="close text-muted" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                {{-- BODY --}}
                <div class="modal-body px-4 py-4 bg-light">

                    <div class="row">

                        {{-- KODE ANGGOTA --}}
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold text-dark mb-2">
                                Kode Anggota
                            </label>

                            <div class="input-group shadow-sm">

                                <div class="input-group-prepend">

                                    <span class="input-group-text bg-primary border-0 text-white px-3">

                                        <i class="fas fa-id-badge"></i>

                                    </span>

                                </div>

                                <input type="text" wire:model="kode_anggota" class="form-control border-0 bg-white"
                                    readonly>

                            </div>

                        </div>

                        {{-- NAMA --}}
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold text-dark mb-2">
                                Nama Anggota
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group shadow-sm">

                                <div class="input-group-prepend">

                                    <span class="input-group-text bg-info border-0 text-white px-3">

                                        <i class="fas fa-user"></i>

                                    </span>

                                </div>

                                <input type="text" wire:model="nama_anggota"
                                    class="form-control border-0 @error('nama_anggota') is-invalid @enderror"
                                    placeholder="Masukkan nama anggota">

                            </div>

                            @error('nama_anggota')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold text-dark mb-2">
                                Email
                            </label>

                            <div class="input-group shadow-sm">

                                <div class="input-group-prepend">

                                    <span class="input-group-text bg-danger border-0 text-white px-3">

                                        <i class="fas fa-envelope"></i>

                                    </span>

                                </div>

                                <input type="email" wire:model="email"
                                    class="form-control border-0 @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email">

                            </div>

                            @error('email')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- NIK --}}
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold text-dark mb-2">
                                Nomor KTP
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group shadow-sm">

                                <div class="input-group-prepend">

                                    <span class="input-group-text bg-secondary border-0 text-white px-3">

                                        <i class="fas fa-id-card"></i>

                                    </span>

                                </div>

                                <input type="text" wire:model="no_ktp"
                                    class="form-control border-0 @error('no_ktp') is-invalid @enderror"
                                    placeholder="Masukkan nomor KTP">

                            </div>

                            @error('no_ktp')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- NO HP --}}
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold text-dark mb-2">
                                Nomor HP
                            </label>

                            <div class="input-group shadow-sm">

                                <div class="input-group-prepend">

                                    <span class="input-group-text bg-success border-0 text-white px-3">

                                        <i class="fas fa-phone-alt"></i>

                                    </span>

                                </div>

                                <input type="text" wire:model="no_hp"
                                    class="form-control border-0 @error('no_hp') is-invalid @enderror"
                                    placeholder="Masukkan nomor HP">

                            </div>

                            @error('no_hp')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- STATUS --}}
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold mb-2">
                                Status
                            </label>

                            <div class="input-group shadow-sm rounded overflow-hidden">

                                <div class="input-group-prepend">

                                    <span
                                        class="
                                            input-group-text border-0 text-white

                                            @if ($status == 'disetujui') bg-success
                                            @elseif($status == 'ditolak')
                                                bg-danger
                                            @else
                                                bg-warning @endif
                                        ">

                                        <i
                                            class="
                                                @if ($status == 'disetujui') fas fa-check-circle
                                                @elseif($status == 'ditolak')
                                                    fas fa-times-circle
                                                @else
                                                    fas fa-clock @endif
                                            ">
                                        </i>

                                    </span>

                                </div>

                                <div
                                    class="
                                        form-control
                                        border-0
                                        bg-light
                                        text-muted
                                        d-flex
                                        align-items-center
                                    ">

                                    @if ($status == 'disetujui')
                                        Anggota Disetujui
                                    @elseif($status == 'ditolak')
                                        Pengajuan Ditolak
                                    @else
                                        Sedang Menunggu Verifikasi
                                    @endif

                                </div>

                            </div>

                            @error('status')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- ALAMAT --}}
                        <div class="col-md-12 mb-2">

                            <label class="font-weight-bold text-dark mb-2">
                                Alamat
                            </label>

                            <textarea wire:model="alamat" rows="4"
                                class="form-control border-0 shadow-sm @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap"></textarea>

                            @error('alamat')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer bg-white border-0 px-4 py-3">

                    <button type="button" class="btn btn-light px-4 shadow-sm" data-dismiss="modal">

                        <i class="fas fa-times mr-1"></i>
                        Tutup

                    </button>

                    <button wire:click="confirmUpdate" type="button"
                        class="btn btn-warning px-4 shadow-sm text-dark font-weight-bold">

                        <i class="fas fa-save mr-1"></i>
                        Update Anggota

                    </button>

                </div>

            </div>

        </div>

        <script>
            document.addEventListener('livewire:init', () => {

                Livewire.on('show-confirm-update', (event) => {

                    Swal.fire({

                        title: 'Update Data Simpanan Anggota',

                        html: `

                            <div style="text-align:left;">

                                <div style="
                                    font-size:14px;
                                    color:#6c757d;
                                    margin-bottom:14px;
                                ">
                                    Anda akan memperbarui data anggota berikut:
                                </div>

                                <div style="
                                    background:#ffffff;
                                    border:1px solid #e9ecef;
                                    border-radius:14px;
                                    padding:16px;
                                    margin-bottom:18px;
                                    box-shadow:0 2px 10px rgba(0,0,0,.03);
                                ">

                                    <div style="
                                        display:flex;
                                        align-items:center;
                                        gap:12px;
                                        margin-bottom:14px;
                                    ">

                                        <div style="
                                            width:45px;
                                            height:45px;
                                            border-radius:12px;
                                            background:#fff3cd;

                                            display:flex;
                                            align-items:center;
                                            justify-content:center;

                                            color:#856404;
                                            font-size:18px;
                                        ">
                                            <i class='fas fa-user-edit'></i>
                                        </div>

                                        <div>

                                            <div style="
                                                font-size:15px;
                                                font-weight:600;
                                                color:#212529;
                                                margin-bottom:2px;
                                            ">
                                                ${event.anggota}
                                            </div>

                                            <div style="
                                                font-size:12px;
                                                color:#6c757d;
                                            ">
                                                Data anggota koperasi
                                            </div>

                                        </div>

                                    </div>

                                    <div style="
                                        display:grid;
                                        grid-template-columns:110px 1fr;
                                        row-gap:8px;
                                        column-gap:10px;
                                        font-size:13px;
                                    ">

                                        <div style="color:#6c757d;">
                                            Kode Anggota
                                        </div>

                                        <div style="color:#212529;">
                                            ${event.kode}
                                        </div>

                                        <div style="color:#6c757d;">
                                            Nomor KTP
                                        </div>

                                        <div style="color:#212529;">
                                            ${event.ktp}
                                        </div>

                                    </div>

                                </div>

                                <div style="
                                    font-size:13px;
                                    font-weight:600;
                                    color:#495057;
                                    margin-bottom:10px;
                                ">
                                    Perubahan Data:
                                </div>

                                <div style="
                                    background:#f8f9fa;
                                    border:1px solid #e9ecef;
                                    border-radius:14px;
                                    padding:14px;
                                ">

                                    <div style="
                                        display:grid;
                                        grid-template-columns:110px 1fr;
                                        row-gap:10px;
                                        column-gap:10px;

                                        font-size:13px;
                                        color:#343a40;
                                        line-height:1.6;
                                    ">

                                        ${event.message}

                                    </div>

                                </div>

                            </div>

                        `,

                        icon: 'question',

                        showCancelButton: true,

                        confirmButtonColor: '#f0ad4e',
                        cancelButtonColor: '#6c757d',

                        confirmButtonText: 'Ya, Update',
                        cancelButtonText: 'Batal',

                        reverseButtons: true

                    }).then((result) => {

                        if (result.isConfirmed) {

                            Livewire.dispatch('prosesUpdate');

                        }

                    });

                });

            });
        </script>

    </div>

</div>

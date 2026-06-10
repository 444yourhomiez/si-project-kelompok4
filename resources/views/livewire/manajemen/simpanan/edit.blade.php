<div>

    <div>

        <div class="modal fade" wire:ignore.self id="editModalSimpanan" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-md modal-dialog-scrollable">

                <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="modal-header bg-white">

                        <div>

                            <h5 class="modal-title font-weight-bold mb-1">

                                <i class="fas fa-wallet text-primary mr-2"></i>
                                Edit Simpanan

                            </h5>

                            <small class="text-muted">

                                Perbarui transaksi simpanan anggota

                            </small>

                        </div>

                        <button type="button" class="close" data-dismiss="modal">

                            <span>&times;</span>

                        </button>

                    </div>

                    {{-- BODY --}}
                    <div class="modal-body px-4 py-4">

                        <div class="row">

                            {{-- PILIH ANGGOTA --}}
                            <div class="col-md-12 mb-4">

                                <label class="font-weight-bold">

                                    Pilih Anggota
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text" wire:model.live="search"
                                    class="form-control @error('anggota_id') is-invalid @enderror"
                                    placeholder="Cari nama / no KTP..." autocomplete="off">

                                @if ($selectedAnggota)
                                    <button type="button" wire:click="resetAnggota" class="btn btn-danger btn-sm mt-2">

                                        <i class="fas fa-sync-alt mr-1"></i>
                                        Ganti Anggota

                                    </button>
                                @endif

                                {{-- LIST --}}
                                @if ($search && !$selectedAnggota)

                                    <div class="position-absolute w-100 mt-2" style="z-index:1000;">

                                        <div class="card shadow border-0 anggota-search-card">

                                            <div class="card-body p-2">

                                                @forelse($anggota as $a)
                                                    <button type="button"
                                                        wire:click="pilihAnggota('{{ $a->id }}', '{{ $a->nama_anggota }}', '{{ $a->no_ktp }}')"
                                                        class="btn btn-light btn-block text-left mb-2 anggota-item-search">

                                                        <div class="d-flex justify-content-between align-items-center">

                                                            <div>

                                                                {{-- NAMA --}}
                                                                <div class="font-weight-bold text-dark"
                                                                    style="font-size:15px;">

                                                                    {{ $a->nama_anggota }}

                                                                </div>

                                                                {{-- KODE --}}
                                                                <small class="text-primary d-block">

                                                                    <i class="fas fa-user-tag mr-1"></i>

                                                                    {{ $a->kode_anggota }}

                                                                </small>

                                                                {{-- KTP --}}
                                                                <small class="text-muted">

                                                                    <i class="fas fa-id-card mr-1"></i>

                                                                    {{ $a->no_ktp }}

                                                                </small>

                                                            </div>

                                                            <div>

                                                                <span class="badge badge-primary px-3 py-2">

                                                                    <i class="fas fa-check mr-1"></i>
                                                                    Pilih

                                                                </span>

                                                            </div>

                                                        </div>

                                                    </button>

                                                @empty

                                                    <div class="text-center py-4 text-muted">

                                                        <i class="fas fa-search fa-2x mb-2"></i>

                                                        <div class="font-weight-bold">

                                                            Data anggota tidak ditemukan

                                                        </div>

                                                        <small>

                                                            Coba gunakan nama atau NIK lain

                                                        </small>

                                                    </div>
                                                @endforelse

                                            </div>

                                        </div>

                                    </div>

                                @endif

                                @error('anggota_id')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            {{-- JENIS --}}
                            <div class="col-md-12 mb-4">

                                <label class="font-weight-bold">

                                    Jenis Simpanan
                                    <span class="text-danger">*</span>

                                </label>

                                <select wire:model="jenis_simpanan"
                                    class="form-control @error('jenis_simpanan') is-invalid @enderror">

                                    <option value="">
                                        -- Pilih Jenis Simpanan --
                                    </option>

                                    <option value="wajib">

                                        Simpanan Wajib

                                    </option>

                                    <option value="pokok">

                                        Simpanan Pokok

                                    </option>

                                    <option value="sukarela">

                                        Simpanan Sukarela

                                    </option>

                                </select>

                                @error('jenis_simpanan')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            {{-- JUMLAH --}}
                            <div class="col-md-12 mb-3">

                                <label class="font-weight-bold">
                                    Jumlah Simpanan
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group shadow-sm rounded overflow-hidden">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white border-0 px-3">
                                            Rp
                                        </span>
                                    </div>

                                    <input type="number" wire:model.blur="jumlah"
                                        class="form-control border-0 @error('jumlah') is-invalid @enderror"
                                        placeholder="Masukkan jumlah simpanan"
                                        min="1">

                                </div>

                                {{-- PREVIEW --}}
                                @if ($jumlah)
                                    <div class="mt-2">
                                        <small class="text-muted">Nominal Simpanan</small>
                                        <div class="font-weight-bold text-success" style="font-size:18px;">
                                            Rp {{ number_format((float) $jumlah, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endif

                                @error('jumlah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer bg-white">

                        <button type="button" class="btn btn-light btn-close-modal" data-dismiss="modal">

                            <i class="fas fa-times mr-1"></i>
                            Tutup

                        </button>

                        <button wire:click="confirmUpdate" type="button" class="btn btn-primary btn-save shadow-sm">

                            <i class="fas fa-save mr-1"></i>
                            Update Simpanan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    <script>
        Livewire.on('show-confirm-update', (event) => {
            Swal.fire({
                title: 'Update Simpanan',
                html: `
                <div style="text-align:left;">
                    <div style="
                        font-size:14px;
                        color:#6c757d;
                        margin-bottom:14px;
                    ">
                        Anda akan memperbarui data simpanan berikut:
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
                                background:#e0f2fe;

                                display:flex;
                                align-items:center;
                                justify-content:center;

                                color:#0369a1;
                                font-size:18px;
                            ">
                                <i class='fas fa-wallet'></i>
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
                                    Data simpanan anggota
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
                                Jenis
                            </div>

                            <div style="color:#212529;">
                                ${event.kode}
                            </div>

                            <div style="color:#6c757d;">
                                Jumlah
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
                confirmButtonColor: '#0d6efd',
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
    </script>

</div>

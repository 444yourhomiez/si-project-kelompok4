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

                    {{-- ===== AKUN ===== --}}
                    <div class="font-weight-bold text-muted text-uppercase mb-3" style="font-size:.72rem;letter-spacing:.08em;">
                        <i class="fas fa-lock mr-1"></i> Akun
                    </div>
                    <div class="row">
                        {{-- KODE ANGGOTA --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">Kode Anggota</label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary border-0 text-white px-3">
                                        <i class="fas fa-id-badge"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="kode_anggota" class="form-control border-0 bg-white" readonly>
                            </div>
                        </div>
                        {{-- EMAIL --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Email <span class="text-danger">*</span>
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
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- STATUS (readonly) --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold mb-2">Status</label>
                            <div class="input-group shadow-sm rounded overflow-hidden">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white
                                        @if($status == 'disetujui') bg-success
                                        @elseif($status == 'ditolak') bg-danger
                                        @else bg-warning @endif">
                                        <i class="@if($status == 'disetujui') fas fa-check-circle
                                            @elseif($status == 'ditolak') fas fa-times-circle
                                            @else fas fa-clock @endif"></i>
                                    </span>
                                </div>
                                <div class="form-control border-0 bg-light text-muted d-flex align-items-center">
                                    @if($status == 'disetujui') Anggota Disetujui
                                    @elseif($status == 'ditolak') Pengajuan Ditolak
                                    @else Sedang Menunggu Verifikasi @endif
                                </div>
                            </div>
                        </div>
                        {{-- TANGGAL BERGABUNG --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Tanggal Bergabung <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning border-0 text-white px-3">
                                        <i class="fas fa-calendar-check"></i>
                                    </span>
                                </div>
                                <input type="date" wire:model="tanggal_daftar"
                                    class="form-control border-0 @error('tanggal_daftar') is-invalid @enderror">
                            </div>
                            @error('tanggal_daftar')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- ===== BIODATA ===== --}}
                    <div class="font-weight-bold text-muted text-uppercase mb-3" style="font-size:.72rem;letter-spacing:.08em;">
                        <i class="fas fa-id-card mr-1"></i> Biodata
                    </div>
                    <div class="row">
                        {{-- NAMA --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Nama Anggota <span class="text-danger">*</span>
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
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- NIK --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                No KTP/NIK <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary border-0 text-white px-3">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="no_ktp"
                                    class="form-control border-0 @error('no_ktp') is-invalid @enderror"
                                    placeholder="Masukkan nomor KTP (16 digit)">
                            </div>
                            @error('no_ktp')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- NO HP --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Nomor HP <span class="text-danger">*</span>
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
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- JENIS KELAMIN --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-purple border-0 text-white px-3" style="background:#6f42c1;">
                                        <i class="fas fa-venus-mars"></i>
                                    </span>
                                </div>
                                <select wire:model="jenis_kelamin"
                                    class="form-control border-0 @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            @error('jenis_kelamin')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- TEMPAT LAHIR --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Tempat Lahir <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#fd7e14;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="tempat_lahir"
                                    class="form-control border-0 @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="Kota tempat lahir">
                            </div>
                            @error('tempat_lahir')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- TANGGAL LAHIR --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#e83e8c;">
                                        <i class="fas fa-birthday-cake"></i>
                                    </span>
                                </div>
                                <input type="date" wire:model="tanggal_lahir"
                                    class="form-control border-0 @error('tanggal_lahir') is-invalid @enderror">
                            </div>
                            @error('tanggal_lahir')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- AGAMA --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Agama <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#20c997;">
                                        <i class="fas fa-pray"></i>
                                    </span>
                                </div>
                                <select wire:model="agama"
                                    class="form-control border-0 @error('agama') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Buddha</option>
                                    <option>Konghucu</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            @error('agama')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- NAMA IBU KANDUNG --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Nama Ibu Kandung <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#6610f2;">
                                        <i class="fas fa-female"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="nama_ibu_kandung"
                                    class="form-control border-0 @error('nama_ibu_kandung') is-invalid @enderror"
                                    placeholder="Nama ibu kandung">
                            </div>
                            @error('nama_ibu_kandung')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- STATUS RUMAH --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Status Rumah <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#17a2b8;">
                                        <i class="fas fa-home"></i>
                                    </span>
                                </div>
                                <select wire:model="status_rumah"
                                    class="form-control border-0 @error('status_rumah') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option>Milik Sendiri</option>
                                    <option>Milik Keluarga</option>
                                    <option>Milik Perusahaan</option>
                                    <option>Sewa</option>
                                </select>
                            </div>
                            @error('status_rumah')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- PENGHASILAN --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Penghasilan <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#28a745;">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </span>
                                </div>
                                <select wire:model="penghasilan"
                                    class="form-control border-0 @error('penghasilan') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="Dibawah Rp 500.000">Dibawah Rp 500.000</option>
                                    <option value="Rp 500.000 - Rp. 1.000.000">Rp 500rb - 1jt</option>
                                    <option value="Rp 1.000.000 - Rp. 2.000.000">Rp 1jt - 2jt</option>
                                    <option value="Rp 2.000.000 - Rp. 3.000.000">Rp 2jt - 3jt</option>
                                    <option value="Rp 3.000.000 - Rp. 4.000.000">Rp 3jt - 4jt</option>
                                    <option value="Rp 4.000.000 - Rp. 5.000.000">Rp 4jt - 5jt</option>
                                    <option value="Diatas Rp 5.000.000">Diatas Rp 5.000.000</option>
                                </select>
                            </div>
                            @error('penghasilan')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- ===== DATA PERNIKAHAN (OPSIONAL) ===== --}}
                    <div class="font-weight-bold text-muted text-uppercase mb-3" style="font-size:.72rem;letter-spacing:.08em;">
                        <i class="fas fa-ring mr-1"></i> Data Pernikahan <small class="text-muted font-weight-normal">(opsional)</small>
                    </div>
                    <div class="row">
                        {{-- TANGGAL KAWIN --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">Tanggal Kawin</label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#e83e8c;">
                                        <i class="fas fa-calendar-heart" style="color:inherit;"></i>
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="date" wire:model="tanggal_kawin"
                                    class="form-control border-0 @error('tanggal_kawin') is-invalid @enderror">
                            </div>
                            @error('tanggal_kawin')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- NAMA PASANGAN --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">Nama Pasangan</label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#fd7e14;">
                                        <i class="fas fa-user-friends"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="nama_pasangan"
                                    class="form-control border-0 @error('nama_pasangan') is-invalid @enderror"
                                    placeholder="Nama pasangan (opsional)">
                            </div>
                            @error('nama_pasangan')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- ===== AHLI WARIS ===== --}}
                    <div class="font-weight-bold text-muted text-uppercase mb-3" style="font-size:.72rem;letter-spacing:.08em;">
                        <i class="fas fa-users mr-1"></i> Ahli Waris
                    </div>
                    <div class="row">
                        {{-- NAMA AHLI WARIS --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Nama Ahli Waris <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#343a40;">
                                        <i class="fas fa-user-shield"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="nama_ahli_waris"
                                    class="form-control border-0 @error('nama_ahli_waris') is-invalid @enderror"
                                    placeholder="Nama ahli waris">
                            </div>
                            @error('nama_ahli_waris')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- HUBUNGAN AHLI WARIS --}}
                        <div class="col-md-6 mb-4">
                            <label class="font-weight-bold text-dark mb-2">
                                Hubungan Ahli Waris <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 text-white px-3" style="background:#6f42c1;">
                                        <i class="fas fa-link"></i>
                                    </span>
                                </div>
                                <select wire:model="hubungan_ahli_waris"
                                    class="form-control border-0 @error('hubungan_ahli_waris') is-invalid @enderror">
                                    <option value="">Pilih Hubungan</option>
                                    <option value="Ayah">Ayah</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Suami">Suami</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Saudara Kandung">Saudara Kandung</option>
                                    <option value="Kakek">Kakek</option>
                                    <option value="Nenek">Nenek</option>
                                    <option value="Paman">Paman</option>
                                    <option value="Bibi">Bibi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            @error('hubungan_ahli_waris')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- ===== ALAMAT ===== --}}
                    <div class="font-weight-bold text-muted text-uppercase mb-3" style="font-size:.72rem;letter-spacing:.08em;">
                        <i class="fas fa-map-marked-alt mr-1"></i> Alamat
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <textarea wire:model="alamat" rows="4"
                                class="form-control border-0 shadow-sm @error('alamat') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap"></textarea>
                            @error('alamat')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
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
                        title: 'Update Data Anggota',
                        html: `
                <div style="text-align:left;">
                    <div style="font-size:14px;color:#6c757d;margin-bottom:14px;">
                        Anda akan memperbarui data anggota berikut:
                    </div>
                    <div style="background:#ffffff;border:1px solid #e9ecef;border-radius:14px;padding:16px;margin-bottom:18px;box-shadow:0 2px 10px rgba(0,0,0,.03);">
                        <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                            <div style="width:45px;height:45px;border-radius:12px;background:#fff3cd;display:flex;align-items:center;justify-content:center;color:#856404;font-size:18px;">
                                <i class='fas fa-user-edit'></i>
                            </div>
                            <div>
                                <div style="font-size:15px;font-weight:600;color:#212529;margin-bottom:2px;">${event.anggota}</div>
                                <div style="font-size:12px;color:#6c757d;">Data anggota koperasi</div>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:110px 1fr;row-gap:8px;column-gap:10px;font-size:13px;">
                            <div style="color:#6c757d;">Kode Anggota</div>
                            <div style="color:#212529;">${event.kode}</div>
                            <div style="color:#6c757d;">No KTP/NIK</div>
                            <div style="color:#212529;">${event.ktp}</div>
                        </div>
                    </div>
                    <div style="font-size:13px;font-weight:600;color:#495057;margin-bottom:10px;">Perubahan Data:</div>
                    <div style="background:#f8f9fa;border:1px solid #e9ecef;border-radius:14px;padding:14px;">
                        <div style="display:grid;grid-template-columns:110px 1fr;row-gap:10px;column-gap:10px;font-size:13px;color:#343a40;line-height:1.6;">
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

<div class="register-wrapper">

    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card register-card shadow-lg border-0">

                    <div class="card-body px-4 py-4">

                        {{-- HEADER --}}
                        <div class="text-center mb-4">

                            <h3 class="text-success font-weight-bold mb-1">
                                Registrasi Anggota
                            </h3>

                            <small class="text-muted">
                                Lengkapi data dengan benar
                            </small>

                        </div>

                        {{-- STEPPER --}}
                        <div class="mb-4">

                            <div class="progress" style="height: 6px; border-radius: 10px;">

                                <div class="progress-bar bg-success" style="width: {{ ($step / 3) * 100 }}%">
                                </div>

                            </div>

                            <div class="d-flex justify-content-between mt-3 text-center">

                                <div class="{{ $step >= 1 ? 'text-success' : 'text-muted' }}">
                                    <i class="fas fa-user"></i><br>
                                    <small>Akun</small>
                                </div>

                                <div class="{{ $step >= 2 ? 'text-success' : 'text-muted' }}">
                                    <i class="fas fa-id-card"></i><br>
                                    <small>Biodata</small>
                                </div>

                                <div class="{{ $step >= 3 ? 'text-success' : 'text-muted' }}">
                                    <i class="fas fa-check-circle"></i><br>
                                    <small>Wawancara</small>
                                </div>

                            </div>

                        </div>

                        {{-- ================= STEP 1 ================= --}}
                        @if ($step == 1)
                            <div class="form-group mb-3">

                                <label>
                                    Nama
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="text" wire:model="nama_user"
                                        class="form-control @error('nama_user') is-invalid @enderror"
                                        placeholder="Masukkan nama">

                                    @error('nama_user')
                                        <div class="input-group-append">

                                            <span class="input-group-text bg-danger text-white border-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </span>

                                        </div>
                                    @enderror

                                </div>

                                @error('nama_user')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="form-group mb-3">

                                <label>
                                    Email
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="email" wire:model.live="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email Gmail">

                                    @error('email')
                                        <div class="input-group-append">

                                            <span class="input-group-text bg-danger border-danger text-white">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </span>

                                        </div>
                                    @enderror

                                </div>

                                @error('email')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="form-group mb-3">

                                <label>
                                    Password
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="password" wire:model="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="********">

                                    @error('password')
                                        <div class="input-group-append">

                                            <span class="input-group-text bg-danger text-white border-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </span>

                                        </div>
                                    @enderror

                                </div>

                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="form-group mb-4">

                                <label>
                                    Konfirmasi Password
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="password" wire:model="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="********">

                                    @error('password_confirmation')
                                        <div class="input-group-append">

                                            <span class="input-group-text bg-danger text-white border-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </span>

                                        </div>
                                    @enderror

                                </div>

                                @error('password_confirmation')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">

                                {{-- KEMBALI KE HOMEPAGE --}}
                                <a href="{{ route('homepage') }}" class="btn btn-outline-secondary px-4">

                                    <i class="fas fa-times mr-1"></i>
                                    Batal Untuk Mendafatar

                                </a>

                                {{-- LANJUT --}}
                                <button wire:click="saveStep1" wire:loading.attr="disabled"
                                    class="btn btn-success px-4">

                                    <span wire:loading.remove wire:target="saveStep1">

                                        <i class="fas fa-arrow-right mr-1"></i>
                                        Lanjut

                                    </span>

                                    <span wire:loading wire:target="saveStep1">

                                        <i class="fas fa-spinner fa-spin mr-1"></i>
                                        Memproses...

                                    </span>

                                </button>

                            </div>
                        @endif

                        {{-- ================= STEP 2 ================= --}}
                        @if ($step == 2)
                            <div class="row">

                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        Nama Lengkap
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input type="text" wire:model="nama_anggota"
                                            class="form-control @error('nama_anggota') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap">

                                        @error('nama_anggota')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('nama_anggota')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        No KTP
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input type="text" wire:model="no_ktp"
                                            class="form-control @error('no_ktp') is-invalid @enderror"
                                            placeholder="Masukkan no KTP">

                                        @error('no_ktp')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('no_ktp')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        No HP
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input type="text" wire:model="no_hp"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            placeholder="Masukkan no HP">

                                        @error('no_hp')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('no_hp')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        Jenis Kelamin
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <select wire:model="jenis_kelamin"
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror">

                                            <option value="">Pilih</option>
                                            <option>Laki-laki</option>
                                            <option>Perempuan</option>

                                        </select>

                                        @error('jenis_kelamin')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('jenis_kelamin')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group mb-3">
                                <label>
                                    Alamat
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="text" wire:model="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Masukkan alamat">

                                    @error('alamat')
                                        <div class="input-group-append">

                                            <span class="input-group-text bg-danger text-white border-danger">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </span>

                                        </div>
                                    @enderror

                                </div>

                                @error('alamat')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="row">

                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        Tempat Lahir
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input type="text" wire:model="tempat_lahir"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            placeholder="Masukkan tempat lahir">

                                        @error('tempat_lahir')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('tempat_lahir')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-3">

                                    <label>
                                        Tanggal Lahir
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input type="date" wire:model="tanggal_lahir"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror">

                                        @error('tanggal_lahir')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('tanggal_lahir')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        Agama
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <select wire:model="agama"
                                            class="form-control @error('agama') is-invalid @enderror">

                                            <option value="">Pilih</option>
                                            <option>Islam</option>
                                            <option>Kristen</option>
                                            <option>Katolik</option>
                                            <option>Hindu</option>
                                            <option>Buddha</option>
                                            <option>Konghucu</option>
                                            <option>Lainnya</option>

                                        </select>

                                        @error('agama')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('agama')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label>
                                        Nama Ibu Kandung
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input type="text" wire:model="nama_ibu_kandung"
                                            class="form-control @error('nama_ibu_kandung') is-invalid @enderror"
                                            placeholder="Masukkan nama ibu kandung">

                                        @error('nama_ibu_kandung')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('nama_ibu_kandung')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-3">

                                    <label>
                                        Status Rumah
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <select wire:model="status_rumah"
                                            class="form-control @error('status_rumah') is-invalid @enderror">

                                            <option value="">Pilih</option>
                                            <option>Milik Sendiri</option>
                                            <option>Milik Keluarga</option>
                                            <option>Milik Perusahaan</option>
                                            <option>Sewa</option>
                                        </select>

                                        @error('status_rumah')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('status_rumah')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group mb-4">

                                    <label>
                                        Penghasilan
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <select wire:model="penghasilan"
                                            class="form-control @error('penghasilan') is-invalid @enderror">

                                            <option value="">-- Pilih --</option>
                                            <option value="Dibawah Rp 500.000">Dibawah Rp 500.000</option>
                                            <option value="Rp 500.000 - Rp. 1.000.000">Rp 500rb - 1jt</option>
                                            <option value="Rp 1.000.000 - Rp. 2.000.000">Rp 1jt - 2jt</option>
                                            <option value="Rp 2.000.000 - Rp. 3.000.000">Rp 2jt - 3jt</option>
                                            <option value="Rp 3.000.000 - Rp. 4.000.000">Rp 3jt - 4jt</option>
                                            <option value="Rp 4.000.000 - Rp. 5.000.000">Rp 4jt - 5jt</option>
                                            <option value="Diatas Rp 5.000.000">> 5jt</option>

                                        </select>

                                        @error('penghasilan')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('penghasilan')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group mb-3">

                                    <label>
                                        Ahli Waris
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input wire:model="nama_ahli_waris"
                                            class="form-control @error('nama_ahli_waris') is-invalid @enderror">

                                        @error('nama_ahli_waris')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('nama_ahli_waris')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group mb-3">

                                    <label>
                                        Hubungan
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <select wire:model="hubungan_ahli_waris"
                                            class="form-control @error('hubungan_ahli_waris') is-invalid @enderror">

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

                                        @error('hubungan_ahli_waris')
                                            <div class="input-group-append">

                                                <span class="input-group-text bg-danger text-white border-danger">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span>

                                            </div>
                                        @enderror

                                    </div>

                                    @error('hubungan_ahli_waris')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                            </div>

                            {{-- PEMBATAS --}}
                            <div class="border-top my-4"></div>

                            {{-- DATA TAMBAHAN --}}
                            <div class="d-flex align-items-center mb-3">

                                <h6 class="text-muted mb-0">
                                    Data Tambahan
                                </h6>

                                <span class="badge badge-light ml-2">
                                    Opsional
                                </span>

                            </div>

                            <div class="row">

                                <div class="col-md-6 form-group mb-3">
                                    <label>Tanggal Kawin</label>

                                    <input type="date" wire:model="tanggal_kawin" class="form-control">
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label>Nama Pasangan</label>

                                    <input wire:model="nama_pasangan" class="form-control">
                                </div>

                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2 border-top pt-2 pb-3">

                                <button wire:click="prev" class="btn btn-secondary px-4">

                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali

                                </button>

                                <button wire:click="saveStep2" class="btn btn-success px-4">

                                    <i class="fas fa-arrow-right mr-1"></i>
                                    Lanjut

                                </button>

                            </div>
                        @endif

                        {{-- ================= STEP 3 ================= --}}
                        @if ($step == 3)

                            <div class="form-group mb-4">

                                <label>Tanggal Wawancara</label>

                                <input type="date" wire:model="tanggal_wawancara" class="form-control"
                                    min="{{ date('Y-m-d') }}">

                            </div>

                            <div class="row mt-3">

                                @forelse ($this->jadwalList as $jadwal)
                                    <div class="col-md-4 mb-3">

                                        <button type="button" wire:click="pilihJadwal({{ $jadwal->id }})"
                                            class="btn btn-block p-3
                                            {{ $jadwal_id == $jadwal->id ? 'btn-success' : 'btn-outline-success' }}">

                                            <div class="mb-2">
                                                <i class="fas fa-clock fa-lg"></i>
                                            </div>

                                            <div class="font-weight-bold">

                                                {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($jadwal->waktu)->addHour()->format('H:i') }}

                                            </div>

                                            <small>
                                                Slot:
                                                {{ $jadwal->terisi }}/{{ $jadwal->kuota }}
                                            </small>

                                        </button>

                                    </div>

                                @empty

                                    <div class="col-12">

                                        <div class="alert alert-danger text-center">
                                            Tidak ada jadwal tersedia
                                        </div>

                                    </div>
                                @endforelse

                            </div>

                            @error('jadwal_id')
                                <small class="text-danger d-block mb-3">
                                    {{ $message }}
                                </small>
                            @enderror

                            <div class="d-flex justify-content-between mt-3">

                                <button wire:click="prev" type="button" class="btn btn-secondary">

                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali

                                </button>

                                <button wire:click="saveStep3" type="button" class="btn btn-success">

                                    <i class="fas fa-check mr-1"></i>
                                    Konfirmasi

                                </button>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

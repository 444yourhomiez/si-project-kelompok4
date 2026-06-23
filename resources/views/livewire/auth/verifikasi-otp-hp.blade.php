<div class="login-wrapper">
    <div class="login-container">
        <div class="login-box">
            <div class="card login-card p-4">
                <a href="{{ route('menunggu') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                </a>
                {{-- HEADER --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo_motekar.png') }}" alt="Logo Koperasi" class="mb-3"
                        style="width: 90px; height: 90px; object-fit: contain;">
                    <h2 class="text-success font-weight-bold mb-1">Verifikasi Nomor HP</h2>
                    <small class="text-muted">Koperasi Motekar</small>
                </div>

                @if (session('success'))
                    <div class="alert alert-success text-center py-2">
                        <i class="fas fa-check-circle mr-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info text-center py-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ session('info') }}
                    </div>
                @endif

                <div class="alert alert-light border text-center mb-4">
                    <i class="fas fa-mobile-alt text-success mr-1"></i>
                    Kode OTP telah dikirim ke email Anda untuk verifikasi nomor HP
                    <strong>{{ $anggota->no_hp ?? '-' }}</strong>.<br>
                    <small class="text-muted">Berlaku selama 10 menit.</small>
                </div>

                {{-- OTP INPUT --}}
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Masukkan Kode OTP <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" wire:model="otp" maxlength="6"
                            class="form-control custom-input text-center font-weight-bold @error('otp') is-invalid @enderror"
                            placeholder="Contoh: 123456" style="letter-spacing: 8px; font-size: 1.2rem;">
                        @error('otp')
                            <div class="input-group-append">
                                <span class="input-group-text bg-danger text-white border-danger">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span>
                            </div>
                        @enderror
                    </div>
                    @error('otp')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <button wire:click="verifikasi" wire:loading.attr="disabled" class="btn btn-success btn-block mb-3">
                    <span wire:loading.remove wire:target="verifikasi">
                        <i class="fas fa-check-circle mr-1"></i>
                        Verifikasi
                    </span>
                    <span wire:loading wire:target="verifikasi">
                        <i class="fas fa-spinner fa-spin mr-1"></i>
                        Memverifikasi...
                    </span>
                </button>

                <div class="text-center">
                    <small class="text-muted">Tidak menerima OTP?</small><br>
                    <button wire:click="kirimUlang" wire:loading.attr="disabled"
                        class="btn btn-link text-success p-0 mt-1" style="font-size: 0.9rem;">
                        <span wire:loading.remove wire:target="kirimUlang">
                            <i class="fas fa-redo mr-1"></i>
                            Kirim Ulang OTP
                        </span>
                        <span wire:loading wire:target="kirimUlang">
                            <i class="fas fa-spinner fa-spin mr-1"></i>
                            Mengirim...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

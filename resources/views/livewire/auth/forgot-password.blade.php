<div class="login-wrapper">
    <div class="login-container">
        <div class="login-box">
            <div class="card login-card">
                <a href="{{ route('login') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                </a>
                {{-- HEADER --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo_motekar.png') }}" alt="Logo Koperasi" class="mb-3"
                        style="width: 90px; height: 90px; object-fit: contain;">
                    <h2 class="text-success font-weight-bold mb-1">Koperasi Motekar</h2>
                    <small class="text-muted">Lupa Password</small>
                </div>

                @if ($terkirim)
                    <div class="alert alert-success text-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Link reset password telah dikirim ke email Anda.<br>
                        <small>Cek inbox atau folder <strong>Spam</strong> jika tidak ada di inbox.</small>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-block">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali ke Login
                        </a>
                    </div>
                @else
                    <p class="text-center text-muted mb-4">
                        Masukkan email yang terdaftar. Kami akan kirimkan link untuk reset password.
                    </p>

                    <div wire:loading.class="opacity-50 pe-none" wire:target="kirim">
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <input type="email" wire:model.live="email"
                                    class="form-control custom-input @error('email') is-invalid @enderror"
                                    placeholder="Email terdaftar"
                                    wire:loading.attr="disabled" wire:target="kirim">
                                @error('email')
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-danger text-white border-danger">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </span>
                                    </div>
                                @else
                                    <div class="input-group-append">
                                        <div class="input-group-text bg-white">
                                            <span class="fas fa-envelope text-success"></span>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <button wire:click="kirim" wire:loading.attr="disabled" wire:target="kirim"
                            class="btn btn-login btn-block">
                            <span wire:loading.remove wire:target="kirim">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Kirim Link Reset
                            </span>
                            <span wire:loading wire:target="kirim">
                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                Mengirim email, harap tunggu...
                            </span>
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small>
                            Ingat password?
                            <a href="{{ route('login') }}" class="text-success font-weight-bold">Login</a>
                        </small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

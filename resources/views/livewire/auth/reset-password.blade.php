<div class="login-wrapper">
    <div class="login-container">
        <div class="login-box">
            <div class="card login-card">
                {{-- HEADER --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo_motekar.png') }}" alt="Logo Koperasi" class="mb-3"
                        style="width: 90px; height: 90px; object-fit: contain;">
                    <h2 class="text-success font-weight-bold mb-1">Koperasi Motekar</h2>
                    <small class="text-muted">Reset Password</small>
                </div>

                @if ($errorMessage)
                    <div class="alert alert-danger text-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $errorMessage }}
                        @if (str_contains($errorMessage, 'kedaluwarsa'))
                            <div class="mt-2">
                                <a href="{{ route('password.request') }}" class="btn btn-sm btn-outline-danger">
                                    Minta Link Baru
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                <p class="text-center text-muted mb-4">Masukkan password baru Anda.</p>

                {{-- EMAIL (readonly, diambil dari link) --}}
                <div class="form-group mb-3">
                    <div class="input-group">
                        <input type="email" wire:model="email"
                            class="form-control custom-input bg-light @error('email') is-invalid @enderror"
                            placeholder="Email" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-envelope text-success"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                {{-- PASSWORD BARU --}}
                <div class="form-group mb-3">
                    <div class="input-group">
                        <input type="password" wire:model="password"
                            class="form-control custom-input @error('password') is-invalid @enderror"
                            placeholder="Password baru (min. 8 karakter)">
                        <div class="input-group-append"
                            onclick="var i=this.closest('.input-group').querySelector('input');i.type=i.type==='password'?'text':'password';var ic=this.querySelector('i');ic.classList.toggle('fa-eye');ic.classList.toggle('fa-eye-slash');"
                            style="cursor:pointer;">
                            <div class="input-group-text bg-white">
                                <i class="fas fa-eye text-success"></i>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="form-group mb-4">
                    <div class="input-group">
                        <input type="password" wire:model="password_confirmation"
                            class="form-control custom-input @error('password_confirmation') is-invalid @enderror"
                            placeholder="Konfirmasi password baru">
                        <div class="input-group-append"
                            onclick="var i=this.closest('.input-group').querySelector('input');i.type=i.type==='password'?'text':'password';var ic=this.querySelector('i');ic.classList.toggle('fa-eye');ic.classList.toggle('fa-eye-slash');"
                            style="cursor:pointer;">
                            <div class="input-group-text bg-white">
                                <i class="fas fa-eye text-success"></i>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <button wire:click="simpan" wire:loading.attr="disabled" class="btn btn-login btn-block">
                    <span wire:loading.remove wire:target="simpan">
                        <i class="fas fa-key mr-1"></i>
                        Reset Password
                    </span>
                    <span wire:loading wire:target="simpan">
                        <i class="fas fa-spinner fa-spin mr-1"></i>
                        Memproses...
                    </span>
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-muted" style="font-size:0.85rem;">
                        <i class="fas fa-arrow-left mr-1"></i> Minta link reset baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

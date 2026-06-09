<div class="login-wrapper">

    <div class="login-container">

        <div class="login-box">
            <div class="card login-card">

                <a href="{{ route('homepage') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                </a>

                {{-- HEADER --}}
                <div class="text-center mb-4">

                    <img src="{{ asset('images/logo_motekar.png') }}" alt="Logo Koperasi" class="mb-3"
                        style="width: 90px; height: 90px; object-fit: contain;">

                    <h2 class="text-success font-weight-bold mb-1">
                        Koperasi Motekar
                    </h2>

                    <small class="text-muted">
                        Sistem Simpan Pinjam
                    </small>
                    
                </div>

                <p class="text-center text-muted mb-4">
                    Silakan login untuk melanjutkan
                </p>

                {{-- ERROR --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- EMAIL --}}
                <div class="input-group mb-3">
                    <input type="email" wire:model="email" class="form-control custom-input" placeholder="Email">

                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-envelope text-success"></span>
                        </div>
                    </div>
                </div>

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- PASSWORD --}}
                <div class="input-group mb-3">
                    <input type="password" wire:model="password" class="form-control custom-input"
                        placeholder="Password">

                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-lock text-success"></span>
                        </div>
                    </div>
                </div>

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- REMEMBER --}}
                {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="icheck-success">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                </div> --}}

                {{-- BUTTON --}}
                <button wire:click="login" class="btn btn-login btn-block">
                    <i class="fas fa-sign-in-alt mr-1"></i>
                    Login
                </button>

                {{-- REGISTER --}}
                <div class="text-center mt-3">
                    <small>
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-success font-weight-bold">
                            Daftar
                        </a>
                    </small>
                </div>
            </div>
        </div>

    </div>

</div>

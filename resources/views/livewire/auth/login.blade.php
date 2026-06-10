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

                <form wire:submit.prevent="login">

                    {{-- EMAIL --}}
                    <div class="form-group mb-3">

                        <div class="input-group">

                            <input type="email" wire:model.live="email"
                                class="form-control custom-input @error('email') is-invalid @enderror"
                                placeholder="Email">

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
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- PASSWORD --}}
                    <div class="form-group mb-3">

                        <div class="input-group">

                            <input type="password" wire:model="password"
                                class="form-control custom-input @error('password') is-invalid @enderror"
                                placeholder="Password">

                            @error('password')
                                <div class="input-group-append">

                                    <span class="input-group-text bg-danger text-white border-danger">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </span>

                                </div>
                            @else
                                <div class="input-group-append">

                                    <div class="input-group-text bg-white">
                                        <span class="fas fa-lock text-success"></span>
                                    </div>

                                </div>
                            @enderror

                        </div>

                        @error('password')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


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
                    
                </form>

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

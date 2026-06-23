<div>
    <div class="modal fade"
         wire:ignore.self
         id="ubahPasswordPengawasModal"
         tabindex="-1"
         aria-hidden="true"
         data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                {{-- HEADER --}}
                <div class="modal-header bg-white">
                    <div>
                        <h5 class="modal-title font-weight-bold mb-1">
                            <i class="fas fa-lock text-primary mr-2"></i>
                            Ubah Password
                        </h5>
                        <small class="text-muted">
                            Perbarui keamanan akun Anda
                        </small>
                    </div>
                    <button type="button"
                            class="close"
                            data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                {{-- BODY --}}
                <div class="modal-body px-4 py-4">
                    {{-- PASSWORD LAMA --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Password Lama</label>
                        <div class="input-group">
                            <input type="password"
                                   wire:model.live="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" tabindex="-1"
                                    onclick="var i=this.closest('.input-group').querySelector('input');i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- PASSWORD BARU --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Password Baru</label>
                        <div class="input-group">
                            <input type="password"
                                   wire:model.live="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" tabindex="-1"
                                    onclick="var i=this.closest('.input-group').querySelector('input');i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- KONFIRMASI --}}
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password"
                                   wire:model.live="password_confirmation"
                                   class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" tabindex="-1"
                                    onclick="var i=this.closest('.input-group').querySelector('input');i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer bg-white">
                    <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal">
                        Batal
                    </button>
                    <button wire:click="updatePassword"
                            class="btn btn-success shadow-sm">
                        <i class="fas fa-save mr-1"></i>
                        Simpan Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
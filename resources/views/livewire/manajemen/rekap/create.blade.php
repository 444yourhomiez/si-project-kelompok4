<div>
    <div class="modal fade" wire:ignore.self id="createRekapModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                {{-- HEADER --}}
                <div class="modal-header bg-white">
                    <div>
                        <h5 class="modal-title font-weight-bold mb-1">
                            <i class="fas fa-plus-circle text-success mr-2"></i>
                            Tambah Rekapitulasi Harian
                        </h5>
                        <small class="text-muted">Catat transaksi uang masuk atau uang keluar</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                {{-- BODY --}}
                <div class="modal-body px-4 py-4">
                    {{-- JENIS TRANSAKSI --}}
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Jenis Transaksi <span class="text-danger">*</span>
                        </label>
                        <select wire:model="jenis"
                                class="form-control @error('jenis') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Transaksi --</option>
                            <option value="uang_masuk">Uang Masuk</option>
                            <option value="uang_keluar">Uang Keluar</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- NOMINAL --}}
                    <div class="form-group"
                         x-data="{
                             display: '',
                             format(e) {
                                 let raw = e.target.value.replace(/\./g, '').replace(/\D/g, '');
                                 if (parseInt(raw) > 999999999) raw = '999999999';
                                 this.display = raw ? raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
                                 $wire.set('nominal', raw ? parseInt(raw) : '');
                             }
                         }">
                        <label class="font-weight-bold">
                            Nominal <span class="text-danger">*</span>
                        </label>
                        <div class="input-group shadow-sm rounded overflow-hidden">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white border-0 px-3">Rp</span>
                            </div>
                            <input type="text"
                                   x-model="display"
                                   @input="format($event)"
                                   class="form-control border-0 @error('nominal') is-invalid @enderror"
                                   placeholder="Contoh: 500.000"
                                   autocomplete="off">
                            @error('nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Minimal Rp 1.000 — Maksimal Rp 999.999.999</small>
                    </div>
                    {{-- KETERANGAN --}}
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">
                            Keterangan <span class="text-danger">*</span>
                        </label>
                        <textarea wire:model="keterangan"
                                  class="form-control @error('keterangan') is-invalid @enderror"
                                  rows="3"
                                  maxlength="255"
                                  placeholder="Tulis keterangan transaksi..."></textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ strlen($keterangan) }}/255 karakter</small>
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-light" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </button>
                    <button type="button"
                            wire:click="simpan"
                            wire:loading.attr="disabled"
                            class="btn btn-success">
                        <span wire:loading wire:target="simpan">
                            <i class="fas fa-spinner fa-spin mr-1"></i>
                        </span>
                        <span wire:loading.remove wire:target="simpan">
                            <i class="fas fa-save mr-1"></i>
                        </span>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

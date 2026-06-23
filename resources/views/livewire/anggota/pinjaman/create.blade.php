<div>
    <div class="modal fade" wire:ignore.self id="createModalPinjaman" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content shadow-lg">
                {{-- HEADER --}}
                <div class="modal-header bg-white">
                    <div>
                        <h5 class="modal-title font-weight-bold mb-1">
                            <i class="fas fa-hand-holding-usd text-primary mr-2"></i>
                            {{ $title }}
                        </h5>
                        <small class="text-muted">
                            Formulir pengajuan pinjaman
                        </small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                {{-- BODY --}}
                <div class="modal-body px-4 py-4">
                    {{-- JENIS PINJAMAN --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold">
                            Jenis Pinjaman
                            <span class="text-danger">*</span>
                        </label>
                        <select wire:model.live="jenis_pinjaman"
                            class="form-control @error('jenis_pinjaman') is-invalid @enderror">
                            <option value="">
                                -- Pilih Jenis Pinjaman --
                            </option>
                            <option value="biasa">
                                Pinjaman Biasa
                            </option>
                            <option value="khusus">
                                Pinjaman Khusus
                            </option>
                        </select>
                        @error('jenis_pinjaman')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    @if ($jenis_pinjaman)
                        <div class="alert alert-light border mb-3">
                            <strong>Informasi Pinjaman</strong>
                            <hr>
                            @if ($jenis_pinjaman == 'biasa')
                                <p class="mb-0">
                                    Bunga Pinjaman Biasa :
                                    <strong>0.6% / bulan</strong>
                                </p>
                            @else
                                <p class="mb-0">
                                    Bunga Pinjaman Khusus :
                                    <strong>1.2% / bulan</strong>
                                </p>
                            @endif
                        </div>
                    @endif
                    {{-- JUMLAH PINJAMAN --}}
                    <div class="col-md-12 mb-4" x-data="{
                        display: '{{ $jumlah_pengajuan ? number_format($jumlah_pengajuan, 0, ',', '.') : '' }}',
                        format(e) {
                            let raw = e.target.value.replace(/\./g, '').replace(/\D/g, '');
                            this.display = raw ? raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
                            $wire.set('jumlah_pengajuan', raw ? parseInt(raw) : '');
                        }
                    }">
                        <label class="font-weight-bold">
                            Jumlah Pinjaman
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group shadow-sm rounded overflow-hidden">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white border-0 px-3">
                                    Rp
                                </span>
                            </div>
                            <input type="text" x-model="display" @input="format($event)"
                                class="form-control border-0 @error('jumlah_pengajuan') is-invalid @enderror"
                                placeholder="Masukkan jumlah pinjaman">
                        </div>
                        @error('jumlah_pengajuan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- TENOR --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold">
                            Tenor
                            <span class="text-danger">*</span>
                        </label>
                        <select wire:model.live="tenor" class="form-control @error('tenor') is-invalid @enderror">
                            <option value="">
                                -- Pilih Tenor --
                            </option>
                            <option value="6">6 Bulan</option>
                            <option value="12">12 Bulan</option>
                            <option value="24">24 Bulan</option>
                            <option value="36">36 Bulan</option>
                            <option value="48">48 Bulan</option>
                            <option value="60">60 Bulan</option>
                        </select>
                        @error('tenor')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- TUJUAN PINJAMAN --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold">
                            Tujuan Pinjaman
                            <span class="text-danger">*</span>
                        </label>
                        <textarea wire:model.live="tujuan_pinjaman" class="form-control @error('tujuan_pinjaman') is-invalid @enderror"
                            rows="3" placeholder="Contoh: Modal usaha, biaya pendidikan, renovasi rumah"></textarea>
                        @error('tujuan_pinjaman')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- JAMINAN --}}
                    <div class="col-md-12 mb-4">
                        <label class="font-weight-bold">
                            Jaminan
                        </label>
                        <input type="text" wire:model="jaminan" class="form-control"
                            placeholder="Contoh: BPKB Motor, Sertifikat Rumah">
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-secondary">
                            <strong>Total Simpanan :</strong><br>
                            Rp {{ number_format($total_simpanan, 0, ',', '.') }}
                        </div>
                    </div>
                    {{-- SIMULASI --}}
                    @if ($jenis_pinjaman && $jumlah_pengajuan && $tenor)
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6 class="font-weight-bold mb-3">
                                    Simulasi Pinjaman
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Total Simpanan</strong><br>
                                        Rp {{ number_format($total_simpanan, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Jenis Pinjaman</strong><br>
                                        @if ($jenis_pinjaman == 'biasa')
                                            <span class="badge badge-success">
                                                Biasa
                                            </span>
                                        @elseif($jenis_pinjaman == 'khusus')
                                            <span class="badge badge-warning">
                                                Khusus
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                Belum Dipilih
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Jumlah Pinjaman</strong><br>
                                        Rp {{ number_format($jumlah_pengajuan, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Tenor</strong><br>
                                        {{ $tenor }} Bulan
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Jasa Pinjaman</strong><br>
                                        {{ $bunga }}% / bulan
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Jasa per Bulan</strong><br>
                                        Rp {{ number_format($jasa_per_bulan, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Provisi (1.5%)</strong><br>
                                        Rp {{ number_format($provisi, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Kapitalisasi (1%)</strong><br>
                                        Rp {{ number_format($kapitalisasi, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Dana Perlindungan (2%)</strong><br>
                                        Rp {{ number_format($dana_perlindungan, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Dana Diterima</strong><br>
                                        Rp {{ number_format($dana_diterima, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Cicilan / Bulan</strong><br>
                                        Rp {{ number_format($cicilan_per_bulan, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Total Pembayaran</strong><br>
                                        Rp {{ number_format($total_pembayaran, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($errorPinjaman)
                        <div class="col-md-12 mt-3">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ $errorPinjaman }}
                            </div>
                        </div>
                    @endif
                </div>
                @error('anggota_id')
                    <div class="alert alert-danger mt-2 ml-2 mr-2">
                        {{ $message }}
                    </div>
                @enderror
                {{-- FOOTER --}}
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-light btn-close-modal" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Tutup
                    </button>
                    <button wire:click="simpan" type="button" class="btn btn-success btn-save shadow-sm">
                        <i class="fas fa-paper-plane mr-1"></i>
                        Ajukan Pinjaman
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

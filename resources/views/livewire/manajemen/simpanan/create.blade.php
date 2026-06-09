<div>

    <div class="modal fade" wire:ignore.self id="createModalSimpanan" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-scrollable">

            <div class="modal-content shadow-lg">

                {{-- HEADER --}}
                <div class="modal-header bg-white">

                    <div>

                        <h5 class="modal-title font-weight-bold mb-1">
                            <i class="fas fa-wallet text-primary mr-2"></i>
                            Tambah {{ $title }}
                        </h5>

                        <small class="text-muted">
                            Tambahkan transaksi simpanan anggota
                        </small>

                    </div>

                    <button type="button" class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                {{-- BODY --}}
                <div class="modal-body px-4 py-4">

                    <div class="row">

                        {{-- PILIH ANGGOTA --}}
                        <div class="col-md-12 mb-4">

                            <label class="font-weight-bold">
                                Pilih Anggota
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" wire:model.live="search"
                                class="form-control @error('anggota_id') is-invalid @enderror"
                                placeholder="Cari nama / no KTP..." autocomplete="off">

                            @if ($selectedAnggota)
                                <button type="button" wire:click="resetAnggota" class="btn btn-danger btn-sm mt-2">

                                    <i class="fas fa-sync-alt mr-1"></i>
                                    Ganti Anggota

                                </button>
                            @endif

                            {{-- LIST --}}
                            {{-- LIST HASIL --}}
                            @if ($search && !$selectedAnggota)

                                <div class="position-absolute w-100 mt-2" style="z-index: 1000;">

                                    <div class="card shadow border-0 anggota-search-card">

                                        <div class="card-body p-2">

                                            @forelse($anggota as $a)
                                                <button type="button"
                                                    wire:click="pilihAnggota('{{ $a->id }}', '{{ $a->nama_anggota }}', '{{ $a->no_ktp }}')"
                                                    class="btn btn-light btn-block text-left mb-2 anggota-item-search">

                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <div>

                                                            {{-- NAMA --}}
                                                            <div class="font-weight-bold text-dark"
                                                                style="font-size: 15px;">

                                                                {{ $a->nama_anggota }}

                                                            </div>

                                                            {{-- KODE ANGGOTA --}}
                                                            <small class="text-primary d-block">

                                                                <i class="fas fa-user-tag mr-1"></i>
                                                                {{ $a->kode_anggota }}

                                                            </small>

                                                            {{-- NIK --}}
                                                            <small class="text-muted">

                                                                <i class="fas fa-id-card mr-1"></i>
                                                                {{ $a->no_ktp }}

                                                            </small>

                                                        </div>

                                                        {{-- BUTTON --}}
                                                        <div>

                                                            <span class="badge badge-primary px-3 py-2">

                                                                <i class="fas fa-check mr-1"></i>
                                                                Pilih

                                                            </span>

                                                        </div>

                                                    </div>

                                                </button>

                                            @empty

                                                <div class="text-center py-4 text-muted">

                                                    <i class="fas fa-search fa-2x mb-2"></i>

                                                    <div class="font-weight-bold">
                                                        Data anggota tidak ditemukan
                                                    </div>

                                                    <small>
                                                        Coba gunakan nama atau NIK lain
                                                    </small>

                                                </div>
                                            @endforelse

                                        </div>

                                    </div>

                                </div>

                            @endif



                            @error('anggota_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- JENIS SIMPANAN --}}
                        <div class="col-md-12 mb-4">

                            <label class="font-weight-bold">
                                Jenis Simpanan
                                <span class="text-danger">*</span>
                            </label>

                            <select wire:model="jenis_simpanan"
                                class="form-control @error('jenis_simpanan') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Jenis Simpanan --
                                </option>

                                <option value="wajib">
                                    Simpanan Wajib
                                </option>

                                <option value="pokok">
                                    Simpanan Pokok
                                </option>

                                <option value="sukarela">
                                    Simpanan Sukarela
                                </option>

                            </select>

                            @error('jenis_simpanan')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- JUMLAH --}}
                        <div class="col-md-12 mb-3">

                            <label class="font-weight-bold">
                                Jumlah Simpanan
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group shadow-sm rounded overflow-hidden" wire:ignore>

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white border-0 px-3">
                                        Rp
                                    </span>
                                </div>

                                <input type="text" id="rupiah"
                                    class="form-control border-0 @error('jumlah') is-invalid @enderror"
                                    placeholder="Masukkan jumlah simpanan">

                            </div>

                            {{-- PREVIEW --}}
                            @if ($jumlah)
                                <div class="mt-2">

                                    <small class="text-muted">
                                        Nominal Simpanan
                                    </small>

                                    <div class="font-weight-bold text-success" style="font-size: 18px;">

                                        Rp {{ number_format($jumlah, 0, ',', '.') }}

                                    </div>

                                </div>
                            @endif

                            @error('jumlah')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        {{-- FORMAT RUPIAH --}}
                        <script>
                            function initRupiahInput() {
                                const rupiah = document.getElementById('rupiah');
                                if (!rupiah || rupiah._rupiahInit) return;
                                rupiah._rupiahInit = true;

                                rupiah.addEventListener('input', function() {
                                    let angka = this.value.replace(/[^0-9]/g, '');
                                    @this.set('jumlah', angka);
                                    this.value = new Intl.NumberFormat('id-ID').format(angka);
                                });
                            }

                            document.addEventListener('livewire:init', () => {
                                initRupiahInput();

                                Livewire.on('openCreate', () => {
                                    const rupiah = document.getElementById('rupiah');
                                    if (rupiah) rupiah.value = '';
                                    // Re-init jika belum terpasang
                                    setTimeout(initRupiahInput, 50);
                                });
                            });

                            // Fallback: juga jalankan saat navigasi
                            document.addEventListener('livewire:navigated', initRupiahInput);
                        </script>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer bg-white">

                    <button type="button" class="btn btn-light btn-close-modal" data-dismiss="modal">

                        <i class="fas fa-times mr-1"></i>
                        Tutup

                    </button>

                    <button wire:click="simpan" type="button" class="btn btn-primary btn-save shadow-sm">

                        <i class="fas fa-save mr-1"></i>
                        Simpan Sekarang

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<div>
    <div class="modal fade" wire:ignore.self id="deleteModalSimpanan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
                {{-- HEADER --}}
                <div class="modal-header bg-white">
                    <div>
                        <h5 class="modal-title font-weight-bold mb-1">
                            <i class="fas fa-trash-alt text-danger mr-2"></i>
                            Hapus Simpanan
                        </h5>
                        <small class="text-muted">
                            Konfirmasi penghapusan transaksi simpanan
                        </small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                {{-- BODY --}}
                <div class="modal-body px-4 py-4">
                    @if ($simpanan)
                        {{-- TOP --}}
                        <div
                            style="
                            background:#ffffff;
                            border:1px solid #e9ecef;
                            border-radius:18px;
                            padding:18px;
                            margin-bottom:22px;
                            box-shadow:0 2px 12px rgba(0,0,0,.03);
                        ">
                            <div class="d-flex align-items-center">
                                {{-- ICON --}}
                                <div
                                    style="
                                    width:60px;
                                    height:60px;
                                    border-radius:18px;
                                    background:#fee2e2;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    margin-right:16px;
                                ">
                                    <i class="fas fa-wallet
                                              text-danger"
                                        style="font-size:24px;"></i>
                                </div>
                                {{-- INFO --}}
                                <div>
                                    <div
                                        style="
                                        font-size:17px;
                                        font-weight:700;
                                        color:#212529;
                                        margin-bottom:4px;
                                    ">
                                        {{ $simpanan->anggota->nama_anggota ?? '-' }}
                                    </div>
                                    <div class="text-muted" style="font-size:13px;">
                                        Data transaksi simpanan anggota
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- DETAIL --}}
                        <div
                            style="
                            background:#f8f9fa;
                            border:1px solid #e9ecef;
                            border-radius:18px;
                            padding:18px;
                        ">
                            <div
                                style="
                                display:grid;
                                grid-template-columns:120px 1fr;
                                row-gap:14px;
                                column-gap:12px;
                                font-size:14px;
                                line-height:1.7;
                            ">
                                {{-- KODE --}}
                                <div class="text-muted">
                                    ID Anggota
                                </div>
                                <div class="font-weight-bold text-dark">
                                    {{ $simpanan->anggota->kode_anggota ?? '-' }}
                                </div>
                                {{-- JENIS --}}
                                <div class="text-muted">
                                    Jenis
                                </div>
                                <div class="font-weight-bold text-dark">
                                    {{ $simpanan->jenis_simpanan }}
                                </div>
                                {{-- NOMINAL --}}
                                <div class="text-muted">
                                    Nominal
                                </div>
                                <div class="font-weight-bold text-success">
                                    Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}
                                </div>
                                {{-- TANGGAL --}}
                                <div class="text-muted">
                                    Tanggal
                                </div>
                                <div class="font-weight-bold text-dark">
                                    {{ \Carbon\Carbon::parse($simpanan->tanggal)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        {{-- WARNING --}}
                        <div class="alert border-0 mt-4"
                            style="
                                background:#fff7ed;
                                border-radius:16px;
                             ">
                            <div class="d-flex align-items-start">
                                <div class="mr-3">
                                    <div
                                        style="
                                        width:42px;
                                        height:42px;
                                        border-radius:12px;
                                        background:#fed7aa;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    ">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-weight-bold text-dark mb-1">
                                        Perhatian
                                    </div>
                                    <small class="text-muted">
                                        Data yang dihapus tidak dapat dikembalikan kembali.
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-light btn-close-modal" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </button>
                    <button wire:click="delete" type="button" class="btn btn-danger shadow-sm px-4">
                        <i class="fas fa-trash-alt mr-1"></i>
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

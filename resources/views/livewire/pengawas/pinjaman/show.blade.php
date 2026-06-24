<div>
    <div class="modal fade" id="showModalPinjaman" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg overflow-hidden">
                @if ($detailPinjaman)
                    <div class="modal-header border-0 py-0 px-0">
                        <div class="w-100" style="background: linear-gradient(135deg, #155724 0%, #28a745 100%); padding: 20px 24px 16px;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white-50 small mb-1">
                                        <i class="fas fa-hand-holding-usd mr-1"></i>
                                        Detail Pengajuan Pinjaman
                                    </div>
                                    <h5 class="text-white font-weight-bold mb-1">
                                        {{ $detailPinjaman->anggota?->nama_anggota ?? '-' }}
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        @if ($detailPinjaman->jenis_pinjaman == 'biasa')
                                            <span class="badge badge-light text-success mr-2">
                                                <i class="fas fa-tag mr-1"></i> Pinjaman Biasa
                                            </span>
                                        @else
                                            <span class="badge badge-light text-primary mr-2">
                                                <i class="fas fa-tag mr-1"></i> Pinjaman Khusus
                                            </span>
                                        @endif
                                        @if ($detailPinjaman->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif ($detailPinjaman->status == 'aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @elseif ($detailPinjaman->status == 'ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @elseif ($detailPinjaman->status == 'lunas')
                                            <span class="badge badge-info">Lunas</span>
                                        @endif
                                    </div>
                                </div>
                                <button type="button" class="close text-white" data-dismiss="modal" style="font-size:1.4rem;">
                                    <span>&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body px-4 py-3">
                        <div class="row mb-3">
                            <div class="col-4 text-center p-2">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Jumlah Pengajuan</small>
                                    <div class="font-weight-bold text-success" style="font-size:1rem;">
                                        Rp {{ number_format($detailPinjaman->jumlah_pengajuan, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center p-2">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Dana Diterima</small>
                                    <div class="font-weight-bold text-primary" style="font-size:1rem;">
                                        Rp {{ number_format($detailPinjaman->dana_diterima, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center p-2">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Total Pembayaran</small>
                                    <div class="font-weight-bold text-danger" style="font-size:1rem;">
                                        Rp {{ number_format($detailPinjaman->total_pembayaran, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body py-3">
                                <h6 class="font-weight-bold text-success mb-3">
                                    <i class="fas fa-info-circle mr-1"></i> Informasi Pinjaman
                                </h6>
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Tenor</small>
                                        <div class="font-weight-bold">{{ $detailPinjaman->tenor }} Bulan</div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Jasa Pinjaman</small>
                                        <div class="font-weight-bold">{{ $detailPinjaman->bunga }}% / bulan</div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Cicilan / Bulan</small>
                                        <div class="font-weight-bold text-success">
                                            Rp {{ number_format($detailPinjaman->cicilan_per_bulan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Provisi (1.5%)</small>
                                        <div class="font-weight-bold">
                                            Rp {{ number_format($detailPinjaman->provisi, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted">Kapitalisasi (1%)</small>
                                        <div class="font-weight-bold">
                                            Rp {{ number_format($detailPinjaman->kapitalisasi, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-6 mb-0">
                                        <small class="text-muted">Dana Perlindungan (2%)</small>
                                        <div class="font-weight-bold">
                                            Rp {{ number_format($detailPinjaman->dana_perlindungan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-bullseye mr-1"></i> Tujuan Pinjaman
                                </small>
                                <div class="border rounded px-3 py-2 bg-white small" style="min-height:48px;">
                                    {{ $detailPinjaman->tujuan_pinjaman ?: '-' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-shield-alt mr-1"></i> Jaminan
                                </small>
                                <div class="border rounded px-3 py-2 bg-white small" style="min-height:48px;">
                                    {{ $detailPinjaman->jaminan ?: '-' }}
                                </div>
                            </div>
                        </div>

                        @if($detailPinjaman->catatan)
                            <div class="mb-0">
                                <label class="font-weight-bold small text-muted">
                                    <i class="fas fa-sticky-note mr-1"></i> Catatan Manajemen
                                </label>
                                <div class="border rounded px-3 py-2 bg-light small">
                                    {{ $detailPinjaman->catatan }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Tutup
                        </button>
                    </div>
                @else
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Detail Pinjaman</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body text-center py-5">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

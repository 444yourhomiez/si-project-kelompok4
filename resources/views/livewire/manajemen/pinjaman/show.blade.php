<div class="modal fade" id="showModalPinjaman" wire:ignore.self tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Detail Pinjaman
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($detailPinjaman)
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Nama Anggota</strong><br>
                            {{ $detailPinjaman->anggota->nama_anggota }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Jenis Pinjaman</strong><br>
                            @if ($detailPinjaman->jenis_pinjaman == 'biasa')
                                <span class="badge badge-success">
                                    Biasa
                                </span>
                            @else
                                <span class="badge badge-primary">
                                    Khusus
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Jumlah Pengajuan</strong><br>
                            Rp {{ number_format($detailPinjaman->jumlah_pengajuan, 0, ',', '.') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tenor</strong><br>
                            {{ $detailPinjaman->tenor }} Bulan
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Jasa Pinjaman</strong><br>
                            {{ $detailPinjaman->bunga }}% / bulan
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Cicilan / Bulan</strong><br>
                            Rp {{ number_format($detailPinjaman->cicilan_per_bulan, 0, ',', '.') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Provisi (1.5%)</strong><br>
                            Rp {{ number_format($detailPinjaman->provisi, 0, ',', '.') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Kapitalisasi (1%)</strong><br>
                            Rp {{ number_format($detailPinjaman->kapitalisasi, 0, ',', '.') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Dana Perlindungan (2%)</strong><br>
                            Rp {{ number_format($detailPinjaman->dana_perlindungan, 0, ',', '.') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Dana Diterima</strong><br>
                            Rp {{ number_format($detailPinjaman->dana_diterima, 0, ',', '.') }}
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Total Pembayaran</strong><br>
                            Rp {{ number_format($detailPinjaman->total_pembayaran, 0, ',', '.') }}
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Tujuan Pinjaman</strong><br>
                            {{ $detailPinjaman->tujuan_pinjaman }}
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Jaminan</strong><br>
                            {{ $detailPinjaman->jaminan ?? '-' }}
                        </div>
                        <div class="col-md-12">
                            <label class="font-weight-bold">
                                Catatan Manajemen
                            </label>
                            <textarea wire:model="catatan" class="form-control" rows="4"
                                placeholder="Masukkan alasan persetujuan atau penolakan..."></textarea>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button wire:click="tolak" class="btn btn-danger">
                    Tolak
                </button>
                <button wire:click="setujui" class="btn btn-success">
                    Setujui
                </button>
            </div>
        </div>
    </div>
</div>

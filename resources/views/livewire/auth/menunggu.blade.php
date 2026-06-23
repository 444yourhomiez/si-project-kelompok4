<div wire:poll.15s="checkStatus" class="login-wrapper">
    <div class="login-container">
        <div class="login-box" style="max-width: 480px;">
            <div class="card login-card p-4">
                {{-- BACK --}}
                <div class="mb-2">
                    <a href="{{ route('homepage') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Homepage
                    </a>
                </div>

                {{-- FLASH MESSAGES --}}
                @if (session('success') || session('email_verified'))
                    <div class="alert alert-success py-2 text-center">
                        <i class="fas fa-check-circle mr-1"></i>
                        {{ session('success') ?? 'Email berhasil diverifikasi!' }}
                    </div>
                @endif
                @if (session('info'))
                    <div class="alert alert-info py-2 text-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ session('info') }}
                    </div>
                @endif

                {{-- HEADER --}}
                <div class="text-center mb-3">
                    <h3 class="text-success font-weight-bold mb-1">Status Pendaftaran</h3>
                    <small class="text-muted">Koperasi Motekar</small>
                </div>

                {{-- ICON STATUS --}}
                <div class="text-center mb-3">
                    @if ($status == 'menunggu')
                        <i class="fas fa-clock fa-3x text-warning"></i>
                    @elseif ($status == 'disetujui')
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    @else
                        <i class="fas fa-times-circle fa-3x text-danger"></i>
                    @endif
                </div>

                {{-- TITLE STATUS --}}
                <h5 class="text-center font-weight-bold">
                    @if ($status == 'menunggu')
                        Sedang Ditinjau
                    @elseif ($status == 'disetujui')
                        Pendaftaran Disetujui
                    @else
                        Pendaftaran Ditolak
                    @endif
                </h5>
                <p class="text-center text-muted small">
                    @if ($status == 'menunggu')
                        Data Anda sedang diverifikasi.
                        Silakan menunggu jadwal wawancara dari pihak koperasi.
                    @elseif ($status == 'disetujui')
                        Selamat! Akun Anda sudah disetujui.
                    @else
                        Silakan hubungi admin koperasi.
                    @endif
                </p>

                {{-- INFO BOX --}}
                <div class="info-box mb-3">
                    <div class="row text-start">
                        <div class="col-6 mb-2">
                            <small>Nama</small>
                            <div>{{ $anggota->nama_anggota ?? '-' }}</div>
                        </div>
                        <div class="col-6 mb-2">
                            <small>Email</small>
                            <div>{{ $user->email }}</div>
                        </div>
                        <div class="col-6">
                            <small>NIK</small>
                            <div>{{ $anggota->no_ktp ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <small>Status</small>
                            <span class="badge {{ $status == 'disetujui' ? 'bg-success' : ($status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>
                        @if ($anggota && $anggota->jadwal)
                            <div class="col-12 mt-2">
                                <small>Jadwal Wawancara</small>
                                <div>
                                    {{ \Carbon\Carbon::parse($anggota->jadwal->tanggal)->format('d M Y') }}
                                    - {{ $anggota->jadwal->waktu }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($status == 'menunggu')
                    <div class="text-center mt-1">
                        <small class="text-muted">
                            <i class="fas fa-sync-alt fa-spin"></i>
                            Memperbarui status...
                        </small>
                    </div>
                @endif

                @if ($status == 'disetujui')
                    <a href="{{ route('login') }}" class="btn btn-success w-100 mt-3">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        Login Sekarang
                    </a>
                @endif

                @if ($status == 'ditolak')
                    <div class="alert alert-danger mt-3 text-center">
                        Akun Anda ditolak dan akan dihapus otomatis.
                    </div>
                    <a href="{{ route('homepage') }}" class="btn btn-dark w-100 mt-2">
                        Kembali ke Beranda
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

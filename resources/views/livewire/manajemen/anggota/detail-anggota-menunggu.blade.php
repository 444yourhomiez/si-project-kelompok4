<div>
    <div class="content-wrapper modern-wrapper">
        {{-- HEADER --}}
        <section class="content-header modern-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <div class="modern-header-icon">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div>
                                <h1 class="modern-title mb-0">Detail Anggota</h1>
                                <small class="text-muted">Verifikasi data anggota koperasi</small>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('manajemen.anggota.menunggu') }}" class="btn modern-back-btn">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                {{-- PROFILE CARD --}}
                <div class="card border-0 modern-profile-card mb-4">
                    <div class="card-body px-4 py-4">
                        <div class="d-flex justify-content-between align-items-start flex-wrap" style="gap:16px;">
                            {{-- AVATAR + INFO --}}
                            <div class="d-flex align-items-center" style="gap:18px;">
                                <div class="modern-avatar flex-shrink-0">
                                    <span style="font-size:2rem;font-weight:800;color:#fff;">
                                        {{ strtoupper(substr($anggota->nama_anggota, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-weight-bold mb-1" style="font-size:1.3rem;">
                                        {{ $anggota->nama_anggota }}
                                    </h3>
                                    <div class="text-muted mb-2" style="font-size:0.85rem;">
                                        <i class="fas fa-id-badge mr-1"></i>
                                        {{ $anggota->no_ktp }}
                                    </div>
                                    <span class="modern-status">
                                        <i class="fas fa-clock mr-1"></i>
                                        Menunggu Verifikasi
                                    </span>
                                </div>
                            </div>
                            {{-- ACTION BUTTONS --}}
                            <div class="d-flex flex-wrap" style="gap:10px;">
                                <button wire:click="tolak" class="btn modern-danger-btn" style="min-width:110px;">
                                    <i class="fas fa-times-circle mr-1"></i>Tolak
                                </button>
                                <button wire:click="setujui" class="btn modern-success-btn" style="min-width:110px;">
                                    <i class="fas fa-check-circle mr-1"></i>Setujui
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BIODATA --}}
                <div class="card border-0 modern-detail-card mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-id-card text-success mr-2"></i>Biodata Anggota
                        </h5>
                        <small class="text-muted">Informasi lengkap anggota koperasi</small>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nama Lengkap</small>
                                    <h6>{{ $anggota->nama_anggota }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Email</small>
                                    <h6>{{ $anggota->user->email }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nomor KTP</small>
                                    <h6>{{ $anggota->no_ktp }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nomor HP</small>
                                    <h6>{{ $anggota->no_hp }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Tempat Lahir</small>
                                    <h6>{{ $anggota->tempat_lahir ?: '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Tanggal Lahir</small>
                                    <h6>
                                        {{ $anggota->tanggal_lahir
                                            ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
                                            : '-' }}
                                        @if($anggota->tanggal_lahir)
                                            <small class="text-muted font-weight-normal">
                                                ({{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->age }} tahun)
                                            </small>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Jenis Kelamin</small>
                                    <h6>{{ $anggota->jenis_kelamin ?: '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Agama</small>
                                    <h6>{{ $anggota->agama ?: '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nama Ibu Kandung</small>
                                    <h6>{{ $anggota->nama_ibu_kandung ?: '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Status Rumah</small>
                                    <h6>{{ $anggota->status_rumah ?: '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Penghasilan</small>
                                    <h6>{{ $anggota->penghasilan ?: '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Tanggal Daftar</small>
                                    <h6>{{ $anggota->tanggal_daftar_format }}</h6>
                                </div>
                            </div>
                            @if($anggota->tanggal_kawin || $anggota->nama_pasangan)
                                <div class="col-md-6">
                                    <div class="modern-detail-item">
                                        <small>Tanggal Kawin</small>
                                        <h6>{{ $anggota->tanggal_kawin
                                            ? \Carbon\Carbon::parse($anggota->tanggal_kawin)->translatedFormat('d F Y')
                                            : '-' }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modern-detail-item">
                                        <small>Nama Pasangan</small>
                                        <h6>{{ $anggota->nama_pasangan ?? '-' }}</h6>
                                    </div>
                                </div>
                            @endif
                            @if($anggota->nama_ahli_waris)
                                <div class="col-md-6">
                                    <div class="modern-detail-item">
                                        <small>Nama Ahli Waris</small>
                                        <h6>{{ $anggota->nama_ahli_waris }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modern-detail-item">
                                        <small>Hubungan Ahli Waris</small>
                                        <h6>{{ $anggota->hubungan_ahli_waris ?: '-' }}</h6>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="modern-detail-item mb-0">
                                    <small>Alamat</small>
                                    <h6 class="alamat-text">{{ $anggota->alamat ?: '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS (shortcut bawah halaman, hanya mobile) --}}
                <div class="d-md-none mb-4">
                    <div class="row no-gutters" style="gap:0;">
                        <div class="col-6 pr-1">
                            <button wire:click="tolak" class="btn modern-danger-btn btn-block">
                                <i class="fas fa-times-circle mr-1"></i>Tolak
                            </button>
                        </div>
                        <div class="col-6 pl-1">
                            <button wire:click="setujui" class="btn modern-success-btn btn-block">
                                <i class="fas fa-check-circle mr-1"></i>Setujui
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

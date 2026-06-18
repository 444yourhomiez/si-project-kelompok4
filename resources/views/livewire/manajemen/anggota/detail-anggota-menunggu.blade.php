<div>
    <div class="content-wrapper modern-wrapper">
        {{-- HEADER --}}
        <section class="content-header modern-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    {{-- TITLE --}}
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="modern-header-icon">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div>
                                <h1 class="modern-title mb-1">
                                    Detail Anggota
                                </h1>
                                <small class="text-muted">
                                    Verifikasi data anggota koperasi
                                </small>
                            </div>
                        </div>
                    </div>
                    {{-- BACK --}}
                    <a href="{{ route('manajemen.anggota.menunggu') }}"
                        class="btn modern-back-btn">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            <div class="container-fluid">
                {{-- PROFILE CARD --}}
                <div class="card border-0 modern-profile-card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            {{-- LEFT --}}
                            <div class="d-flex align-items-center flex-wrap">
                                {{-- AVATAR --}}
                                <div class="modern-avatar mr-4">
                                    <i class="fas fa-user"></i>
                                </div>
                                {{-- PROFILE --}}
                                <div>
                                    <h3 class="font-weight-bold mb-1">
                                        {{ $anggota->nama_anggota }}
                                    </h3>
                                    <div class="text-muted mb-3">
                                        {{ $anggota->kode_anggota ?? 'Belum Tersedia' }}
                                    </div>
                                    <span class="modern-status">
                                        <i class="fas fa-clock mr-1"></i>
                                        Menunggu Verifikasi
                                    </span>
                                </div>
                            </div>
                            {{-- ACTION --}}
                            <div class="d-flex flex-wrap mt-3 mt-md-0">
                                {{-- TOLAK --}}
                                <button wire:click="tolak"
                                    class="btn modern-danger-btn mr-2">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Tolak
                                </button>
                                {{-- SETUJUI --}}
                                <button wire:click="setujui"
                                    class="btn modern-success-btn">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Setujui
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- BIODATA --}}
                <div class="card border-0 modern-detail-card">
                    {{-- HEADER --}}
                    <div class="card-header modern-detail-header">
                        <div>
                            <h5 class="mb-1 font-weight-bold">
                                Biodata Anggota
                            </h5>
                            <small class="text-muted">
                                Informasi lengkap anggota koperasi
                            </small>
                        </div>
                    </div>
                    {{-- BODY --}}
                    <div class="card-body pt-2">
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
                                    <h6>{{ $anggota->tempat_lahir }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Tanggal Lahir</small>
                                    <h6>
                                        {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y') }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Jenis Kelamin</small>
                                    <h6>{{ $anggota->jenis_kelamin }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Agama</small>
                                    <h6>{{ $anggota->agama }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nama Ibu Kandung</small>
                                    <h6>{{ $anggota->nama_ibu_kandung }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nama Ahli Waris</small>
                                    <h6>{{ $anggota->nama_ahli_waris }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Hubungan Ahli Waris</small>
                                    <h6>{{ $anggota->hubungan_ahli_waris }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Status Rumah</small>
                                    <h6>{{ $anggota->status_rumah }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Penghasilan</small>
                                    <h6>{{ $anggota->penghasilan }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Tanggal Kawin</small>
                                    <h6>
                                        {{ $anggota->tanggal_kawin 
                                            ? \Carbon\Carbon::parse($anggota->tanggal_kawin)->translatedFormat('d F Y')
                                            : '-' }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Nama Pasangan</small>
                                    <h6>{{ $anggota->nama_pasangan ?? '-' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-detail-item">
                                    <small>Tanggal Daftar</small>
                                    <h6>{{ $anggota->tanggal_daftar_format }}</h6>
                                </div>
                            </div>
                            {{-- ALAMAT --}}
                            <div class="col-12">
                                <div class="modern-detail-item mb-0">
                                    <small>Alamat</small>
                                    <h6 class="alamat-text">
                                        {{ $anggota->alamat }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
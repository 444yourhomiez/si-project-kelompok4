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
                                <small class="text-muted">Data anggota koperasi menunggu verifikasi</small>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pengawas.anggota.menunggu') }}" class="btn modern-back-btn">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                {{-- PROFILE CARD --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:14px;overflow:hidden;">
                    <div style="background:linear-gradient(135deg,#1a7f3c,#28a745);height:6px;"></div>
                    <div class="card-body px-4 py-4">
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
                                <div class="text-muted mb-1" style="font-size:0.85rem;">
                                    <i class="fas fa-id-badge mr-1"></i>{{ $anggota->no_ktp }}
                                </div>
                                <div class="text-muted mb-2" style="font-size:0.85rem;">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    Daftar: {{ \Carbon\Carbon::parse($anggota->tanggal_daftar)->format('d M Y') }}
                                    <small class="ml-1">
                                        (<span data-timestamp="{{ \Carbon\Carbon::parse($anggota->tanggal_daftar)->timestamp }}"></span>)
                                    </small>
                                </div>
                                <span class="badge px-3 py-1" style="background:#fff8e1;color:#f59e0b;border:1px solid #fde68a;border-radius:20px;font-size:0.78rem;">
                                    <i class="fas fa-clock mr-1"></i>Menunggu Verifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- READ-ONLY NOTICE --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;border-left:4px solid #17a2b8 !important;">
                    <div class="card-body py-3 d-flex align-items-center" style="gap:12px;">
                        <i class="fas fa-eye text-info" style="font-size:1.1rem;flex-shrink:0;"></i>
                        <small class="text-muted">
                            Pengawas hanya dapat melihat data ini. Untuk menyetujui atau menolak anggota, hubungi manajemen.
                        </small>
                    </div>
                </div>

                {{-- QUICK INFO STRIP --}}
                <div class="row mb-4">
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px;">
                            <div class="text-muted" style="font-size:0.78rem;">Jenis Kelamin</div>
                            <div class="font-weight-bold mt-1" style="font-size:0.95rem;">
                                {{ $anggota->jenis_kelamin ?: '-' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px;">
                            <div class="text-muted" style="font-size:0.78rem;">Usia</div>
                            <div class="font-weight-bold mt-1" style="font-size:0.95rem;">
                                {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->age . ' tahun' : '-' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px;">
                            <div class="text-muted" style="font-size:0.78rem;">Status Rumah</div>
                            <div class="font-weight-bold mt-1" style="font-size:0.95rem;">
                                {{ $anggota->status_rumah ?: '-' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px;">
                            <div class="text-muted" style="font-size:0.78rem;">Penghasilan</div>
                            <div class="font-weight-bold mt-1" style="font-size:0.95rem;">
                                {{ $anggota->penghasilan ?: '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BIODATA --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:14px;overflow:hidden;">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-id-card text-success mr-2"></i>Biodata Lengkap
                        </h5>
                        <small class="text-muted">Informasi data diri anggota koperasi</small>
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
                                    <small>No KTP/NIK</small>
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

            </div>
        </section>
    </div>
</div>

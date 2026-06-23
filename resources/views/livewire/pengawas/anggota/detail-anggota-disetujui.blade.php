<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="font-weight-bold">
                            <i class="fas fa-user-check text-success mr-2"></i>
                            Detail Anggota
                        </h1>
                        <ol class="breadcrumb p-0 bg-transparent mb-0" style="font-size:0.85rem;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('pengawas.dashboard') }}" class="text-muted breadcrumb-green">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pengawas.anggota.disetujui') }}" class="text-muted breadcrumb-green">Anggota Disetujui</a>
                            </li>
                            <li class="breadcrumb-item active text-success">Detail</li>
                        </ol>
                    </div>
                    <a href="{{ route('pengawas.anggota.disetujui') }}" class="btn btn-light shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            <div class="container-fluid">
                {{-- PROFILE CARD --}}
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <div style="background: linear-gradient(135deg, #155724 0%, #28a745 100%); padding: 28px 28px 60px;">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                    style="width:72px;height:72px;">
                                    <span class="text-success font-weight-bold" style="font-size:1.6rem;">
                                        {{ strtoupper(substr($anggota->nama_anggota, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-white">
                                <h4 class="font-weight-bold mb-1">{{ $anggota->nama_anggota }}</h4>
                                <div class="text-white-50 small mb-2">{{ $anggota->kode_anggota }}</div>
                                <span class="badge badge-light text-success px-3 py-1">
                                    <i class="fas fa-check-circle mr-1"></i> Anggota Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:-36px; padding: 0 20px 20px;">
                        <div class="row">
                            <div class="col-md-4 col-6 mb-2">
                                <div class="card border-0 shadow-sm h-100 mb-0">
                                    <div class="card-body py-3 text-center">
                                        <small class="text-muted d-block">Total Simpanan</small>
                                        <div class="font-weight-bold text-success mt-1" style="font-size:1rem;">
                                            Rp {{ number_format($anggota->simpanan->sum('jumlah'), 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-2">
                                <div class="card border-0 shadow-sm h-100 mb-0">
                                    <div class="card-body py-3 text-center">
                                        <small class="text-muted d-block">Simpanan Wajib</small>
                                        <div class="font-weight-bold text-primary mt-1" style="font-size:1rem;">
                                            Rp {{ number_format($anggota->simpanan->where('jenis_simpanan','wajib')->sum('jumlah'), 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-2">
                                <div class="card border-0 shadow-sm h-100 mb-0">
                                    <div class="card-body py-3 text-center">
                                        <small class="text-muted d-block">Tgl. Bergabung</small>
                                        <div class="font-weight-bold mt-1" style="font-size:0.9rem;">
                                            {{ $anggota->tanggal_daftar_format }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BIODATA --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="font-weight-bold mb-0 text-success">
                            <i class="fas fa-id-card mr-2"></i> Biodata Anggota
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-hashtag mr-1"></i> Kode Anggota</small>
                                <div class="font-weight-bold">{{ $anggota->kode_anggota ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-user mr-1"></i> Nama Lengkap</small>
                                <div class="font-weight-bold">{{ $anggota->nama_anggota }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-envelope mr-1"></i> Email</small>
                                <div class="font-weight-bold">{{ $anggota->user->email }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-phone mr-1"></i> Nomor HP</small>
                                <div class="font-weight-bold">{{ $anggota->no_hp }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-id-badge mr-1"></i> No KTP/NIK</small>
                                <div class="font-weight-bold">{{ $anggota->no_ktp }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</small>
                                <div class="font-weight-bold">{{ $anggota->jenis_kelamin ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-map-marker-alt mr-1"></i> Tempat Lahir</small>
                                <div class="font-weight-bold">{{ $anggota->tempat_lahir ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-birthday-cake mr-1"></i> Tanggal Lahir</small>
                                <div class="font-weight-bold">
                                    {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-' }}
                                    @if($anggota->tanggal_lahir)
                                        <small class="text-muted">({{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->age }} tahun)</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-pray mr-1"></i> Agama</small>
                                <div class="font-weight-bold">{{ $anggota->agama ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-home mr-1"></i> Status Rumah</small>
                                <div class="font-weight-bold">{{ $anggota->status_rumah ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-money-bill-wave mr-1"></i> Penghasilan</small>
                                <div class="font-weight-bold">{{ $anggota->penghasilan ?: '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-female mr-1"></i> Nama Ibu Kandung</small>
                                <div class="font-weight-bold">{{ $anggota->nama_ibu_kandung ?: '-' }}</div>
                            </div>
                            <div class="col-12 mb-3">
                                <small class="text-muted d-block"><i class="fas fa-map-pin mr-1"></i> Alamat</small>
                                <div class="font-weight-bold">{{ $anggota->alamat ?: '-' }}</div>
                            </div>
                        </div>
                        @if ($anggota->nama_ahli_waris)
                            <div class="border-top pt-3 mt-1">
                                <small class="text-muted text-uppercase font-weight-bold d-block mb-2" style="font-size:0.7rem; letter-spacing:0.05em;">
                                    Ahli Waris
                                </small>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Nama</small>
                                        <div class="font-weight-bold">{{ $anggota->nama_ahli_waris }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block">Hubungan</small>
                                        <div class="font-weight-bold">{{ $anggota->hubungan_ahli_waris ?: '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- RIWAYAT SIMPANAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold mb-0 text-success">
                            <i class="fas fa-wallet mr-2"></i> Riwayat Simpanan
                        </h5>
                        <span class="badge badge-success px-3 py-1">
                            {{ $anggota->simpanan->count() }} Transaksi
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Simpanan</th>
                                    <th class="text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($anggota->simpanan->sortByDesc('tanggal') as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                        <td>
                                            @if ($item->jenis_simpanan == 'wajib')
                                                <span class="badge badge-success">Wajib</span>
                                            @elseif ($item->jenis_simpanan == 'pokok')
                                                <span class="badge badge-primary">Pokok</span>
                                            @else
                                                <span class="badge badge-info">Sukarela</span>
                                            @endif
                                        </td>
                                        <td class="text-right font-weight-bold text-success">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                            Belum ada data simpanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($anggota->simpanan->count() > 0)
                                <tfoot>
                                    <tr class="font-weight-bold" style="background:#d4edda;">
                                        <td colspan="2" class="text-right">Total</td>
                                        <td class="text-right text-success">
                                            Rp {{ number_format($anggota->simpanan->sum('jumlah'), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

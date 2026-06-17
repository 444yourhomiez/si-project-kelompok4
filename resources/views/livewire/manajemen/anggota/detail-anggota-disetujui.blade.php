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
                        <small class="text-muted">
                            Informasi lengkap anggota koperasi
                        </small>
                    </div>
                    <a href="{{ route('manajemen.anggota.index') }}" class="btn btn-light shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            <div class="container-fluid">
                {{-- PROFILE --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            {{-- FOTO --}}
                            <div class="mr-4">
                                <div class="
                                    bg-success
                                    text-white
                                    rounded-circle
                                    d-flex
                                    align-items-center
                                    justify-content-center
                                "
                                    style="
                                    width:85px;
                                    height:85px;
                                    font-size:34px;
                                ">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            {{-- PROFILE --}}
                            <div>
                                <h3 class="font-weight-bold mb-1">
                                    {{ $anggota->nama_anggota }}
                                </h3>
                                <div class="text-muted mb-2">
                                    {{ $anggota->kode_anggota }}
                                </div>
                                <span class="badge badge-success px-3 py-2">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Disetujui
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- BIODATA --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="font-weight-bold mb-0">
                            Biodata Anggota
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- KODE --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Kode Anggota
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->kode_anggota }}
                                </div>
                            </div>
                            {{-- NAMA --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Nama Lengkap
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->nama_anggota }}
                                </div>
                            </div>
                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Email
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->user->email }}
                                </div>
                            </div>
                            {{-- KTP --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Nomor KTP
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->no_ktp }}
                                </div>
                            </div>
                            {{-- HP --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Nomor HP
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->no_hp }}
                                </div>
                            </div>
                            {{-- STATUS --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Status
                                </small>
                                <div>
                                    <span class="badge badge-success px-3 py-2">
                                        Disetujui
                                    </span>
                                </div>
                            </div>
                            {{-- TANGGAL --}}
                            <div class="col-md-6 mb-4">
                                <small class="text-muted">
                                    Tanggal Daftar
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->tanggal_daftar_format }}
                                </div>
                            </div>
                            {{-- ALAMAT --}}
                            <div class="col-12">
                                <small class="text-muted">
                                    Alamat
                                </small>
                                <div class="font-weight-bold">
                                    {{ $anggota->alamat }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- STATISTIK --}}
                <div class="row mb-4">
                    {{-- TOTAL SIMPANAN --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <small class="text-muted">
                                    Total Simpanan
                                </small>
                                <h3 class="font-weight-bold text-success mt-2">
                                    Rp
                                    {{ number_format($anggota->simpanan->sum('jumlah'), 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    {{-- TOTAL PINJAMAN
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <small class="text-muted">
                                    Total Pinjaman
                                </small>
                                <h3 class="font-weight-bold text-danger mt-2">
                                    Rp
                                    {{ number_format($anggota->pinjaman->sum('jumlah'), 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                    </div> --}}
                </div>
                {{-- RIWAYAT SIMPANAN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="font-weight-bold mb-0">
                            Riwayat Simpanan
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($anggota->simpanan as $item)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                        </td>
                                        <td>
                                            {{ $item->jenis_simpanan }}
                                        </td>
                                        <td class="font-weight-bold text-success">
                                            Rp
                                            {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Belum ada data simpanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- RIWAYAT PINJAMAN
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="font-weight-bold mb-0">
                            Riwayat Pinjaman
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($anggota->pinjaman as $item)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                        </td>
                                        <td class="font-weight-bold text-danger">
                                            Rp
                                            {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Belum ada data pinjaman
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
</div>

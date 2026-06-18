@php
    $user = auth()->user();
@endphp
<div>
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="font-weight-bold mb-1">
                            Detail Profile
                        </h3>
                        <small class="text-muted">
                            Informasi akun pengguna
                        </small>
                    </div>
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                        <li class="breadcrumb-item">
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Profile
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        {{-- CONTENT --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- LEFT --}}
                    <div class="col-md-3">
                        {{-- PROFILE --}}
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                {{-- FOTO --}}
                                <img src="{{ asset('adminlte3/dist/img/user2-160x160.jpg') }}"
                                     class="img-circle elevation-2 mb-3"
                                     width="110">
                                {{-- NAMA --}}
                                <h5 class="font-weight-bold mb-1">
                                    {{ $user->nama_user }}
                                </h5>
                                {{-- ROLE --}}
                                <p class="text-muted mb-3">
                                    {{ ucfirst($user->role) }}
                                </p>
                                {{-- BUTTON --}}
                                <button class="btn btn-success btn-block"
                                        data-toggle="modal"
                                        data-target="#ubahPasswordAnggotaModal">
                                    <i class="fas fa-lock mr-1"></i>
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                        {{-- INFORMASI --}}
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white">
                                <h6 class="mb-0 font-weight-bold">
                                    Informasi
                                </h6>
                            </div>
                            <div class="card-body">
                                {{-- EMAIL --}}
                                <div class="mb-3">
                                    <strong>
                                        <i class="fas fa-envelope mr-2 text-success"></i>
                                        Email
                                    </strong>
                                    <p class="text-muted mb-0 mt-1">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <hr>
                                {{-- ROLE --}}
                                <div class="mb-3">
                                    <strong>
                                        <i class="fas fa-user-shield mr-2 text-success"></i>
                                        Role
                                    </strong>
                                    <p class="text-muted mb-0 mt-1">
                                        {{ ucfirst($user->role) }}
                                    </p>
                                </div>
                                <hr>
                                {{-- BERGABUNG --}}
                                <div>
                                    <strong>
                                        <i class="fas fa-calendar-alt mr-2 text-success"></i>
                                        Bergabung Sejak
                                    </strong>
                                    <p class="text-muted mb-0 mt-1">
                                        {{ $user->created_at->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- RIGHT --}}
                    <div class="col-md-9">
                        {{-- DATA AKUN --}}
                        <div class="card shadow-sm border-0">
                            {{-- HEADER --}}
                            <div class="card-header bg-white">
                                <h5 class="font-weight-bold mb-0">
                                    Data Akun
                                </h5>
                            </div>
                            {{-- BODY --}}
                            <div class="card-body">
                                <div class="row">
                                    {{-- NAMA --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Nama Lengkap
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->nama_user }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- EMAIL --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Email
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->email }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- ROLE --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Role
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ ucfirst($user->role) }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- BERGABUNG --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Bergabung Sejak
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->created_at->translatedFormat('d F Y') }}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- INFORMASI PRIBADI --}}
                        <div class="card shadow-sm border-0 mt-4">
                            {{-- HEADER --}}
                            <div class="card-header bg-white">
                                <h5 class="font-weight-bold mb-0">
                                    Informasi Pribadi
                                </h5>
                            </div>
                            {{-- BODY --}}
                            <div class="card-body">
                                <div class="row">
                                    {{-- KODE ANGGOTA --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Kode Anggota
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->kode_anggota ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- NOMOR KTP --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Nomor KTP
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->no_ktp ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- NOMOR HP --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Nomor HP
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->no_hp ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- JENIS KELAMIN --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Jenis Kelamin
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->jenis_kelamin ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- TEMPAT LAHIR --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Tempat Lahir
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->tempat_lahir ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- TANGGAL LAHIR --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Tanggal Lahir
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota?->tanggal_lahir?->translatedFormat('d F Y') ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- AGAMA --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Agama
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->agama ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- STATUS RUMAH --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Status Rumah
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $user->anggota->status_rumah ?? '-' }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    {{-- ALAMAT --}}
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label>
                                                Alamat
                                            </label>
                                            <textarea class="form-control"
                                                      rows="4"
                                                      readonly>{{ $user->anggota->alamat ?? '-' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
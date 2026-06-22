<div>
    @php
        $user = auth()->user();
    @endphp
    <div>
        <div class="content-wrapper">
            {{-- HEADER --}}
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <i class="nav-icon fas fa-user mr-2"></i>
                                {{ $title }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('manajemen.dashboard') }}" class="text-muted breadcrumb-green">
                                        <i class="fas fa-th-large mr-1"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active text-success">
                                    <i class="nav-icon fas fa-user mr-1"></i>
                                    {{ $title }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            {{-- CONTENT --}}
            <section class="content">
                <div class="container-fluid">
                    @if (session('foto_success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle mr-1"></i>
                            {{ session('foto_success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        {{-- LEFT --}}
                        <div class="col-md-3">
                            {{-- PROFILE --}}
                            <div class="card shadow-sm border-0">
                                <div class="card-body text-center">
                                    {{-- FOTO --}}
                                    @if ($foto)
                                        <img src="{{ $foto->temporaryUrl() }}"
                                            class="img-circle elevation-2 mb-2"
                                            style="width:110px;height:110px;object-fit:cover;">
                                    @else
                                        <img src="{{ $user->foto_profile ? asset('storage/' . $user->foto_profile) : asset('adminlte3/dist/img/user2-160x160.jpg') }}"
                                            class="img-circle elevation-2 mb-2"
                                            style="width:110px;height:110px;object-fit:cover;">
                                    @endif
                                    {{-- UPLOAD FOTO --}}
                                    <div class="mb-3">
                                        <input type="file"
                                               wire:model="foto"
                                               id="fotoInputManajemen"
                                               accept="image/*"
                                               class="d-none">
                                        @if (!$foto)
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    onclick="document.getElementById('fotoInputManajemen').click()">
                                                <i class="fas fa-camera mr-1"></i>
                                                Ganti Foto
                                            </button>
                                        @else
                                            <button type="button"
                                                    wire:click="uploadFoto"
                                                    wire:loading.attr="disabled"
                                                    class="btn btn-sm btn-success">
                                                <span wire:loading wire:target="uploadFoto">
                                                    <i class="fas fa-spinner fa-spin mr-1"></i>
                                                </span>
                                                <span wire:loading.remove wire:target="uploadFoto">
                                                    <i class="fas fa-check mr-1"></i>
                                                </span>
                                                Simpan
                                            </button>
                                            <button type="button"
                                                    wire:click="batalFoto"
                                                    class="btn btn-sm btn-outline-danger ml-1">
                                                <i class="fas fa-times mr-1"></i>
                                                Batal
                                            </button>
                                        @endif
                                        @error('foto')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                        <div wire:loading wire:target="foto" class="text-muted small mt-1">
                                            <i class="fas fa-spinner fa-spin mr-1"></i> Memuat...
                                        </div>
                                    </div>
                                    {{-- NAMA --}}
                                    <h5 class="font-weight-bold mb-1">
                                        {{ $user->nama_user }}
                                    </h5>
                                    {{-- ROLE --}}
                                    <p class="text-muted mb-3">
                                        {{ ucfirst($user->role) }}
                                    </p>
                                    {{-- BUTTON --}}
                                    <button class="btn btn-success btn-block" data-toggle="modal"
                                        data-target="#ubahPasswordManajemenModal">
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
                                                <input type="text" class="form-control"
                                                    value="{{ $user->nama_user }}" readonly>
                                            </div>
                                        </div>
                                        {{-- EMAIL --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Email
                                                </label>
                                                <input type="text" class="form-control" value="{{ $user->email }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        {{-- ROLE --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Role
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ ucfirst($user->role) }}" readonly>
                                            </div>
                                        </div>
                                        {{-- BERGABUNG --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Bergabung Sejak
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->created_at->translatedFormat('d F Y') }}"
                                                    readonly>
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
</div>

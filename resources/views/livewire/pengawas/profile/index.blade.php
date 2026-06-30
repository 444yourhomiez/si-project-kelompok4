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
                                    <img id="fotoPreview"
                                        src="{{ $fotoUrl ?? asset('adminlte3/dist/img/user2-160x160.jpg') }}"
                                        class="img-circle elevation-2 mb-2"
                                        style="width:110px;height:110px;object-fit:cover;">
                                    {{-- UPLOAD FOTO --}}
                                    <div class="mb-3">
                                        <input type="file" id="fotoInput" accept="image/*" class="d-none">
                                        @if (session('foto_error'))
                                            <div class="alert alert-danger py-1 px-2 small mb-2">{{ session('foto_error') }}</div>
                                        @endif
                                        <div id="fotoBtnGanti">
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                onclick="document.getElementById('fotoInput').click()">
                                                <i class="fas fa-images mr-1"></i>Ganti Foto
                                            </button>
                                            <br><small class="text-muted">JPG, PNG, GIF &bull; Maks. 5MB</small>
                                        </div>
                                        <div id="fotoBtnSimpan" style="display:none;">
                                            <button type="button" id="fotoSimpanBtn" class="btn btn-sm btn-success">
                                                <i class="fas fa-check mr-1"></i>Simpan
                                            </button>
                                            <button type="button" id="fotoBatalBtn"
                                                class="btn btn-sm btn-outline-danger ml-1">
                                                <i class="fas fa-times mr-1"></i>Batal
                                            </button>
                                        </div>
                                        <div id="fotoError" class="text-danger small mt-1" style="display:none;"></div>
                                    </div>
                                    @script
                                    <script>
                                    (function () {
                                        const input     = document.getElementById('fotoInput');
                                        const preview   = document.getElementById('fotoPreview');
                                        const divGanti  = document.getElementById('fotoBtnGanti');
                                        const divSimpan = document.getElementById('fotoBtnSimpan');
                                        const btnSimpan = document.getElementById('fotoSimpanBtn');
                                        const btnBatal  = document.getElementById('fotoBatalBtn');
                                        const errDiv    = document.getElementById('fotoError');
                                        const origSrc   = preview.src;
                                        let base64 = null;

                                        function resetState() {
                                            base64 = null;
                                            preview.src = origSrc;
                                            divGanti.style.display = 'block';
                                            divSimpan.style.display = 'none';
                                            input.value = '';
                                            errDiv.style.display = 'none';
                                        }

                                        input.addEventListener('change', function (e) {
                                            const file = e.target.files[0];
                                            if (!file) return;
                                            errDiv.style.display = 'none';
                                            if (!file.type.startsWith('image/')) {
                                                errDiv.textContent = 'File harus berupa gambar.';
                                                errDiv.style.display = 'block';
                                                e.target.value = '';
                                                return;
                                            }
                                            if (file.size > 5 * 1024 * 1024) {
                                                errDiv.textContent = 'Ukuran gambar maksimal 5MB.';
                                                errDiv.style.display = 'block';
                                                e.target.value = '';
                                                return;
                                            }
                                            const reader = new FileReader();
                                            reader.onload = function (ev) {
                                                const img = new Image();
                                                img.onload = function () {
                                                    const canvas = document.createElement('canvas');
                                                    const max = 800;
                                                    let w = img.width, h = img.height;
                                                    if (w > max || h > max) {
                                                        if (w > h) { h = Math.round(h * max / w); w = max; }
                                                        else        { w = Math.round(w * max / h); h = max; }
                                                    }
                                                    canvas.width = w; canvas.height = h;
                                                    canvas.getContext('2d').drawImage(img, 0, 0, w, h);
                                                    base64 = canvas.toDataURL('image/jpeg', 0.85);
                                                    preview.src = base64;
                                                    divGanti.style.display = 'none';
                                                    divSimpan.style.display = 'block';
                                                };
                                                img.src = ev.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        });

                                        btnSimpan.addEventListener('click', function () {
                                            if (!base64) return;
                                            btnSimpan.disabled = true;
                                            btnSimpan.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...';
                                            $wire.call('uploadFoto', base64);
                                        });

                                        btnBatal.addEventListener('click', resetState);
                                    })();
                                    </script>
                                    @endscript
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
                                        data-target="#ubahPasswordPengawasModal">
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
                                                    value="{{ $user->created_at->translatedFormat('d F Y') }}" readonly>
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

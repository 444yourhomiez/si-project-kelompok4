  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('anggota.dashboard') }}" class="brand-link">
          <img src="{{ asset('images/logo_motekar.png') }}" alt="Koperasi Motekar"
              class="brand-image img-circle">
          <span class="brand-text font-weight-light ml-1">Koperasi Motekar</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  {{-- DASHBOARD --}}
                  <li class="nav-item">
                      <a href="{{ route('anggota.dashboard') }}" class="nav-link @yield('menuAnggotaDashboard')">
                          <i class="nav-icon fas fa-th-large"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  {{-- SIMPANAN --}}
                  {{-- <li class="nav-item">
                      <a href="{{ route('anggota.simpanan.index') }}"
                          class="nav-link @yield('menuAnggotaSimpanan')">
                          <i class="nav-icon fas fa-wallet"></i>
                          <p>
                              Simpanan
                          </p>
                      </a>
                  </li> --}}

                  {{-- PINJAMAN --}}
                  {{-- <li class="nav-item">
                      <a href="{{ route('anggota.pinjaman.index') }}"
                          class="nav-link @yield('menuAnggotaPinjaman')">
                          <i class="nav-icon fas fa-hand-holding-usd"></i>
                          <p>
                              Pinjaman
                          </p>
                      </a>
                  </li> --}}

                  {{-- PROFILE --}}
                  <li class="nav-item">
                      <a href="{{ route('anggota.profile.index') }}"
                          class="nav-link @yield('menuAnggotaProfile')">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Profile
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>

          <!-- Sidebar User Panel (Bottom) -->
          <div class="user-panel user-panel-bottom d-flex flex-column">
              <!-- Profil -->
              <div class="d-flex align-items-center">
                  <div class="image">
                      <img src="{{ asset('adminlte3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                          alt="User Image">
                  </div>
                  <div class="info ml-2">
                      <a href="#" class="d-block">
                          {{ auth()->user()->anggota->nama_anggota ?? '-' }}
                      </a>
                      <small class="text-muted">
                          {{ strtoupper(auth()->user()->role) }}
                      </small>
                  </div>
              </div>

              <!-- Logout di bawah -->
              <form id="logout-form" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button id="btn-logout" type="submit" class="btn btn-danger btn-sm btn-block">
                      <i class="fas fa-sign-out-alt"></i>
                      <span class="logout-text">Logout</span>
                  </button>
              </form>

          </div>

          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

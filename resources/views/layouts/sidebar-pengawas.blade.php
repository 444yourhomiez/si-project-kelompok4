  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('pengawas.dashboard') }}" class="brand-link">
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
                      <a wire:navigate href="{{ route('pengawas.dashboard') }}" class="nav-link @yield('menuPengawasDashboard')">
                          <i class="nav-icon fas fa-th-large"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  {{-- SIMPANAN --}}
                  {{-- <li class="nav-item">
                      <a wire:navigate href="{{ route('pengawas.simpanan.index') }}" class="nav-link @yield('menuPengawasSimpanan')">
                          <i class="nav-icon fas fa-wallet"></i>
                          <p>
                              Simpanan
                          </p>
                      </a>
                  </li> --}}

                  {{-- PINJAMAN --}}
                  {{-- <li class="nav-item">
                      <a wire:navigate href="{{ route('pengawas.pinjaman.index') }}" class="nav-link @yield('menuPengawasPinjaman')">
                          <i class="nav-icon fas fa-hand-holding-usd"></i>
                          <p>
                              Pinjaman
                          </p>
                      </a>
                  </li> --}}

                  {{-- ANGGOTA --}}
                  {{-- <li class="nav-item">
                      <a wire:navigate href="{{ route('pengawas.anggota.index') }}" class="nav-link @yield('menuPengawasAnggota')">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Anggota
                          </p>
                      </a>
                  </li> --}}

                  {{-- REKAPITULASI HARIAN --}}
                  {{-- <li class="nav-item">
                      <a wire:navigate href="{{ route('pengawas.rekap.index') }}" class="nav-link @yield('menuPengawasRekap')">
                          <i class="nav-icon fas fa-calendar-day"></i>
                          <p>
                              Rekapitulasi Harian
                          </p>
                      </a>
                  </li> --}}

                  {{-- LAPORAN --}}
                  {{-- <li class="nav-item">
                      <a wire:navigate href="{{ route('pengawas.laporan.index') }}" class="nav-link @yield('menuPengawasLaporan')">
                          <i class="nav-icon fas fa-file-invoice"></i>
                          <p>
                              Laporan
                          </p>
                      </a>
                  </li> --}}

                  {{-- PROFILE --}}
                  <li class="nav-item">
                      <a wire:navigate href="{{ route('pengawas.profile.index') }}"
                          class="nav-link @yield('menuPengawasProfile')">
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
                          {{ auth()->user()->nama_user ?? '-' }}
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

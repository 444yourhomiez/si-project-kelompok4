  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('anggota.dashboard') }}" class="brand-link">
          <img src="{{ asset('images/logo_motekar.png') }}" alt="Koperasi Motekar" class="brand-image img-circle">
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
                  <li class="nav-item has-treeview @yield('menuAnggotaSimpananOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuAnggotaSimpanan')">

                          <i class="nav-icon fas fa-wallet"></i>

                          <p>
                              Simpanan
                              <i class="right fas fa-angle-left"></i>
                          </p>

                      </a>

                      {{-- SUB MENU --}}
                      <ul class="nav nav-treeview">

                          {{-- SEMUA --}}
                          <li class="nav-item">
                              <a href="{{ route('anggota.simpanan.index') }}" class="nav-link @yield('menuAnggotaSimpananSemua')">

                                  <p>Daftar Simpanan</p>

                              </a>
                          </li>

                          {{-- WAJIB --}}
                          <li class="nav-item">
                              <a href="{{ route('anggota.simpanan.wajib') }}" class="nav-link @yield('menuAnggotaSimpananWajib')">

                                  <p>Simpanan Wajib</p>

                              </a>
                          </li>

                          {{-- POKOK --}}
                          <li class="nav-item">
                              <a href="{{ route('anggota.simpanan.pokok') }}" class="nav-link @yield('menuAnggotaSimpananPokok')">

                                  <p>Simpanan Pokok</p>

                              </a>
                          </li>

                          {{-- SUKARELA --}}
                          <li class="nav-item">
                              <a href="{{ route('anggota.simpanan.sukarela') }}" class="nav-link @yield('menuAnggotaSimpananSukarela')">

                                  <p>Simpanan Sukarela</p>

                              </a>
                          </li>

                      </ul>

                  </li>

                  {{-- PINJAMAN --}}
                  <li class="nav-item has-treeview @yield('menuAnggotaPinjamanOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuAnggotaPinjaman')">

                          <i class="nav-icon fas fa-hand-holding-usd"></i>

                          <p>
                              Pinjaman
                              <i class="right fas fa-angle-left"></i>
                          </p>

                      </a>

                      {{-- SUB MENU --}}
                      <ul class="nav nav-treeview">

                          {{-- DAFTAR PINJAMAN --}}
                          <li class="nav-item">

                              <a  href="{{ route('anggota.pinjaman.index') }}"
                                  class="nav-link @yield('menuAnggotaPinjamanSemua')">


                                  <p>
                                      Daftar Pinjaman
                                  </p>

                              </a>

                          </li>

                          {{-- PRIBADI --}}
                          <li class="nav-item">

                              <a  href="{{ route('anggota.pinjaman.pribadi') }}"
                                  class="nav-link @yield('menuAnggotaPinjamanPribadi')">


                                  <p>
                                      Pinjaman Pribadi
                                  </p>

                              </a>

                          </li>

                          {{-- KHUSUS --}}
                          <li class="nav-item">

                              <a  href="{{ route('anggota.pinjaman.khusus') }}"
                                  class="nav-link @yield('menuAnggotaPinjamanKhusus')">


                                  <p>
                                      Pinjaman Khusus
                                  </p>

                              </a>

                          </li>

                      </ul>

                  </li>

                  {{-- CICILAN --}}
                  <li class="nav-item has-treeview @yield('menuAnggotaCicilanOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuAnggotaCicilan')">

                          <i class="fas fa-money-bill-wave"></i>

                          <p>
                              Cicilan
                              <i class="right fas fa-angle-left"></i>
                          </p>

                      </a>

                      {{-- SUB MENU --}}
                      <ul class="nav nav-treeview">

                          {{-- DAFTAR PINJAMAN --}}
                          <li class="nav-item">

                              <a  href="{{ route('anggota.cicilan.index') }}"
                                  class="nav-link @yield('menuAnggotaCicilanSemua')">


                                  <p>
                                      Daftar Cicilan
                                  </p>

                              </a>

                          </li>

                          {{-- PRIBADI --}}
                          <li class="nav-item">

                              <a  href="{{ route('anggota.cicilan.pribadi') }}"
                                  class="nav-link @yield('menuAnggotaCicilanPribadi')">


                                  <p>
                                      Cicilan Pinjaman Pribadi
                                  </p>

                              </a>

                          </li>

                          {{-- KHUSUS --}}
                          <li class="nav-item">

                              <a  href="{{ route('anggota.cicilan.khusus') }}"
                                  class="nav-link @yield('menuAnggotaCicilanKhusus')">


                                  <p>
                                      Cicilan Pinjaman Khusus
                                  </p>

                              </a>

                          </li>

                      </ul>

                  </li>

                  {{-- PROFILE --}}
                  <li class="nav-item">
                      <a href="{{ route('anggota.profile.index') }}" class="nav-link @yield('menuAnggotaProfile')">
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

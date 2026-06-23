  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('manajemen.dashboard') }}" class="brand-link">
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
                      <a  href="{{ route('manajemen.dashboard') }}" class="nav-link @yield('menuManajemenDashboard')">
                          <i class="nav-icon fas fa-th-large"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">MENU UTAMA</li>
                  {{-- SIMPANAN --}}
                  <li class="nav-item has-treeview @yield('menuManajemenSimpananOpen')">
                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuManajemenSimpanan')">
                          <i class="nav-icon fas fa-coins"></i>
                          <p>
                              Simpanan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      {{-- SUB MENU --}}
                      <ul class="nav nav-treeview">
                          {{-- SEMUA --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.simpanan.index') }}"
                                  class="nav-link @yield('menuManajemenSimpananSemua')">
                                  <p>Daftar Simpanan</p>
                              </a>
                          </li>
                          {{-- WAJIB --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.simpanan.wajib') }}"
                                  class="nav-link @yield('menuManajemenSimpananWajib')">
                                  <p>Simpanan Wajib</p>
                              </a>
                          </li>
                          {{-- POKOK --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.simpanan.pokok') }}"
                                  class="nav-link @yield('menuManajemenSimpananPokok')">
                                  <p>Simpanan Pokok</p>
                              </a>
                          </li>
                          {{-- SUKARELA --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.simpanan.sukarela') }}"
                                  class="nav-link @yield('menuManajemenSimpananSukarela')">
                                  <p>Simpanan Sukarela</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- PINJAMAN --}}
                  <li class="nav-item has-treeview @yield('menuManajemenPinjamanOpen')">
                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuManajemenPinjaman')">
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
                              <a  href="{{ route('manajemen.pinjaman.index') }}"
                                  class="nav-link @yield('menuManajemenPinjamanSemua')">
                                  <p>
                                      Daftar Pinjaman
                                  </p>
                              </a>
                          </li>
                          {{-- BIASA --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.pinjaman.biasa') }}"
                                  class="nav-link @yield('menuManajemenPinjamanBiasa')">
                                  <p>
                                      Pinjaman Biasa
                                  </p>
                              </a>
                          </li>
                          {{-- KHUSUS --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.pinjaman.khusus') }}"
                                  class="nav-link @yield('menuManajemenPinjamanKhusus')">
                                  <p>
                                      Pinjaman Khusus
                                  </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- CICILAN --}}
                  <li class="nav-item">
                      <a href="{{ route('manajemen.cicilan.index') }}" class="nav-link @yield('menuManajemenCicilan')">
                          <i class="nav-icon fas fa-money-bill-wave"></i>
                          <p>
                              Cicilan
                          </p>
                      </a>
                  </li>
                  {{-- ANGGOTA --}}
                  <li class="nav-item has-treeview @yield('menuManajemenAnggotaOpen')">
                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuManajemenAnggota')">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Anggota
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      {{-- SUB MENU --}}
                      <ul class="nav nav-treeview">
                          {{-- DAFTAR ANGGOTA --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.anggota.index') }}"
                                  class="nav-link @yield('menuManajemenAnggotaSemua')">
                                  <p>
                                      Daftar Anggota
                                  </p>
                              </a>
                          </li>
                          {{-- DISETUJUI --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.anggota.disetujui') }}"
                                  class="nav-link @yield('menuManajemenAnggotaDisetujui')">
                                  <p>
                                      Anggota Disetujui
                                  </p>
                              </a>
                          </li>
                          {{-- MENUNGGU --}}
                          <li class="nav-item">
                              <a  href="{{ route('manajemen.anggota.menunggu') }}"
                                  class="nav-link @yield('menuManajemenAnggotaMenunggu')">
                                  <p>
                                      Menunggu Verifikasi
                                  </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">LAINNYA</li>
                  {{-- REKAPITULASI HARIAN --}}
                  <li class="nav-item">
                      <a  href="{{ route('manajemen.rekap.index') }}" class="nav-link @yield('menuManajemenRekap')">
                          <i class="nav-icon fas fa-calendar-day"></i>
                          <p>
                              Rekapitulasi Harian
                          </p>
                      </a>
                  </li>
                  {{-- LAPORAN --}}
                  <li class="nav-item">
                      <a  href="{{ route('manajemen.laporan.index') }}"
                          class="nav-link @yield('menuManajemenLaporan')">
                          <i class="nav-icon fas fa-file-invoice"></i>
                          <p>
                              Laporan
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- Sidebar User Panel (Bottom) -->
          <div class="user-panel user-panel-bottom d-flex flex-column">
              <!-- Profil -->
              <a href="{{ route('manajemen.profile.index') }}">
                  <div class="d-flex align-items-center">
                      <div class="image">
                          <img src="{{ auth()->user()->foto_profile ? asset('storage/' . auth()->user()->foto_profile) : asset('adminlte3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                              alt="User Image" style="width:40px;height:40px;object-fit:cover;">
                      </div>
                      <div class="info ml-2">
                          <div class="d-block">
                              {{ auth()->user()->nama_user ?? '-' }}
                          </div>
                          <small class="text-muted">
                              {{ strtoupper(auth()->user()->role) }}
                          </small>
                      </div>
                  </div>
              </a>
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

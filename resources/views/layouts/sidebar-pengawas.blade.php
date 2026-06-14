  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('pengawas.dashboard') }}" class="brand-link">
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
                      <a  href="{{ route('pengawas.dashboard') }}" class="nav-link @yield('menuPengawasDashboard')">
                          <i class="nav-icon fas fa-th-large"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  {{-- SIMPANAN --}}
                  <li class="nav-item has-treeview @yield('menuPengawasSimpananOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuPengawasSimpanan')">

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
                              <a  href="{{ route('pengawas.simpanan.index') }}"
                                  class="nav-link @yield('menuPengawasSimpananSemua')">

                                  <p>Daftar Simpanan</p>

                              </a>
                          </li>

                          {{-- WAJIB --}}
                          <li class="nav-item">
                              <a  href="{{ route('pengawas.simpanan.wajib') }}"
                                  class="nav-link @yield('menuPengawasSimpananWajib')">

                                  <p>Simpanan Wajib</p>

                              </a>
                          </li>

                          {{-- POKOK --}}
                          <li class="nav-item">
                              <a  href="{{ route('pengawas.simpanan.pokok') }}"
                                  class="nav-link @yield('menuPengawasSimpananPokok')">

                                  <p>Simpanan Pokok</p>

                              </a>
                          </li>

                          {{-- SUKARELA --}}
                          <li class="nav-item">
                              <a  href="{{ route('pengawas.simpanan.sukarela') }}"
                                  class="nav-link @yield('menuPengawasSimpananSukarela')">

                                  <p>Simpanan Sukarela</p>

                              </a>
                          </li>

                      </ul>

                  </li>

                  {{-- PINJAMAN --}}
                  <li class="nav-item has-treeview @yield('menuPengawasPinjamanOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuPengawasPinjaman')">

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

                              <a  href="{{ route('pengawas.pinjaman.index') }}"
                                  class="nav-link @yield('menuPengawasPinjamanSemua')">


                                  <p>
                                      Daftar Pinjaman
                                  </p>

                              </a>

                          </li>

                          {{-- PRIBADI --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.pinjaman.pribadi') }}"
                                  class="nav-link @yield('menuPengawasPinjamanPribadi')">


                                  <p>
                                      Pinjaman Pribadi
                                  </p>

                              </a>

                          </li>

                          {{-- KHUSUS --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.pinjaman.khusus') }}"
                                  class="nav-link @yield('menuPengawasPinjamanKhusus')">


                                  <p>
                                      Pinjaman Khusus
                                  </p>

                              </a>

                          </li>

                      </ul>

                  </li>

                  {{-- CICILAN --}}
                  <li class="nav-item has-treeview @yield('menuPengawasCicilanOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuPengawasCicilan')">

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

                              <a  href="{{ route('pengawas.cicilan.index') }}"
                                  class="nav-link @yield('menuPengawasCicilanSemua')">


                                  <p>
                                      Daftar Cicilan
                                  </p>

                              </a>

                          </li>

                          {{-- PRIBADI --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.cicilan.pribadi') }}"
                                  class="nav-link @yield('menuPengawasCicilanPribadi')">


                                  <p>
                                      Cicilan Pinjaman Pribadi
                                  </p>

                              </a>

                          </li>

                          {{-- KHUSUS --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.cicilan.khusus') }}"
                                  class="nav-link @yield('menuPengawasCicilanKhusus')">


                                  <p>
                                      Cicilan Pinjaman Khusus
                                  </p>

                              </a>

                          </li>

                      </ul>

                  </li>

                  {{-- ANGGOTA --}}
                  <li class="nav-item has-treeview @yield('menuPengawasAnggotaOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuPengawasAnggota')">

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

                              <a  href="{{ route('pengawas.anggota.index') }}"
                                  class="nav-link @yield('menuPengawasAnggotaSemua')">

                                  <p>
                                      Daftar Anggota
                                  </p>

                              </a>

                          </li>

                          {{-- DISETUJUI --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.anggota.disetujui') }}"
                                  class="nav-link @yield('menuPengawasAnggotaDisetujui')">

                                  <p>
                                      Anggota Disetujui
                                  </p>

                              </a>

                          </li>

                          {{-- MENUNGGU --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.anggota.menunggu') }}"
                                  class="nav-link @yield('menuPengawasAnggotaMenunggu')">

                                  <p>
                                      Menunggu Verifikasi
                                  </p>

                              </a>

                          </li>

                      </ul>

                  </li>

                  {{-- REKAPITULASI HARIAN --}}
                  <li class="nav-item has-treeview @yield('menuPengawasRekapOpen')">

                      {{-- PARENT --}}
                      <a href="#" class="nav-link @yield('menuPengawasRekap')">

                          <i class="nav-icon fas fa-calendar-day"></i>

                          <p>
                              Rekapitulasi Harian
                              <i class="right fas fa-angle-left"></i>
                          </p>

                      </a>

                      {{-- SUB MENU --}}
                      <ul class="nav nav-treeview">

                          {{-- REKAPITULASI HARI --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.rekap.index') }}"
                                  class="nav-link @yield('menuPengawasRekapSemua')">

                                  <p>
                                      Daftar Rekapitulasi Harian
                                  </p>

                              </a>

                          </li>

                          {{-- DUM --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.rekap.dum') }}"
                                  class="nav-link @yield('menuPengawasRekapDum')">

                                  <p>
                                      DUM
                                  </p>

                              </a>

                          </li>

                          {{-- DUK --}}
                          <li class="nav-item">

                              <a  href="{{ route('pengawas.rekap.duk') }}"
                                  class="nav-link @yield('menuPengawasRekapDuk')">

                                  <p>
                                      DUK
                                  </p>

                              </a>

                          </li>

                      </ul>

                  </li>

                  {{-- LAPORAN --}}
                  <li class="nav-item">
                      <a  href="{{ route('pengawas.laporan.index') }}"
                          class="nav-link @yield('menuPengawasLaporan')">
                          <i class="nav-icon fas fa-file-invoice"></i>
                          <p>
                              Laporan
                          </p>
                      </a>
                  </li>

                  {{-- PROFILE --}}
                  <li class="nav-item">
                      <a  href="{{ route('pengawas.profile.index') }}"
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

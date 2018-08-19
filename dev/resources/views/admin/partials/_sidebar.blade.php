<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">
                <span class="menu-title">Dashboard</span>
                {{-- <span class="menu-sub-title">( 2 new updates )</span> --}}
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Data Master</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/master_user') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Pengiklan</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/master_kategori') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Kategori</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/master_sub_kategori') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Sub Kategori</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/master_features_paid') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Features Paid</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/pop_up') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Pop Up</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/voucher') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Voucher</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/filter') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Master Filter</a>
                  </li>


                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts2" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Pengelola Iklan</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/iklan_pengguna', 'pending') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Iklan Yang Pending</a>
                    <a class="nav-link" href="{{ url('/iklan_pengguna', 'approved') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Iklan Yang Disetujui</a>
                    <a class="nav-link" href="{{ url('/iklan_pengguna', 'reject') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Iklan Yang Ditolak</a>
                    <a class="nav-link" href="{{ url('/laporan_user') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Laporan Iklan</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts-koin" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts-koin">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/transaksi') }}">Transaksi Koin</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#reporting" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Reporting</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="reporting">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> 
                    <a class="nav-link open_additional_modal" href="#" tppabs="http://localhost:7777/djualaja_admin/master-user" data-url="/laporan/laporan_pengiklan/setting" data-title="Setting Laporan Data Pengiklan">Laporan Daftar Pengiklan</a>
                  </li>

                  <li class="nav-item"> 
                    <a class="nav-link open_additional_modal" href="#" tppabs="http://localhost:7777/djualaja_admin/master-user" data-url="/laporan/laporan_iklan/setting" data-title="Setting Laporan Data Iklan">Laporan Daftar Iklan</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>

          {{-- <div class="sidebar-progress">
            <p>Total Sales</p>
            <div class="progress progress-sm">
              <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p>50 Items sold</p>
          </div>
          <div class="sidebar-progress">
            <p>Customer Target</p>
            <div class="progress progress-sm">
              <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p>200 Items sold</p>
          </div> --}}
        </nav>
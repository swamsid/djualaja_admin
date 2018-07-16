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
                    <a class="nav-link" href="{{ url('/iklan_pengguna') }}" tppabs="http://localhost:7777/djualaja_admin/master-user">Data Iklan Pengguna</a>
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
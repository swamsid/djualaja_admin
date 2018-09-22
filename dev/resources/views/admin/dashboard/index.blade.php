@extends("admin.app")

@section("title", " Dashboard")


@section("extra_styles")

@endsection


@section("content")
  
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-yellow text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Iklan Baru Hari Ini</h4>
            <h2 class="font-weight-normal mb-5">{{ $iklan_hari_ini }} Iklan</h2>
            {{-- <p class="card-text">Incresed by 60%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Iklan Baru Bulan Ini</h4>
            <h2 class="font-weight-normal mb-5">{{ $iklan_bulan_ini }} Iklan</h2>
            {{-- <p class="card-text">Increased by 5%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Hasil Penjualan Token Hari Ini</h4>
            <h2 class="font-weight-normal mb-5">Rp. {{ number_format($total_token) }}</h2>
            {{-- <p class="card-text">Increased by 5%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Iklan Aktif</h4>
            <h2 class="font-weight-normal mb-5">{{ count($iklan->where('product_status', 'approved')) }} Iklan</h2>
            {{-- <p class="card-text">Decreased by 10%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-warning text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Iklan Pending</h4>
            <h2 class="font-weight-normal mb-5">{{ count($iklan->where('product_status', 'pending')) }} Iklan</h2>
            {{-- <p class="card-text">Decreased by 10%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Iklan Blocked</h4>
            <h2 class="font-weight-normal mb-5">{{ count($iklan->where('product_status', 'blocked')) }} Iklan</h2>
            {{-- <p class="card-text">Decreased by 10%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Pengguna Baru Hari Ini</h4>
            <h2 class="font-weight-normal mb-5">{{ $user_hari_ini }} Pengguna</h2>
            {{-- <p class="card-text">Decreased by 10%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-yellow text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Pengguna Baru Bulan Ini</h4>
            <h2 class="font-weight-normal mb-5">{{ $user_bulan_ini }} Pengguna</h2>
            {{-- <p class="card-text">Decreased by 10%</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-warning text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Jumlah Total Pengguna </h4>
            <h2 class="font-weight-normal mb-5">{{ count($users) }} Pengguna</h2>
            {{-- <p class="card-text">Increased by 5%</p> --}}
          </div>
        </div>
      </div>
      
    </div>
  </div>

@endsection


@section("extra_scripts")
  
@endsection
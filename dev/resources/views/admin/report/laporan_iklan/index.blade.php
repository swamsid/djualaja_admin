<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
  @include("admin.partials._head")

  <style type="text/css">
    .table-data-report{
      color: #3a3f51;
      font-size: 0.7em;
      margin-top: 15px;
      margin-bottom: 15px;
    }  

    .table-data-report th{
      text-align: center;
      background: #FF8800;
      color: #eee;
      border: 1px solid #ccc;
    }

    .table-data-report td{
      text-align: center;
      border: 1px solid #ccc;
    }
  </style>

</head>

<body style="background: #ccc;">

  {{-- @include("admin.partials._right_sidebar") --}}

  {{-- @include("admin.partials._template_setting") --}}
  <!-- partial -->

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    {{-- @include("admin.partials._navbar") --}}

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row" style="margin-top: 30px;">
        <div class="col-md-10 offset-1" style="background: white;">
          <div class="col-md-12" style="padding: 0px;">
            <table width="100%" border="0" style="color: #3a3f51;">
              <thead>
                <tr>
                  <th class="text-center" style="padding: 10px 10px 0px 10px;">Laporan Daftar Iklan</th>
                </tr>
                <tr>
                  <th class="text-center" style="padding: 5px 5px 0px 5px; font-size: 0.7em;">Djualaja - Untuk Wilayah Provinsi {{ $province }}</th>
                </tr>
                <tr>
                  <th class="text-center" style="padding: 5px; font-size: 0.7em;">
                    Bulan {{ $request->bulan }}
                  </th>
                </tr>
              </thead>
            </table>

            <table class="table-data-report" width="100%" border="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Iklan</th>
                  <th>Harga</th>
                  <th>Kondisi</th>
                  <th>Kota</th>
                  <th>Status</th>
                </tr>
              </thead>

              <tbody>

                @foreach($data as $key => $user)
                  <tr>
                    <td class="text-center">{{ ($key+1) }}</td>
                    <td class="text-center">{{ $user->product_name }}</td>
                    <td class="text-center">{{ number_format($user->product_price) }}</td>
                    <td class="text-center">{{ $user->product_condition }}</td>
                    <td class="text-center">{{ $user->district->regency->name }}</td>
                    <td class="text-center">{{ $user->product_status }}</td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include("admin.partials._script")

</body>

</html>

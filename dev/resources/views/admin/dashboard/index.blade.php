@extends("admin.app")

@section("title", " Dashboard")


@section("extra_styles")

@endsection


@section("content")
  
  <div class="content-wrapper">

    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card" style="background: white; color: #666; box-shadow: 0px 0px 10px #ccc;">
          <div class="row" style="padding: 0px;">
            <div class="col-md-3 text-center" style="border-right: 1px solid #ccc;">
              <i class="fa fa-exchange" style="font-size: 24pt; padding: 20px 0px; padding-left: 0.4em;"></i>
            </div>

            <div class="col-md-9">
              <div class="col-md-12" style="font-size: 10pt; padding: 10px 0px;">
                Total Pengunjung 1 Bulan Terakhir
              </div>

              <div class="col-md-12" style="font-size: 12pt; padding: 5px 0px; font-weight: bold;">
                {{ $month }} Pengunjung
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 stretch-card grid-margin">
        <div class="card" style="background: white; color: #666; box-shadow: 0px 0px 10px #ccc;">
          <div class="row" style="padding: 0px;">
            <div class="col-md-3 text-center" style="border-right: 1px solid #ccc;">
              <i class="fa fa-exchange" style="font-size: 24pt; padding: 20px 0px; padding-left: 0.4em;"></i>
            </div>

            <div class="col-md-9">
              <div class="col-md-12" style="font-size: 10pt; padding: 10px 0px;">
                Total Pengunjung 7 Hari Terakhir
              </div>

              <div class="col-md-12" style="font-size: 12pt; padding: 5px 0px; font-weight: bold;">
                {{ $week }} Pengunjung
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 stretch-card grid-margin">
        <div class="card" style="background: white; color: #666; box-shadow: 0px 0px 10px #ccc;">
          <div class="row" style="padding: 0px;">
            <div class="col-md-3 text-center" style="border-right: 1px solid #ccc;">
              <i class="fa fa-exchange" style="font-size: 24pt; padding: 20px 0px; padding-left: 0.4em;"></i>
            </div>

            <div class="col-md-9">
              <div class="col-md-12" style="font-size: 10pt; padding: 10px 0px;">
                Total Pengunjung Hari Ini
              </div>

              <div class="col-md-12" style="font-size: 12pt; padding: 5px 0px; font-weight: bold;">
                {{ $day }} Pengunjung
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 stretch-card grid-margin">
        <div class="card" style="background: white; color: #666; box-shadow: 0px 0px 5px #fefefe; padding: 0px 15px;">
          <canvas id="canvas"></canvas>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card" style="background: white; color: #666; box-shadow: 0px 0px 10px #ccc;">
          <div class="col-md-12 text-center" style="background: #FF8800; color: white; padding: 10px 0px; border-bottom: 1px solid #ccc;">
            Top Browser
          </div>

          @foreach($top_browser as $num => $data_browser)
            <div class="col-md-12" style="background: #fff; color: #888; padding: 10px 20px; font-size: 11pt;">
              <div class="row">
                <div class="col-md-7">
                  {{ $num+1 }} . {{ $data_browser["browser"] }}
                </div>

                <div class="col-md-5 text-right" style="color: #007E33; font-weight: bold;">
                  <small>{{ $data_browser["sessions"] }} session</small>
                </div>
              </div>
            </div>
          @endforeach

          <div class="card" style="background: white; color: #666; box-shadow: 0px 0px 10px #ccc;">
            <div class="col-md-12 text-center" style="background: #FF8800; color: white; padding: 10px 0px; border-bottom: 1px solid #ccc;">
              Iklan Paling Banyak Dilihat
            </div>

            <div class="col-md-12" style="background: #fff; color: #888; padding: 10px 20px; font-size: 11pt;">
              <div class="row">
                <div class="col-md-12 text-center">
                  <a href="https://djualaja.com/iklan/{{ $top_iklan->product_id }}?np={{ $top_iklan->product_no }}" target="_blank"> 
                      djualaja.com/iklan/{{ $top_iklan->product_id }}?np={{ $top_iklan->product_no }}
                  </a>
                </div>
              </div>
            </div>
          </div>

      </div>
    </div>

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

    <script src="{{ asset('js/plugins/chart_js/dist/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/plugins/chart_js/samples/utils.js') }}"></script>

    <script type="text/javascript">
        
        var config = {
          type: 'line',
          data: {
            labels: {!! $encode_tanggal_chart !!},
            datasets: [
            {
              label: ' Pengunjung',
              fill: false,
              backgroundColor: window.chartColors.blue,
              borderColor: window.chartColors.blue,
              data: {!! $encode_nilai_chart !!},
            }]
          },
          options: {
            responsive: true,
            title: {
              display: true,
              text: 'Traffic Pengunjung 5 Hari Terakhir'
            },
            tooltips: {
              mode: 'index',
              intersect: false,
            },
            hover: {
              mode: 'nearest',
              intersect: true
            },
            scales: {
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Tanggal'
                }
              }],
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Jumlah Pengunjung'
                }
              }]
            }
          }
        };

        window.onload = function() {
          var ctx = document.getElementById('canvas').getContext('2d');
          window.myLine = new Chart(ctx, config);
        };

        document.getElementById('randomizeData').addEventListener('click', function() {
          config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
              return randomScalingFactor();
            });

          });

          window.myLine.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
          var colorName = colorNames[config.data.datasets.length % colorNames.length];
          var newColor = window.chartColors[colorName];
          var newDataset = {
            label: 'Dataset ' + config.data.datasets.length,
            backgroundColor: newColor,
            borderColor: newColor,
            data: [],
            fill: false
          };

          for (var index = 0; index < config.data.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
          }

          config.data.datasets.push(newDataset);
          window.myLine.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
          if (config.data.datasets.length > 0) {
            var month = MONTHS[config.data.labels.length % MONTHS.length];
            config.data.labels.push(month);

            config.data.datasets.forEach(function(dataset) {
              dataset.data.push(randomScalingFactor());
            });

            window.myLine.update();
          }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
          config.data.datasets.splice(0, 1);
          window.myLine.update();
        });

        document.getElementById('removeData').addEventListener('click', function() {
          config.data.labels.splice(-1, 1); // remove the label first

          config.data.datasets.forEach(function(dataset) {
            dataset.data.pop();
          });

          window.myLine.update();
        });
    </script>

@endsection
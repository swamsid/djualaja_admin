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
            <h4 class="font-weight-normal mb-3">Weekly Sales</h4>
            <h2 class="font-weight-normal mb-5">$ 15,00000.00</h2>
            <p class="card-text">Incresed by 60%</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Weekly Orders</h4>
            <h2 class="font-weight-normal mb-5">45633456</h2>
            <p class="card-text">Decreased by 10%</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary text-white">
          <div class="card-body">
            <h4 class="font-weight-normal mb-3">Visitors Online</h4>
            <h2 class="font-weight-normal mb-5">955741235</h2>
            <p class="card-text">Increased by 5%</p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection


@section("extra_scripts")
  
@endsection
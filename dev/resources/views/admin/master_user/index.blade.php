@extends("admin.app")

@section("title", " Master User")


@section("extra_styles")
  
  <style>

    .table th{
      background: #545454;
      color: white;
      text-align: center;
    }

    .table td, td{
      padding: 8px;
    }

    .opsi {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #fff;
    }

    .opsi li {
      float: left;
    }

    .opsi li a {
      display: block;
      color: #3a3f51;
      text-align: center;
      padding: 10px 20px;
      text-decoration: none;
    }

    .opsi li.hovered a:hover {
      background-color: #3a3f51;
      color: white;
    }

  </style>

@endsection


@section("content")
  
  <div class="content-wrapper">
  
    <div class="col-md-12 col-sm-12 col-xs-12">
      <nav aria-label="breadcrumb" role="navigation">
        <div class="row">
          <div class="col-11">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Master User</span> &nbsp;<small>( Pengiklan )</small></li>
            </ol>
          </div>

          <div class="col-1" style="padding: 5px 0px; background: none; height: 45px; border: 0px solid #ddd;">
            
            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;">
              <button type="button" class="btn btn-dark btn-xs" style="border: 0px solid white; height: 35px;">
                &nbsp; <i class="fa fa-ellipsis-v"></i> Opsi
              </button>
            </a>

          </div>
        </div>
      </nav>

    </div>

    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
      <div class="card">
        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body" style="padding: 0px;">
              <ul class="opsi">
                <li class="hovered"><a href="#home"><i class="fa fa-plus"></i> &nbsp;Tambah Data</a></li>
                <li class="hovered"><a href="#news"><i class="fa fa-file-pdf-o"></i> &nbsp;Print Pdf</a></li>
                <li class="hovered"><a href="#contact"><i class="fa fa-file-excel-o"></i> &nbsp;Print Excel</a></li>

                <li style="float: right;"><a href="#contact"><i class="fa fa-filter"></i> &nbsp;Filter</a></li>
              </ul>
            </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-12" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
                <h4 class="card-title">Data Table User <small>( Pengiklan )</small> </h4>
            </div>

            {{-- <div class="col-4 text-right" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
              <button type="button" class="btn btn-primary btn-xs" style="margin-top: -15px;"><i class="fa fa-plus"></i>Tambah</button>
            </div> --}}
          </div>

          <div class="row">
            <div class="col-12">
              <table id="order-listing" class="table table-bordered table-condensed" cellspacing="0">
                <thead>
                  <tr>
                      <th>Order #</th>
                      <th>Purchased On</th>
                      <th>Customer</th>
                      <th>Ship to</th>
                      <th>Base Price</th>
                      <th>Purchased Price</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>1</td>
                      <td>2012/08/03</td>
                      <td>Edinburgh</td>
                      <td>New York</td>
                      <td>$1500</td>
                      <td>$3200</td>
                      <td>
                        <label class="badge badge-info">On hold</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary btn-xs">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>2015/04/01</td>
                      <td>Doe</td>
                      <td>Brazil</td>
                      <td>$4500</td>
                      <td>$7500</td>
                      <td>
                        <label class="badge badge-danger">Pending</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary btn-sm">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>3</td>
                      <td>2010/11/21</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                        <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>4</td>
                      <td>2016/01/12</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                        <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>5</td>
                      <td>2017/12/28</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                        <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>6</td>
                      <td>2000/10/30</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                        <label class="badge badge-info">On-hold</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>7</td>
                      <td>2011/03/11</td>
                      <td>Cris</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                        <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>8</td>
                      <td>2015/06/25</td>
                      <td>Tim</td>
                      <td>Italy</td>
                      <td>$6300</td>
                      <td>$2100</td>
                      <td>
                        <label class="badge badge-info">On-hold</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>9</td>
                      <td>2016/11/12</td>
                      <td>John</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                        <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                  <tr>
                      <td>10</td>
                      <td>2003/12/26</td>
                      <td>Tom</td>
                      <td>Germany</td>
                      <td>$1100</td>
                      <td>$2300</td>
                      <td>
                        <label class="badge badge-danger">Pending</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary">View</button>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection


@section("extra_scripts")
  <script>
      
      $(document).ready(function(){
        $('#order-listing').DataTable({
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "iDisplayLength": 10,
          "language": { search: "" }
        });

        $('#order-listing').each(function(){
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Search');
          search_input.removeClass('form-control-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.removeClass('form-control-sm');
        });
      });

  </script>
@endsection
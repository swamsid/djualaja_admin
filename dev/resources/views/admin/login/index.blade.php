
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>D'Jualaja | Login Admin</title>

   <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('dev/node_modules/mdi/css/materialdesignicons.min.css') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/mdi/css/materialdesignicons.min.css">

  <link rel="stylesheet" href="{{ url('dev/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ url('dev/node_modules/font-awesome/css/font-awesome.min.css') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/font-awesome/css/font-awesome.min.css" />
  <!-- End plugin css for this page -->

 <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset("css/app.css") }}" tppabs="http://www.bootstrapdash.com/demo/purple/css/style.css">
  <link rel="stylesheet" href="{{ asset("css/style.css") }}" tppabs="http://www.bootstrapdash.com/demo/purple/css/style.css">
 <!-- endinject -->

  <link rel="shortcut icon" href="{{ asset('images/favicon_d.png') }}" />

  <style>

    .btn:disabled{
      cursor: not-allowed;
    }

  </style>
</head>

<body>
  <div class="container-scroller" style="color: #282828;">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center">
          <div class="card col-lg-4 mx-auto" style="box-shadow: 2px 2px 10px #ccc; font-size: 8pt; border: 1px dotted #b5131e;">
            <div class="card-body px-5 py-5">
              {{-- <h3 class="card-title text-left mb-3">Login</h3> --}}
              <form id="login-form">
                <div class="form-group">
                  <label>Username <small style="color: #e2616a; display: none;" id="name_err"> &nbsp;- Tidak Boleh Kosong</small></label>
                  <input type="text" class="input_validate form-control p_input" id="username" data-err="name" name="username">
                </div>
                <div class="form-group">
                  <label>Password <small style="color: #e2616a; display: none;" id="pass_err"> &nbsp;- Tidak Boleh Kosong</small></label>
                  <input type="password" class="input_validate form-control p_input" id="password" data-err="pass" name="password">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
              </form>

                <div class="text-center">
                  <button type="button" id="login" class="btn btn-primary btn-block enter-btn" style="background: #b5131e; border: 1px solid #b5131e;">Login</button>
                </div>

              
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ URL::asset('js/app.js') }}"></script>

  <script src="{{ url('dev/node_modules/popper.js/dist/umd/popper.min.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/popper.js/dist/umd/popper.min.js"></script>

  <script src="{{ url('dev/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  
  <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/off-canvas.js"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/hoverable-collapse.js"></script>
    <script src="{{ asset('js/misc.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/misc.js"></script>
    <script src="{{ asset('js/settings.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/settings.js"></script>
    <script src="{{ asset('js/todolist.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/todolist.js"></script>
  <!-- endinject -->

  <script>
    $(document).ready(function(){

      baseUrl = '{{ url("/") }}';

      $('#login').click(function(evt){
        evt.stopImmediatePropagation();
        evt.preventDefault();

        button = $(this);
        // button.attr("disabled", "disabled");

        if(form_auth()){
          axios.post('login', $("#login-form").serialize())
          .then((response) => {
            console.log(response.data);
            if(response.data.status == "berhasil")
              window.location = "{{ route("dashboard") }}";
            else
              alert(response.data.message);
          }).catch((error) => {
            alert(error);
          })
        }
      })

      function form_auth(){
        ret = true;

        $(".input_validate").each(function(){
          if($(this).val() == ""){

            err = $(this).data("err");
            $("#"+err+"_err").fadeIn(500);
            ret = false;

            return false;
          }
        })

        return ret;
      }

    })
  </script>
</body>

</html>

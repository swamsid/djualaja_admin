<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>D'Jualaja | @yield("title")</title>
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('dev/node_modules/mdi/css/materialdesignicons.min.css') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/mdi/css/materialdesignicons.min.css">

  <link rel="stylesheet" href="{{ url('dev/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">

  <link rel="stylesheet" href="{{ url('dev/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" />

  <link rel="stylesheet" href="{{ url('dev/node_modules/font-awesome/css/font-awesome.min.css')}} " tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/font-awesome/css/font-awesome.min.css" />
  <!-- endinject -->
  
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset("css/app.css") }}" tppabs="http://www.bootstrapdash.com/demo/purple/css/style.css">
  <link rel="stylesheet" href="{{ asset("css/style.css") }}" tppabs="http://www.bootstrapdash.com/demo/purple/css/style.css">
  <!-- endinject -->

  <link rel="shortcut icon" href="{{ asset('images/favicon_d.png') }}" />
  <link rel="stylesheet" href="{{ asset('js/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/jquery-confirm-master/dist/jquery-confirm.min.css') }}">

  @yield("extra_styles")
<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
  @include("admin.partials._head")
</head>

<body class="sidebar-fixed sidebar-collapse">
  <!-- partial:partials/_settings-panel.html -->
  <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>

  {{-- @include("admin.partials._right_sidebar") --}}

  {{-- @include("admin.partials._template_setting") --}}
  <!-- partial -->

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    @include("admin.partials._navbar")

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        
        @include("admin.partials._sidebar")

        <!-- partial -->
            @yield("content")
        <!-- content-wrapper ends -->

        <!-- partial:partials/_footer.html -->
        
        @include("admin.partials._footer")

        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  
  @include("admin.partials._script")

  @yield("extra_scripts")

</body>

</html>

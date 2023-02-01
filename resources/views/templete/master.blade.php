<!DOCTYPE html>
<html lang="en">
<head>
        <!------------ css---------------------->
        @include('include.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!---------------navbar------------------------------>
              @include('include.nav')
<!---------------emd navbar------------------------------>
<!--------------- Main Sidebar Container ---------------->
              @include('include.sidebar')
<!-------------------MainContent------------------------->
               <div class="content-wrapper">
                    @yield('main-content')
                </div>
<!------------------------footer------------------------------->
                @include('include.footer')
<!------------------------end footer--------------------------->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!--------------------script-------------------------->
            @include('include.script')
<!--------------------end script-------------------------->
<!------------- CUSTOME SCREPT  -------------------------->
</body>
</html>

<!DOCTYPE html>
<html lang="en">
    @include('customer.components.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    @include('customer.components.navbar')
    @include('customer.components.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

        @yield('content')

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
    @include('customer.components.js')
    @yield('script')
</body>
</html>

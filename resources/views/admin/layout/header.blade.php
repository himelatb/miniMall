<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/dashboard')}}" class="nav-link">Welcome {{ Auth::guard('admin')->user()->name }} ({{ (Auth::guard('admin')->user()->type == 1) ? "Admin" : "Subadmin" }})</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/dashboard')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('admin/logout')}}" class="nav-link">Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
  </nav>
  <!-- /.navbar -->
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>AdminLTE 3 | Dashboard</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.css') }}">
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

     


      
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
               </li>
            </ul>
            <ul class="navbar-nav ml-auto">
               <!-- Notifications Dropdown Menu -->
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <a href="" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> Edit Profile
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i>Change Password
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="{{url('admin/logout')}}" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> Logout
                     </a>
                  </div>
               </li>
            </ul>
         </nav>
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <img src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="{{ asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
   

                     <a href="#" class="d-block"> {{session::get('name')}} </a>
                  </div>
               </div>
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <li class="nav-item">
                        <a href="{{url('admin/dashboard') }}" class="nav-link ">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p> Dashboard</p>
                        </a>
                     </li>

                      <li class="nav-item">
                        <a href="{{url('admin/category') }}" class="nav-link ">
                          <i class="fas fa-certificate"></i>
                           <p> Category</p>
                        </a>
                     </li>

                       <li class="nav-item">
                        <a href="{{url('admin/subcategory') }}" class="nav-link ">
                          <i class="fas fa-certificate"></i>
                           <p> Sub-Category</p>
                        </a>
                     </li>

                      <li class="nav-item">
                        <a href="{{url('admin/product') }}" class="nav-link ">
                          <i class="fas fa-certificate"></i>
                           <p> Product</p>
                        </a>
                     </li>


                      <li class="nav-item">
                        <a href="{{url('admin/contactus')}}" class="nav-link ">
                          <i class="far fa-address-book"></i>
                           <p> Contact Users</p>
                        </a>
                     </li>
                        <li class="nav-item">
                        <a href="{{url('admin/subscribe')}}" class="nav-link ">
                         <i class="fas fa-bell"></i>
                           <p> Subscribe Users</p>
                        </a>
                     </li>

                      <li class="nav-item">
                        <a href="{{url('admin/transaction')}}" class="nav-link ">
                        <i class="fas fa-money-check"></i>
                           <p>Transaction</p>
                        </a>
                     </li>

                      <li class="nav-item">
                        <a href="{{url('admin/users')}}" class="nav-link ">
                        <i class="fas fa-users"></i>
                           <p>Users</p>
                        </a>
                     </li>

                  </ul>
               </nav>
            </div>
         </aside>
         <!-- Main Sidebar Container -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                           <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            @yield('content')
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
               <b>Version</b> 3.0.5
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
      <script src="{{ asset('public/custom.js') }}"></script>
      <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <!-- Bootstrap 4 -->
      <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- ChartJS -->
      <script src="{{ asset('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
      <!-- Sparkline -->
      <script src="{{ asset('public/admin/plugins/sparklines/sparkline.js') }}"></script>
      <!-- JQVMap -->
     <!--  <script src="{{ asset('public/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
      <script src="{{ asset('public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
      <!-- daterangepicker -->
      <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
      <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
      <!-- Summernote -->
      <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
      <!-- overlayScrollbars -->
      <!-- <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> -->
      <!-- AdminLTE App -->
      <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="{{ asset('public/admin/dist/js/pages/dashboard.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
     
      <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
   </body>
</html>
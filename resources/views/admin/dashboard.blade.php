 @extends('admin.layout.layout')
 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Dashboard</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="">Home</a></li>
                     <li class="breadcrumb-item active">Dashboard</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <section class="content">
     <div class="container-fluid">
         <!-- Info boxes -->
         <div class="row">
             <!-- /.col -->
             <div class="col-12 col-sm-6 col-md-3">
                 <div class="info-box mb-3">
                     <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Products</span>
                         <span class="info-box-number">{{totalProducts()}}</span>
                     </div>
                     <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
             </div>
             <!-- /.col -->

             <!-- fix for small devices only -->
             <div class="clearfix hidden-md-up"></div>
             <!-- /.col -->
             <div class="col-12 col-sm-6 col-md-3">
                 <div class="info-box mb-3">
                     <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Members</span>
                         <span class="info-box-number">{{totalUsers()}}</span>
                     </div>
                     <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
             </div>
             <!-- /.col -->
         </div>
         <!-- /.row -->
         <!-- /.row -->
     </div>
     <!--/. container-fluid -->
 </section>
 <!-- /.content -->
 <!-- /.content-wrapper -->
 @endsection

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>miniMall | Dashboard</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    </head>

    <body
        class="hold-transition sidebar-collapse dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="{{ asset('admin/images/miniMallLogo.svg') }}" alt="miniMall"
                    height="60" width="60">
            </div>

            <!-- header -->
            @include('admin.layout.header')
            <!-- header end -->

            <!-- sidebar -->
            @include('admin.layout.sidebar')
            <!-- sidebar end -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            @include('admin.layout.footer')
            <!-- Main Footer end-->
            @include('admin.users.add_modal')
            @include('admin.users.update_modal')

            @include('admin.pages.add_cms_modal')
            @include('admin.pages.update_cms_modal')

            @include('admin.category.edit_cat_modal')
            @include('admin.category.add_cat_modal')

            @include('admin.product.edit_product_modal')
            @include('admin.product.add_product_modal')

            @include('admin.brand.edit_brand_modal')
            @include('admin.brand.add_brand_modal')
            {!! Toastr::message() !!}
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{ url('admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ url('admin/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ url('admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ url('admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ url('admin/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="{{ url('admin/js/adminlte.js') }}"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

        <!-- DataTables  & Plugins -->
        <script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ url('admin/plugins/jszip/jszip.min.js')}}"></script>
        <script src="{{ url('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{ url('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ url('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        <script src="{{ url('admin/js/custom/customtable.js')}}"></script>
        <script src="{{ url('admin/js/custom/customadminactions.js')}}"></script>
        <script src="{{ url('admin/js/custom/customproductactions.js')}}"></script>
        <script src="{{ url('admin/js/custom/customcategoryactions.js')}}"></script>
        <script src="{{ url('admin/js/custom/customcmsactions.js')}}"></script>
        <script src="{{ url('admin/js/custom/custombrandactions.js')}}"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        </script>

        <script>
            $(document).ready(function () {

                adminActions();
                cmsActions();
                productActions();
                categoryActions();
                brandActions();

            });

        </script>



        <!-- AdminLTE for demo purposes -->
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    </body>

</html>

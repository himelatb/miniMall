<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>miniMall | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body class="hold-transition sidebar-collapse dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('admin/images/miniMallLogo.svg') }}" alt="miniMall" height="60" width="60">
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
            
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  </script>
  
<script>
  $(document).ready(function () {

    $(document).on('submit','#adminForm',function(e){
          e.preventDefault();
          $('.spanmsg').remove();
          $('.errbr').remove();
          var formData = new FormData(this);
          formData.append("type",$('#type').val());
          formData.append("status",$('#status').val());
          
          
          $.ajax({
                url:"{{url('admin/add.admins')}}",
                method: 'post',
                data:formData,
                processData: false,
                contentType: false,
                success:function(res) {
                  if(res.status =='success'){
                      $("#adminModal .close").click();
                      $('#adminForm').trigger("reset");
                      $('.table').load(location.href+' .table');
                    
                      Command: toastr["success"]("Admin added successfully", "Added")

                          toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                          }
                        }
                },
                error:function(err){
                  $('.spanmsg').remove();
                  $('.errbr').remove();
                  let error = err.responseJSON;
                  $.each(error.errors, function(index, value){
                    $('#errormsg').append('<span class="text-danger spanmsg">'+value+'</span>'+'<br class="errbr">');
                  });
                }
                });
          
         

    })
  
    $(document).on('click','.editAdminBtn',function() {
          $('.spanmsg').remove();
          $('.errbr').remove();
          let id = $(this).data('id');
          let name = $(this).data('name');
          let email = $(this).data('email');
          let mobile = $(this).data('mobile');
          let type = $(this).data('type');
          let status = $(this).data('status');
          $('#uid').val(id);
          $('#uname').val(name);
          $('#uemail').val(email);
          $('#umobile').val(mobile);
          $('#utype').val((type==1)? "1" : "2");
          $('#ustatus').val((status==1)? "1" : "2");
     })
    
     $(document).on('submit','#updateForm',function(e){
          e.preventDefault();
          $('.spanmsg').remove();
          $('.errbr').remove();
          var formData = new FormData(this);
          formData.append("utype", $('#utype').val());
          formData.append("ustatus", $('#ustatus').val());
        
          

          $.ajax({
              url:"{{url('admin/update.admins')}}",
              method: 'post',
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(res) {
                if(res.status =='success'){
                    $("#updateModal .close").click();
                    $('#updteForm').trigger("reset");
                    $('.table').load(location.href+' .table');
                    Command: toastr["info"]("Admin updated successfully", "Updated")

                      toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                }
                
              },
              error:function(err){
                let error = err.responseJSON;
                $('.spanmsg').remove();
                $('.errbr').remove();
                $.each(error.errors, function(index, value){
                  $('#errormsg').append('<span class="text-danger spanmsg">'+value+'</span>'+'<br class="errbr">');
                });
              }
            });

    })

    $(document).on('click','.deleteAdminBtn',function(){

      if(confirm("confirm deletion!!")){
        let id = $(this).data('id');
          
          $.ajax({
              url:"{{url('admin/delete.admins')}}",
              method: 'post',
              data:{
                id:id,
                
              },
              success:function(res) {
                if(res.status =='success'){
                    $('.table').load(location.href+' .table');
                    Command: toastr["error"]("Admin deleted successfully", "Deleted")

                      toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                  
                }
              },
              
              });
      }
          

    })

    $(document).on('click','.pagination a', function(e){
        e.preventDefault();
        let page = $(this).attr("href").split('page=')[1];
        
        admin(page)

        function admin(page) {
          $.ajax({
            url:"pagination?page="+page,
            success:function(res){
                  $('.table-data').html(res);
            }
          });
          
        }


    })

    $(document).on('click','#passChangeBtn',function(){

if(confirm("confirm password change?")){
    let oldPassword = $("#oldPassword").val();
    let newPassword = $("#newPassword").val();
    let confirmPassword = $("#confirmPassword").val();
    
    $.ajax({
        url:"{{url('admin/password.admins')}}",
        method: 'post',
        data:{
            oldPassword:oldPassword,
            newPassword:newPassword,
            confirmPassword:confirmPassword,
        
        },
        success:function(res) {
          $('.spanmsg').remove();
          $('.errbr').remove();
        if (res.status =='not_matched') {
                    $('.nerrormsg').append('<span class=" bg-danger spanmsg">'+'Confirm password is not maching'+'</span>'+'<br class="errbr">');
                }
        if (res.status =='wrong_pass') {
                    $('#oerrormsg').append('<span class=" bg-danger spanmsg">'+'Enter current password'+'</span>'+'<br class="errbr">');
                }
        if(res.status =='success'){
            Command: toastr["success"]("Password changed successfully", "Successful")

                toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                window.location.href = "{{url('admin/dashboard')}}";
            
        }
        },
        error:function(err){
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function(index, value){
                    $('#perrormsg').append('<span class=" bg-danger spanmsg">'+value+'</span>'+'<br class="errbr">');
                });
                
    }
        
        });
}
})

  });


</script>



<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
</body>
</html>
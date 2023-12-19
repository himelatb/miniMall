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

  @include('admin.pages.add_cms_modal')
  @include('admin.pages.update_cms_modal')
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<!-- DataTables  & Plugins -->
<script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
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
          $("#image").on("change",function(){
              
              /* Current this object refer to input element */         
              var $input = $(this);
              var reader = new FileReader(); 
              reader.onload = function(){
                    $("#imageView").attr("src", reader.result);
              } 
              reader.readAsDataURL($input[0].files[0]);
              });
          
          
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
                      setTimeout(location.reload.bind(location), 1500);
                      
  
                    
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

    $(document).on('click','#createNewAdmin',function() {
      $("#image").on("change",function(){
 
      /* Current this object refer to input element */         
      var $input = $(this);
      var reader = new FileReader(); 
      reader.onload = function(){
            $("#imageView").attr("src", reader.result);
      } 
      reader.readAsDataURL($input[0].files[0]);
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
          let img = $(this).data('img');
          $('#uid').val(id);
          $('#uname').val(name);
          $('#uemail').val(email);
          $('#umobile').val(mobile);
          $('#utype').val((type==1)? "1" : "2");
          $('#ustatus').val((status==1)? "1" : "2");
          $('#uimageView').attr('src', "images/"+img);
          $('#uimageView').attr('alt', name+ " image");
          $("#uimage").on("change",function(){
 
              /* Current this object refer to input element */         
              var $input = $(this);
              var reader = new FileReader(); 
              reader.onload = function(){
                    $("#uimageView").attr("src", reader.result);
              } 
              reader.readAsDataURL($input[0].files[0]);
              });
          

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
                    setTimeout(location.reload.bind(location), 1500);

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

        let id = $(this).data('id');
        swal({
              title:"Do you want delete this admin?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
              confirmButtonText: "Delete",
              cancelButtonText: "Cancel",
              closeOnConfirm: true,
              showLoaderOnConfirm: true,
          },
          function(isConfirm){
              if(isConfirm){
                          $.ajax({
                            url:"{{url('admin/delete.admins')}}",
                            method: 'post',
                            data:{
                              id:id,
                            },
                            success:function(res) {
                              if(res.status =='success'){

                                setTimeout(location.reload.bind(location), 1500);

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

                        
                
          });
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


  //cms scripts

  $(function () {
    $("#AdminViewTable").DataTable({
      "paging": true,
      "lengthChange": true,
      "pageLength": 5,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#AdminViewTable_filter").addClass("d-flex");
    $("#AdminViewTable_filter").children("label").addClass("d-flex");
    $("#AdminViewTable_wrapper").children().first().children().first().remove();
  });

  $(function () {
          $("#CmsViewTable").DataTable({
            "paging":true,
            "lengthChange": false,
            "pageLength": 5,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,

          });
          $("#CmsViewTable_filter").addClass("d-flex");
          $("#CmsViewTable_filter").children("label").addClass("d-flex");
          $("#CmsViewTable_wrapper").children().first().children().first().remove();
        });

  $(document).on('submit','#cmsForm',function(e){
          e.preventDefault();
          $('.spanmsg').remove();
          $('.errbr').remove();
          var formData = new FormData(this);
          formData.append("status",$('#cmsstatus').val());
          
          
          $.ajax({
                url:"{{url('admin/add.cms')}}",
                method: 'post',
                data:formData,
                processData: false,
                contentType: false,
                success:function(res) {
                  if(res.status =='success'){
                      $("#AddCmsModal .close").click();
                      $('#cmsForm').trigger("reset");
                      setTimeout(location.reload.bind(location), 1500);
                      
                      Command: toastr["success"]("CMS page added successfully", "Added")

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


          $(document).on('click','.editCmsBtn',function() {
          $('.spanmsg').remove();
          $('.errbr').remove();
          let id = $(this).data('id');
          let title = $(this).data('title');
          let description = $(this).data('description');
          let url = $(this).data('url');
          let meta_title = $(this).data('meta_title');
          let meta_description = $(this).data('meta_description');
          let meta_keywords = $(this).data('meta_keywords');
          let status = $(this).data('status');
          $('#ucmsid').val(id);
          $('#ucmstitle').val(title);
          $('#ucmsdescription').val(description);
          $('#ucmsurl').val(url);
          $('#ucmsmeta_title').val(meta_title);
          $('#ucmsstatus').val((status==1)? "1" : "2");
          $('#ucmsmeta_description').val(meta_description);
          $('#ucmsmeta_keywords').val(meta_keywords);

     })
    
     $(document).on('submit','#UpdateCmsForm',function(e){
          e.preventDefault();
          $('.spanmsg').remove();
          $('.errbr').remove();
          var formData = new FormData(this);
          formData.append("ucmsstatus", $('#ucmsstatus').val());
        
          

          $.ajax({
              url:"{{url('admin/update.cms')}}",
              method: 'post',
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(res) {
                if(res.status =='success'){
                    $("#UpdateCmsModal .close").click();
                    $('#UpdteCmsForm').trigger("reset");
                    setTimeout(location.reload.bind(location), 1500);

                    Command: toastr["info"]("CMS page updated successfully", "Updated")

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

    $(document).on('click','.deleteCmsBtn',function(){

                let id = $(this).data('id');
                swal({
                      title:"Do you want delete this page?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: 'btn btn-success',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false,
                      confirmButtonText: "Delete",
                      cancelButtonText: "Cancel",
                      closeOnConfirm: true,
                      showLoaderOnConfirm: true,
                  },
                  function(isConfirm){
                      if(isConfirm){
                                  $.ajax({
                                    url:"{{url('admin/delete.cms')}}",
                                    method: 'post',
                                    data:{
                                      id:id,
                                    },
                                    success:function(res) {
                                      if(res.status =='success'){
                                        setTimeout(location.reload.bind(location), 1500);


                                          Command: toastr["error"]("CMS page deleted successfully", "Deleted")

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
                                }); 
                              })
});


</script>



<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
</body>
</html>
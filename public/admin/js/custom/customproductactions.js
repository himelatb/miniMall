function productActions(){
    $(document).on('click','#createNewProduct', function(){
        $("#product_image").on("change",function(){
            /* Current this object refer to input element */         
            var $input = $(this);
            var reader = new FileReader(); 
            reader.onload = function(){
                  $("#product_imageView").attr("src", reader.result);
            } 
            reader.readAsDataURL($input[0].files[0]);
            });
      }) 
        
        $(document).on('submit','#addProductForm',function(e){
              e.preventDefault();
    
              $('.spanmsg').remove();
              $('.errbr').remove();
              var formData = new FormData(this);
              $.ajax({
                  url:"add.product",
                  method: 'post',
                  data:formData,
                  processData: false,
                  contentType: false,
                  success:function(res) {
                    if(res.status =='success'){
                        $("#addProductModal .close").click();
                        $('#addProductForm').trigger("reset");
                        setTimeout(location.reload.bind(location), 1500);
    
                        Command: toastr["success"]("Product added successfully", "Added")
    
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
                      $('.errormsg').append('<span class="text-danger spanmsg">'+value+'</span>'+'<br class="errbr">');
                    });
                  }
                });
               }) 
               
               $(document).on('click','.deleteProductBtn', function() {
                let id = $(this).data('id');
                          swal({
                                title:"Do you want delete this product?",
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
                                          url:"delete.product",
                                          method:'POST',
                                          data: {
                                            "id": id
                                          },
                                          success:function(data){
                                            if(data.status =='success'){
                                                                            setTimeout(location.reload.bind(location), 1500);
                
                
                                                                              Command: toastr["error"]("Product deleted successfully", "Deleted")
                
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
                                                                        }
                                                                      
                                                                      });
                                   }
                                    });
                          
                
                
                          })
                                

}
// rest of the actions
$(document).on('click','.editProductBtn',function() {
         
    $('#updateProductForm').trigger("reset");
    $("#deleteCategoryImage").prop("disabled",false);
    $("#deleteCategoryImage").prop("checked", false);
    $('.spanmsg').remove();
    $('.errbr').remove();
    $('#uproduct_id').val($(this).data("id"));
    $('#uproduct_name').val($(this).data("name"));
    $('#uproduct_url').val($(this).data("url"));
    $('#uproduct_description').val($(this).data("description"));
    $('#uproduct_discount').val($(this).data("discount"));
    $('#uproduct_parent').val($(this).data("parent_id"));

    if ($(this).data("image")!='') {
    $('#uproduct_imageView').attr('src','{{ asset("product/images")}}'+'/'+$(this).data("image"));
    $old = $('#uproduct_imageView').attr('src');
    }
    $('#uproduct_imageView').attr('alt','Empty image');
    
    if ($(this).data("image")=='') {
      $("#deleteCategoryImage").prop("disabled",true);
      $("#deleteCategoryImage").prop("checked", false);
    }
    $('#uproduct_meta_description').val($(this).data("meta_description"));
    $('#uproduct_meta_title').val($(this).data("meta_title"));
    $('#uproduct_meta_keywords').val($(this).data("meta_keywords"));
    $('#uproduct_status').val($(this).data("status"));
    
    $("#uproduct_image").on("change",function(){
              /* Current this object refer to input element */         
              var $input = $(this);
              var reader = new FileReader(); 
              reader.onload = function(){
                    $("#uproduct_imageView").attr("src", reader.result);
                    $("#deleteCategoryImage").prop("disabled",true);
                    $("#deleteCategoryImage").prop("checked", false);
              } 
              reader.readAsDataURL($input[0].files[0]);
              });
    
    
    
    $("#deleteCategoryImage").click(function(){
      if($(this).is(":checked")) {
      $new = $("#uproduct_imageView").attr("src");
      $("#uproduct_imageView").attr("src", '');
    }  
    else if ($(this).is(":not(:checked)")) {
      $("#uproduct_imageView").attr("src", ($new=='')? $old : $new);
      }
    })
    

})

$(document).on('submit','#updateproductForm',function(e){
    e.preventDefault();

    $('.spanmsg').remove();
    $('.errbr').remove();
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        url:"update.product",
        method: 'post',
        data:formData,
        processData: false,
        contentType: false,
        success:function(res) {
          if(res.status =='success'){
              $("#updateproductModal .close").click();
              $('#updateproductForm').trigger("reset");
              setTimeout(location.reload.bind(location), 1500);

              Command: toastr["info"]("Category updated successfully", "Updated")

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
            $('.errormsg').append('<span class="text-danger spanmsg">'+value+'</span>'+'<br class="errbr">');
          });
        }
      });
     })



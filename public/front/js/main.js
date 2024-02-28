(function ($) {
    "use strict";

    $('#price').tooltip('toggle');

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    }

 
    $('#price').on('mouseover', function() {
        $('#price').attr("data-original-title", $(this).val());
        $('#price').tooltip('show');
    });

    $('#price').on('change', function() {
        $('#price').attr("data-original-title", $(this).val());
        $('#price').tooltip('show');
    });
    
    $(document).on('change','.allSizes', function(){

                if ($(this).is(':checked')) {
                    $('.otherSizes').prop('checked', true);
                }
    });

    $('.otherSizes').change(function() {
        var allChecked = true;
        var allUnChecked = true;
        $('.otherSizes').each(function() {
          if (!$(this).is(':checked')) {
            allChecked = false;
            return false; // break the loop
          }
        });
        $('.otherSizes').each(function() {
            if($(this).is(':checked')) {
              allUnChecked = false;
              return false; // break the loop
            }
          });
        // Update parent checkbox based on children's state
        if(allChecked == true || allUnChecked == true){
            $('.allSizes').prop('checked', true);
            $('.otherSizes').prop('checked', true);
        }
        else{
            $('.allSizes').prop('checked', false);
        }
      });


      $(document).on('change','.allColors', function(){

        if ($(this).is(':checked')) {
            $('.otherColors').prop('checked', true);
        }
    });

    $('.otherColors').change(function() {
            var allChecked = true;
            var allUnChecked = true;
            $('.otherColors').each(function() {
            if (!$(this).is(':checked')) {
                allChecked = false;
                return false; // break the loop
            }
            });
            $('.otherColors').each(function() {
                if($(this).is(':checked')) {
                  allUnChecked = false;
                  return false; // break the loop
                }
              });
            // Update parent checkbox based on children's state
            if(allChecked == true || allUnChecked == true){
                $('.allColors').prop('checked', true);
                $('.otherColors').prop('checked', true);
            }
            else{
                $('.allColors').prop('checked', false);
            }
            });

    $(".filterElements").on("change", function(){
        this.form.submit();

    });


    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
                $('.dropdown').children('button').on('click', function () {
                    $(this).siblings('.dropdown-menu').toggle();
                });
                $(".dpIn").addClass('fa-angle-right');
                $(".dpIn").removeClass('fa-angle-down');
                if ($(window).width() < 992) {
                    $(".dpIn").removeClass('fa-angle-right');
                    $(".dpIn").addClass('fa-angle-down');
                }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);

        $('#sorting').on('change', function (){
            this.form.submit();
        });

    });
    let originalPrice = $('#final-price').html();
    let originaldiscountPrice = $('#discount-price').html();
    $('.sizeSelector').each(function() {
            $(this).on('click', function(){
                $(".error").html('');
                let product_id = $(this).data('product_id');
                let size = $(this).val();
                let product_discount = $(this).data('product_discount');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/get_color_by_size',
                    data:{
                        product_id: product_id,
                        size: size,
                        product_discount: product_discount,
                    },
                    success: function(res){
                        $('#cartForm').children('#sku_id').val('');
                        $('#final-price').html(originalPrice);
                        $('#discount-price').html(originaldiscountPrice);
                        $('#cartForm').children('#price').val(originalPrice);
                        $('#showColors').html(`<strong class="text-dark mr-3">Colors:</strong>`);
                        res.forEach(attribute => {
                            $('#showColors').append(`
                            <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input colorSelector" 
                            data-final_price="${attribute['final_price']}"
                            data-price="${attribute['price']}" 
                            data-sku_id="${attribute['id']}"
                            id="${attribute['color']}" name="color">
                            <label class="custom-control-label" for="${attribute['color']}">${attribute['color']}</label>
                            </div>`);
                        });
                        $('.colorSelector').each(function() {
                            $(this).on('click', function(){
                                $(".error").html('');
                                $('#final-price').html($(this).data('final_price'));
                                $('#discount-price').html($(this).data('price'));
                                let final_price = $('#final-price').html();
                                let sku_id = $(this).data('sku_id');
                                $('#cartForm').children('#sku_id').val(sku_id);
                                $('#cartForm').children('#price').val(final_price);
                            })
                        });
                    }
                });
            })
    });

    $('.cartBtn').on('click', function(){
        
        let formdata = $('#cartForm').serialize();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url:'/add_to_cart',
            data: formdata,
            success: function(res){
               if(res.success != true){
                    $(".error").html(res.message);
               }
               else{
                $(".error").html('');
                $('#cartCount').html(res.totalCartItems);
                command: toastr.success("Product added to cart successfully", "Added")
               }
            },
            error: function(err){
                $(".error").html("Select size and color.");
            }
        })
    });
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find('input').val(newVal);
        $('#cartForm').children('#qty').val(newVal);
    });

    $('.qtyButton').on('click', function(){
        let id = $(this).data('id');
        var qty = $(this).parent('div').siblings('.qty').val();
        let sku_id = $(this).data('sku_id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/update_cart_qty",
            data:{
                id: id,
                qty: qty,
                sku_id: sku_id,
            },
            success:function(res){
                if(res.status == false){
                    $("#error"+id).html(res.massage);
                    location.reload(true);
                }
                else{
                    location.reload();
                }
            },
            error: function(){
                alert('ERROR!!!! Something went wrong!!!!');
            }
        })
    })

    $('.deleteCartItems').on('click', function(){
        let id = $(this).data('id');
        swal({
            title: "Do you want delete this item from cart?",
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
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "/delete_cart_item",
                    data:{
                        id: id,
                    },
                    success: function () {
                        setTimeout(location.reload.bind(location), 500);
                        Command: toastr["error"]("Item deleted successfully", "Deleted")

                    },
                    error: function(){
                        alert('ERROR!!!! Something went wrong!!!!');
                    }

                });
            }
        });
    })
    
})(jQuery);


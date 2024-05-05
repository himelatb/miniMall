function myAddressActions(id) {        
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method:'post',
        url:'default_address',
        data:{
            id:id
        }
    });
}

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
                            data-stock="${attribute['stock']}"
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
                                let stock = $(this).data('stock');
                                $('#cartForm').children('#sku_id').val(sku_id);
                                $('#cartForm').children('#price').val(final_price);
                                $('.stock').html(stock+" item/s available!")
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

    function CouponActions(total) {
        $("#subtotal").html(total +' tk');
        $("#totalCost").html(total +' tk');
        $('.couponTag').html('');
        $('.couponAmount').html('');
        $('#couponSubmit').prop('hidden', false);
        $('#couponRemove').prop('hidden', true);
        $('#coupon_code').prop('disabled', false);
        $('#coupon_code').val('');
        $('.spanmsg').remove();
        $('.errbr').remove();
    }

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
                let total = 0;
                res.cart.forEach(value => {
                    $('#productTotal'+value.id).html(value.total);
                    if(value.maxStock == true){
                        $('#error'+value.id).prop('disabled', false);
                        $('#error'+value.id).prop('hidden', false);
                        $('#btn'+value.id).prop('disabled', true);
                    }
                    else{
                        $('#error'+value.id).prop('disabled', true);
                        $('#error'+value.id).prop('hidden', true);
                        $('#btn'+value.id).prop('disabled', false);
                    }
                    total += value.total;
                });
                CouponActions(total);
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
                    success: function (res) {
                        let total = 0;
                        let count = 0;
                        $('#cartrow'+id).remove();
                        res.cart.forEach(value => {
                            total += value.total;
                            count += 1;
                        });
                        CouponActions(total);
                        $('#cartCount').html(count);
                        Command: toastr["error"]("Item deleted successfully", "Deleted")

                    },
                    error: function(){
                        alert('ERROR!!!! Something went wrong!!!!');
                    }

                });
            }
        });
    })

    $(document).on('click', ".dropdown-item, cat-item, .action", function(){
        $('.ring').prop('hidden', false);
    });

    $('#infoEdit').on('click', function () {

        if ($(this).val() == 'Save') {
            
            let formdata = $('#infoForm').serialize();
            $.ajax({
                method: 'POST',
                url: '/profile',
                data: formdata,
                success:function (res) {
                    if(res.status == 'success'){  
                    
                    $('.spanmsg').remove();
                    $('.errbr').remove();
                    $('#msg').html('<span class="text-success spanmsg">Profile updated successfully!!</span>')
                    }
                },
                error:function(err){
                    $('.spanmsg').remove();
                    $('.errbr').remove();
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $('#msg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                    });
                }
            })
            let elements = document.querySelectorAll('.form-control');

            elements.forEach(function (element) {
                    element.disabled = true;        
            });

            $(this).val('Edit');
        }
        else{
            let elements = document.querySelectorAll('.form-control');

            elements.forEach(function (element) {
                    if(element.name != "country_code"){
                        element.disabled = false; 
                    }  
            });
    
            $(this).val('Save');
        }

    });

    $('#country, #edit_country').on('change', function () {
        const name = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"post",
            url:'get.country_details',
            data:{
                name: name
            },
            success: function(res){
                $('#countrycode').val(res[0].phonecode);
                $('select[name="district"], select[name="edit_district"]').empty();
                $.each(res[0].state, function(key, value) {
                    $('select[name="district"], select[name="edit_district"]').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                    
                    });
            },
            error: function(){
                alert('Country selection failed!');
            }

        })
    })

    $("#submitNewPass").on('click', function(){
        let formData = $('#passChangeForm').serialize();
        $.ajax({
            url:'/change_password',
            method:'POST',
            data: formData,
            success: function(res){
                $('.spanmsg').remove();
                $('.errbr').remove();
                if(res.success == true){
                    $('#msg').append('<span class="text-success spanmsg">' + res.msg + '</span>' + '<br class="errbr">');
                    $('#passChangeForm').html(`<a href="/miniMall" class="nav-item nav-link action d-flex justify-content-center">Go back to home page</a>`);
                }
                else{
                    $('#msg').append('<span class="text-danger spanmsg">' + res.msg + '</span>' + '<br class="errbr">');
                }
                
            },
            error: function(err){
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('#msg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }
        })
    });

    $("#couponSubmit").on('click', function(e){
        e.preventDefault();
        var formData = $('#couponForm').serialize();
        $.ajax({
            method: 'POST',
            url:'/add_coupon',
            data: formData,
            success: function(res){
                $('.spanmsg').remove();
                $('.errbr').remove();
                if(res.status == 'success'){
                    $('#coupon_code').prop('disabled', true);
                    $('#couponSubmit').prop('hidden', true);
                    $('#couponRemove').prop('hidden', false);
                    let total = 0;
                    res.cart.forEach(value => {
                        total += value.total;
                    });
                    $('.couponTag').html('Coupon');

                    if (res.coupon.amount_type == 'Fixed') {
                        $('.couponAmount').html(res.coupon.amount + 'tk');
                        total = total - res.coupon.amount;
                    }
                    else {
                        $('.couponAmount').html(res.coupon.amount + '%');
                        total = total - total* (res.coupon.amount/100);
                    }
                    $("#totalCost").html(total +' tk');
                    
                    $('#couponForm').append('<small class="text-success spanmsg">' + res.message + '</small>');
                }
                else{
                    $('#couponForm').append('<small class="text-danger spanmsg">' + res.message + '</small>');
                }
                    
            },
            error: function(err){
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('#couponForm').append('<small class="text-danger spanmsg">' + value + '</small>');
                });
            }
        });

    });

    $("#couponRemove").on('click', function(e){
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url:'/remove_coupon',
            success: function(res){
                if(res.status == 'success'){
                    let total = 0;
                    res.cart.forEach(value => {
                        total += value.total;
                    });
                    CouponActions(total);
                }      
            },
            error: function(err){
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('#couponForm').append('<small class="text-danger spanmsg">' + value + '</small>');
                });
            }
        });

    });

    $('#newAddressBtn').on('click', function(e){
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        let formData = $('#newAddress').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/add_address',
            data: formData,
            success: function(){
                $("#addAddressModal .close").click();
                $('#newAddress').trigger("reset");
                setTimeout(location.reload.bind(location), 1500);
                Command: toastr["success"]("Address added successfully!", "Added")
            },
            error:function(err){
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.msg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }

        });


    });

    $('.editAddressBtn').on('click', function(){
        $('.spanmsg').remove();
        $('.errbr').remove();
        let id = $(this).data('id');
        let country = $(this).data('country');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/get_address',
            data: {
                id: id,
                country: country
            },
            success: function(res){
                $('#editAddress').trigger("reset");
                $('select[name="edit_district"]').empty();
                $.each(res.states, function(key, value) {
                    $(' select[name="edit_district"]').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                    
                    });
                $('#id').val(res.address.id);
                $('#edit_name').val(res.address.name);
                $('#edit_mobile').val(res.address.mobile);
                $('#edit_address').val(res.address.address);
                $('#edit_road_house').val(res.address.road_house);
                $('#edit_town').val(res.address.town);
                $('#edit_district').val(res.address.district);
                $('#edit_country').val(res.address.country);
                $('#edit_zipcode').val(res.address.zipcode);
            }
        });


    });

    $('#changeAddressBtn').on('click', function(){
        let formData = $('#editAddress').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/update_address',
            data: formData,
            success: function(res){
                $('.spanmsg').remove();
                $('.errbr').remove();
                $("#editAddressModal .close").click();
                $('#editAddress').trigger("reset");
                $('.address'+res.id).html(`
                ${res.name+', '+ res.mobile+', '+res.address
                + (res.road_house != null ? ", "+res.road_house: '')
                + (res.town != null ? ", "+res.town: '')
                + (res.district != null ? ", "+res.district: '')
                + (res.country != null ? ", "+res.country: '')
                + (res.zipcode != null ? ", "+res.zipcode: '')
            }`);

            $.each($('.myAddress'), function(key, address) {
                        if(address.checked == true && res.id == address.value){ 
                                myAddressActions(res.id);
                        }
            });

                Command: toastr["info"]("Address Updated successfully!", "Updated")
            },
            error:function(err){
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.msg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }

        });


    });

    $('.deleteAddressBtn').on('click', function(){
        let id = $(this).data('id');
        swal({
            title: "Do you want delete this address?",
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
                    url: "/delete_address",
                    data:{
                        id: id,
                    },
                    success: function () {
                        $('.addressrow'+id).remove();

                        Command: toastr["error"]("Address deleted successfully", "Deleted")

                    },
                    error: function(){
                        alert('ERROR!!!! Something went wrong!!!!');
                    }

                });
            }
        });
    })

    $('.myAddress').on('change', function(){
        let id = $(this).val();
        myAddressActions(id);
    })

    $('#cancelOrderBtn').on('click', function(){
        let id = $(this).data('id');
        swal({
            title: "Do you want cancel this order?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
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
                    url: "/cancel_order",
                    data:{
                        id: id,
                    },
                    success: function () {
                        $('.track').html(`<div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Cancelled</span> </div>`);
                        $('#detailOrderStatus').html('Cancelled');
                        $('#cancelOrderBtn').remove();

                        Command: toastr["error"]("Order cancelled successfully", "Cancelled")

                    },
                    error: function(){
                        alert('ERROR!!!! Something went wrong!!!!');
                    }

                });
            }
        });
    })

})(jQuery);


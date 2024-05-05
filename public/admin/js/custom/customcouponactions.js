function couponActions() {

    function CouponTable(view) {
        $(view).DataTable({
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
            ajax: "view.coupon",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'coupon_code',
                    name: 'coupon_code'
                },
                {
                    data: 'coupon_type',
                    name: 'coupon_type',
                },
                {
                    data: 'amount',
                    name: 'amount',
                },
                {
                    data: 'expiry_date',
                    name: 'expiry_date',
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
        $(view + "_paginate").addClass("pt-3");
        $(view + "_paginate").removeClass("dataTables_paginate ");
        $(view + "_filter").addClass("d-flex");
        $(view + "_filter").children("label").addClass("d-flex");
    }

    CouponTable("#CouponViewTable");

    $('.coupon_option').on('change', function(){
        if($(this).val() == "Manual"){
            $('.coupon_code_div').prop('hidden', false);
        }
        else{
            $('.coupon_code_div').prop('hidden', true);
            $("#coupon_code, #ucoupon_code" ).val(Math.random().toString(36).substring(2,7));
        }
    })

    $(document).on('submit', '#addCouponForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "add.coupon",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#addCouponModal .close").click();
                    $('#addCouponForm').trigger("reset");
                    var oTable = $("#CouponViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["success"]("Coupon added successfully", "Added")

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
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
            error: function (err) {
                let error = err.responseJSON;
                $('.spanmsg').remove();
                $('.errbr').remove();
                $.each(error.errors, function (index, value) {
                    $('.errormsg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }
        });
    })

    $(document).on('click', '.editCouponBtn', function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            method: "POST",
            url: "get.coupon",
            data: {id: id},
            success: function (res) {
                $('#updateCouponForm').trigger("reset");
                $("#ucoupon_imageView").attr("src", null);
                $('.spanmsg').remove();
                $('.errbr').remove();
                $('#ucoupon_id').val(res.id);
                $('#ucoupon_option').val(res.coupon_option);
                $('#ucoupon_type').val(res.coupon_type);
                $('#ucoupon_code').val(res.coupon_code);
                $('#ucoupon_amount').val(res.amount);
                $('#uamount_type').val(res.amount_type);
                $('#uexpiry_date').val(res.expiry_date);
                $('#ucoupon_status').val(res.status);
                if(res.coupon_option == "Manual"){
                    $('.coupon_code_div').prop('hidden', false);
                }
                else{
                    $('.coupon_code_div').prop('hidden', true);
                }
                
                let categoryOptions = $('#ucategories option');
                
                $.each(categoryOptions, function(index, value){
                    if(res.categories == null){
                        if(value.value == ''){
                            value.selected = true;
                        }
                    }
                    else{
                        if(res.categories.includes(value.value)){
                            value.selected = true;
                        }
                        else{
                            value.selected = false;
                        }
                    }
                })

                let brandOptions = $('#ubrands option');
                
                $.each(brandOptions, function(index, value){
                    if(res.brands == null){
                        if(value.value == ''){
                            value.selected = true;
                        }
                    }
                    else{
                        if(res.brands.includes(value.value)){
                            value.selected = true;
                        }
                        else{
                            value.selected = false;
                        }
                    }
                })

                let userOptions = $('#uusers option');
                $.each(userOptions, function(index, value){
                    if(res.users == null){
                        if(value.value == ''){
                            value.selected = true;
                        }
                    }
                    else{
                        if(res.users.includes(value.value)){
                            value.selected = true;
                        }
                        else{
                            value.selected = false;
                        }
                    }
                })
                
            }
        });

    })

    $(document).on('submit', '#updateCouponForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        
        $.ajax({
            url: "update.coupon",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#updateCouponModal .close").click();
                    $('#updateCouponForm').trigger("reset");
                    var oTable = $("#CouponViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["info"]("Coupon updated successfully", "Updated")

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "500",
                        "timeOut": "2000",
                        "extendedTimeOut": "300",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }

            },
            error: function (err) {
                let error = err.responseJSON;
                $('.spanmsg').remove();
                $('.errbr').remove();
                $.each(error.errors, function (index, value) {
                    $('.errormsg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }
        });
    })


    $(document).on('click', '.deleteCouponBtn', function () {
        let id = $(this).data('id');
        swal({
                title: "Do you want delete this Coupon?",
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
                        url: "delete.coupon",
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                var oTable = $("#CouponViewTable").dataTable();
                                oTable.fnDraw(false);

                                Command: toastr["error"]("Coupon deleted successfully", "Deleted")

                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": true,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "500",
                                    "timeOut": "2000",
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

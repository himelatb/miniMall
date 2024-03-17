function customersActions() {

    function customersTable(view) {
        $(view).DataTable({
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
            ajax: "view.customers",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
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

    customersTable("#CustomersViewTable");

    $(document).on('click', '#createNewCustomers', function () {
        $("#customers_imageView").attr("src", '');
        $("#customers_image").on("change", function () {
            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#customers_imageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });
    })

    $(document).on('submit', '#addCustomersForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "add.customers",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#addCustomersModal .close").click();
                    $('#addCustomersForm').trigger("reset");
                    var oTable = $("#CustomersViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["success"]("Customer added successfully", "Added")

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

    $(document).on('click', '.editCustomersBtn', function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            method: "POST",
            url: "get.customers",
            data: {id: id},
            success: function (res) {
                $('#updateCustomersForm').trigger("reset");
                $("#ucustomers_imageView").attr("src", null);

                console.log(res);
                $('.spanmsg').remove();
                $('.errbr').remove();
                $('#ucustomers_id').val(res.id);
                $('#ucustomers_name').val(res.name);
                $('#ucustomers_email').val(res.email);
                $('#ucustomers_mobile').val(res.mobile);
                $('#ucustomers_status').val(res.status);

                if (res.image != null) {
                    $('#ucustomers_imageView').attr('src',"/front/images/customer/"+res.image);
                    $oldimg = $('#ucustomers_imageView').attr('src');
                    $("#deleteCustomersImage").prop("disabled", false);
                    $("#deleteCustomersImage").prop("checked", false);
                }
                $('#ucustomers_imageView').attr('alt', 'No image');
                if (res.image == null) {
                    $("#deleteCustomersImage").prop("disabled", true);
                    $("#deleteCustomersImage").prop("checked", false);
                }
        
                $("#ucustomers_image").on("change", function () {
                    /* Current this object refer to input element */
                    var $input = $(this);
                    var reader = new FileReader();
                    reader.onload = function () {
                        $("#ucustomers_imageView").attr("src", reader.result);
                        $("#deleteCustomersImage").prop("disabled", true);
                        $("#deleteCustomersImage").prop("checked", false);
                    }
                    reader.readAsDataURL($input[0].files[0]);
                });
        
                $("#deleteCustomersImage").click(function () {
                    if ($(this).is(":checked")) {
                        $newimg = $("#ucustomers_imageView").attr("src");
                        $("#ucustomers_imageView").attr("src", '');
                    } else if ($(this).is(":not(:checked)")) {
                        $("#ucustomers_imageView").attr("src", ($newimg == '') ? $oldimg : $newimg);
                    }
                })
        
            }
        });

    })

    $(document).on('submit', '#updateCustomersForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "update.customers",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#updateCustomersModal .close").click();
                    $('#updateCustomersForm').trigger("reset");
                    var oTable = $("#CustomersViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["info"]("Customer updated successfully", "Updated")

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


    $(document).on('click', '.deleteCustomersBtn', function () {
        let id = $(this).data('id');
        swal({
                title: "Do you want delete this Customers?",
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
                        url: "delete.customers",
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                var oTable = $("#CustomersViewTable").dataTable();
                                oTable.fnDraw(false);

                                Command: toastr["error"]("Customer deleted successfully", "Deleted")

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

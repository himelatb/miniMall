function brandActions() {

    function BrandTable(view) {
        $(view).DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
            ajax: "view.brand",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                {
                    data: 'brand_logo',
                    name: 'brand_logo',
                    orderable: false,
                    searchable: false
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

    BrandTable("#BrandViewTable");

    $(document).on('click', '#createNewBrand', function () {
        $("#brand_imageView").attr("src", '');
        $("#brand_logoView").attr("src", '');
        $("#brand_image").on("change", function () {
            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#brand_imageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });
        $("#brand_logo").on("change", function () {
            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#brand_logoView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });
    })

    $(document).on('submit', '#addBrandForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "add.brand",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#addBrandModal .close").click();
                    $('#addBrandForm').trigger("reset");
                    var oTable = $("#BrandViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["success"]("Brand added successfully", "Added")

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

    $(document).on('click', '.editBrandBtn', function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            method: "POST",
            url: "get.brand",
            data: {id: id},
            success: function (res) {
                $('#updateBrandForm').trigger("reset");
                $("#ubrand_imageView").attr("src", null);
                $("#ubrand_logoView").attr("src", null);
                $('.spanmsg').remove();
                $('.errbr').remove();
                $('#ubrand_id').val(res.id);
                $('#ubrand_name').val(res.brand_name);
                $('#ubrand_url').val(res.url);
                $('#ubrand_description').val(res.description);
                $('#ubrand_discount').val(res.discount);
                $('#ubrand_meta_description').val(res.meta_description);
                $('#ubrand_meta_title').val(res.meta_title);
                $('#ubrand_meta_keywords').val(res.meta_keywords);
                $('#ubrand_status').val(res.status);

                        
                if (res.brand_image != null) {
                    $('#ubrand_imageView').attr('src', "/front/images/brand/images/" + res.brand_image);
                    $oldimg = $('#ubrand_imageView').attr('src');
                    $("#deleteBrandImage").prop("disabled", false);
                    $("#deleteBrandImage").prop("checked", false);
                }
                $('#ubrand_imageView').attr('alt', 'No image');
                if (res.brand_image == null) {
                    $("#deleteBrandImage").prop("disabled", true);
                    $("#deleteBrandImage").prop("checked", false);
                }
        
                $("#ubrand_image").on("change", function () {
                    /* Current this object refer to input element */
                    var $input = $(this);
                    var reader = new FileReader();
                    reader.onload = function () {
                        $("#ubrand_imageView").attr("src", reader.result);
                        $("#deleteBrandImage").prop("disabled", true);
                        $("#deleteBrandImage").prop("checked", false);
                    }
                    reader.readAsDataURL($input[0].files[0]);
                });
        
        
        
                $("#deleteBrandImage").click(function () {
                    if ($(this).is(":checked")) {
                        $newimg = $("#ubrand_imageView").attr("src");
                        $("#ubrand_imageView").attr("src", '');
                    } else if ($(this).is(":not(:checked)")) {
                        $("#ubrand_imageView").attr("src", ($newimg == '') ? $oldimg : $newimg);
                    }
                })


                if (res.brand_logo != null) {
                    $('#ubrand_logoView').attr('src', "/front/images/brand/logos/" + res.brand_logo);
                    $oldlogo = $('#ubrand_logoView').attr('src');
                    $("#deleteBrandLogo").prop("disabled", false);
                    $("#deleteBrandLogo").prop("checked", false);
                }
                $('#ubrand_logoView').attr('alt', 'No logo');
                if (res.brand_logo == null) {
                    $("#deleteBrandLogo").prop("disabled", true);
                    $("#deleteBrandLogo").prop("checked", false);
                }

                $("#ubrand_logo").on("change", function () {
                    /* Current this object refer to input element */
                    var $input = $(this);
                    var reader = new FileReader();
                    reader.onload = function () {
                        $("#ubrand_logoView").attr("src", reader.result);
                        $("#deleteBrandLogo").prop("disabled", true);
                        $("#deleteBrandLogo").prop("checked", false);
                    }
                    reader.readAsDataURL($input[0].files[0]);
                });
                $("#deleteBrandLogo").click(function () {
                    if ($(this).is(":checked")) {
                        $newlogo = $("#ubrand_logoView").attr("src");
                        $("#ubrand_logoView").attr("src", '');
                    } else if ($(this).is(":not(:checked)")) {
                        $("#ubrand_logoView").attr("src", ($newlogo == '') ? $oldlogo : $newlogo);
                    }
                })
        
            }
        });

    })

    $(document).on('submit', '#updateBrandForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        
        $.ajax({
            url: "update.brand",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#updateBrandModal .close").click();
                    $('#updateBrandForm').trigger("reset");
                    var oTable = $("#BrandViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["info"]("Brand updated successfully", "Updated")

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


    $(document).on('click', '.deleteBrandBtn', function () {
        let id = $(this).data('id');
        swal({
                title: "Do you want delete this Brand?",
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
                        url: "delete.brand",
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                var oTable = $("#BrandViewTable").dataTable();
                                oTable.fnDraw(false);

                                Command: toastr["error"]("Brand deleted successfully", "Deleted")

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

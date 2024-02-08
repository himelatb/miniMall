function bannerActions() {

    function BannerTable(view) {
        $(view).DataTable({
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
            ajax: "view.banner",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'type',
                    name: 'type',
                    orderable: false,
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'sort',
                    name: 'sort',
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

    BannerTable("#BannerViewTable");

    $(document).on('click', '#createNewBanner', function () {
        $("#banner_imageView").attr("src", '');
        $("#banner_image").on("change", function () {
            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#banner_imageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });
    })

    $(document).on('submit', '#addBannerForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "add.banner",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#addBannerModal .close").click();
                    $('#addBannerForm').trigger("reset");
                    var oTable = $("#BannerViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["success"]("Banner added successfully", "Added")

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

    $(document).on('click', '.editBannerBtn', function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            method: "POST",
            url: "get.banner",
            data: {id: id},
            success: function (res) {
                $('#updateBannerForm').trigger("reset");
                $("#ubanner_imageView").attr("src", null);
                $('.spanmsg').remove();
                $('.errbr').remove();
                $('#ubanner_id').val(res.id);
                $('#ubanner_url').val(res.url);
                $('#ubanner_type').val(res.type);
                $('#ubanner_sort').val(res.sort);
                $('#ubanner_text').val(res.text);
                $('#ubanner_title').val(res.title);
                $('#ubanner_status').val(res.status);

                if (res.image != null) {
                    $('#ubanner_imageView').attr('src',"/front/images/banner/"+res.image);
                    $oldimg = $('#ubanner_imageView').attr('src');
                    $("#deleteBannerImage").prop("disabled", false);
                    $("#deleteBannerImage").prop("checked", false);
                }
                $('#ubanner_imageView').attr('alt', 'No image');
                if (res.image == null) {
                    $("#deleteBannerImage").prop("disabled", true);
                    $("#deleteBannerImage").prop("checked", false);
                }
        
                $("#ubanner_image").on("change", function () {
                    /* Current this object refer to input element */
                    var $input = $(this);
                    var reader = new FileReader();
                    reader.onload = function () {
                        $("#ubanner_imageView").attr("src", reader.result);
                        $("#deleteBannerImage").prop("disabled", true);
                        $("#deleteBannerImage").prop("checked", false);
                    }
                    reader.readAsDataURL($input[0].files[0]);
                });
        
                $("#deleteBannerImage").click(function () {
                    if ($(this).is(":checked")) {
                        $newimg = $("#ubanner_imageView").attr("src");
                        $("#ubanner_imageView").attr("src", '');
                    } else if ($(this).is(":not(:checked)")) {
                        $("#ubanner_imageView").attr("src", ($newimg == '') ? $oldimg : $newimg);
                    }
                })
        
            }
        });

    })

    $(document).on('submit', '#updateBannerForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "update.banner",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#updateBannerModal .close").click();
                    $('#updateBannerForm').trigger("reset");
                    var oTable = $("#BannerViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["info"]("Banner updated successfully", "Updated")

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


    $(document).on('click', '.deleteBannerBtn', function () {
        let id = $(this).data('id');
        swal({
                title: "Do you want delete this Banner?",
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
                        url: "delete.banner",
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                var oTable = $("#BannerViewTable").dataTable();
                                oTable.fnDraw(false);

                                Command: toastr["error"]("Banner deleted successfully", "Deleted")

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

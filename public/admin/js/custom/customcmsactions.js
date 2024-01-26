function cmsActions() {
    $(document).on('submit', '#cmsForm', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        formData.append("status", $('#cmsstatus').val());


        $.ajax({
            url: "add.cms",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
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
            error: function (err) {
                $('.spanmsg').remove();
                $('.errbr').remove();
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('.errormsg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }
        });
    })


    $(document).on('click', '.editCmsBtn', function () {
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
        $('#ucmsstatus').val(status);
        $('#ucmsmeta_description').val(meta_description);
        $('#ucmsmeta_keywords').val(meta_keywords);
    })

    $(document).on('submit', '#UpdateCmsForm', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        formData.append("ucmsstatus", $('#ucmsstatus').val());

        $.ajax({
            url: "update.cms",
            method: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 'success') {
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

    $(document).on('click', '.deleteCmsBtn', function () {

        let id = $(this).data('id');
        swal({
                title: "Do you want delete this page?",
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
                        url: "admin/delete.cms",
                        method: 'post',
                        data: {
                            id: id,
                        },
                        success: function (res) {
                            if (res.status == 'success') {
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


}

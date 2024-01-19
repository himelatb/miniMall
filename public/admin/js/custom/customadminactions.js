function adminActions() {
    $(document).on('submit', '#adminForm', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        formData.append("type", $('#type').val());
        formData.append("status", $('#status').val());
        $("#image").on("change", function () {

            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#imageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });


        $.ajax({
            url: "add.admins",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
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

    $(document).on('click', '#createNewAdmin', function () {

        $("#image").on("change", function () {

            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#imageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });

    })

    $(document).on('click', '.editAdminBtn', function () {
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
        $('#utype').val((type == 1) ? "1" : "2");
        $('#ustatus').val((status == 1) ? "1" : "2");
        $('#uimageView').attr('src', "images/" + img);
        $('#uimageView').attr('alt', name + " image");

        $("#uimage").on("change", function () {

            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#uimageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });


    })

    $(document).on('submit', '#updateForm', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        formData.append("utype", $('#utype').val());
        formData.append("ustatus", $('#ustatus').val());

        $.ajax({
            url: "update.admins",
            method: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 'success') {
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

    $(document).on('click', '.deleteAdminBtn', function () {

        let id = $(this).data('id');
        swal({
                title: "Do you want delete this admin?",
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
                        url: "delete.admins",
                        method: 'post',
                        data: {
                            id: id,
                        },
                        success: function (res) {
                            if (res.status == 'success') {

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

    $(document).on('click', '#passChangeBtn', function () {

        swal({
                title: "Do you want to change the password?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            },
            function (isConfirm) {
                if (isConfirm) {

                    let oldPassword = $("#oldPassword").val();
                    let newPassword = $("#newPassword").val();
                    let confirmPassword = $("#confirmPassword").val();


                    $.ajax({
                        url: "{{url('admin/password.admins')}}",
                        method: 'post',
                        data: {
                            oldPassword: oldPassword,
                            newPassword: newPassword,
                            confirmPassword: confirmPassword,

                        },
                        success: function (res) {
                            $('.spanmsg').remove();
                            $('.errbr').remove();
                            if (res.status == 'not_matched') {
                                $('.nerrormsg').append('<span class=" bg-danger spanmsg">' + 'Confirm password is not maching' + '</span>' + '<br class="errbr">');
                            }
                            if (res.status == 'wrong_pass') {
                                $('#oerrormsg').append('<span class=" bg-danger spanmsg">' + 'Enter current password' + '</span>' + '<br class="errbr">');
                            }
                            if (res.status == 'success') {
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

                                setTimeout("location.href = '{{url('admin/login')}}';", 2000);
                            }
                        },
                        error: function (err) {
                            $('.spanmsg').remove();
                            $('.errbr').remove();
                            let error = err.responseJSON;
                            $.each(error.errors, function (index, value) {
                                $('#perrormsg').append('<span class=" bg-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                            });
                        }
                    });
                }
            }
        );
    })


}

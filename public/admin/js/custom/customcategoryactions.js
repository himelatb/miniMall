function categoryActions() {
    $(document).on('click', '#createNewCategory', function () {
        $("#category_image").on("change", function () {
            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#category_imageView").attr("src", reader.result);
            }
            reader.readAsDataURL($input[0].files[0]);
        });
    })

    $(document).on('submit', '#addcategoryForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "add.category",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#addcategoryModal .close").click();
                    $('#addcategoryForm').trigger("reset");
                    setTimeout(location.reload.bind(location), 1500);

                    Command: toastr["success"]("Category added successfully", "Added")

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

    $(document).on('click', '.editCategoryBtn', function () {

        $('#updatecategoryForm').trigger("reset");
        $("#deleteCategoryImage").prop("disabled", false);
        $("#deleteCategoryImage").prop("checked", false);
        $('.spanmsg').remove();
        $('.errbr').remove();
        $('#ucategory_id').val($(this).data("id"));
        $('#ucategory_name').val($(this).data("name"));
        $('#ucategory_url').val($(this).data("url"));
        $('#ucategory_description').val($(this).data("description"));
        $('#ucategory_discount').val($(this).data("discount"));
        $('#ucategory_parent').val($(this).data("parent_id"));

        if ($(this).data("image") != '') {
            $('#ucategory_imageView').attr('src', "/category/images/" + $(this).data("image"));
            $old = $('#ucategory_imageView').attr('src');
        }
        $('#ucategory_imageView').attr('alt', 'Empty image');

        if ($(this).data("image") == '') {
            $("#deleteCategoryImage").prop("disabled", true);
            $("#deleteCategoryImage").prop("checked", false);
        }
        $('#ucategory_meta_description').val($(this).data("meta_description"));
        $('#ucategory_meta_title').val($(this).data("meta_title"));
        $('#ucategory_meta_keywords').val($(this).data("meta_keywords"));
        $('#ucategory_status').val($(this).data("status"));

        $("#ucategory_image").on("change", function () {
            /* Current this object refer to input element */
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function () {
                $("#ucategory_imageView").attr("src", reader.result);
                $("#deleteCategoryImage").prop("disabled", true);
                $("#deleteCategoryImage").prop("checked", false);
            }
            reader.readAsDataURL($input[0].files[0]);
        });



        $("#deleteCategoryImage").click(function () {
            if ($(this).is(":checked")) {
                $new = $("#ucategory_imageView").attr("src");
                $("#ucategory_imageView").attr("src", '');
            } else if ($(this).is(":not(:checked)")) {
                $("#ucategory_imageView").attr("src", ($new == '') ? $old : $new);
            }
        })


    })

    $(document).on('submit', '#updatecategoryForm', function (e) {
        e.preventDefault();

        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            url: "update.category",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#updatecategoryModal .close").click();
                    $('#updatecategoryForm').trigger("reset");
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


    $(document).on('click', '.deleteCategoryBtn', function () {
        let id = $(this).data('id');
        swal({
                title: "Do you want delete this product?",
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
                        url: "delete.category",
                        method: 'POST',
                        data: {
                            "id": id
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                setTimeout(location.reload.bind(location), 1500);


                                Command: toastr["error"]("Category deleted successfully", "Deleted")

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

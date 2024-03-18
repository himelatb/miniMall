function productActions() {

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
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `<div class="d-flex col-sm-12">
    <input type="text" class="col-sm-2 m-1 form-control" name="size[]" value="" placeholder="Size (letters only.example:S)"/>
    <input type="text" class="col-sm-1 m-1 form-control" name="color[]" value="" placeholder="Color"/>
    <input type="text" class="col-sm-1 m-1 form-control" name="colorCode[]" value="" placeholder="Color code"/>
    <input type="text" class="col-sm-1 m-1 form-control" name="sku[]" value="" placeholder="SKU"/>
    <input type="text" class="col-sm-1 m-1 form-control" name="price[]" value="" placeholder="Price"/>
    <input type="text" class="col-sm-1 m-1 form-control" name="stock[]" value="" placeholder="Stock"/>
    <a href="javascript:void(0);" style="background: #464768;" class="col-sm-1 m-1 form-control remove_button btn btn-primary">Remove</a>
    </div>`; //New input field html 
    var x = 1; //Initial field counter is 1

    // Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        } else {
            swal({
                title: "A maximum of " + maxField + " fields are allowed to be added.",
                type: "warning",
                confirmButtonClass: 'btn btn-secondary',
                buttonsStyling: true,
                showCancelButton: false,
                closeOnConfirm: true,
            });
        }
    });

    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });

    function ProductTable(view) {
        $(view).DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
            ajax: "view.product",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'product_code',
                    name: 'product_code'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'brand.brand_name',
                    name: 'brand.brand_name'
                },
                {
                    data: 'category.category_name',
                    name: 'category.category_name'
                },
                {
                    data: 'category.parent.category_name',
                    name: 'category.parent.category_name'
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

    ProductTable("#ProductViewTable");

    $(document).on('submit', '#addProductForm', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "add.product",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            Cache: false,
            success: function (res) {
                if (res.status == 'success') {
                    $("#addProductModal .close").click();
                    $('#addProductForm').trigger("reset");
                    var oTable = $("#ProductViewTable").dataTable();
                    oTable.fnDraw(false);

                    Command: toastr["success"]("Product added successfully", "Added")
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

    $(document).on("change", "#product_images, #uproduct_images", function (e) {
        $(".imagePreview").html("Pictures to be added ");
        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            if (!files[i].type.match("image")) continue;
            var reader = new FileReader();
            reader.readAsDataURL(files[i]);
            reader.onload = function (e) {
                const picFile = e.target;
                $(".imagePreview").append('<img src="' + picFile.result + '" alt="Image"  style="width: 100px;position : block; margin-left: auto;"><input type="text" style="width: 20px;" name="sort[]"></input>');
            }
        }



    });

    $(document).on('click', '.editProductBtn', function () {
        let id = $(this).data('id');
        $(".imagePreview").html("");
        $('#updateProductForm').trigger("reset");
        $.ajax({
            type: 'POST',
            url: "get.product",
            data: {
                id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#uproduct_id').val(res.id);
                $('#uproduct_name').val(res.product_name);
                $('#uproduct_weight').val(res.weight);
                $('#uproduct_description').val(res.description);
                $('#uproduct_discount').val(res.product_discount);
                $('#uproduct_category').val(res.category_id);
                $('#uproduct_brand').val(res.brand_id);
                $('#uproduct_code').val(res.product_code);
                $('#udiscount_type').val(res.discount_type);
                $('#ufinal_price').val(res.final_price);
                $('#uproduct_price').val(res.product_price);
                $('#uproduct_wash').val(res.wash_care);
                $('#uproduct_material').val(res.material);
                $('#uproduct_fit').val(res.fit);
                $('#uproduct_occasion').val(res.occasion);
                $('#uproduct_sleeve').val(res.sleeve);
                $('#uproduct_keywords').val(res.keywords);
                $('#uproduct_featured').prop("checked", (res.is_featured == "Yes") ? true : false);
                $('#uproduct_meta_description').val(res.meta_description);
                $('#uproduct_meta_title').val(res.meta_title);
                $('#uproduct_meta_keywords').val(res.meta_keywords);
                $('#uproduct_status').val(res.status);
                $('#added_attributes_table').html("");

                res.attributes.forEach(function (attribute) {
                    $('#added_attributes_table').append('<tr><td hidden><input type="text" id="attributeId" name="attributeId[]" value="'+ attribute.id + '"/></td><td>' + attribute.size + '</td><td>' + attribute.sku + '</td><td>'+'<input type="text" id="attributePrices" name="attributePrices[]" class="col-sm-10 border-0 form-control" value="'+ attribute.price + '"/></td><td>' +'<input type="text" id="attributeStocks" name="attributeStocks[]" value="'+ attribute.stock + '" class="col-sm-8 border-0 form-control"/></td><td>' +'<input type="text" id="attributeStocks" name="attributeColors[]" value="'+ attribute.color + '" class="col-sm-8 border-0 form-control"/></td><td>' +'<input type="text" id="attributeStocks" name="attributeColorCodes[]" value="'+ attribute.color_code + '" class="col-sm-8 border-0 form-control"/></td><td id="astatusd-'+attribute.id+'"><a href="javascript:void(0);" data-id="'+attribute.id+'" data-status="'+attribute.status+'" class="toggleAttributeStatus"><i  class="fas m-1 '+(attribute.status == 1 ? "fa-toggle-on" : "fa-toggle-off")+'"></i></a><a href="javascript:void(0);" data-id="'+attribute.id+'" data-product_id="'+attribute.product_id+'" class="deleteAttribute"><i class="fas fa-trash deleteAttribute"></i></a></td></tr>');
                    });

                $(document).on('click','.toggleAttributeStatus', function(e){
                    e.preventDefault();
                    let id = $(this).data('id'); 
                    let status = $(this).data('status');
                    $.ajax({
                        method: 'POST',
                        url: "attribute.status",
                        data: {
                            id: id,
                            status: status
                        },
                        success: function (res) {
                            $("#astatus-"+res[0].id).remove();
                            if(res[0].status == 1){
                                $("#astatusd-"+res[0].id).html('<a href="javascript:void(0);" data-id="'+res[0].id+'" data-status="1" class="toggleAttributeStatus"><i  class="fas m-1 fa-toggle-on"></i></a><a href="javascript:void(0);" data-id="'+res[0].id+'" data-product_id="'+res[0].product_id+'" class="deleteAttribute"><i class="fas fa-trash"></i></a>');
                            }
                            else{
                                $("#astatusd-"+res[0].id).html('<a href="javascript:void(0);" data-id="'+res[0].id+'" data-status="0" class="toggleAttributeStatus"><i  class="fas m-1 fa-toggle-off"></i></a><a href="javascript:void(0);" data-id="'+res[0].id+'" data-product_id="'+res[0].product_id+'" class="deleteAttribute"><i class="fas fa-trash"></i></a>');
                            }
                        },
                    });
                });
                $(document).on('click', '.deleteAttribute', function(e){
                    e.preventDefault();
                    let id = $(this).data('id'); 
                    let product_id = $(this).data('product_id');
                    $.ajax({
                        method: 'POST',
                        url: "attribute.delete",
                        data: {
                            id: id,
                            product_id: product_id
                        },
                        success: function (res) {
                            $('#added_attributes_table').html("");
                            res.forEach(function (attribute) {
                                $('#added_attributes_table').append('<tr><td hidden><input type="text" id="attributeId" name="attributeId[]" value="'+ attribute.id + '"/></td><td>' + attribute.size + '</td><td>' + attribute.sku + '</td><td>'+'<input type="text" id="attributePrices" name="attributePrices[]" class="col-sm-10 border-0 form-control" value="'+ attribute.price + '"/></td><td>' +'<input type="text" id="attributeStocks" name="attributeStocks[]" value="'+ attribute.stock + '" class="col-sm-8 border-0 form-control"/></td><td>' +'<input type="text" id="attributeStocks" name="attributeColors[]" value="'+ attribute.color + '" class="col-sm-8 border-0 form-control"/></td><td>' +'<input type="text" id="attributeStocks" name="attributeColorCodes[]" value="'+ attribute.color_code + '" class="col-sm-8 border-0 form-control"/></td><td id="astatusd-'+attribute.id+'"><a href="javascript:void(0);" data-id="'+attribute.id+'" data-status="'+attribute.status+'" class="toggleAttributeStatus"><i  class="fas m-1 '+(attribute.status == 1 ? "fa-toggle-on" : "fa-toggle-off")+'"></i></a><a href="javascript:void(0);" data-id="'+attribute.id+'" data-product_id="'+attribute.product_id+'" class="deleteAttribute"><i class="fas fa-trash deleteAttribute"></i></a></td></tr>');
                            });
                        },
                    });
                });



                $(document).on('click', '.deleteProductImage', function () {
                    let id = $(this).data('id');
                    let product_id = $(this).data('product_id');
                    swal({
                            title: "Do you want delete this Image?",
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
                                    url: "delete.product.image",
                                    method: 'POST',
                                    data: {
                                        id: id,
                                        product_id: product_id,
                                    },
                                    success: function (res) {
                                        $('#imageContainer').html("");
                                        res.forEach(function (image) {
                                            $('#imageContainer').append('<img src="/front/images/product/small/' + image.image + '" alt="Image"  style="width: 100px;position : block; margin-left: auto;"><input type="text" style="width: 20px;" name="usort[]" value="' + image.image_sort + '"></input><input hidden type="text" style="width: 20px;" name="uimage[]" value="' + image.image + '"></input><a class="p-1 deleteProductImage" href="javascript:void(0)" data-id="' + image.id + '" data-product_id="' + image.product_id + '"><i class="fas fa-eraser" style="color: #fd0404;"></i></a>');
                                        });

                                        Command: toastr["error"]("Image deleted successfully", "Deleted")

                                    }

                                });
                            }
                        });



                })
                $('#imageContainer').html("");
                res.images.forEach(function (image) {
                    $('#imageContainer').append('<img src="' + "/front/images/product/small/" + image.image + '" alt="Image"  style="width: 100px;position : block; margin-left: auto;"><input style="width: 20px;" type="text" name="usort[]" value="' + image.image_sort + '"></input><input hidden type="text" style="width: 20px;" name="uimage[]" value="' + image.image + '"></input><a class="p-1 deleteProductImage" href="javascript:void(0)" data-id="' + image.id + '" data-product_id="' + res.id + '"><i class="fas fa-eraser" style="color: #fd0404;"></i></a>');
                });
            }
        });


    })

    $(document).on('submit', '#updateProductForm', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();
        $('.errbr').remove();
        var formData = new FormData(this);
        $.ajax({
            url: "update.product",
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res != null) {
                    $("#updateProductModal .close").click();
                    $('#updateProductForm').trigger("reset");
                    var oTable = $("#ProductViewTable").dataTable();
                    oTable.fnDraw(false);
                    $('#imageContainer').html("");
                    res.forEach(function (image) {
                        $('#imageContainer').append('<img src="' + "/front/images/product/small/" + image.image + '" alt="Image"  style="width: 100px;position : block; margin-left: auto;"><input type="text" style="width: 20px;" name="usort[]" value="' + image.image_sort + '"></input><input hidden type="text" style="width: 20px;" name="uimage[]" value="' + image.image + '"></input><a class="p-1 deleteProductImage" href="javascript:void(0)" data-id="' + image.id + '" data-product_id="' + res.id + '"><i class="fas fa-eraser" style="color: #fd0404;"></i></a>');
                    });

                    Command: toastr["info"]("Product updated successfully", "Updated")

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

    $(document).on('click', '.deleteProductBtn', function () {
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
                        url: "delete.product",
                        method: 'POST',
                        data: {
                            "id": id
                        },
                        success: function (data) {
                            if (data.status == 'success') {

                                var oTable = $("#ProductViewTable").dataTable();
                                oTable.fnDraw(false);

                                Command: toastr["error"]("Product deleted successfully", "Deleted")

                            }
                        }

                    });
                }
            });



    })


}

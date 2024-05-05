function orderActions() {

    function OrderTable(view) {
        $(view).DataTable({
            "responsive": true,
            "processing": false,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 5,
            ajax: "view.order",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'customer.email',
                    name: 'customer.email',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'customer.name',
                    name: 'customer.name',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'product',
                    name: 'product',
                    searchable: false,
                },
                {
                    data: 'total',
                    name: 'total',
                    searchable: false,
                },
                {
                    data: 'payment_method',
                    name: 'payment_method',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
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
    OrderTable("#OrderViewTable");

    $('#order_status').on('change', function (e) {
        let status = $(this).val();

        if (status == 'Shipped') {
            $('#courier_name').prop('hidden', false);
            $('#courier_name').prop('disabled', false);
            $('#courier_name').prop('required', true);
            $('#tracking_id').prop('hidden', false);
            $('#tracking_id').prop('disabled', false);
            $('#tracking_id').prop('required', true);
        } else {
            $('#courier_name').prop('hidden', true);
            $('#courier_name').prop('disabled', true);
            $('#courier_name').prop('required', false);
            $('#tracking_id').prop('hidden', true);
            $('#tracking_id').prop('disabled', true);
            $('#tracking_id').prop('required', false);
            
        }
    })


    $('#changeStatusBtn').on('click', function (e) {
        e.preventDefault();
        $('.spanmsg').remove();

        let id = $('#order_status').data('id');
        let status = $('#order_status').val();
        let courier_name = '';
        let tracking_id = '';

        if (status == "Shipped") {
            courier_name = $('#courier_name').val();
            tracking_id = $('#tracking_id').val();
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "change.status",
            method: 'post',
            data: {
                id : id,
                status : status,
                courier_name: courier_name,
                tracking_id: tracking_id
            },
            success: function (res) {
                if (res.status == 'success') {
                    
                    Command: toastr["info"]("Order status updated successfully", "Updated")

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

                    var time = new Date(res.orderLog['created_at']);
                    let shipped = '';

                    if (res.orderLog['status'] == 'Shipped') {
                       shipped = `<h6>Courier name: ${res.orderLog['courier_name']}</h6>
                        <h6>Tracking Id: ${res.orderLog['tracking_id']}</h6>`;
                    }

                    $('#statusLog').append(`<label class="form-label">${res.orderLog['status']}</label>
                    ${shipped}
                    <h6>Updated at: ${time.toLocaleDateString('es-ES')}</h6><br/>`)
                }

            },
            error: function (err) {
                let error = err.responseJSON;
                $('.spanmsg').remove();
                $('.errbr').remove();
                $.each(error.errors, function (index, value) {
                    $('.msg').append('<span class="text-danger spanmsg">' + value + '</span>' + '<br class="errbr">');
                });
            }
        });
    })


    // $(document).on('click', '.deleteOrderBtn', function () {
    //     let id = $(this).data('id');
    //     swal({
    //             title: "Do you want delete this Order?",
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonClass: 'btn btn-success',
    //             cancelButtonClass: 'btn btn-danger',
    //             buttonsStyling: false,
    //             confirmButtonText: "Delete",
    //             cancelButtonText: "Cancel",
    //             closeOnConfirm: true,
    //             showLoaderOnConfirm: true,
    //         },
    //         function (isConfirm) {
    //             if (isConfirm) {
    //                 $.ajax({
    //                     url: "delete.order",
    //                     method: 'POST',
    //                     data: {
    //                         id: id,
    //                     },
    //                     success: function (data) {
    //                         if (data.status == 'success') {
    //                             var oTable = $("#OrderViewTable").dataTable();
    //                             oTable.fnDraw(false);

    //                             Command: toastr["error"]("Order deleted successfully", "Deleted")

    //                             toastr.options = {
    //                                 "closeButton": true,
    //                                 "debug": false,
    //                                 "newestOnTop": false,
    //                                 "progressBar": false,
    //                                 "positionClass": "toast-top-right",
    //                                 "preventDuplicates": true,
    //                                 "onclick": null,
    //                                 "showDuration": "300",
    //                                 "hideDuration": "500",
    //                                 "timeOut": "2000",
    //                                 "extendedTimeOut": "1000",
    //                                 "showEasing": "swing",
    //                                 "hideEasing": "linear",
    //                                 "showMethod": "fadeIn",
    //                                 "hideMethod": "fadeOut"
    //                             }

    //                         }
    //                     }

    //                 });
    //             }
    //         });



    // })
}

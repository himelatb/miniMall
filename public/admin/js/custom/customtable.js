function myTableFunction(view) {
    $(view).DataTable({
        "lengthChange": false,
        "pageLength": 5,
        "searching": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": true,
        "serverSide": true,
    });
    $(view + "_filter").addClass("d-flex");
    $(view + "_filter").children("label").addClass("d-flex");
}

myTableFunction("#CmsViewTable");
myTableFunction("#AdminViewTable");
myTableFunction("#CategoryViewTable");
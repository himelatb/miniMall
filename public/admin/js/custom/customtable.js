function myTableFunction(view) {
    $(view).DataTable({
        "paging":true,
        "lengthChange": false,
        "pageLength": 5,
        "searching": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": true,
    });
    $(view+"_filter").addClass("d-flex");
    $(view+"_filter").children("label").addClass("d-flex");
    $(view+"_wrapper").children().first().children().first().remove();
  }

myTableFunction("#CmsViewTable");
myTableFunction("#AdminViewTable");
myTableFunction("#CategoryViewTable");
<div class="d-flex">
    <a href="{{url('admin/order-details/'.$id)}}" title="View order details" id="detailsOrderBtn" class="detailsOrderBtn btn btn-success">
        <i class="fa fa-file"></i>
    </a>
    @if ($status == 'Shipped' || $status == 'Delivered')
    <a href="{{url('admin/order-print/'.$id)}}" title="Print order invoice" id="printOrderBtn" data-id="{{$id}}" class="printOrderBtn btn btn-info">
        <i class="fa fa-print"></i>
    </a>
    <a href="{{url('admin/order-pdf/'.$id)}}" title="download order invoice" id="pdfOrderBtn" data-id="{{$id}}" class="pdfOrderBtn btn btn-danger">
        <i class="fa fa-file-pdf"></i>
    </a>
    @endif
</div>
@extends('front.layout.layout')

@section('content')
<div class="container">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: {{$order['id']}}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Placed At:</strong> <br>{{date("d/m/Y H:i A", strtotime($order['created_at']))}} </div>
                    @if ($order['status'] == 'Shipped' || $order['status'] == 'Delivered')
                    <div class="col"> <strong>Shipping BY:</strong> <br> {{$order['courier_name']}} </div>
                    <div class="col"> <strong>Tracking #:</strong> <br>  {{$order['tracking_id']}} </div>
                    @endif
                    <div class="col"> <strong>Status:</strong> <br> <span id="detailOrderStatus">{{$order['status']}}</span> </div>
                </div>
            </article>
            <div class="track">
                @if ($order['status'] == 'Cancelled')
                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Cancelled</span> </div>  
                @else
                @php
                foreach ($orderLog as $log) {
                    $status[] = $log['status'];
                }
            @endphp
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Placed</span> </div>
            <div class="step {{in_array('Pending', $status) ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step {{in_array('Processing', $status) ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Order Processing </span> </div>
            <div class="step {{in_array('Shipped', $status) ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Order Shipped</span> </div>
            <div class="step {{in_array('Delivered', $status) ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Order Delivered</span> </div>
                @endif
            </div>
            <hr>
            <ul class="row">
                @foreach ($order['order_products'] as $product)
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                                    @if($product['images'] != null)
                                    @foreach ($product['images'] as $image)
                                    <div class="aside"><img src="{{ asset ('front/images/product/small/'.$image['image']) }}" class="img-sm border"></div>
                                    @break
                                    @endforeach
                                    @endif
                        <figcaption class="info align-self-center">
                            <p class="title">{{$product['product']['product_name']}} <br> {{'Size: '.$product['attribute']['size'].', Color: '.$product['attribute']['color']}}</p> <span class="text-muted">{{' Qty:'.$product['qty'].',  '.$product['price'].' tk' }} </span>
                        </figcaption>
                    </figure>
                </li>
                @endforeach
            </ul>
            <hr>
            <div class="row d-flex justify-content-between pl-3 pr-3">
                <a href="{{url('/my_orders')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to Orders</a>
                @if ($order['status'] == 'Pending')
                <a id="cancelOrderBtn" data-id="{{$order['id']}}" class="btn btn-danger" data-abc="true">Cancel Order <i class="fa fa-times"> </i></a>
                @endif
            </div>
        </div>
    </article>
</div>
@endsection
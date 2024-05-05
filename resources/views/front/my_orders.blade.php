@extends('front.layout.profile_layout')
@section('profile_pages')
        <div class="col-lg-10">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Orders</span></h5>
        <span class="msg" id="msg"></span>
        <div class="mb-5">
                <div class="container">
                    @foreach ($orders as $order)
                        
                    <div class="row pb-5 pt-2 mb-3 bg-light">
                        <div class="col-lg-12 d-flex justify-content-between p-0 mb-3 border-bottom">
                            <div class="col-md-10">
                                Order: <a href="#">{{$order->id}}</a><br>
                                <small>Placed on {{$order->created_at}}</small>
                            </div>
                            <div class="col-md-2 text-right text-uppercase">
                                <a href="{{url('/order_detail/'.$order->id)}}">manage</a>
                            </div>
                        </div>
                        @foreach ($order->orderProducts as $product)
                        <div class="col-lg-12 d-flex mb-2">
                            <div class="col-lg-4 d-flex text-left">
                                <span><img src="{{asset('front/images/product/small/'.$product->image)}}" alt="" style="width: 100px; height: 100px;"> </span>
                                <div class="pl-1 align-self-center overflow-hidden text-dark">{{$product->name.', '.$product->size.', '.$product->color}}</div>
                            </div>
                            <div class="col-lg-2 align-self-center text-right">
                                Qty: <span class="text-dark">{{$product->qty}}</span>
                            </div>
                            <div class="col-lg-2 align-self-center text-right">
                                <small class="border rounded-pill pl-2 pr-2 p-1 bg-secondary text-dark">{{$order->status}}</small>
                            </div>
                            @if ($order->status == "Delivered")
                            <div class="col-lg-4 align-self-center text-dark text-right">
                                Delivered {{date("d/m/Y H:i A", strtotime($order->updated_at))}}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
        </div>
@endsection
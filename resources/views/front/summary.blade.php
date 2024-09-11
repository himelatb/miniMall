@extends('front.layout.layout') @section('content')
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Order Summary</span></h5>
@if(isset($cart))
                <div class="col-lg-12">
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Products</h6>
                            <?php $total = 0; ?>
                            @foreach ($cart as $product)
                            <div class="d-flex justify-content-between">
                                <p>                                    
                                    @if($product['images'] != null)
                                    @foreach ($product['images'] as $image)
                                    <img src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt="" style="width: 30px; height: 30px;">
                                    @break
                                    @endforeach
                                    @endif
                                    {{$product['product']['product_name'].', Size:'.$product['attribute']['size'].', Color:'.$product['attribute']['color']}}<small>{{' X '.$product['product_qty'] }}</small></p>
                                <?php
                                $total += $product['product_qty'] * $product['price'];
                                ?>
                                <p>{{$product['product_qty'] * $product['price'].' tk'}}</p>
        
                            </div>
                            @endforeach
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between">
                                <p>Subtotal</p>
                                <p>{{$total}} tk</p>
                            </div>
                            @if (Session::has('coupon_code'))
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-medium couponTag">Coupon</p>
                                <p class="font-weight-medium couponAmount">{{'-'.Session::get('coupon_amount')}}{{Session::get("coupon_type") == "Fixed"? 'tk' : (Session::get("coupon_type") == "Percentage"? '%' : "")}}</p>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <p >Shipping</p>
                                <p >100 tk</p>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h6 class="font-weight-medium">Total</h6>
                                <h6 id="totalCost">{{$totalCost}} tk</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between">
                                <p>Payment method</p>
                                <p >{{Session::has('paymentMethod') ? Session::get('paymentMethod') : 'payment method invalid!!'}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-light text-center">
                            <thead>
                                <tr>
                                    <th>Billing Address</th>
                                    <th>Shipping Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{$billingAddress['name'].', '.$billingAddress['mobile'].', '.$billingAddress['address'].
                                        ($billingAddress['road_house'] != null ? ', '.$billingAddress['road_house']: '').
                                        ($billingAddress['town'] != null ? ', '.$billingAddress['town']: '').
                                        ($billingAddress['district'] != null ? ', '.$billingAddress['district']: '').
                                        ($billingAddress['country'] != null ? ', '.$billingAddress['country']: '').
                                        ($billingAddress['zipcode'] != null ? ', '.$billingAddress['zipcode']: '')
                                        }}
                                        </td>
                                    <td>{{$shippingAddress['name'].', '.$shippingAddress['mobile'].', '.$shippingAddress['address'].
                                        ($shippingAddress['road_house'] != null ? ', '.$shippingAddress['road_house']: '').
                                        ($shippingAddress['town'] != null ? ', '.$shippingAddress['town']: '').
                                        ($shippingAddress['district'] != null ? ', '.$shippingAddress['district']: '').
                                        ($shippingAddress['country'] != null ? ', '.$shippingAddress['country']: '').
                                        ($shippingAddress['zipcode'] != null ? ', '.$shippingAddress['zipcode']: '')
                                        }}</td>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <a href="{{url('/place_order')}}"> 
                            <button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                        </a>
                    </div>
                </div>
@endif
        </div>
    </div>
</div>
<!-- Checkout End -->
@endsection
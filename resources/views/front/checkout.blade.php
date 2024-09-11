@extends('front.layout.layout') @section('content')
<!-- Checkout Start -->
<div class="container-fluid">
@if (isset($cart))

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{$error}}</div>
        @endforeach
    @endif
<form action="{{url('/checkout')}}" method="post">@csrf
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Billing Address</span></h5>
            <a
                style="width: 150px;margin-right: 15px;"
                class="btn btn-outline-dark mb-2"
                data-toggle="modal"
                data-target="#addAddressModal"
                id="createNewAddress">Add Address</a>
            <div class="bg-light p-30 mb-5">
                <div class="form-group">
                    <table>
                        <tbody>
                            @if (isset($addresses)) 
                            @foreach ($addresses as $address)
                            <tr class="addressrow{{$address['id']}}">
                                <td>
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            value="{{$address['id']}}"
                                            name="billing"
                                            id="bilingAddressSelect{{$address['id']}}" {{$address['status'] == 1 ? "checked" :''}}>
                                        <label
                                            class="custom-control-label d-flex"
                                            for="bilingAddressSelect{{$address['id']}}">
                                            <div class="address{{$address['id']}}">
                                                {{$address['name'].', '.$address['mobile'].', '.$address['address'].
                                                            ($address['road_house'] != null ? ', '.$address['road_house']: '').
                                                            ($address['town'] != null ? ', '.$address['town']: '').
                                                            ($address['district'] != null ? ', '.$address['district']: '').
                                                            ($address['country'] != null ? ', '.$address['country']: '').
                                                            ($address['zipcode'] != null ? ', '.$address['zipcode']: '')
                                                            }}
                                            </div>
    
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex custom-control mb-2">
                                        <a
                                            href="javascript:void(0);"
                                            data-toggle="modal"
                                            data-target="#editAddressModal"
                                            id="editAddressBtn"
                                            data-id="{{$address['id']}}"
                                            data-country="{{$address['country']}}"
                                            class="btn btn-warning editAddressBtn">
                                            Edit
                                        </a>
                                        <a
                                            href="javascript:void(0);"
                                            id="deleteAddressBtn"
                                            data-id="{{$address['id']}}"
                                            class="btn btn-danger deleteAddressBtn">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach 
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="form-group mt-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="shipto">
                        <label
                            class="custom-control-label"
                            for="shipto"
                            data-toggle="collapse"
                            data-target="#shipping-address">Ship to different address</label>
                    </div>
                </div>
            </div>
            <div class="collapse mb-5" id="shipping-address">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Shipping Address</span></h5>
                <a
                    style="width: 150px;margin-right: 15px;"
                    class="btn btn-outline-dark mb-2"
                    data-toggle="modal"
                    data-target="#addAddressModal"
                    id="createNewAddress">Add Address</a>
                <div class="bg-light p-30">
                    <div class="form-group">
                        <table>
                            <tbody>
                                @if (isset($addresses))
                                @foreach ($addresses as $address)
                                <tr class="addressrow{{$address['id']}}">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input
                                                type="radio"
                                                class="custom-control-input"
                                                value="{{$address['id']}}"
                                                name="shipping"
                                                id="shippingAddressSelect{{$address['id']}}">
                                            <label
                                                class="custom-control-label d-flex"
                                                for="shippingAddressSelect{{$address['id']}}">
                                                <div class="address{{$address['id']}}">
                                                    {{$address['name'].', '.$address['mobile'].', '.$address['address'].
                                                                ($address['road_house'] != null ? ', '.$address['road_house']: '').
                                                                ($address['town'] != null ? ', '.$address['town']: '').
                                                                ($address['district'] != null ? ', '.$address['district']: '').
                                                                ($address['country'] != null ? ', '.$address['country']: '').
                                                                ($address['zipcode'] != null ? ', '.$address['zipcode']: '')
                                                                }}
                                                </div>
    
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex custom-control mb-2">
                                            <a
                                                href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#editAddressModal"
                                                id="editAddressBtn"
                                                data-id="{{$address['id']}}"
                                                data-country="{{$address['country']}}"
                                                class="btn btn-warning editAddressBtn">
                                                Edit
                                            </a>
                                            <a
                                                href="javascript:void(0);"
                                                id="deleteAddressBtn"
                                                data-id="{{$address['id']}}"
                                                class="btn btn-danger deleteAddressBtn">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach 
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    <?php $total = 0; ?>
                    @foreach ($cart as $product)
                        <div class="d-flex justify-content-between">
                            <span>
                                @if($product['images'] != null)
                                @foreach ($product['images'] as $image)
                                <img src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt=""
                                    style="width: 20px; height: 20px;">
                                @break
                                @endforeach
                                @endif
                                {{'Size:'.$product['attribute']['size'].', Color:'.$product['attribute']['color']}}<small>{{' X '.$product['product_qty'] }}</small>
                            </span>
                            <?php
                            $total += $product['product_qty'] * $product['price'];
                            ?>
                            <p>{{$product['product_qty'] * $product['price'].' tk'}}</p>
        
                        </div>
                    @endforeach
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>{{$total}} tk</h6>
                    </div>
                    @if (Session::has('coupon_code'))
                    <div class="d-flex justify-content-between  mb-3">
                        <h6 class="font-weight-medium couponTag">Coupon</h6>
                        <h6 class="font-weight-medium couponAmount">{{Session::get("coupon_type") == "Fixed"? '-'.Session::get('coupon_amount').'tk' : (Session::get("coupon_type") == "Percentage"? '-'.Session::get('coupon_amount').'%' : "")}}</h6>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">10 tk</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="totalCost">{{(Session::has("coupon_type") && Session::get("coupon_type") == "Fixed"? ($total + 10 - Session::get('coupon_amount')) : ($total + 10 - $total * (Session::get('coupon_amount')/100)))}} tk</h5>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Payment</span></h5>
                <div class="bg-light p-30">
                    <div class="form-group mb-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" value="cod" name="payment" id="cod">
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                class="custom-control-input"
                                value="PO"
                                name="payment"
                                id="PO">
                            <label class="custom-control-label" for="PO">Pay online</label>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endif
</div>
<!-- Checkout End -->
@endsection
@extends('front.layout.layout')
@section('content')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="cartItems">
                            @if (isset($cart))
                                <?php $total = 0; ?>
                            @foreach ($cart as $product)
                            <tr id="cartrow{{$product['id']}}">
                                <td class="align-middle">
                                    @if($product['images'] != null)
                                    @foreach ($product['images'] as $image)
                                    <img src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt=""
                                        style="width: 50px;">
                                    @break
                                    @endforeach
                                    @endif
                                    {{$product['product']['product_name']}}
                                </td>
                                <td class="align-middle">{{$product['attribute']['size']}}</td>
                                <td class="align-middle">{{$product['attribute']['color']}}</td>
                                <td class="align-middle">{{$product['price']}}</td>
                                <?php
                                $total += $product['product_qty'] * $product['price'];
                                ?>
                                <td class="align-middle" id="qtyrow{{$product['id']}}">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus qtyButton" data-sku_id="{{$product['sku_id']}}" data-id="{{$product['id']}}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center qty"
                                            value="{{$product['product_qty']}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus qtyButton" id="btn{{$product['id']}}" {{$product['maxStock'] == true ? "disabled": ''}} data-sku_id="{{$product['sku_id']}}" data-id="{{$product['id']}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small id="error{{$product['id']}}" {{$product['maxStock'] == true? '' : 'hidden disabled'}} style="color: red;">Stock maxxed out!!</small>
                                </td>
                                <td class="align-middle" id="productTotal{{$product['id']}}">{{$product['product_qty'] * $product['price']}}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger deleteCartItems" data-id="{{$product['id']}}"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <form class="mb-30" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subtotal">{{$total}}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">60</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="totalCost">{{$total + 60}}</h5>
                            </div>
                            <a href='{{url('/checkout')}}'>
                                <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Cart End -->
@endsection
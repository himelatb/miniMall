@extends('admin.layout.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="invoice-inner" id="invoice_wrapper">
                <div class="invoice-titel">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="invoice-number">
                                <h3>Invoice Id: {{$order['id']}}</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 text-end">
                            <div class="invoice-date">
                                <h3>Invoice Date: {{date("d/m/Y H:i A", strtotime($order['created_at']))}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-titel w-50" style="border: 1px solid #ddd">
                    <span class="msg"></span>
                    <div class="col-12" style="padding-right: 0px;">
                        <div class="form-label col-12">Update Order Status</div>
                        <div class="col-12">
                            <form method="post" class="d-flex">@csrf
                                <select name="status" id="order_status" data-id="{{$order['id']}}" class="form-control">
                                    @foreach(['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'] as $statusOption)
                                        <option value="{{ $statusOption }}" {{ $statusOption === $order['status'] ? 'selected' : '' }}>{{ $statusOption }}</option>
                                    @endforeach
                                </select>
                                <select name="courier_name" id="courier_name" class="form-control" hidden disabled>
                                    <option value="" selected disabled>Select Courier</option>
                                    <option value="FedEx">FedEx</option>
                                    <option value="Pathao">Pathao</option>
                                    <option value="UPS">UPS</option>
                                    <option value="DHL">DHL</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" id="tracking_id" class="form-control" placeholder="Tracking Id" hidden disabled>
                                <button type="submit" id="changeStatusBtn" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-8" id="statusLog">
                        @foreach ($orderLog as $log)
                            <label class="form-label">{{$log['status']}}</label>
                            @if($log['status'] === 'Shipped')
                                <h6>Courier name: {{$order['courier_name']}}</h6>
                                <h6>Tracking Id: {{$order['tracking_id']}}</h6>
                            @endif
                            <h6>Updated at: {{date("d/m/Y H:i A", strtotime($log['created_at']))}}</h6><br>
                        @endforeach
                    </div>
                </div>
                <div class="invoice-info">
                    <div class="row">
                        <div class="col-sm-6 mb-30" style="border: 1px solid #ddd">
                            <div class="invoice-number">
                                <h4 class="inv-title-1">Invoice To</h4>
                                <p class="invo-addr-1">
                                    {{ $order['shipping_address']['name'] }}<br/>
                                    {{ $order['shipping_address']['mobile'] }} <br/>
                                    {{$order['shipping_address']['address'].($order['shipping_address']['road_house'] != null ? ', '.$order['shipping_address']['road_house']: '').
                                              ($order['shipping_address']['town'] != null ? ', '.$order['shipping_address']['town']: '').
                                              ($order['shipping_address']['district'] != null ? ', '.$order['shipping_address']['district']: '').
                                              ($order['shipping_address']['country'] != null ? ', '.$order['shipping_address']['country']: '').
                                              ($order['shipping_address']['zipcode'] != null ? ', '.$order['shipping_address']['zipcode']: '')
                                              }}<br/>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-30" style="border: 1px solid #ddd">
                            <div class="invoice-number text-end">
                                <h4 class="inv-title-1">Bill To</h4>
                                <p class="invo-addr-1">
                                    {{ $order['billing_address']['name'] }}<br/>
                                    {{ $order['billing_address']['mobile'] }} <br/>
                                    {{$order['billing_address']['address'].($order['billing_address']['road_house'] != null ? ', '.$order['shipping_address']['road_house']: '').
                                              ($order['billing_address']['town'] != null ? ', '.$order['billing_address']['town']: '').
                                              ($order['billing_address']['district'] != null ? ', '.$order['billing_address']['district']: '').
                                              ($order['billing_address']['country'] != null ? ', '.$order['billing_address']['country']: '').
                                              ($order['billing_address']['zipcode'] != null ? ', '.$order['billing_address']['zipcode']: '')
                                              }}<br/>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border: 1px solid #ddd">
                        <div class="col-sm-6 mb-30">
                          <h4 class="inv-title-1">Ordered By</h4>
                          <p class="inv-from-1">
                            {{$order['customer']['name']}}<br/>
                            {{$order['customer']['email']}}<br/>
                          </p>
                        </div>
                        <div class="col-sm-6 text-end mb-30">
                            <h4 class="inv-title-1">Payment Method</h4>
                            <p class="inv-from-1 text-uppercase">{{$order['payment_method']}}</p>
                        </div>
                    </div>
                </div>
                <div class="row" style="border: 1px solid #ddd">
                    <div class="table-responsive">
                        <table class="table invoice-table">
                            <thead class="bg-active">
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0; ?>
                            @foreach ($order['order_products'] as $product)
                            <tr>
                                <td>
                                    <div class="item-desc-1">
                                        @if($product['images'] != null)
                                        @foreach ($product['images'] as $image)
                                        <img src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt="" style="width: 30px; height: 30px;">
                                        @break
                                        @endforeach
                                        @endif
                                        <span>{{$product['product']['product_name']}}</span>
                                        <small> {{'SKU: '.$product['attribute']['sku']. ', Size: '.$product['attribute']['size'].', Color: '.$product['attribute']['color']}}</small>
                                    </div>
                                </td>
                                <?php
                                $total += $product['price'];
                                ?>
                                <td class="text-center">{{$product['qty'] }}</td>
                                <td class="text-right">{{$product['price'].' tk'}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-end">SubTotal</td>
                                <td class="text-right">{{$total}} tk</td>
                            </tr>
                            @if ($order['coupon_amount'] != null)
                            <tr>
                                <td colspan="2" class="text-end">Coupon "{{$order['coupon_code']}}"</td>
                                <td class="text-right">-{{$order['coupon_amount'] .' tk'}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="2" class="text-end">Shipping</td>
                                <td class="text-right">10 tk</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-end fw-bold">Grand Total</td>
                                <td class="text-right fw-bold">{{$order['total']}} tk</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Order Invoice</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <style type="text/css">
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>
    <link type="text/css" rel="stylesheet" href="{{ url('front/email/assets/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{url ('front/email/assets/fonts/font-awesome/css/font-awesome.min.css')}}">

    <!-- Favicon icon -->

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ url('front/email/assets/css/style.css')}}">
</head>
<body style="background-color: #e9ecef;">

  <div class="invoice-4 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner" id="invoice_wrapper">
                    <div class="invoice-top pt-1 pb-0">
                        <div class="row">
                            <div class="col-sm-6">
                                    <h5>miniMall</h5>
                            </div>
                            <div class="col-sm-6">
                                <div class="invoice text-end">
                                    <h5>Invoice</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-titel  pt-1 pb-0">
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
                    <div class="invoice-info  pt-1 pb-0">
                        <div class="row">
                            <div class="col-sm-6 ">
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
                            <div class="col-sm-6">
                                <div class="invoice-number text-end">
                                    <h4 class="inv-title-1">Bill To</h4>
                                    <p class="invo-addr-1">
                                        {{ $order['billing_address']['name'] }}<br/>
                                        {{ $order['billing_address']['mobile'] }} <br/>
                                        {{$order['billing_address']['address'].($order['billing_address']['road_house'] != null ? ', '.$order['billing_address']['road_house']: '').
                                                  ($order['billing_address']['town'] != null ? ', '.$order['billing_address']['town']: '').
                                                  ($order['billing_address']['district'] != null ? ', '.$order['billing_address']['district']: '').
                                                  ($order['billing_address']['country'] != null ? ', '.$order['billing_address']['country']: '').
                                                  ($order['billing_address']['zipcode'] != null ? ', '.$order['billing_address']['zipcode']: '')
                                                  }}<br/>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-20">
                            <div class="col-sm-6">
                              <h4 class="inv-title-1">Ordered By</h4>
                              <p class="inv-from-1">
                                {{$order['customer']['name']}}<br/>
                                {{$order['customer']['email']}}<br/>
                              </p>
                            </div>
                            <div class="col-sm-6 text-end">
                                <h4 class="inv-title-1">Payment Method</h4>
                                <p class="inv-from-1">{{$order['payment_method']}}</p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-12">
                                <div class="invoice">
                                    <?php
                                        echo DNS1D::getBarcodeSVG($order['id'], 'C39', true);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-summary">
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
                                            <span>{{$product['product']['product_name']}}</span>
                                            <small> {{'Size: '.$product['attribute']['size'].', Color: '.$product['attribute']['color']}}</small>
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
                                    <td colspan="2" class="text-end">Coupon</td>
                                    <td class="text-right">-{{$order['coupon_amount'].' tk'}}</td>
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
</div>
<!-- Invoice 4 end -->

<script src="{{url('front/email/assets/js/jquery.min.js')}}"></script>
<script src="{{url('front/email/assets/js/jspdf.min.js')}}"></script>
<script src="{{url('front/email/assets/js/html2canvas.min.js')}}"></script>
<script src="{{url('front/email/assets/js/app.js')}}"></script>

</body>
</html>
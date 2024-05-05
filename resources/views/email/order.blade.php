<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Order Placed</title>
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
    <link rel="shortcut icon" href="{{ url('front/email/assets/img/favicon.ico')}}" type="image/x-icon" >

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
                    <div class="invoice-top">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="logo">
                                    <img src="{{asset('front/email/assets/img/logo.svg')}}" alt="logo">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="invoice text-end">
                                    <h1>Invoice</h1>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                {{$msg}}
                            </div>
                        </div>
                    </div>
                    <div class="invoice-titel">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="invoice-number">
                                    <h3>Invoice Id: {{$order->id}}</h3>
                                </div>
                            </div>
                            <div class="col-sm-6 text-end">
                                <div class="invoice-date">
                                    <h3>Invoice Date: {{date("d/m/Y H:i A", strtotime($order['created_at']))}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-info">
                        <div class="row">
                            <div class="col-sm-6 mb-30">
                                <div class="invoice-number">
                                    <h4 class="inv-title-1">Invoice To</h4>
                                    <p class="invo-addr-1">
                                        {{ $shippingAddress->name }}<br/>
                                        {{ $shippingAddress->mobile }} <br/>
                                        {{$shippingAddress->address.($shippingAddress->road_house != null ? ', '.$shippingAddress->road_house: '').
                                                  ($shippingAddress->town != null ? ', '.$shippingAddress->town: '').
                                                  ($shippingAddress->disctrict != null ? ', '.$shippingAddress->disctrict: '').
                                                  ($shippingAddress->country != null ? ', '.$shippingAddress->country: '').
                                                  ($shippingAddress->zipcode != null ? ', '.$shippingAddress->zipcode: '')
                                                  }} <br/>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-30">
                                <div class="invoice-number text-end">
                                    <h4 class="inv-title-1">Bill To</h4>
                                    <p class="invo-addr-1">
                                        {{$billingAddress->name}} <br/>
                                        {{$billingAddress['mobile']}} <br/>
                                        {{$billingAddress->address.($billingAddress->road_house != null ? ', '.$billingAddress->road_house: '').
                                         ($billingAddress->town != null ? ', '.$billingAddress->town: '').
                                          ($billingAddress->disctrict != null ? ', '.$billingAddress->disctrict: '').
                                          ($billingAddress->country != null ? ', '.$billingAddress->country: '').
                                           ($billingAddress->zipcode != null ? ', '.$billingAddress->zipcode: '')
                                            }} <br/>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-30">
                              <h4 class="inv-title-1">Ordered By</h4>
                              <p class="inv-from-1">
                                {{$name}}<br/>
                                {{$email}}<br/>
                              </p>
                            </div>
                            <div class="col-sm-6 text-end mb-30">
                                <h4 class="inv-title-1">Payment Method</h4>
                                <p class="inv-from-1">{{$order->payment_method}}</p>
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
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="item-desc-1">
                                            <span>{{$product->name}}</span>
                                            <small> {{'Size: '.$product->size.', Color: '.$product->color}}</small>
                                        </div>
                                    </td>
                                    <?php
                                    $total += $product['price'];
                                    ?>
                                    <td class="text-center">{{$product->qty }}</td>
                                    <td class="text-right">{{$product['price'].' tk'}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-end">SubTotal</td>
                                    <td class="text-right">{{$total}} tk</td>
                                </tr>
                                @if ($order->coupon_code != null)
                                <tr>
                                    <td colspan="2" class="text-end">Coupon</td>
                                    <td class="text-right">-{{$order->coupon_amount.' tk'}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="2" class="text-end">Shipping</td>
                                    <td class="text-right">10 tk</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Grand Total</td>
                                    <td class="text-right fw-bold">{{$order->total}} tk</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-informeshon">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="terms-and-condistions mb-30">
                                    <h3 class="inv-title-1">Terms and Condistions</h3>
                                    <p class="mb-0">Once order done, money can't refund. Delivery might delay due to</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="nates mb-30">
                                    <h4 class="inv-title-1">Notes</h4>
                                    <p class="text-muted">This is computer generated invoice and physical signature</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="invoice-contact clearfix">
                        <div class="row g-0">
                            <div class="col-lg-9 col-md-11 col-sm-12">
                                <div class="contact-info">
                                    <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> +00 123 647 840</a>
                                    <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i> info@themevessel.com</a>
                                    <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i class="fa fa-map-marker"></i> 169 Teroghoria, Bangladesh</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <!-- <div class="invoice-btn-section clearfix d-print-none">
                    <a href="javascript:window.print()" class="btn btn-lg btn-print">
                        <i class="fa fa-print"></i> Print Invoice
                    </a>
                    <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                        <i class="fa fa-download"></i> Download Invoice
                    </a>
                </div> -->
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
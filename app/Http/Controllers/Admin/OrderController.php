<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\UserAddresses;
use App\Models\User;
use DB;
use Dompdf\Dompdf;

class OrderController extends Controller
{
    public function view(Request $request){
        // $order = Order::with('orderProducts','customer')->get()->toArray();
        // dd($order);

        if ($request->ajax()) {
            return datatables()->of(Order::with('orderProducts','customer')->get()->toArray())
            ->addColumn("product","admin/order/showproducts")
            ->addColumn("action","admin/order/order-action")
            ->rawColumns(['action', 'product'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin/order/view_order');
    }

    public function details($id){
        $order = Order::with('orderProducts','customer', 'billingAddress', 'shippingAddress')->where('id', $id)->get()->first()->toArray();
        $orderLog = OrderLog::where('order_id', $id)->get()->toArray();
        //  dd($order);
        return view('admin/order/details')->with(['order' => $order, 'orderLog' => $orderLog]);
    }

    public function statusUpdate(Request $request){
        DB::beginTransaction();
        $order = Order::where('id', $request->id)->first();
        $order->status = $request->status;
        if ($request->status == 'Shipped') {
            $order->courier_name = $request->courier_name;
            $order->tracking_id = $request->tracking_id;
           }
        $order->save();

       $orderLog = new OrderLog;

       $orderLog->order_id = $request->id;
       $orderLog->status = $request->status;
       $orderLog->save();

       if ($request->status == 'Shipped') {
        $orderLog->courier_name = $request->courier_name;
        $orderLog->tracking_id = $request->tracking_id;

        $message = " Order has been shipped (Order ID: ".$order->id."). Tracking ID: ".$request->tracking_id." .Our courier will reach your address soon.";
        $products = OrderProducts::with('images')->where('order_id', $order->id)->get();
        foreach ($products as $product) {
            $product->name = Product::where('id', $product->product_id)->first()->product_name;
            $product->color = productAttribute::where('id', $product->attribute_id)->first()->color;
            $product->size = productAttribute::where('id', $product->attribute_id)->first()->size;
            
        }
        $user = User::where('id', $order->user_id)->first();
        $userData = ['email' => $user->email,'name'=> $user->name, 
        'msg' => $message, 
        'order' => $order, 
        'billingAddress' => UserAddresses::where('id', $order->billing_id)->first(), 
        'shippingAddress' => UserAddresses::where('id', $order->shipping_id)->first(), 
        'products' => $products];

        Mail::send('email.order', $userData, function ($message) use($userData){
            $message->to($userData['email'], $userData['name']);
            $message->subject('Order shipped. miniMall');
        });
       }

       if ($request->status == 'Delivered') {
        $orderLog->courier_name = $request->courier_name;
        $orderLog->tracking_id = $request->tracking_id;

        $message = " Order has been delivered (Order ID: ".$order->id."). Thank you for shopping with us.";
        $products = OrderProducts::with('images')->where('order_id', $order->id)->get();
        foreach ($products as $product) {
            $product->name = Product::where('id', $product->product_id)->first()->product_name;
            $product->color = productAttribute::where('id', $product->attribute_id)->first()->color;
            $product->size = productAttribute::where('id', $product->attribute_id)->first()->size;
            
        }

        $user = User::where('id', $order->user_id)->first();
        $userData = ['email' => $user->email,'name'=> $user->name,
        'msg' => $message, 
        'order' => $order, 
        'billingAddress' => UserAddresses::where('id', $order->billing_id)->first(), 
        'shippingAddress' => UserAddresses::where('id', $order->shipping_id)->first(), 
        'products' => $products];

        Mail::send('email.order', $userData, function ($message) use($userData){
            $message->to($userData['email'], $userData['name']);
            $message->subject('Order delivered. miniMall');
        });
       }

       DB::commit();

        return response()->json(['status' => 'success', 'orderLog' => $orderLog]);
    }

    public function printOrder($id){
        $order = Order::with('orderProducts','customer', 'billingAddress', 'shippingAddress')->where('id', $id)->get()->first()->toArray();

        return view('admin/order/invoice')->with(['order' => $order]);
    }

    public function orderPdf($id){
        $order = Order::with('orderProducts','customer', 'billingAddress', 'shippingAddress')->where('id', $id)->get()->first();

        $output = '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>Example 1</title>
            <style type="text/css">
              .clearfix:after {
          content: "";
          display: table;
          clear: both;
        }
        
        a {
          color: #5D6975;
          text-decoration: underline;
        }
        
        body {
          position: relative;
          width: 21cm;  
          height: 29.7cm; 
          margin: 0 auto; 
          color: #001028;
          background: #FFFFFF; 
          font-family: Arial, sans-serif; 
          font-size: 12px; 
          font-family: Arial;
        }
        
        header {
          padding: 10px 0;
          margin-bottom: 30px;
        }
        
        #logo {
          text-align: center;
          margin-bottom: 10px;
        }
        
        #logo img {
          width: 90px;
        }
        
        h1 {
          border-top: 1px solid  #5D6975;
          border-bottom: 1px solid  #5D6975;
          color: #5D6975;
          font-size: 2.4em;
          line-height: 1.4em;
          font-weight: normal;
          text-align: center;
          margin: 0 0 20px 0;
          background: url(dimension.png);
        }
        
        #project {
          float: left;
        }
        
        #project span {
          color: #5D6975;
          text-align: right;
          width: 52px;
          margin-right: 10px;
          display: inline-block;
          font-size: 0.8em;
        }
        
        #company {
          float: right;
          text-align: right;
        }
        
        #project div,
        #company div {
          white-space: nowrap;        
        }
        
        table {
          width: 100%;
          border-collapse: collapse;
          border-spacing: 0;
          margin-bottom: 20px;
        }
        
        table tr:nth-child(2n-1) td {
          background: #F5F5F5;
        }
        
        table th,
        table td {
          text-align: center;
        }
        
        table th {
          padding: 5px 20px;
          color: #5D6975;
          border-bottom: 1px solid #C1CED9;
          white-space: nowrap;        
          font-weight: normal;
        }
        
        table .service,
        table .desc {
          text-align: left;
        }
        
        table td {
          padding: 20px;
          text-align: right;
        }
        
        table td.service,
        table td.desc {
          vertical-align: top;
        }
        
        table td.unit,
        table td.qty,
        table td.total {
          font-size: 1.2em;
        }
        
        table td.grand {
          border-top: 1px solid #5D6975;;
        }
        
        #notices .notice {
          color: #5D6975;
          font-size: 1.2em;
        }
        
        footer {
          color: #5D6975;
          width: 100%;
          height: 30px;
          position: absolute;
          bottom: 0;
          border-top: 1px solid #C1CED9;
          padding: 8px 0;
          text-align: center;
        }
        </style>
          </head>
          <body>
            <header class="clearfix">
              <h1>INVOICE</h1>
              <div id="company" class="clearfix">
                <div>
                <h4>Ordered By</h4>
                <p>
                  '.$order['customer']['name'].'<br/>
                  '.$order['customer']['email'].'<br/>
                </p>
                <h4>Payment Method: '.$order['payment_method'].'</h4>
                </div>
              <div>
              <h4>Shipped To</h4>
              <p>
                  '.$order['shippingAddress']['name'].' <br/>
                  '. $order['shippingAddress']['mobile'] .' <br/>
                  '.$order['shippingAddress']['address'].($order['shippingAddress']['road_house'] != null ? ', '.$order['shippingAddress']['road_house']: '').
                            ($order['shippingAddress']['town'] != null ? ', '.$order['shippingAddress']['town']: '').
                            ($order['shippingAddress']['district'] != null ? ', '.$order['shippingAddress']['district']: '').
                            ($order['shippingAddress']['country'] != null ? ', '.$order['shippingAddress']['country']: '').
                            ($order['shippingAddress']['zipcode'] != null ? ', '.$order['shippingAddress']['zipcode']: '')
                            .'<br/>
              </p>
          </div>
              </div>
              <div id="project">
                <div>
                <div>
                <p>Invoice Id: '.$order['id'].'</p>
                </div>
                <div>
                    <p>Invoice Date: '.date("d/m/Y H:i A", strtotime($order['created_at'])).'</p>
                </div>
                </div>
                <div>
                    <h4>Bill To</h4>
                    <p>
                        '.$order['billingAddress']['name'].' <br/>
                        '. $order['billingAddress']['mobile'] .' <br/>
                        '.$order['billingAddress']['address'].($order['billingAddress']['road_house'] != null ? ', '.$order['billingAddress']['road_house']: '').
                                  ($order['billingAddress']['town'] != null ? ', '.$order['billingAddress']['town']: '').
                                  ($order['billingAddress']['district'] != null ? ', '.$order['billingAddress']['district']: '').
                                  ($order['billingAddress']['country'] != null ? ', '.$order['billingAddress']['country']: '').
                                  ($order['billingAddress']['zipcode'] != null ? ', '.$order['billingAddress']['zipcode']: '')
                                  .'<br/>
                          </p>
                  </div>
              </div>
            </header>
            <main>
              <table>
                <thead>
                  <tr>
                    <th class="desc">PRODUCT</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                  </tr>
                </thead>
                <tbody>';

                foreach($order['orderProducts'] as $product){
                  $output.='<tr>
                  <td class="desc">'.$product['product']['product_name'].'<small> Size: '.$product['attribute']['size'].', Color: '.$product['attribute']['color'].'</small> </td>
                  <td class="qty">'.$product['qty'].'</td>
                  <td class="total">'.$product['price'].' tk'.'</td>
                </tr>';
                }
                $output .='<tr>
                    <td colspan="2">SUBTOTAL</td>
                    <td class="total">'.($order->total - $order->coupon_amount - 10).'tk </td>
                  </tr>';
                  if ($order->coupon_amount != null) {
                    $output .= '<tr>
                    <td colspan="2">COUPON</td>
                    <td class="total">'.$order->coupon_amount.'tk </td>
                  </tr>';
                  }

                  $output .='<tr>
                    <td colspan="2" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">'.$order->total.'tk </td>
                  </tr>
                </tbody>
              </table>
            </main>
            <footer>
              Invoice was created on a computer and is valid without the signature and seal.
            </footer>
          </body>
        </html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
        $dompdf->stream();

    }
}

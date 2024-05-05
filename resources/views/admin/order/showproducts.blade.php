@foreach ($order_products as $allproduct)
       {{$allproduct['product']['product_code'].'('.$allproduct['qty'].')'}} <br/>
@endforeach
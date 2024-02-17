@extends('front.layout.filters')
@section('shop')
@if (count($products) > 0)
  <div class="col-lg-9 col-md-8">
      <div class="row pb-3">
          @include('front.layout.ajax_productDisplay')
          <div class="col-12">
              <nav>
                {{ $products->withQueryString()->links()}}
              </nav>
          </div>
      </div>
  </div>
@else
  <div class="col-lg-9 col-md-8">
      <div class="row pb-3">
        <h6 class="text-center col-lg-center product-item col-12">No Products Available</h6>
      </div>
  </div>
@endif
@endsection



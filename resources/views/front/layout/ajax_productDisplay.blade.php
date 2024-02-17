<div class="navbar col-12 align-items-between">
    <div class="col-lg-left text-left">
        <div class="d-inline-flex align-items-center">
            <span class="ml-2 font-weight-normal">{{ ' ('.$products->total().($products->total()> 1 ?' products)' :' product)')}}</span> 
        </div>
    </div>
    <div class="col-lg-right text-right mb-3 pr-0.5">
        <input type="text" value="{{url($Url)}}" hidden>
            <form method="get" style="width: 94%" name="productsorting" id="productsorting">
                <div class="col-sm-12">
                    <select style="position: absolute" onchange="this.nextElementSibling.value=this.value" class="form-control bg-secondary" name="sorting" id="sorting"> 
                        <option class="dropdown-item" disabled selected>Sort By</option>
                        <option class="dropdown-item" value="Latest first">Latest first</option>
                        <option class="dropdown-item" value="Price (Lowest first)">Price (Lowest first)</option>
                        <option class="dropdown-item" value="Price (Highest first)">Price (Highest first)</option>
                        {{-- <option class="dropdown-item" value="Rating">Rating</option> --}}
                    </select>
                    <input class="selectInput form-control" id="sortSelectInput" readonly type="text" autocomplete="disabled" placeholder="Sort By" 
                    @if(isset($sortingOrder) && !empty($sortingOrder))
                        value="{{$sortingOrder}}"
                    @endif>
                </div>
            </form>
    </div>
</div>
@foreach($products as $product)
<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
    <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
            @if ($product['images'] != null)
                @foreach ($product['images'] as $image)
                <img class="img-fluid w-100" src="{{ asset ('front/images/product/small/'.$image['image']) }}" alt="">
                    @break
                @endforeach
            @endif
            <div class="product-action">
                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
            </div>
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="">{{$product['product_name']}}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>{{$product['final_price'] == null ? $product['product_price']:$product['final_price']}}</h5><h6 class="text-muted ml-2"><del>{{$product['final_price'] == null ? '':$product['product_price']}}</del></h6>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-1">
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small>(99)</small>
            </div>
        </div>
    </div>
</div>
@endforeach

@extends('front.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <form action="{{url()->current()}}" method="get" id="filterForm" class="filterForm">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">
                    {{-- <button class="btn btn-primary" id="filterBtn" type="submit">Filter</button> --}}
                </span>
            </h5>
            <div class="bg-light p-4">
                <div class="col-sm-12 p-0">
                    <select style="position: absolute" onchange="this.nextElementSibling.value=this.value" class="form-control bg-secondary filterElements" name="sorting" id="sorting"> 
                        <option class="dropdown-item" disabled selected>Sort By</option>
                        <option class="dropdown-item" value="Latest first">Latest first</option>
                        <option class="dropdown-item" value="Price (Lowest first)">Price (Lowest first)</option>
                        <option class="dropdown-item" value="Price (Highest first)">Price (Highest first)</option>
                        {{-- <option class="dropdown-item" value="Rating">Rating</option> --}}
                    </select>
                    <input class="selectInput form-control" id="sortSelectInput" readonly  type="text" autocomplete="off" placeholder="Sort By" 
                    @if(isset($filters['sorting']) && !empty($filters['sorting']))
                        value="{{$filters['sorting']}}"
                    @endif>
                </div>
            </div>
            <div class="bg-light p-4">
                    <div class="custom-control p-0 d-flex align-items-center justify-content-between">
                        <label for="price">$500</label><input class="form-control m-2 filterElements" data-toggle="tooltip" data-placement="top"
                         type="range" name="price" id="price" min="500" max="20000" 
                            @if(isset($filters) && !empty($filters['price']))
                                value="{{$filters['price']}}"
                            @else 
                            value="20000"
                            @endif
                            step="500"><label for="price">$20000</label>
                    </div>
            </div>
            <!-- Price End -->
            
            <!-- Color Start -->
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3"></span></h5> --}}
            @if (!empty($colors))
                <div class="bg-light p-4">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input allColors filterElements" name='allColors' id="allColors"
                        @if (isset($filters['colors']))
                            @if (count($filters['colors']) == count($colors))
                                checked
                            @endif
                        @else
                            checked
                        @endif>
                        <label class="custom-control-label" for="allColors">All Colors</label>
                    </div>
                    @foreach ($colors as $color)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input otherColors filterElements" 
                            @if(isset($filters['colors']))
                                @foreach ($filters['colors'] as $filterColor)
                                    @if(isset($filters['allColors']) || $filterColor == $color['color'])
                                        checked
                                    @endif
                                @endforeach
                            @endif 
                        name="colors[{{$color['color']}}]" id="{{$color['color']}}">
                        <label class="custom-control-label" for="{{$color['color']}}">{{$color['color'] }}</label>
                        <span class="border-0"><input type="color" style="border: 0 !important; padding: 0 !important" disabled value="{{$color['color_code'] }}"></span>
                    </div>
                    @endforeach
                </div>
            @else 
                <input type="checkbox" class="custom-control-input allColors filterElements" name='allColors' id="allColors" checked hidden>
            @endif
            <!-- Color End -->

            <!-- Size Start -->
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3"></span></h5> --}}
            @if(!empty($sizes))
                <div class="bg-light p-4">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input allSizes filterElements" name='allSizes' id="allSizes"
                        @if (isset($filters['sizes']))
                        @if (isset($filters['allSizes'] )|| count($filters['sizes']) == count($sizes))
                            checked
                        @endif
                    @else
                        checked
                    @endif>
                    <label class="custom-control-label" for="allSizes">All Sizes</label>
                    </div>
                    @foreach ($sizes as $size)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input otherSizes filterElements"
                        @if(isset($filters['sizes']))
                        @foreach ($filters['sizes'] as $filterSize)
                            @if($filterSize == $size['size'])
                                checked
                            @endif
                        @endforeach
                    @endif 
                        id="{{$size['size']}}" name="sizes[{{$size['size']}}]">
                        <label class="custom-control-label" for="{{$size['size']}}">{{$size['size']}}</label>
                        {{-- <span class="badge border font-weight-normal">1000</span> --}}
                    </div>
                    @endforeach
                </div>
            @else 
                <input type="checkbox" class="custom-control-input allSizes filterElements" name='allSizes' id="allSizes" checked hidden>
            @endif

            <!-- Size End -->
            </form>
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        @yield('shop')
        <!-- Shop Product End -->
    </div>
</div>
@endsection

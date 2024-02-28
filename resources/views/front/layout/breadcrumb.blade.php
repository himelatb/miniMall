@if (isset($breadcrumbs))
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{url('/miniMall')}}">Home</a>
                        @foreach ($breadcrumbs as $crumb)
                        <a class="breadcrumb-item text-dark" href="{{$crumb['url']}}">{{$crumb['category_name']}}</a>
                        @endforeach
                </nav>
            </div>
        </div>
    </div>
@endif
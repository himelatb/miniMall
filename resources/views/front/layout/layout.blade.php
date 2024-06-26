<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>miniMall</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{asset ('favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{url ('front/lib/animate/animate.min.css" rel="stylesheet')}}">
    <link href="{{url ('front/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url ('front/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url ('front/css/toastr.min.css')}}">
</head>
<script type="text/javascript">  
  	window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload();
		}
	};
</script>
<body>
    
    <!-- Topbar Start -->
@include('front.layout.header')
    <!-- Topbar End -->

    {{-- loading --}}
<div class="ring" hidden>Loading
    <span id="ringspan"></span>
</div>

    <!-- Navbar Start -->
@include('front.layout.navbar')
    <!-- Navbar End -->
@include('front.layout.breadcrumb')

@yield('content')


    <!-- Vendor Start -->
    {{-- <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="img/vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Vendor End -->


    <!-- Footer Start -->
 @include('front.layout.footer')

 @include('front.add_address')
 @include('front.edit_address')

    <!-- Footer End -->
    {!! Toastr::message() !!}
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset ('front/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset ('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- Contact Javascript File -->
    <script src="{{asset ('front/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset ('front/mail/contact.js')}}"></script>
    <script src={{asset('admin/plugins/toastr/toastr.min.js')}}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Template Javascript -->
    <script src="{{asset('front/js/main.js')}}"></script>
</body>

</html>

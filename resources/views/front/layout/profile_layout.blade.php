@extends('front.layout.layout')

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="mt-5">
            <a href="{{url('/profile')}}"><div>Profile</div> </a>
            <a href="#"><div>My Wishlist</div> </a>
            <a href="{{url('/my_orders')}}"><div>My Orders</div> </a>
            <a href="{{url('/my_addresses')}}"><div>My Addresses</div> </a>
            <a href="{{url('/change_password')}}"><div>Change Password</div></a>
        </div>
        @yield('profile_pages')
    </div>
</div>
@endsection
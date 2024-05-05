@extends('front.layout.profile_layout')
@section('profile_pages')
        <div class="col-lg-10">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
        <span class="msg" id="msg"></span>
        <div class="bg-light p-30 mb-5">
            <form method="post" id="infoForm" class="infoForm">@csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" id="name" disabled name="name" value="{{isset($user['name']) && $user['name'] != '' ? $user['name']: ''}}" placeholder="Name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" id="email" disabled name="email" value="{{isset($user['email']) && $user['email'] != '' ? $user['email']: ''}}" placeholder="Email">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select form-control" id="country" disabled name="country">
                            <option value="{{isset($address['country']) && $address['country'] != '' ? $address['country']: ''}}" selected>{{isset($address['country']) && $address['country'] != '' ? $address['country']: 'Country'}}</option>
                            @if (isset($countries))
                                @foreach ($countries as $country)
                                    <option value="{{$country['name']}}">{{$country['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <div class="d-flex">
                            <input type="text" class="form-control col-md-2"value="{{isset($countrycode) && $countrycode != '' ? $countrycode: ''}}" disabled name="countrycode" id="countrycode">
                            <input class="form-control col-md-10" type="text" id="mobile" disabled name="mobile" value="{{isset($address['mobile']) && $address['mobile'] != '' ? $address['mobile']: ''}}" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" id="address" disabled name="address" value="{{isset($address['address']) && $address['address'] != '' ? $address['address']: ''}}" placeholder="Full address">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>District</label>
                        <select class="custom-select form-control" id="district" disabled name="district">
                            <option selected>{{isset($address['district']) && $address['district'] != '' ? $address['district']: 'District'}}</option>
                            @if (isset($states))
                                @foreach ($states as $state)
                                <option value="{{$state['name']}}">{{$state['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Town</label>
                        <input class="form-control" type="text" id="town" disabled name="town" value="{{isset($address['town']) && $address['town'] != '' ? $address['town']: ''}}" placeholder="Town">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Road/house No</label>
                        <input class="form-control" type="text" id="road_house" disabled value="{{isset($address['road_house']) && $address['road_house'] != '' ? $address['road_house']: ''}}" name="road_house" placeholder="Road and house number">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>ZIP Code</label>
                        <input class="form-control" type="text" disabled value="{{isset($address['zipcode']) && $address['zipcode'] != '' ? $address['zipcode']: ''}}" placeholder="ZIP code" id="zipcode" name="zipcode">
                    </div>
                    <div class="col-md-6 mt-4">
                        <input class="btn col-md-12 btn-outline-dark" type="button" id="infoEdit" value="Edit">
                    </div>
                </div>
            </form>
        </div>
@endsection
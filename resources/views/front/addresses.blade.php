@extends('front.layout.profile_layout')
@section('profile_pages')
        <div class="col-lg-10">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
        <span class="msg" id="msg"></span>
        <a
        style="width: 150px;margin-right: 15px;"
        class="btn btn-outline-dark mb-2"
        data-toggle="modal"
        data-target="#addAddressModal"
        id="createNewAddress">Add Address</a>
    <div class="bg-light p-30 mb-5">
        <div class="form-group">
            <span id="addressMsg"></span>
            <table>
                <tbody>
                    @if (isset($addresses)) @foreach ($addresses as $address)
                    <tr class="addressrow{{$address['id']}}">
                        <td>
                            <div class="custom-control custom-radio">
                                <input
                                    type="radio"
                                    class="custom-control-input myAddress"
                                    name="myAddress"
                                    data-id="{{$address['id']}}"
                                    value="{{$address['id']}}"
                                    id="bilingAddressSelect{{$address['id']}}" {{$address['status'] == 1? 'checked':''}}>
                                <label
                                    class="custom-control-label d-flex"
                                    for="bilingAddressSelect{{$address['id']}}">
                                    <div class="address{{$address['id']}}">
                                        {{$address['name'].', '.$address['mobile'].', '.$address['address'].
                                                    ($address['road_house'] != null ? ', '.$address['road_house']: '').
                                                    ($address['town'] != null ? ', '.$address['town']: '').
                                                    ($address['district'] != null ? ', '.$address['district']: '').
                                                    ($address['country'] != null ? ', '.$address['country']: '').
                                                    ($address['zipcode'] != null ? ', '.$address['zipcode']: '')
                                                    }}
                                    </div>

                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex custom-control mb-2">
                                <a
                                    href="javascript:void(0);"
                                    data-toggle="modal"
                                    data-target="#editAddressModal"
                                    id="editAddressBtn"
                                    data-id="{{$address['id']}}"
                                    data-country="{{$address['country']}}"
                                    class="btn btn-warning editAddressBtn">
                                    Edit
                                </a>
                                <a
                                    href="javascript:void(0);"
                                    id="deleteAddressBtn"
                                    data-id="{{$address['id']}}"
                                    class="btn btn-danger deleteAddressBtn">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
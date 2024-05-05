<div class="modal" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="addAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addAddress_modal-title" id="addAddressModalLabel">
                    Add Address
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="newAddress" name="newAddress">@csrf
                <div class="bg-light p-30">
                    <span class="msg"></span>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" id="name"  name="name" placeholder="Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <div class="d-flex">
                                <input class="form-control col-md-12" type="text" id="mobile" name="mobile" value="{{isset($user['mobile']) && $user['mobile'] != '' ? $user['mobile']: ''}}" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Full Address*</label>
                            <input class="form-control" type="text" id="address"  name="address" placeholder="Full address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country*</label>
                            <select class="custom-select form-control" id="country"  name="country">
                                <option value="" selected disabled>Country</option>
                                @if (isset($countries))
                                    @foreach ($countries as $country)
                                        <option value="{{$country['name']}}">{{$country['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>District*</label>
                            <select class="custom-select form-control" id="district"  name="district">
                                <option value="" selected disabled>District</option>
                                @if (isset($states))
                                    @foreach ($states as $state)
                                    <option value="{{$state['name']}}">{{$state['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Town</label>
                            <input class="form-control" type="text" id="town"  name="town" placeholder="Town">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Road/house No</label>
                            <input class="form-control" type="text" id="road_house" name="road_house" placeholder="Road and house number">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="ZIP code" id="zipcode" name="zipcode">
                        </div>
                        <div class="col-md-12 mt-4">
                            <input class="btn col-md-12 btn-outline-dark" type="button" id="newAddressBtn" value="Save">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
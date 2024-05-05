<div class="modal" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="editAddress_modal-title" id="editAddressModalLabel">
                    Edit Address
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="editAddress" name="editAddress">@csrf
                <div class="bg-light p-30">
                    <span class="msg"></span>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" id="id" name="id" hidden>
                            <label>Name</label>
                            <input class="form-control" type="text" id="edit_name"  name="edit_name" placeholder="Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <div class="d-flex">
                                <input class="form-control col-md-12" type="text" id="edit_mobile" name="edit_mobile" value="{{isset($user['mobile']) && $user['mobile'] != '' ? $user['mobile']: ''}}" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Full Address*</label>
                            <input class="form-control" type="text" id="edit_address"  name="edit_address" placeholder="Full address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country*</label>
                            <select class="custom-select form-control" id="edit_country"  name="edit_country">
                                @if (isset($countries))
                                    @foreach ($countries as $country)
                                        <option value="{{$country['name']}}">{{$country['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>District*</label>
                            <select class="custom-select form-control" id="edit_district"  name="edit_district">
                                @if (isset($states))
                                    @foreach ($states as $state)
                                    <option value="{{$state['name']}}">{{$state['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Town</label>
                            <input class="form-control" type="text" id="edit_town"  name="edit_town" placeholder="Town">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Road/house No</label>
                            <input class="form-control" type="text" id="edit_road_house" name="edit_road_house" placeholder="Road and house number">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="ZIP code" id="edit_zipcode" name="edit_zipcode">
                        </div>
                        <div class="col-md-12 mt-4">
                            <input class="btn col-md-12 btn-outline-dark" type="button" id="changeAddressBtn" value="Save Changes">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
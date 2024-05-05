<div class="modal" id="updateCouponModal" tabindex="-1" role="dialog" aria-labelledby="updateCouponModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="updateCoupon_modal-title" id="updateCouponModalLabel">
                    Update Coupon
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="updateCouponForm" name="updateCouponForm" method="POST" class="form-horizontal">@csrf
                <div class="modal-body">
                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <input type="text" hidden id="ucoupon_id" name="ucoupon_id">
                        <div class="form-group col-md-6">
                            <label for="ucoupon_option" class="col-sm-2 control-label">Option*</label>
                            <div class="col-sm-12">
                                <select class="form-control coupon_option" id="ucoupon_option" name="ucoupon_option">
                                    <option value="" selected disabled hidden>Select ucoupon option</option>
                                    <option value="Automatic">Automatic</option>
                                    <option value="Manual">Manual</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 coupon_code_div" hidden>
                            <label for="ucoupon_code" class="col-sm-8 control-label">Coupon Code*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ucoupon_code" name="ucoupon_code"
                                    placeholder="Coupon code">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ucoupon_type" class="col-sm-2 control-label">Type*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ucoupon_type" name="ucoupon_type">
                                    <option value="" selected disabled hidden>Select ucoupon type</option>
                                    <option value="Single">Single</option>
                                    <option value="Multiple">Multiple</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ucategories" class="col-sm-7 control-label">Categories</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ucategories" name="ucategories[]" multiple>
                                    <option value="" selected disabled hidden>Select categories</option>
                                    <option value="">All</option>
                                    @if(isset($categories) && !empty($categories))
                                    <x-categories :categories="$categories" />
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubrands" class="col-sm-6 control-label">Brands</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ubrands" name="ubrands[]" multiple>
                                    <option value="" selected disabled hidden>Select brands</option>
                                    <option value="">All</option>
                                    @if (isset($brands))
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uusers" class="col-sm-6 control-label">Users</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uusers" name="uusers[]" multiple>
                                    <option value="" selected disabled hidden>Select users</option>
                                    <option value="">All</option>
                                    @if (isset($users))
                                    @foreach ($users as $user)
                                    <option value="{{ $user['email'] }}">{{ $user['email'] }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="uamount_type" class="col-sm-8 control-label">Amount Type*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uamount_type" name="uamount_type">
                                    <option value="" selected disabled hidden>Select amount type</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ucoupon_amount" class="col-sm-6 control-label">Amount*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ucoupon_amount" name="ucoupon_amount"
                                    placeholder="Coupon amount">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expiry_date" class="col-sm-6 control-label">Expiry Date*</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="uexpiry_date" name="uexpiry_date"
                                    placeholder="Coupon expiry date">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ucoupon_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ucoupon_status" name="ucoupon_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-3 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary">Save changes
                        </button>
                    </div>

                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
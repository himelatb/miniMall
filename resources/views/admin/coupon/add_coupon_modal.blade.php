<div class="modal" id="addCouponModal" tabindex="-1" role="dialog" aria-labelledby="addCouponModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addCoupon_modal-title" id="addCouponModalLabel">
                    Add Coupon
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addCouponForm" name="addCouponForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="coupon_option" class="col-sm-2 control-label">Option*</label>
                            <div class="col-sm-12">
                                <select class="form-control coupon_option" id="coupon_option" name="coupon_option">
                                    <option value="" selected disabled hidden>Select coupon option</option>
                                    <option value="Automatic">Automatic</option>
                                    <option value="Manual">Manual</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 coupon_code_div" hidden>
                            <label for="coupon_code" id="coupon_codeLabel" class="col-sm-8 control-label">Coupon Code*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                    placeholder="Coupon code">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coupon_type" class="col-sm-2 control-label">Type*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="coupon_type" name="coupon_type">
                                    <option value="" selected disabled hidden>Select coupon type</option>
                                    <option value="Single">Single</option>
                                    <option value="Multiple">Multiple</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="categories" class="col-sm-7 control-label">Categories</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="categories" name="categories[]" multiple>
                                    <option value="" selected disabled hidden>Select categories</option>
                                    <option value="">All</option>
                                    @if(isset($categories) && !empty($categories))
                                    <x-categories :categories="$categories" />
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="brands" class="col-sm-6 control-label">Brands</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="brands" name="brands[]" multiple>
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
                            <label for="users" class="col-sm-6 control-label">Users</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="users" name="users[]" multiple>
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
                            <label for="amount_type" class="col-sm-8 control-label">Amount Type*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="amount_type" name="amount_type">
                                    <option value="" selected disabled hidden>Select amount type</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coupon_amount" class="col-sm-6 control-label">Amount*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="coupon_amount" name="coupon_amount"
                                    placeholder="Coupon amount">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expiry_date" class="col-sm-6 control-label">Expiry Date*</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                    placeholder="Coupon expiry date">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coupon_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="coupon_status" name="coupon_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-3 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary">Save
                        </button>
                    </div>

                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
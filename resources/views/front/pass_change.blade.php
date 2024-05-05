@extends('front.layout.layout')

@section('content')
<div class="container-fluid">
    <div class="row  d-flex justify-content-center">
        <div class="col-lg-6">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Change Password</span></h5>
            <span class="msg" id="msg"></span>
            <div class="bg-light p-30 mb-5">
                <form method="post" id="passChangeForm" class="passChangeForm">@csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Current Password</label>
                            <div class="d-flex">
                                <input type="text" class="form-control col-md-12" name="old_password" id="old_password">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>New Password</label>
                            <div class="d-flex">
                                <input type="text" class="form-control col-md-12" name="password" id="password">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Confirm Password</label>
                            <div class="d-flex">
                                <input type="text" class="form-control col-md-12" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <input class="btn col-md-2 btn-outline-dark" type="button" id="submitNewPass" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
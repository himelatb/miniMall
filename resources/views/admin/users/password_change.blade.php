@extends('admin.layout.layout')
@section('content')
<div class="row justify-content-md-center" style="margin-top: 100px;">
  <div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Change your password</h3>
    </div>
      <div class="row justify-content-md-center">
        
    
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" id="passChangeForm" name="passChangeForm" method="POST"  class="form-horizontal">@csrf
        <div class="card-body pb-0">
            <div class="form-group" id="perrormsg"></div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control bg-gray" id="email" disabled placeholder="{{Auth::guard('admin')->user()->email}}">
            </div>
            <div class="form-group">
              <label for="oldPassword">Old password</label>
              <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Type your old password">
            </div>
            <div class="form-group" id="oerrormsg"></div>
            <div class="form-group">
                <label for="NewPassword">New password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Type your new password"> 
            </div>
            <div class="form-group nerrormsg"></div>
              <div class="form-group">
                <label for="confirmPassword">Confirm password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password">
                </div>
            <div class="form-group nerrormsg"></div>
          <!-- /.card-body -->
    
          <div class="d-flex justify-content-center mb-5">
            <button type="button" id="passChangeBtn" class="btn btn-primary">Submit</button>
          </div>
        </div> 
        </form>
    </div> 
    <div class="card-footer bg-primary"></div>
        
</div>
</div>

@endsection

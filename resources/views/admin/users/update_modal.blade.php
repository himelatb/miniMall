<div class="modal" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <form id="updateForm" name="updateForm" method="POST" class="form-horizontal">
                <div class="modal-body">
                @csrf
                <div class="form-group col-sm-12" id="uerrormsg">
                </div>
                <div class="form-group">
                    <input type="text" name="id" id="uid" value="" hidden>
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="uname" name="name" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" id="uemailLabel" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="uemail" name="email" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="umobile" name="mobile" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="utype">
                            <option value="" selected disabled hidden>Select type</option>
                            <option value="1">Admin</option>
                            <option value="2">Sub admin</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="ustatus">
                            <option value="" selected disabled hidden>Select status</option>
                            <option value="1">Inactive</option>
                            <option value="2">Active</option>
                          </select>
                    </div>
                    
                </div>
     
                <div class="col-sm-offset-2 col-sm-10">
                 <button type="button" class="btn btn-primary" id="updateAdminBtn" value="create">Update
                 </button>
                </div>
            
        </div>
    </form>
        <div class="modal-footer">
            
        </div>
    </div>
    </div>
    </div>
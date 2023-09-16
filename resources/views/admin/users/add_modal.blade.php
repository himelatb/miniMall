<div class="modal" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="adminModalLabel">Add Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <form id="adminForm" name="adminForm" method="POST"  class="form-horizontal">
                @csrf
                <div class="modal-body">
                
                <div class="form-group col-sm-12" id="errormsg">
                </div>
                <div class="form-group">
                    <input type="text" name="id" id="id" value="" hidden>
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" id="emailLabel" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="email" name="email" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="mobile" name="mobile" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" id="passwordLabel" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="type">
                            <option value="" selected disabled hidden>Select type</option>
                            <option value="1">Admin</option>
                            <option value="2">Sub admin</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="status">
                            <option value="" selected disabled hidden>Select status</option>
                            <option value="1">Inactive</option>
                            <option value="2">Active</option>
                          </select>
                    </div>
                    
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                 <button type="button" class="btn btn-primary" id="saveAdminBtn">Save
                 </button>
                </div>
            
        </div>
    </form>
        <div class="modal-footer">
            
        </div>
    </div>
    </div>
    </div>
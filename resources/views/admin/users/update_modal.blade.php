<div class="modal" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <form id="updateForm" name="updateForm" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                @csrf
                <div class="form-group col-sm-12" id="uerrormsg">
                </div>
                <div class="form-group">
                    <input type="text" name="uid" id="uid" value="" hidden>
                    <label for="uname" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="uname" name="uname" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="uemail" id="uemailLabel" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control text-dark bg-secondary" id="uemail" name="uemail" value="" readonly required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="umobile" class="col-sm-2 control-label">Mobile</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="umobile" name="umobile" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="utype" class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="utype">
                            <option value="" selected disabled hidden>Select type</option>
                            <option value="1">Admin</option>
                            <option value="2">Sub admin</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ustatus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="ustatus">
                            <option value="" selected disabled hidden>Select status</option>
                            <option value="1">Inactive</option>
                            <option value="2">Active</option>
                          </select>
                    </div>
                 </div>
                 <div class="form-group">
                    <label for="uimage" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="uimage" name="uimage" onchange="previewFile(this);">
                    </div>
                </div>
                <div class="form-group">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <img width="200" height="200" id="uimageView" name="uimageView"/>
                    </div>
                </div>
                <div class="h-100 d-flex align-items-center justify-content-center">
                 <button type="submit" class="btn btn-primary" id="updateAdminBtn">Update
                 </button>
                </div>
            
        </div>
    </form>
        <div class="modal-footer">
            
        </div>
    </div>
    </div>
    </div>
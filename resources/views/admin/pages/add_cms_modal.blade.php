<div class="modal" id="AddCmsModal" tabindex="-1" role="dialog" aria-labelledby="AddCmsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddCmsModalLabel">Add CMS Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <form id="cmsForm" name="cmsForm" method="POST"  class="form-horizontal">
                @csrf
                <div class="modal-body">
                
                <div class="form-group col-sm-12 errormsg" id="errormsg">
                </div>
                <div class="form-group">
                    <input type="text" name="id" id="id" value="" hidden>
                    <label for="title" class="col-sm-auto control-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" id="descriptionLabel" class="col-sm-auto control-label">Description</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Write Description......" required=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" id="urlLabel" class="col-sm-auto control-label">Url</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_title" id="meta_titleLabel" class="col-sm-auto control-label">Meta Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_description" id="meta_descriptionLabel" class="col-sm-auto control-label">Meta Description</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_keywords" id="meta_KeywordsLabel" class="col-sm-auto control-label">Meta Keywords</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cmsstatus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="cmsstatus">
                            <option value="" selected disabled hidden>Select status</option>
                            <option value="1">Inactive</option>
                            <option value="2">Active</option>
                          </select>
                    </div>
                </div>
     
                <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-primary" id="SaveCmsBtn">Save
                 </button>
                </div>
            
        </div>
    </form>
        <div class="modal-footer">
            
        </div>
    </div>
    </div>
    </div>
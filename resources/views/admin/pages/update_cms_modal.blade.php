<div class="modal" id="UpdateCmsModal" tabindex="-1" role="dialog" aria-labelledby="UpdateCmsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="UpdateCmsModalLabel">Update CMS Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <form  id="UpdateCmsForm" name="UpdateCmsForm" method="POST" class="form-horizontal">
                @csrf
                <div class="modal-body">
                
                <div class="form-group col-sm-12 errormsg" id="errormsg">
                </div>
                <div class="form-group">
                    <input type="text" name="ucmsid" id="ucmsid" value="" hidden>
                    <label for="ucmstitle" class="col-sm-auto control-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucmstitle" name="ucmstitle" placeholder="Title" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucmsdescription" id="ucmsdescriptionLabel" class="col-sm-auto control-label">Description</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="3" id="ucmsdescription" name="ucmsdescription" placeholder="Write Description......" required=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucmsurl" id="ucmsurlLabel" class="col-sm-auto control-label">Url</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucmsurl" name="ucmsurl" placeholder="Url" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucmsmeta_title" id="ucmsmeta_titleLabel" class="col-sm-auto control-label">Meta Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucmsmeta_title" name="ucmsmeta_title" placeholder="Meta Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucmsmeta_description" id="ucmsmeta_descriptionLabel" class="col-sm-auto control-label">Meta Description</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucmsmeta_description" name="ucmsmeta_description" placeholder="Meta Description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucmsmeta_keywords" id="ucmsmeta_keywordsLabel" class="col-sm-auto control-label">Meta Keywords</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucmsmeta_keywords" name="ucmsmeta_keywords" placeholder="Meta Keywords">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucmsstatllus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="ucmsstatus">
                            <option value="" selected disabled hidden>Select status</option>
                            <option value="1">Inactive</option>
                            <option value="2">Active</option>
                          </select>
                    </div>
                </div>
     
                <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-primary" id="UpdateCmsBtn">Save
                 </button>
                </div>
            
        </div>
    </form>
        <div class="modal-footer">
            
        </div>
    </div>
    </div>
    </div>
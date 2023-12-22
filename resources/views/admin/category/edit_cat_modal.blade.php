<div class="modal" id="updatecategoryModal" tabindex="-1" role="dialog" aria-labelledby="updatecategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="updatecategory_modal-title" id="updatecategoryModalLabel">
                Edit Category
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <form id="updatecategoryForm" name="updatecategoryForm" method="POST" class="form-horizontal" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                
                <div class="form-group col-sm-12" id="errormsg">
                </div>
                <div class="form-group">
                    <input type="text" name="ucategory_id" id="ucategory_id" hidden>
                    <label for="ucategory_name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucategory_name" name="ucategory_name" placeholder="Name" required="">
                    </div>
                </div>
                <div class="form-group">
                        <label for="ucategory_parent" class="col-sm-5 control-label">Subcategory of</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="ucategory_parent" name="ucategory_parent">
                                <option value="" selected disabled hidden>Select parent category</option>
                                <option value="">None</option>
                                @if (isset($categories) &&!empty($categories))
                                    @foreach($categories as $category)
                                    <option value="{{$category['cat_id']}}">{{$category['category_name']}}</option>
                                    @endforeach
                                @endif
                              </select>
                        </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_description" id="ucategory_descriptionLabel" class="col-sm-auto control-label">Description</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="3" id="ucategory_description" name="ucategory_description" 
                        placeholder="Write Description......"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_discount" class="col-sm-2 control-label">discount(%)</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucategory_discount" name="ucategory_discount" 
                        placeholder="discount...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_url" id="ucategory_urlLabel" class="col-sm-2 control-label">Url</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucategory_url" name="ucategory_url" placeholder="Url">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="ucategory_status" name="ucategory_status">
                            <option value="" selected disabled hidden>Select status</option>
                            <option value="1">Inactive</option>
                            <option value="2">Active</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_meta_title" id="ucategory_meta_titleLabel" class="col-sm-2 control-label">Meta_title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucategory_meta_title" name="ucategory_meta_title" 
                        placeholder="Meta_title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_meta_description" id="ucategory_meta_descriptionLabel" class="col-sm-2 control-label">Meta_description</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucategory_meta_description" name="ucategory_meta_description" 
                        placeholder="Meta_description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_meta_keywords" id="ucategory_meta_keywordsLabel" class="col-sm-2 control-label">Meta_keywords</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="ucategory_meta_keywords" name="ucategory_meta_keywords" 
                        placeholder="Meta_keywords">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ucategory_image" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="ucategory_image" name="ucategory_image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <img width="150" height="150" id="ucategory_imageView" name="ucategory_imageView"/>
                    </div>
                </div>
                <div class="h-100 d-flex align-items-center justify-content-center">
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
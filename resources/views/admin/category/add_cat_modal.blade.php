<div class="modal" id="addcategoryModal" tabindex="-1" role="dialog" aria-labelledby="addcategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addcategory_modal-title" id="addcategoryModalLabel">
                    Add Category
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addcategoryForm" name="addcategoryForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row col-sm-12">
                        <div class="form-group col-md-5">
                            <input type="text" name="category_id" id="category_id" hidden>
                            <label for="category_name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    placeholder="Name" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="category_parent" class="col-sm-7 control-label">Main Category</label>
                            <div class="col-sm-15">
                                <select class="form-control" id="category_parent" name="category_parent">
                                    <option value="" selected disabled hidden>Select the main category</option>
                                    <option value="0">None</option>
                                    @if(isset($categories) && !empty($categories))
                                    <x-categories :categories="$categories" />
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_description" id="category_descriptionLabel"
                            class="col-sm-auto control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" id="category_description"
                                name="category_description" placeholder="Write Description......"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category_url" id="category_urlLabel" class="col-sm-2 control-label">Url</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="category_url" name="category_url"
                                    placeholder="Url">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category_meta_title" id="category_meta_titleLabel"
                                class="col-sm-2 control-label">Meta_title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="category_meta_title"
                                    name="category_meta_title" placeholder="Meta_title">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category_meta_description" id="category_meta_descriptionLabel"
                                class="col-sm-2 control-label">Meta_description</label>
                            <div class="col-sm-12">
                                <textarea rows="2" class="form-control" id="category_meta_description"
                                    name="category_meta_description" placeholder="Meta_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category_meta_keywords" id="category_meta_keywordsLabel"
                                class="col-sm-2 control-label">Meta_keywords</label>
                            <div class="col-sm-12">
                                <textarea rows="2" class="form-control" id="category_meta_keywords"
                                    name="category_meta_keywords" placeholder="Meta_keywords"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category_discount" class="col-sm-2 control-label">discount(%)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="category_discount" name="category_discount"
                                    placeholder="discount...">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category_status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="category_status" name="category_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="category_image" class="col-sm-6 control-label">Select image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="category_image" name="category_image">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <img class="border" width="150" height="150" id="category_imageView"
                                name="category_imageView" />
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

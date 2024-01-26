<div class="modal" id="updateBrandModal" tabindex="-1" role="dialog" aria-labelledby="updateBrandModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="updateBrand_modal-title" id="updateBrandModalLabel">
                    Update Brand
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="updateBrandForm" name="updateBrandForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text" name="ubrand_id" id="ubrand_id" hidden>
                            <label for="ubrand_name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubrand_name" name="ubrand_name"
                                    placeholder="Name" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ubrand_description" id="ubrand_descriptionLabel"
                            class="col-sm-auto control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" id="ubrand_description" name="ubrand_description"
                                placeholder="Write Description......"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubrand_url" id="ubrand_urlLabel" class="col-sm-2 control-label">Url</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubrand_url" name="ubrand_url"
                                    placeholder="Url">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubrand_meta_title" id="ubrand_meta_titleLabel"
                                class="col-sm-2 control-label">Meta_title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubrand_meta_title" name="ubrand_meta_title"
                                    placeholder="Meta_title">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubrand_meta_description" id="ubrand_meta_descriptionLabel"
                                class="col-sm-2 control-label">Meta_description</label>
                            <div class="col-sm-12">
                                <textarea rows="2" class="form-control" id="ubrand_meta_description"
                                    name="ubrand_meta_description" placeholder="Meta_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubrand_meta_keywords" id="ubrand_meta_keywordsLabel"
                                class="col-sm-2 control-label">Meta_keywords</label>
                            <div class="col-sm-12">
                                <textarea rows="2" class="form-control" id="ubrand_meta_keywords"
                                    name="ubrand_meta_keywords" placeholder="Meta_keywords"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubrand_discount" class="col-sm-2 control-label">discount(%)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubrand_discount" name="ubrand_discount"
                                    placeholder="discount...">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubrand_status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ubrand_status" name="ubrand_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ubrand_image" class="col-sm-6 control-label">Select image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="ubrand_image" name="ubrand_image">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubrand_imageView" class="col-sm-6 control-label">Image</label>
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img class="border" width="150" height="150" id="ubrand_imageView"
                                    name="ubrand_imageView" />
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="deleteBrandImage" name="deleteBrandImage">
                            <label class="form-check-label" for="deleteBrandImage">Delete the brand image</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ubrand_logo" class="col-sm-6 control-label">Select logo</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="ubrand_logo" name="ubrand_logo">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubrand_logoView" class="col-sm-6 control-label">Logo</label>
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img class="border" width="150" height="150" id="ubrand_logoView"
                                    name="ubrand_logoView" />
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="deleteBrandLogo" name="deleteBrandLogo">
                            <label class="form-check-label" for="deleteBrandLogo">Delete the brand logo</label>
                        </div>
                    </div>
                    <div class="m-3 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary">Save Changes
                        </button>
                    </div>

                </div>
            </form>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addBrand_modal-title" id="addBrandModalLabel">
                    Add Brand
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addBrandForm" name="addBrandForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <input type="text" name="brand_id" id="brand_id" hidden>
                        <div class="form-group col-md-12">
                            <label for="brand_name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="brand_name" name="brand_name"
                                    placeholder="Name" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="brand_description" id="brand_descriptionLabel"
                            class="col-sm-auto control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" id="brand_description" name="brand_description"
                                placeholder="Write Description......"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="brand_url" id="brand_urlLabel" class="col-sm-2 control-label">Url</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="brand_url" name="brand_url"
                                    placeholder="Url">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="brand_meta_title" id="brand_meta_titleLabel"
                                class="col-sm-2 control-label">Meta_title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="brand_meta_title" name="brand_meta_title"
                                    placeholder="Meta_title">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="brand_meta_description" id="brand_meta_descriptionLabel"
                                class="col-sm-2 control-label">Meta_description</label>
                            <div class="col-sm-12">
                                <textarea rows="2" class="form-control" id="brand_meta_description"
                                    name="brand_meta_description" placeholder="Meta_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="brand_meta_keywords" id="brand_meta_keywordsLabel"
                                class="col-sm-2 control-label">Meta_keywords</label>
                            <div class="col-sm-12">
                                <textarea rows="2" class="form-control" id="brand_meta_keywords"
                                    name="brand_meta_keywords" placeholder="Meta_keywords"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="brand_discount" class="col-sm-2 control-label">discount(%)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="brand_discount" name="brand_discount"
                                    placeholder="discount...">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="brand_status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="brand_status" name="brand_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="brand_image" class="col-sm-6 control-label">Select image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="brand_image" name="brand_image">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="brand_imageView" class="col-sm-6 control-label">Image</label>
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img class="border" width="150" height="150" id="brand_imageView"
                                    name="brand_imageView" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="brand_logo" class="col-sm-6 control-label">Select logo</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="brand_logo" name="brand_logo">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="brand_logoView" class="col-sm-6 control-label">Logo</label>
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img class="border" width="150" height="150" id="brand_logoView"
                                    name="brand_logoView" />
                            </div>
                        </div>
                    </div>
                    <div class="m-3 d-flex align-items-center justify-content-center">
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

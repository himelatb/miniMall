<div class="modal" id="addBannerModal" tabindex="-1" role="dialog" aria-labelledby="addBannerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addBanner_modal-title" id="addBannerModalLabel">
                    Add Banner
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addBannerForm" name="addBannerForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="banner_id" id="banner_id" hidden>
                            <label for="banner_title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="banner_title" name="banner_title"
                                    placeholder="Title">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="banner_type" class="col-sm-2 control-label">Type*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="banner_type" name="banner_type">
                                    <option value="" selected disabled hidden>Select type</option>
                                    <option value="Slider">Slider</option>
                                    <option value="Offer">Offer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="banner_url" id="banner_urlLabel" class="col-sm-2 control-label">Url*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="banner_url" name="banner_url"
                                    placeholder="Url">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="banner_text" class="col-sm-4 control-label">Text</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="banner_text" name="banner_text"
                                    placeholder="Banner text">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="banner_sort" class="col-sm-2 control-label">Serial*</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="banner_sort" name="banner_sort"
                                    placeholder="Serial number">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="banner_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="banner_status" name="banner_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="banner_image" class="col-sm-8 control-label">Select image*</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="banner_image" name="banner_image">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="banner_imageView" class="col-sm-6 control-label">Image</label>
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img class="border" width="150" height="150" id="banner_imageView"
                                    name="banner_imageView" />
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

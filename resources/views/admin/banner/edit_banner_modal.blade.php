<div class="modal" id="updateBannerModal" tabindex="-1" role="dialog" aria-labelledby="updateBannerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="updateBanner_modal-title" id="updateBannerModalLabel">
                    Update Banner
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="updateBannerForm" name="updateBannerForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="ubanner_id" id="ubanner_id" hidden>
                            <label for="ubanner_title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubanner_title" name="ubanner_title"
                                    placeholder="Title">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ubanner_type" class="col-sm-2 control-label">Type*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ubanner_type" name="ubanner_type">
                                    <option value="" selected disabled hidden>Select type</option>
                                    <option value="Slider">Slider</option>
                                    <option value="Offer">Offer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubanner_url" id="ubanner_urlLabel" class="col-sm-2 control-label">Url*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubanner_url" name="ubanner_url"
                                    placeholder="Url">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubanner_text" class="col-sm-6 control-label">Text</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ubanner_text" name="ubanner_text"
                                    placeholder="Banner text">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubanner_sort" class="col-sm-2 control-label">Serial*</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="ubanner_sort" name="ubanner_sort"
                                    placeholder="Serial number">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubanner_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="ubanner_status" name="ubanner_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ubanner_image" class="col-sm-6 control-label">Select image*</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="ubanner_image" name="ubanner_image">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ubanner_imageView" class="col-sm-6 control-label">Image</label>
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <img class="border" width="150" height="150" id="ubanner_imageView"
                                    name="ubanner_imageView" />
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="deleteBannerImage"
                                name="deleteBannerImage">
                            <label class="form-check-label" for="deleteBannerImage">Delete the banner image</label>
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

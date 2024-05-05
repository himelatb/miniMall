<div class="modal" id="addCustomersModal" tabindex="-1" role="dialog" aria-labelledby="addCustomersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addCustomers_modal-title" id="addCustomersModalLabel">
                    Add Customers
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addCustomersForm" name="addCustomersForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customers_name" class="col-sm-2 control-label">Name*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customers_name" name="customers_name"
                                    placeholder="Name" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customers_email" class="col-sm-2 control-label">Email*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customers_email" name="customers_email"
                                    placeholder="Email" required="">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customers_mobile" class="col-sm-2 control-label">Mobile*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customers_mobile" name="customers_mobile"
                                    placeholder="Mobile" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customers_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="customers_status" name="customers_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="customers_password" class="col-sm-2 control-label">Password*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customers_password" name="customers_password"
                                    placeholder="Password" required="">
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

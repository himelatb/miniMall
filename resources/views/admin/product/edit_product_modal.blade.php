<div class="modal" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="updateProductModalLabel"
    aria-hidden="true">
    <div class="">
        <div class="modal-content" style="opacity: 0.9; background-color: rgb(26, 24, 24);">
            <div class="modal-header">
                <h5 class="updateProduct_modal-title" id="updateProductModalLabel">
                    Update Product
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="updateProductForm" name="updateProductForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <input type="text" name="uproduct_id" id="uproduct_id" hidden>
                            <input type="text" name="udiscount_type" id="udiscount_type" hidden>
                            <input type="text" name="ufinal_price" id="ufinal_price" hidden>
                            <label for="uproduct_name" class="col-sm-2 control-label">Name*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_name" name="uproduct_name"
                                    placeholder="Name" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_code" class="col-sm-2 control-label">Code*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_code" name="uproduct_code"
                                    placeholder="Product code" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_category" class="col-sm-7 control-label">Category*</label>
                            <div class="col-sm-15">
                                <select class="form-control" id="uproduct_category" name="uproduct_category">
                                    <option value="" selected disabled hidden>Select the category</option>
                                    <option value="0">None</option>
                                    @if(isset($categories) && !empty($categories))
                                    <x-categories :categories="$categories" />
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="ucolor_family" class="col-sm-7 control-label">Color Family*</label>
                            <div class="col-sm-15">
                                <select class="form-control" id="ucolor_family" name="ucolor_family">
                                    <option value="" selected disabled hidden>Select the color family</option>
                                    <option value="">None</option>
                                    @php
                                    $colorFamily = \App\Models\Color::colors()
                                    @endphp
                                    @foreach ($colorFamily as $color)
                                    <option value="{{$color['color_name']}}">{{$color['color_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_color" class="col-sm-2 control-label">Color*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_color" name="uproduct_color"
                                    placeholder="Product color">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_material" class="col-sm-2 control-label">Material*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_material" name="uproduct_material">
                                    <option value="" selected disabled hidden>Select material</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['materialArray'] as $material)
                                    <option value="{{ $material }}">{{ $material }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="uproduct_brand" class="col-sm-2 control-label">Brand</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_brand" name="uproduct_brand">
                                    <option value="" selected disabled hidden>Select brand</option>
                                    <option value="0">None</option>
                                    @if (isset($brands))
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_pattern" class="col-sm-2 control-label">Pattern</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_pattern" name="uproduct_pattern">
                                    <option value="" selected disabled hidden>Select pattern</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['patternArray'] as $pattern)
                                    <option value="{{ $pattern }}">{{ $pattern }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_occasion" class="col-sm-2 control-label">Occasion</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_occasion" name="uproduct_occasion">
                                    <option value="" selected disabled hidden>Select occasion</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['occasionArray'] as $occasion)
                                    <option value="{{ $occasion }}">{{ $occasion }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_fit" class="col-sm-2 control-label">Fit</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_fit" name="uproduct_fit">
                                    <option value="" selected disabled hidden>Select fit</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['fitArray'] as $fit)
                                    <option value="{{ $fit }}">{{ $fit }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_sleeve" class="col-sm-2 control-label">Sleeve</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_sleeve" name="uproduct_sleeve">
                                    <option value="" selected disabled hidden>Select sleeve</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['sleeveArray'] as $sleeve)
                                    <option value="{{ $sleeve }}">{{ $sleeve }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="uproduct_weight" class="col-sm-2 control-label">Weight</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_weight" name="uproduct_weight"
                                    placeholder="Product weight">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="added_attributes" class="col-sm-6 control-label">Added attributes</label>
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Size</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody class="added_attributes_table" id="added_attributes_table"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-row col-sm-8 field_wrapper" style="display: block;">
                                <label class="col-sm-12" >Product attributes</label>
                                <div class="d-flex col-sm-12">
                                    <input type="text" class="col-sm-2 m-1 form-control" name="size[]" value="" placeholder="Size"/>
                                    <input type="text" class="col-sm-2 m-1 form-control" name="sku[]" value="" placeholder="SKU"/>
                                    <input type="text" class="col-sm-2 m-1 form-control" name="price[]" value="" placeholder="Price"/>
                                    <input type="text" class="col-sm-2 m-1 form-control" name="stock[]" value="" placeholder="Stock"/>
                                    <a href="javascript:void(0);" class="col-sm-1 m-1 form-control add_button btn btn-primary" style="background: #464768;" title="Add field">Add</a>
                                </div>   
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="uproduct_discount" class="col-sm-4 control-label">Discount(%)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_discount" name="uproduct_discount"
                                    placeholder="Discount...">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="uproduct_price" class="col-sm-4 control-label">Product price*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_price" name="uproduct_price"
                                    placeholder="Product price">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="uproduct_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="uproduct_status" name="uproduct_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="uproduct_description" id="uproduct_descriptionLabel"
                                class="col-sm-auto control-label">Description*</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="4" id="uproduct_description"
                                    name="uproduct_description" placeholder="Write Description......"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uproduct_wash" id="uproduct_washLabel" class="col-sm-auto control-label">Wash &
                                care(optional)</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="4" id="uproduct_wash" name="uproduct_wash"
                                    placeholder="Washing and caring......"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="uproduct_keywords" id="uproduct_keywordsLabel"
                                class="col-sm-2 control-label">Keywords</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_keywords" name="uproduct_keywords"
                                    placeholder="Keywords">
                            </div>
                            <label for="uproduct_meta_title" id="uproduct_meta_titleLabel"
                                class="col-sm-2 control-label">Meta_title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="uproduct_meta_title"
                                    name="uproduct_meta_title" placeholder="Meta_title">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="uproduct_video" class="col-sm-6 control-label">Select video</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="uproduct_video" name="uproduct_video">
                            </div>
                            <div class="d-flex form-group col-md-6">
                                <label for="uproduct_featured" id="uproduct_featuredLabel" class="col-sm-2 control-label"  style="margin-right: 100px;">Featured:</label>
                                <input type="checkbox" id="uproduct_featured" name="uproduct_featured" value="Yes">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="uproduct_meta_description" id="uproduct_meta_descriptionLabel"
                                class="col-sm-2 control-label">Meta_description</label>
                            <div class="col-sm-12">
                                <textarea rows="4" class="form-control" id="uproduct_meta_description"
                                    name="uproduct_meta_description" placeholder="Meta_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="uproduct_meta_keywords" id="uproduct_meta_keywordsLabel"
                                class="col-sm-2 control-label">Meta_keywords</label>
                            <div class="col-sm-12">
                                <textarea rows="4" class="form-control" id="uproduct_meta_keywords"
                                    name="uproduct_meta_keywords" placeholder="Meta_keywords"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="uproduct_image" class="col-sm-6 control-label">Select images</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="uproduct_images" name="uproduct_images[]" multiple="">
                                </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="d-flex" style="margin: auto; margin-top: 5px;margin-bottom: 10px;" id="imageContainer"></div>
                        <div class="d-flex imagePreview" style="margin: auto; margin-top: 5px;margin-bottom: 10px;"></div>
                    </div>
                    <div class="h-100 d-flex align-items-center justify-content-center">
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

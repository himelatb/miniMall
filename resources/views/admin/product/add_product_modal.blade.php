<div class="modal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="">
        <div class="modal-content" style="opacity: 0.9; background-color: rgb(26, 24, 24);">
            <div class="modal-header">
                <h5 class="addProduct_modal-title" id="addProductModalLabel">
                    Add Product
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addProductForm" name="addProductForm" method="POST" class="form-horizontal"
                enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="form-group col-sm-12 errormsg" id="errormsg">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="product_name" class="col-sm-2 control-label">Name*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Name" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="product_code" class="col-sm-2 control-label">Code*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_code" name="product_code"
                                    placeholder="Product code" required="">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="product_category" class="col-sm-7 control-label">Category*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_category" name="product_category">
                                    <option value="" selected disabled hidden>Select the category</option>
                                    <option value="0">None</option>
                                    @if(isset($categories) && !empty($categories))
                                    <x-categories :categories="$categories" />
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="color_family" class="col-sm-7 control-label">Color Family*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="color_family" name="color_family">
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
                            <label for="product_color" class="col-sm-2 control-label">Color*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_color" name="product_color"
                                    placeholder="Product color">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="product_material" class="col-sm-2 control-label">Material*</label>
                            <div class="col-sm-12" style="width: 13.3rem">
                                <select class="form-control" style="position:absolute;" onchange="this.nextElementSibling.value=this.value">
                                    <option value="" selected disabled hidden>Select material</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['materialArray'] as $material)
                                    <option value="{{ $material }}">{{ $material }}</option>
                                    @endforeach
                                    @endif
                                    <input class="form-control" id="product_material" name="product_material" placeholder="Select Material" style="width: 160px;  border: none; position:relative; left:1px; margin-right: 25px; height:inherit;top: 01px;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="product_brand" class="col-sm-2 control-label">Brand</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_brand" name="product_brand">
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
                            <label for="uproduct_weight" class="col-sm-2 control-label">Weight</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_weight" name="product_weight"
                                    placeholder="Product weight">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="product_pattern" class="col-sm-2 control-label">Pattern</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_pattern" name="product_pattern">
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
                            <label for="product_occasion" class="col-sm-2 control-label">Occasion</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_occasion" name="product_occasion">
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
                            <label for="product_fit" class="col-sm-2 control-label">Fit</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_fit" name="product_fit">
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
                            <label for="product_sleeve" class="col-sm-2 control-label">Sleeve</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_sleeve" name="product_sleeve">
                                    <option value="" selected disabled hidden>Select sleeve</option>
                                    @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['sleeveArray'] as $sleeve)
                                    <option value="{{ $sleeve }}">{{ $sleeve }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-row col-sm-8 field_wrapper" style="display: block;">
                            <label class="col-sm-10">Product attributes</label>
                            <div class="d-flex col-sm-12">
                                <input type="text" class="col-sm-2 m-1 form-control" name="size[]" value=""
                                    placeholder="Size" />
                                <input type="text" class="col-sm-2 m-1 form-control" name="sku[]" value=""
                                    placeholder="SKU" />
                                <input type="text" class="col-sm-2 m-1 form-control" name="price[]" value=""
                                    placeholder="Price" />
                                <input type="text" class="col-sm-2 m-1 form-control" name="stock[]" value=""
                                    placeholder="Stock" />
                                <a href="javascript:void(0);"
                                    class="col-sm-1 m-1 form-control add_button btn btn-primary"
                                    style="background: #464768;" title="Add field">Add</a>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="product_discount" class="col-sm-4 control-label">Discount(%)</label>
                            <div class="col-sm-12" style="left: 10px;padding-left: 0px;">
                                <input type="text" class="form-control" id="product_discount" name="product_discount"
                                    placeholder="Discount...">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_price" class="col-sm-5 control-label">Product price*</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_price" name="product_price"
                                    placeholder="Product price">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_status" class="col-sm-2 control-label">Status*</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_status" name="product_status">
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_description" id="product_descriptionLabel"
                                class="col-sm-auto control-label">Description*</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="4" id="product_description"
                                    name="product_description" placeholder="Write Description......"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_wash" id="product_washLabel" class="col-sm-auto control-label">Wash &
                                care(optional)</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="4" id="product_wash" name="product_wash"
                                    placeholder="Washing and caring......"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="product_keywords" id="product_keywordsLabel"
                                class="col-sm-2 control-label">Keywords</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_keywords" name="product_keywords"
                                    placeholder="Keywords">
                            </div>
                            <label for="product_meta_title" id="product_meta_titleLabel"
                                class="col-sm-2 control-label">Meta_title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="product_meta_title"
                                    name="product_meta_title" placeholder="Meta_title">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="product_video" class="col-sm-6 control-label">Select video</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="product_video" name="product_video">
                            </div>
                            <div class="form-group d-flex">
                                <label for="product_featured" style="margin-right: 100px;" id="product_featuredLabel"
                                    class="col-sm-2 control-label">Featured:</label>
                                <input type="checkbox" id="product_featured" name="product_featured" value="Yes">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="product_meta_description" id="product_meta_descriptionLabel"
                                class="col-sm-2 control-label">Meta_description</label>
                            <div class="col-sm-12">
                                <textarea rows="4" class="form-control" id="product_meta_description"
                                    name="product_meta_description" placeholder="Meta_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="product_meta_keywords" id="product_meta_keywordsLabel"
                                class="col-sm-2 control-label">Meta_keywords</label>
                            <div class="col-sm-12">
                                <textarea rows="4" class="form-control" id="product_meta_keywords"
                                    name="product_meta_keywords" placeholder="Meta_keywords"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="product_image" class="col-sm-6 control-label">Select images</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="product_images" name="product_images[]" multiple="">
                                </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="d-flex imagePreview" style="margin: auto; margin-top: 5px;margin-bottom: 10px;">
                        </div>
                    </div>
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
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
            
            <form id="addProductForm" name="addProductForm" method="POST" class="form-horizontal" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                
                <div class="form-group col-sm-12 errormsg" id="errormsg">
                </div>
                <div class="form-row col-sm-12">
                    <div class="form-group col-md-3">
                        <label for="product_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Name" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_code" class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Product code" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                            <label for="product_category" class="col-sm-7 control-label">Category</label>
                            <div class="col-sm-15">
                                <select class="form-control" id="product_category" name="product_category">
                                    <option value="" selected disabled hidden>Select the category</option>
                                    <option value="0">None</option>
                                    @if (isset($catOptions) &&!empty($catOptions))
                                        @foreach($catOptions as $maincategory)
                                        <option value="{{$maincategory['cat_id']}}">{{$maincategory['category_name']}}</option>
                                        @if(!empty($maincategory['subcategory']))
                                        @foreach($maincategory['subcategory'] as $subcategory)
                                        <option value="{{$subcategory['cat_id']}}">&nbsp;&nbsp;&raquo;{{$subcategory['category_name']}}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="color_family" class="col-sm-7 control-label">Color Family</label>
                        <div class="col-sm-15">
                            <select class="form-control" id="color_family" name="color_family">
                                <option value="" selected disabled hidden>Select the color family</option>
                                <option value="">None</option>
                                <option value="Black">Black</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Grey">Grey</option>
                                <option value="Orange">Orange</option>
                                <option value="Red">Red</option>
                                <option value="White">White</option>
                                <option value="Yellow">Yellow</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="product_color" class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Product color">
                        </div>
                    </div>
                </div>
                <div class="form-row col-sm-12">
                    <div class="form-group col-md-2">
                        <label for="group_code" class="col-sm-6 control-label">Group code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="group_code" name="group_code" placeholder="Group code">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="product_material" class="col-sm-2 control-label">Material</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="product_material" name="product_material">
                                <option value="" selected disabled hidden>Select material</option>
                                @if (isset($productsFilters['patternArray']))
                                    @foreach ($productsFilters['materialArray'] as $material)
                                        <option value="{{ $material }}">{{ $material }}</option>
                                    @endforeach
                                @endif
                            </select>
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
                <div class="form-row col-sm-12">
                    <div class="form-group col-md-3">
                        <label for="product_size" class="col-sm-2 control-label">Size</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_size" name="product_size" placeholder="Product size">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_height" class="col-sm-2 control-label">Height</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_height" name="product_height" placeholder="Product height">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_width" class="col-sm-2 control-label">width</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_width" name="product_width" placeholder="Product width">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_weight" class="col-sm-2 control-label">Weight</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Product weight">
                        </div>
                    </div>
                </div>
                <div class="form-row col-sm-12">
                    <div class="form-group col-md-4">
                        <label for="product_discount" class="col-sm-4 control-label">Discount(%)</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_discount" name="product_discount" 
                            placeholder="Discount...">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_price" class="col-sm-4 control-label">Product price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Product price">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="product_status" name="product_status">
                                <option value="" selected disabled hidden>Select status</option>
                                <option value="1">Inactive</option>
                                <option value="2">Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product_description" id="product_descriptionLabel" class="col-sm-auto control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="4" id="product_description" name="product_description" 
                            placeholder="Write Description......"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_wash" id="product_washLabel" class="col-sm-auto control-label">Wash & care(optional)</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="4" id="product_wash" name="product_wash" 
                            placeholder="Washing and caring......"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="product_keywords" id="product_keywordsLabel" class="col-sm-2 control-label">Keywords</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_keywords" name="product_keywords" placeholder="Keywords">
                        </div>
                        <label for="product_meta_title" id="product_meta_titleLabel" class="col-sm-2 control-label">Meta_title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_meta_title" name="product_meta_title" 
                            placeholder="Meta_title">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_video" class="col-sm-6 control-label">Select video</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="product_video" name="product_video">
                        </div>
                        <label for="product_image" class="col-sm-6 control-label">Select image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="product_image" name="product_image">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_meta_description" id="product_meta_descriptionLabel" class="col-sm-2 control-label">Meta_description</label>
                        <div class="col-sm-12">
                            <textarea rows="4" class="form-control" id="product_meta_description" name="product_meta_description" 
                            placeholder="Meta_description"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_meta_keywords" id="product_meta_keywordsLabel" class="col-sm-2 control-label">Meta_keywords</label>
                        <div class="col-sm-12">
                            <textarea rows="4" class="form-control" id="product_meta_keywords" name="product_meta_keywords" 
                            placeholder="Meta_keywords"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12" style="margin-top: 10px;">
                        <label for="product_featured" id="product_featuredLabel" class="col-sm-2 control-label">Featured:</label>
                        <input type="checkbox" id="product_featured" name="product_featured" value="Yes">
                    </div>
                    <div class="form-group col-md-12">
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <img class="border" width="150" height="150" id="product_imageView" name="product_imageView"/>
                        </div>
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
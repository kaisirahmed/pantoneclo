@extends('admin.layouts.index')
@section('title','Product Edit')
@section('content')
{!! Form::open([ 'method'=>'PATCH', 'route' => ['admin.products.update',$product->id], 'files' => true]) !!}
@csrf
<div class="container page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> /<a href="{{ route('admin.products.index') }}"> Products</a> / Product Edit</h5>
        <button type="submit" class="btn btn-success ml-1">Save<i class="material-icons">edit</i></button>
    </div>
</div>

<div class="container page__container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{-- <div class="card-header card-header-large bg-white d-flex align-items-center">
                    <h4 class="card-header__title flex m-0">Product Information</h4>
                    <div>
                        <a href="javascript:void(0)" class="link-date">13/03/2018 <span class="text-muted mx-1">to</span> 20/03/2018</a>
                    </div>
                </div> --}}
                <div class="card-header card-header-tabs-basic nav" role="tablist">
                    <a href="#productinfo" class="active" data-toggle="tab" role="tab" aria-controls="productinfo" aria-selected="true">Product Info</a>
                    <a href="{{ route('admin.attributes.edit',$product->id) }}">Attributes</a>
                    <a href="{{ route('admin.variations.edit',$product->id) }}">Variations</a>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active show fade" id="productinfo">
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Basic Information</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="was-validated">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="{{ $product->name }}" required="">
                                                <div class="invalid-feedback">Please provide a Product Name.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="code">Code</label>
                                                <input type="text" name="code" class="form-control" id="code" placeholder="Code" value="{{ $product->code }}" required="">
                                                <div class="invalid-feedback">Please provide a Code</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Affiliate Link</label>
                                                <input type="text" name="affiliate_link" class="form-control" id="link" placeholder="Affiliate Link" value="{{ $product->affiliate_link }}" required="">
                                                <div class="invalid-feedback">Please provide a valid Affiliate Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="model">Model</label>
                                            <input type="text" name="model" class="form-control" id="model" placeholder="Model" value="{{ $product->model }}">
                                            {{-- <div class="invalid-feedback">Please provide a valid city.</div> --}}
                                            {{-- <div class="valid-feedback">Looks good!</div> --}}
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Price & Discount</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="price">Price</label>
                                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" min="1" type="text" name="price" placeholder="Price" value="{{ $product->price }}" required="">
                                                <div class="invalid-feedback">Please provide a Price of product.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="discount">Discount Amount</label>
                                            <input id="inputDiscountAmount" type="number" class="form-control" name="discount_amount" min="0" value="{{ $product->discount_amount }}" autocomplete="discount" autofocus>
                                                
                                            @error('discount_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    
                                    </div>
                                
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3" id="DP">
                                            <label for="discount">Discount Percentage</label>
                                            <input id="inputDiscountPercentage" type="number" class="form-control" name="discount_percentage" min="0" value="{{ $product->discount_percentage }}" autocomplete="discount_percentage" autofocus>
                
                                            @error('discount_percentage')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">Please provide a Discount Percentage.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="sale_price">Sale Price</label>
                                                <input id="salePrice" type="number" class="form-control @error('sale_price') is-invalid @enderror" min="0" name="sale_price" min="1" value="{{ $product->sale_price }}" required autocomplete="sale_price" readonly autofocus>
                
                                                @error('sale_price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Images Upload</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Default</label>
                                                <input type="text" name="image" class="form-control" id="link" placeholder="Default image" value="{{ $product->image }}" required="">
                                                <div class="invalid-feedback">Please provide a valid default image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Front</label>
                                                <input type="text" name="front_side_image" class="form-control" id="link" placeholder="Front image" value="{{ $product->front_side_image }}" required="">
                                                <div class="invalid-feedback">Please provide a valid fron image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Back</label>
                                                <input type="text" name="back_side_image" class="form-control" id="link" placeholder="Back image" value="{{ $product->back_side_image }}" required="">
                                                <div class="invalid-feedback">Please provide a valid back image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Right</label>
                                                <input type="text" name="right_side_image" class="form-control" id="link" placeholder="Right image" value="{{ $product->right_side_image }}" required="">
                                                <div class="invalid-feedback">Please provide a valid right image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Left</label>
                                                <input type="text" name="left_side_image" class="form-control" id="link" placeholder="Left image" value="{{ $product->left_side_image }}" required="">
                                                <div class="invalid-feedback">Please provide a valid left image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                                                                                        
                                </div>
                            </div>
                        </div>
                
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Description</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <textarea type="textarea" style="display:none" id="description" name="description" rows="4" class="form-control" placeholder="Please enter a description">{!! $product->description !!}</textarea>
                                    <div class="form-group">
                                        <div class="h-150" data-toggle="quill" data-quill-placeholder="Description write here...." data-quill-modules-toolbar='[["bold", "italic"], ["link", "blockquote", "code", "image"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                                        {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">QU & Category</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="price">Quantity</label>
                                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" min="1" type="text" name="quantity" placeholder="Quantity" value="{{ $product->quantity }}" required="">
                                                <div class="invalid-feedback">Please provide a Weight of product.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="unit">Units</label>
                                            <select id="unit" name="unit_id" data-toggle="select" class="form-control">
                                                <option disabled selected>Select Unit</option>
                                                @foreach($units as $unit)
                                                <option value="{{ $unit->id }}" {{ $product->unit_id === $unit->id ? 'selected' : '' }}>{{ $unit->code }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please provide a Discount Amount.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="size">Category</label>
                                            <select id="size" name="category[]" data-toggle="select" class="form-control">
                                                <option disabled selected></option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ implode(', ', $product->categories()->get()->pluck('id')->toArray()) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Publication Status</strong></p>
                                    <p class="text-muted">This is for save the product draft or published</p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="flex">
                                                <label for="Product Status">Product Status</label>
                                                <select id="status" name="status" data-toggle="select" class="form-control">
                                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Has Attributes</strong></p>
                                    <p class="text-muted">Check if product has attributes.</p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="flex">
                                        <label for="subscribe">Has Attribute</label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="has_option" type="checkbox" id="attribute" value="{{ $product->has_option ? 1 : 0 }}" class="custom-control-input" {{ $product->has_option ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="attribute">Yes</label>
                                        </div>
                                        <label for="subscribe" class="mb-0">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <button type="submit" class="btn btn-success ml-1">Save<i class="material-icons">edit</i></button>
                </div>
                
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@section('script')
    
    <!-- Range Slider -->
    <script src="{{ asset('admin/assets/vendor/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ion-rangeslider.js') }}"></script>

    <!-- jQuery Mask Plugin -->
    <script src="{{ asset('admin/assets/vendor/jquery.mask.min.js') }}"></script>

    <!-- Quill -->
    <script src="{{ asset('admin/assets/vendor/quill.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/quill.js') }}"></script>

    <!-- Dropzone -->
    <script src="{{ asset('admin/assets/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dropzone.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('admin/assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2.js') }}"></script>
    <script>

        $(document).ready(function() {
        
            // if($("#specialOffer").prop("checked") == true){ 
            //     $('#isSpecialOffer').append('<div class="form-group" id="specialImage"><label for="specialImage">Product Special Image <i title="Special Image for product" class="ti-help-alt"></i></label><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text">Upload</span></div><div class="custom-file"><input type="file" id="specialOfferImage" class="custom-file-input" name="special_image"><label class="custom-file-label" for="inputGroupFile01" id="specialImageChoose">Choose file</label></div></div></div>');
            // }
        
            // $("#specialOffer").change(function() { 
            //     if($(this).prop("checked") == true){ 
            //         $('#isSpecialOffer').append('<div class="form-group" id="specialImage"><label for="specialImage">Product Special Image <i title="Special Image for product" class="ti-help-alt"></i></label><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text">Upload</span></div><div class="custom-file"><input type="file" id="specialOfferImage" class="custom-file-input" name="special_image"><label class="custom-file-label" for="inputGroupFile01" id="specialImageChoose">Choose file</label></div></div></div>');
            //     } else if($(this).prop("checked") == false){
            //         $('#specialImage').remove();
            //     }
            // });
        
            // $(document).on("change", '#specialOfferImage', function () {
            //     var filename = $(this)[0].value.split("\\").pop();
            //     if ($(this).val() == "") {
            //         $('#specialImageChoose').text('Choose file');
            //     }else{
            //         $('#specialImageChoose').text(filename);
            //     }
            // });
         
            $('#price').on('keyup', function() {
                var price = $(this).val();
                $('form .checkPrice').remove();
                    var discountAmount = $('form #inputDiscountAmount').val();
                    var discountPercent = $('form #inputDiscountPercentage').val();
                    if(discountAmount) { 
                        var salePrice = price - discountAmount; 
                        $('form #salePrice').val(salePrice);
                    } else if(discountPercent) {
                        var discountAmount = price*(discountPercent/100);
                        var salePrice = price - discountAmount;
                        $('form #salePrice').val(salePrice);
                    } else {
                        $('form #salePrice').val(price);
                    }        
            })
        
          
            $(document).on("keyup", "#inputDiscountAmount" , function() {
                $('#inputDiscountPercentage').val(0);
                var discountAmount = $(this).val();
                var price = $("#price").val();
                if(price) {
                    $('form .checkPrice').remove();
                    var salePrice = price - discountAmount;
                    $('form #salePrice').val(salePrice);
                } else {
                    $('form .checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
                }
            });
         
           
        
            $('#reset, #reset1').on('click', function() {
                $('#discountAmount').remove();
                $('#discountPercentage').remove();
                $('#specialImage').remove();
            })

            $('#attribute').change(function() {
                if($(this).is(":checked")) {
                    $(this).prop("checked",'checked');
                    $(this).val(1);
                } else {
                    $(this).val(0);
                    $(this).prop("checked",'');
                }
            });
        
        
    
            $(document).on("keyup", "#inputDiscountPercentage" , function() {
                $('#inputDiscountAmount').val(0);
                var discountPercent = $(this).val();
                var price = $("#price").val();
                if(price) {
                    $('form .checkPrice').remove();
                    var discountAmount = price*(discountPercent/100);
                    var salePrice = price - discountAmount;
                    $('form #salePrice').val(salePrice);
                } else {
                    $('form .checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
                }
            });
              
        
            $('#productImage').change(function () {
                var filename = $(this)[0].value.split("\\").pop();
                if ($(this).val() == "") {
                    $('#imageChoose').text('Choose file');
                }else{
                    $('#imageChoose').text(filename);
                }
            });

            $(".ql-editor").on("keyup",function() { 
                $("#description").val($(".ql-editor").html());
            })

            $("#colorAdd").on('click', function(){
                $('#colorOption').append();
            })

            var maxField = 10; 
            var c = 1; var s = 1;
            $("#colorAdd").click(function () {
                newRowAdd = 
                '<div class="form-row" id="colorOptionSub">'+
                    '<div class="col-12 col-md-6 mb-3">'+
                        '<input type="text" name="color[]" class="form-control" id="color" placeholder="Color" value="" required="">'+
                    '</div>'+
                    '<div class="col-12 col-md-6 mb-3">'+
                        '<button type="button" class="btn btn-outline-warning" id="colorSub">-</button>'+
                    '</div>'+
                '</div>';
    
               
                if(c < maxField){ 
                    c++; //Increment field counter
                    $('#colorOption').append(newRowAdd);
                }
            });
    
            $("#colorOption").on("click", "#colorSub", function () {  
                $(this).parents("#colorOptionSub").remove();
                c--;
            })

            $("#sizeAdd").click(function () {  
                newRowAdd = 
                '<div class="form-row" id="sizeOptionSub">'+
                    '<div class="col-12 col-md-6 mb-3">'+
                        '<input type="text" name="size[]" class="form-control" id="size" placeholder="Size" value="" required="">'+
                    '</div>'+
                    '<div class="col-12 col-md-6 mb-3">'+
                        '<button type="button" class="btn btn-outline-warning" id="sizeSub">-</button>'+
                    '</div>'+
                '</div>';
    
               
                if(s < maxField){ 
                    s++; //Increment field counter
                    $('#sizeOption').append(newRowAdd);
                }
            });
    
            $("#sizeOption").on("click", "#sizeSub", function () {  
                $(this).parents("#sizeOptionSub").remove();
                s--;
            })
         
        });
        
           
        </script>

@endsection
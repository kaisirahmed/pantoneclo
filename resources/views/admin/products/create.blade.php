@extends('admin.layouts.index')
@section('title','Product Create')
@section('content')
{!! Form::open([ 'method'=>'POST', 'route' => ['admin.products.store'], 'files' => true]) !!}
@csrf
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h4 class="m-0">Product Create</h4>
        <button type="submit" class="btn btn-success btn-outline ml-1">Save<i class="material-icons">save</i></button>
    </div>
</div>

<div class="container page__container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{-- <div class="card-header card-header-large bg-white d-flex align-items-center">
                    <h4 class="card-header__title flex m-0">Information</h4>
                    <div>
                        <a href="javascript:void(0)" class="link-date">13/03/2018 <span class="text-muted mx-1">to</span> 20/03/2018</a>
                    </div>
                </div> --}}
                
                <div class="card-header card-header-tabs-basic nav" role="tablist">
                    <a href="#generalinfo" class="active" data-toggle="tab" role="tab" aria-controls="generalinfo" aria-selected="true">Product Information</a>
                    {{-- <a href="#options" data-toggle="tab" role="tab" aria-selected="false">Options</a> --}}
                    {{-- <a href="#variation" data-toggle="tab" role="tab" aria-selected="false">Variation</a> --}}
                    {{-- <a href="#activity_quotes" data-toggle="tab" role="tab" aria-selected="false">Quotes</a> --}}
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active show fade" id="generalinfo">
                    
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
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="{{ old('name') }}" required="">
                                                <div class="invalid-feedback">Please provide a Product Name.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="code">Code</label>
                                                <input type="text" name="code" class="form-control" id="code" placeholder="Code" value="{{ old('code') }}" required="">
                                                <div class="invalid-feedback">Please provide a Code</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Affiliate Link</label>
                                                <input type="text" name="affiliate_link" class="form-control" id="link" placeholder="Affiliate Link" value="{{ old('affiliate_link') }}" required="">
                                                <div class="invalid-feedback">Please provide a valid Affiliate Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="model">Model</label>
                                            <input type="text" name="model" class="form-control" id="model" placeholder="Model" value="{{ old('model') }}" required="">
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
                                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" min="1" type="text" name="price" placeholder="Price" value="{{ old('price') }}" required="">
                                                <div class="invalid-feedback">Please provide a Price of product.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="discount">Discount Amount</label>
                                            <input id="inputDiscountAmount" type="number" class="form-control" name="discount_amount" value="{{ old('discount_amount') ?? 0 }}" autocomplete="discount">
                                                
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
                                            <input id="inputDiscountPercentage" type="number" class="form-control" name="discount_percentage" value="{{ old('discount_percentage') ?? 0 }}" autocomplete="discount_percentage">
                
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
                                                <input id="salePrice" type="number" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price" value="{{ old('sale_price') }}" required autocomplete="sale_price" readonly>
                
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
                                                <input type="text" name="image" class="form-control" id="link" placeholder="Default image" value="{{ old('image') }}" required="">
                                                <div class="invalid-feedback">Please provide a valid default image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Front</label>
                                                <input type="text" name="front_side_image" class="form-control" id="link" placeholder="Front image" value="{{ old('front_side_image') }}" required="">
                                                <div class="invalid-feedback">Please provide a valid fron image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Back</label>
                                                <input type="text" name="back_side_image" class="form-control" id="link" placeholder="Back image" value="{{ old('back_side_image') }}" required="">
                                                <div class="invalid-feedback">Please provide a valid back image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Right</label>
                                                <input type="text" name="right_side_image" class="form-control" id="link" placeholder="Right image" value="{{ old('right_side_image') }}" required="">
                                                <div class="invalid-feedback">Please provide a valid right image Link.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="link">Left</label>
                                                <input type="text" name="left_side_image" class="form-control" id="link" placeholder="Left image" value="{{ old('left_side_image') }}" required="">
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
                                    <textarea type="textarea" style="display:none" id="description" name="description" rows="4" class="form-control" placeholder="Please enter a description">{!! old('description') !!}</textarea>
                                    <div class="form-group">
                                        <div class="h-150" data-toggle="quill" data-quill-placeholder="Description write here...." data-quill-modules-toolbar='[["bold", "italic"], ["link", "blockquote", "code", "image"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                                            {!! old('description') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Quantity & Units</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="was-validated">
                                                <label for="price">Quantity</label>
                                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" min="1" type="text" name="quantity" placeholder="Quantity" value="{{ old('quality') }}" required="">
                                                <div class="invalid-feedback">Please provide a Weight of product.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="unit">Units</label>
                                            <select id="unit" name="unit_id" data-toggle="select" class="form-control">
                                                <option disabled selected>Select Unit</option>
                                                @foreach($units as $unit)
                                                <option value="{{ $unit->id }}" {{ old('unit_id') === $unit->id ? 'selected' : '' }}>{{ $unit->code }}</option>
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
                                                <option disabled selected>Select</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if(old('category') == $category->id) ? 'selected' : '' @endif>{{ $category->name }}</option>
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
                                                    <option value="1">Active</option>
                                                    <option value="0">Draft</option>
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
                                    <p><strong class="headings-color">Size Attributes</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body" id="sizeOption">
                                    <div class="form-row" id="#">
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="text" name="options[size]" class="form-control" id="options_name" placeholder="Options Name" value="Size" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <button type="button" class="btn btn-outline-primary" id="sizeAdd">+</button>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="text" name="size[]" class="form-control" id="size" placeholder="Size">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <button type="button" class="btn btn-outline-warning" disabled>-</button>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Color Attributes</strong></p>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body" id="colorOption">
                                    <div class="form-row" id="#">
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="text" name="options[color]" class="form-control" id="options_name" placeholder="Options Name" value="Color" readonly>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <button type="button" class="btn btn-outline-primary" id="colorAdd">+</button>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="text" name="color[]" class="form-control" id="color" placeholder="Color">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <button type="button" class="btn btn-outline-warning" disabled>-</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                        <button type="submit" class="btn btn-success ml-1">Save<i class="material-icons">save</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@section('script')\
    
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
                    var discountAmount = $('#inputDiscountAmount').val();
                    var discountPercent = $('#inputDiscountPercentage').val();
                    if(discountAmount) { 
                        var salePrice = price - discountAmount; 
                        $('#salePrice').val(salePrice);
                    } else if(discountPercent) {
                        var discountAmount = price*(discountPercent/100);
                        var salePrice = price - discountAmount;
                        $('#salePrice').val(salePrice);
                    } else {
                        $('#salePrice').val(price);
                    }        
            })
        
          
            $(document).on("keyup", "#inputDiscountAmount" , function() {
                $('#inputDiscountPercentage').val(0);
                var discountAmount = $(this).val();
                var price = $("#price").val();
                if(price) {
                    $('.checkPrice').remove();
                    var salePrice = price - discountAmount;
                    $('#salePrice').val(salePrice);
                } else {
                    $('.checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
                }
            });
         
           
        
            $('#reset, #reset1').on('click', function() {
                $('#discountAmount').remove();
                $('#discountPercentage').remove();
                $('#specialImage').remove();
            })
        
        
    
            $(document).on("keyup", "#inputDiscountPercentage" , function() {
                $('#inputDiscountAmount').val(0);
                var discountPercent = $(this).val();
                var price = $("#price").val();
                if(price) {
                    $('.checkPrice').remove();
                    var discountAmount = price*(discountPercent/100);
                    var salePrice = price - discountAmount;
                    $('#salePrice').val(salePrice);
                } else {
                    $('.checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
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
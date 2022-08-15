@extends('admin.layouts.index')
@section('title','Product Create')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h4 class="m-0">Product Create</h4>
    </div>
</div>

<div class="container-fluid page__container">
    {!! Form::open([ 'method'=>'POST', 'route' => ['admin.products.store'], 'files' => true]) !!}
        @csrf
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
                                <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="" required="">
                                <div class="invalid-feedback">Please provide a Product Name.</div>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="code">Code</label>
                                <input type="text" name="code" class="form-control" id="code" placeholder="Code" value="" required="">
                                <div class="invalid-feedback">Please provide a Code</div>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="was-validated">
                                <label for="link">Affiliate Link</label>
                                <input type="text" name="affiliate_link" class="form-control" id="link" placeholder="Affiliate Link" required="">
                                <div class="invalid-feedback">Please provide a valid Affiliate Link.</div>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="model">Model</label>
                            <input type="text" name="model" class="form-control" id="model" placeholder="Model" required="">
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
                    <p><strong class="headings-color">Price & Category</strong></p>
                    <p class="text-muted"></p>
                </div>
                <div class="col-lg-10 card-form__body card-body">
                    
                    <div class="form-row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="was-validated">
                                <label for="price">Price</label>
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" min="1" type="text" name="price" placeholder="Price" value="" required="">
                                <div class="invalid-feedback">Please provide a Price of product.</div>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="discount">Manual Discount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input class="@error('discount_amount') is-invalid @enderror" id="manualDiscount" type="radio" name="discount" aria-label="radio for following text input">
                                    </div>
                                </div>
                                <input type="text" disabled="disabled" class="form-control" value="Manual Discount" aria-label="Text input with radio">
                            </div>

                            @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                        
                        <div class="col-12 col-md-6 mb-3 discountA">
                                                
                        </div>
                        
                    </div>
                
                    <div class="form-row">
                        <div class="col-12 col-md-6 mb-3" id="DP">
                            <label for="discount">Discount Percentage</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input class="@error('discount_percentage') is-invalid @enderror" id="manualPercentage" type="radio" name="discount" aria-label="radio for following text input">
                                    </div>
                                </div>
                                <input type="text" disabled="disabled" class="form-control" value="Discount Percentage" aria-label="Text input with radio">
                            </div>

                            @error('discount_percentage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="invalid-feedback">Please provide a Discount Percentage.</div>
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-12 col-md-6 mb-3 discountP">
                                                
                        </div>  
                    </div>  
                    <div class="form-row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input id="salePrice" type="number" class="form-control @error('sale_price') is-invalid @enderror" min="1" name="sale_price" min="1" value="" required autocomplete="sale_price" readonly autofocus>

                                @error('sale_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="size">Category</label>
                            <select id="size" name="category[]" data-toggle="select" class="form-control">
                                <option disabled selected></option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) ? 'selected' : '' @endif>{{ $category->name }}</option>
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
                    <p><strong class="headings-color">Images Upload</strong></p>
                    <p class="text-muted"></p>
                </div>
                <div class="col-lg-10 card-form__body card-body d-flex align-items-center">
    
                    <div class="form-group">
                        <label>Image</label>
                        <div class="dz-clickable1 media align-items-center" data-toggle="dropzone" data-dropzone-url="{{ route('admin.products.imageupload') }}" data-dropzone-clickable=".dz-clickable1" data-dropzone-files='["{{ asset('admin/assets/images/account-add-photo.svg') }}"]'>
                            {{-- <div class="dz-preview dz-file-preview dz-clickable1 mr-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('admin/assets/images/account-add-photo.svg') }}" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                    <input type="file" name="image" value="" class="avatar-img rounded">
                                </div>
                            </div> --}}
                            <div class="media-body">
                                <input type="file" name="image" value="" class="avatar-img rounded">
                                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-light dz-clickable1">Choose photo</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Front Side Image</label>
                        <div class="dz-clickable2 media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable2" data-dropzone-files='["{{ asset('admin/assets/images/account-add-photo.svg') }}"]'>
                            {{-- <div class="dz-preview dz-file-preview dz-clickable2 mr-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('admin/assets/images/account-add-photo.svg') }}" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                    <input type="hidden" name="front_side_image" value="" class="avatar-img rounded" data-dz-thumbnail>
                                </div>
                            </div> --}}
                            <div class="media-body">
                                <input type="file" name="front_side_image" value="" class="avatar-img rounded">
                                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-light dz-clickable2">Choose photo</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Right Side Image</label>
                        <div class="dz-clickable3 media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable3" data-dropzone-files='["{{ asset('admin/assets/images/account-add-photo.svg') }}"]'>
                            {{-- <div class="dz-preview dz-file-preview dz-clickable3 mr-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('admin/assets/images/account-add-photo.svg') }}" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                    <input type="hidden" name="right_side_image" value="" class="avatar-img rounded" data-dz-thumbnail>
                                </div>
                            </div> --}}
                            <div class="media-body">
                                <input type="file" name="right_side_image" value="" class="avatar-img rounded">
                                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-light dz-clickable3">Choose photo</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Left Side Image</label>
                        <div class="dz-clickable4 media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable4" data-dropzone-files='["{{ asset('admin/assets/images/account-add-photo.svg') }}"]'>
                            {{-- <div class="dz-preview dz-file-preview dz-clickable4 mr-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('admin/assets/images/account-add-photo.svg') }}" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                    <input type="hidden" name="left_side_image" value="" class="avatar-img rounded" data-dz-thumbnail>
                                </div>
                            </div> --}}
                            <div class="media-body">
                                <input type="file" name="left_side_image" value="" class="avatar-img rounded">
                                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-light dz-clickable4">Choose photo</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Back Side Image</label>
                        <div class="dz-clickable5 media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable5" data-dropzone-files='["{{ asset('admin/assets/images/account-add-photo.svg') }}"]'>
                            {{-- <div class="dz-preview dz-file-preview dz-clickable5 mr-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('admin/assets/images/account-add-photo.svg') }}" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                                    <input type="hidden" name="back_side_image" value="" class="avatar-img rounded" data-dz-thumbnail>
                                </div>
                            </div> --}}
                            <div class="media-body">
                                <input type="file" name="back_side_image" value="" class="avatar-img rounded">
                                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-light dz-clickable5">Choose photo</a> --}}
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
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea id="desc" name="description" rows="4" class="form-control" placeholder="Please enter a description"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-2 card-body">
                    <p><strong class="headings-color">Sizes & Units</strong></p>
                    <p class="text-muted"></p>
                </div>
                <div class="col-lg-10 card-form__body card-body">
                    <div class="form-row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="was-validated">
                                <label for="price">Object Quantity</label>
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" min="1" type="text" name="quantity" placeholder="Price" value="" required="">
                                <div class="invalid-feedback">Please provide a Weight of product.</div>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 mb-3">
                            <label for="unit">Units</label>
                            <select id="unit" name="unit_id" data-toggle="select" class="form-control">
                                <option disabled selected>Select Unit</option>
                                @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->code }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please provide a Discount Amount.</div>
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="size">Sizes</label>
                            <select id="size" name="size_id" data-toggle="select" class="form-control">
                                <option disabled selected>Select Size</option>
                                @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->code }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please provide a Price of product.</div>
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="color">Color</label>
                            <select id="color" name="color_id" data-toggle="select" class="form-control">
                                <option disabled selected>Select color</option>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please provide a color of product.</div>
                            <div class="valid-feedback">Looks good!</div>
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
        <div class="text-right mb-5">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    {{ Form::close() }}

</div>
@endsection
@section('script')\
    
    <!-- Range Slider -->
    <script src="{{ asset('admin/assets/vendor/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ion-rangeslider.js') }}"></script>

    <!-- jQuery Mask Plugin -->
    <script src="{{ asset('admin/assets/vendor/jquery.mask.min.js') }}"></script>

    <!-- Quill -->
    {{-- <script src="{{ asset('admin/assets/vendor/quill.min.js') }}"></script> --}}
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
        
            if($("#manualDiscount").prop("checked") == true) {alert(1)
                
                $('#discountPercentage').remove();
                $('.discountA').append('<div id="discountAmount"><label for="discount-amount">Discount Amount</label><input id="inputDiscountAmount" type="number" class="form-control" name="discount_amount" min="1" value="" autocomplete="discount" autofocus><div class="checkPrice"><div></div>');
                
                $(document).on("keyup", "#inputDiscountAmount" , function() {
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
            }
        
            $("#manualDiscount").change(function() {
                
                if($(this).prop("checked") == true) {
                    $('#discountPercentage').remove();
                    $('.discountA').append('<div class="form-group" id="discountAmount"><label for="discount">Discount Amount</label><input id="inputDiscountAmount" type="number" class="form-control" name="discount_percentage" min="1" value="" autocomplete="discount" autofocus><div class="checkPrice"><div></div>');
                    
                    $(document).on("keyup", "#inputDiscountAmount" , function() {
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
                }
            })
        
            $('#reset, #reset1').on('click', function() {
                $('#discountAmount').remove();
                $('#discountPercentage').remove();
                $('#specialImage').remove();
            })
        
            if($("#manualPercentage").prop("checked") == true) {
                $('#discountAmount').remove();
                $('.discountP').append('<div class="form-group" id="discountPercentage"><label for="discount_percentage">Discount Percentage</label><input id="inputDiscountPercentage" type="number" class="form-control" name="discount_percentage" min="1" value="" autocomplete="discount_percentage" autofocus><div class="checkPrice"><div></div>');
        
                $(document).on("keyup", "#inputDiscountPercentage" , function() {
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
            }
        
            $("#manualPercentage").change(function() {
             
                if($(this).prop("checked") == true) {
                    $('#discountAmount').remove();
                    $('#DP').append('<div class="form-group" id="discountPercentage"><label for="discount_percentage">Discount Percentage</label><input id="inputDiscountPercentage" type="number" class="form-control" name="discount_percentage" min="1" value="" autocomplete="discount_percentage" autofocus><div class="checkPrice"><div></div>');
        
                    $(document).on("keyup", "#inputDiscountPercentage" , function() {
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
         
        });
        
           
        </script>

@endsection
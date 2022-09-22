@extends('admin.layouts.index')
@section('title','Product Create')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h4 class="m-0">Product Create</h4>
    </div>
</div>

<div class="container-fluid page__container">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header card-header-large bg-white d-flex align-items-center">
                        <h4 class="card-header__title flex m-0">Information</h4>
                        {{-- <div>
                            <a href="javascript:void(0)" class="link-date">13/03/2018 <span class="text-muted mx-1">to</span> 20/03/2018</a>
                        </div> --}}
                    </div>
                    <div class="card-header card-header-tabs-basic nav" role="tablist">
                        <a href="#generalinfo" class="active" data-toggle="tab" role="tab" aria-controls="generalinfo" aria-selected="true">General Information</a>
                        <a href="#options" data-toggle="tab" role="tab" aria-selected="false">Options</a>
                        <a href="#variation" data-toggle="tab" role="tab" aria-selected="false">Variation</a>
                        {{-- <a href="#activity_quotes" data-toggle="tab" role="tab" aria-selected="false">Quotes</a> --}}
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active show fade" id="generalinfo">
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
                                            {{-- <div class="form-group">
                                                <label for="desc">Description</label> --}}
                                                <textarea type="textarea" style="display:none" id="description" name="description" rows="4" class="form-control" placeholder="Please enter a description"></textarea>
                                            {{-- </div> --}}
                                            {{-- <label>Custom toolbar</label> --}}
                                            <div class="form-group">
                                                <div class="h-150" data-toggle="quill" data-quill-placeholder="Description write here...." data-quill-modules-toolbar='[["bold", "italic"], ["link", "blockquote", "code", "image"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                                                </div>
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
                        <div class="tab-pane fade" id="options">
                            {!! Form::open([ 'method'=>'POST', 'route' => ['admin.products.store'], 'files' => true]) !!}
                            @csrf
                            <div class="card card-form">
                                <div class="card-header card-header-large bg-light d-flex align-items-center">
                                    <div class="flex">
                                        <h4 class="card-header__title float-right">
                                            <button type="button" class="btn btn-outline-success">+ Add New Option</button>
                                        </h4>
                                    </div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-lg-2 card-body">
                                        <p><strong class="headings-color">Basic Information</strong></p>
                                        <p class="text-muted"></p>
                                    </div>
                                    <div class="col-lg-10 card-form__body card-body">
                                        <div class="form-row" id="#">
                                            <div class="col-12 col-md-6 mb-3">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="" required="">
                                                <div class="invalid-feedback">Please provide a Product Name.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <button type="button" class="btn btn-outline-primary">+</button>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="" required="">
                                                <div class="invalid-feedback">Please provide a Product Name.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="tab-pane fade" id="variation">
                            <div class="col-lg-12 card-form__body">
                                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-category-name","js-lists-values-parent-name"]'>
                                    <div class="search-form search-form--light m-3">
                                        <input type="text" class="form-control search" placeholder="Search">
                                        <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                                    </div>
                                    <table class="table mb-0 thead-border-top-0">
                                        <thead class="bg-black">
                                            <tr>
    
                                                <th style="width: 18px;">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input js-toggle-check-all" data-target="#staff" id="customCheckAll">
                                                        <label class="custom-control-label" for="customCheckAll"><span class="text-hide">Toggle all</span></label>
                                                    </div>
                                                    
                                                </th>
                                                <th>
                                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-category-name">Name</a>
                                                </th>
                                                <th>
                                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-parent-name">Parent</a>
                                                </th>
                                                
                                                <th>Order No.</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="staff">
                                            <tr>
    
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="customCheck1_1" value="dfg">
                                                        <label class="custom-control-label" for="customCheck1_1"><span class="text-hide">Check</span></label>
                                                    </div>
                                                </td>
    
                                                <td>
    
                                                    <div class="media align-items-center">
                                                        {{-- <div class="avatar avatar-xs mr-2">
                                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                                        </div> --}}
                                                        <div class="media-body">
                                                            
                                                            <span class="js-lists-values-category-name">dsfg</span>
    
                                                        </div>
                                                    </div>
    
                                                </td>
                                                <td>
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="" required="">
                                                        <div class="invalid-feedback">Please provide a Product Name.</div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="" required="">
                                                        <div class="invalid-feedback">Please provide a Product Name.</div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="" required="">
                                                        <div class="invalid-feedback">Please provide a Product Name.</div>
                                                        <div class="valid-feedback">Looks good!</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
    
    
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="activity_quotes">
                            Odit consectetur dolore maxime similique qui officia deserunt fugiat quo tempore consequuntur dicta ratione sint commodi eum eligendi, magnam aliquid expedita quas accusantium, sed nobis tenetur illum mollitia. Quis ipsum tenetur distinctio tempore vitae atque quam.
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>
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

            $(".ql-editor").on("keyup",function() { 
                $("#description").val($(".ql-editor").html());
            })
         
        });
        
           
        </script>

@endsection
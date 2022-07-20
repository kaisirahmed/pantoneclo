@extends('admin.layouts.index')
@section('title','Category')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            {!! Form::open([ 'method'=>'POST', 'route' => ['category.store'], 'files' => true , 'class' => 'custom-validation']) !!}
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:;" class="float-right">
                        <button id="reset" type="reset" class="btn btn-warning">
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-info">
                            {{ __('save') }}
                        </button>
                        </a>
                    </div>
                    <div class="card-body">
                         
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>   
                                <strong>{!! session('message') !!}</strong>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                    <label for="parent_id">Parent Category <i title="If you want to create main category, you shouldn't select parent category." class="ti-help-alt"></i></label>
                                    <select class="form-control valid multiSelection js-states" id="parentId" name="parent_id" aria-required="true" aria-describedby="parent_id" aria-invalid="false">
                                        <option selected="selected" value="">Please Select</option>
                                        <optgroup>
                                        @foreach($categories as $category) 
                                        
                                            <option value="{{ $category->id }}" @if(old('parent_id') == $category->id) selected @endif>
                                            {{ $category->name }}
                                            </option>
                                            @if(count($category->subcategory))
                                                @include('category.subcategories', ['subcategories' => $category->subcategory])
                                            @endif
                                           
                                        @endforeach
                                        </optgroup> 
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Categoy Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name_bn">Category Name (Bangla) <i title="Write category name in bangla." class="ti-help-alt"></i></label>
                                    <input id="name_bn" type="text" class="form-control @error('name_bn') is-invalid @enderror" name="name_bn" value="{{ old('name_bn') }}" required autocomplete="name_bn" autofocus>

                                    @error('name_bn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags <i title="Tags are the similar name of category. You can write both English & Bangla." class="ti-help-alt"></i></label><br>
                                    <input id="meta_tags" type="text" class="form-control @error('hidden_tags') is-invalid @enderror" name="tags" value="" autocomplete="tags" autofocus>

                                    @error('hidden_tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                     
                                <div class="form-group">
                                    <label for="order_no">Order No (Optional) <i title="Order for menu position of category." class="ti-help-alt"></i></label>
                                    <input id="order_no" type="number" min="0" max="10" class="form-control @error('order_no') is-invalid @enderror" name="order_no" value="{{ old('order_no') }}" autocomplete="order_no" autofocus>

                                    @error('order_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               
                            </div>

                            <div class="col-lg-6">
                            
                                <div class="form-group">
                                    <label for="banner">Banner <i title="Banner for category page." class="ti-help-alt"></i></label>
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('banner') is-invalid @enderror" name="banner" id="banner">
                                        <label class="custom-file-label" id="bannerChoose" for="inputGroupFile01">Choose file</label>
                                      </div>
                                    </div>

                                    @error('banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group menu-icon">
                                    <label for="image">Category Image <i title="Image for category itself." class="ti-help-alt"></i></label>
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="categoryImage">
                                        <label class="custom-file-label" id="imageChoose" for="inputGroupFile01">Choose file</label>
                                      </div>
                                    </div>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if(old('parent_id') == 0)
                                <div class="form-group">
                                    <label for="icon">Menu Icon <i title="Icon for category menu." class="ti-help-alt"></i></label>
                                    <div class="input-group mb-4 icon">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('icon') is-invalid @enderror" name="icon" required id="icon">
                                        <label class="custom-file-label" id="iconChoose" for="inputGroupFile01">Choose file</label>
                                      </div>
                                    </div>

                                    @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="status">Publication Status</label>
                                    <select class="form-control valid multiSelection js-states" name="status" aria-required="true" aria-describedby="admin" aria-invalid="false">
                                        <option value="" selected="selected" disabled="disabled">Please Select</option>
                                        <option value="1" @if(old('status') === '1') selected @endif>Publish</option>
                                        <option value="0" @if(old('status') === '0') selected @endif>Unpublish</option>
                                    </select>
                                </div>

                            </div>
  
                        </div>
                          
                    </div>
                    <div class="card-footer">
                        <a href="javascript:;" class="float-right">
                        <button id="reset1" type="reset" class="btn btn-warning">
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-info">
                            {{ __('Save') }}
                        </button>
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
@include('category.categoryJs') 
@endsection
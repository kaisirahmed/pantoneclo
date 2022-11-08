@extends('admin.layouts.index')
@section('title','Category Create')
@section('content')
{!! Form::open([ 'method'=>'POST', 'route' => ['admin.categories.store'], 'files' => true]) !!}
@csrf
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h4 class="m-0"> @yield('title') </h4>
        <button type="submit" class="btn btn-success btn-outline ml-1">Save<i class="material-icons">save</i></button>
    </div>
</div>

<div class="container page__container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
             
                <div class="card-body tab-content">
                    <div class="tab-pane active show fade" id="generalinfo">
                    
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Category</strong></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="was-validated">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="flex">
                                                    <label for="parent">Parent</label>
                                                    <select id="parent" name="parent_id" data-toggle="select" class="form-control @error('parent_id') is-invalid @enderror">
                                                        <option value=""></option>
                                                        @foreach ($adminCategories as $adminCategory)
                                                        <option value="{{ $adminCategory->id }}">{{ $adminCategory->name }}</option>    
                                         
                                                        @if(count($adminCategory->subcategory))
                                                            @include('admin.category.subcategories', ['subcategories' => $adminCategory->subcategory])
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('parent_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="flex">
                                                    <label for="category">Category</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category" id="category">
                                                    @error('name')
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
                        </div>
                                        
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Sequence</strong></p>
                                    <p class="text-muted">This is for save the Sequence</p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="flex">
                                                <label for="order">Sequence</label>
                                                <input type="number" class="form-control @error('order_no') is-invalid @enderror" name="order_no" id="order">
                                                @error('order_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="flex">
                                                <label for="status">Status</label>
                                                <select id="status" name="status" data-toggle="select" class="form-control @error('status') is-invalid @enderror">
                                                    <option value="0">Draft</option>    
                                                    <option value="1">Save</option>    
                                                </select>
                                                @error('status')
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
 
                        <button type="submit" class="btn btn-success ml-1">Save<i class="material-icons">save</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@extends('admin.layouts.index')
@section('title','Category Edit')
@section('content')
{!! Form::open([ 'method'=>'PATCH', 'route' => ['admin.categories.update',$category->id], 'files' => true]) !!}
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
                                                    <select id="parent" name="parent_id" data-toggle="select" class="form-control">
                                                        <option value=""></option>
                                                        @foreach ($adminCategories as $adminCategory)
                                                        <option value="{{ $adminCategory->id }}" {{ $adminCategory->id == $category->parent->id ? 'selected' : '' }}>{{ $adminCategory->name }}</option>    
                                         
                                                        @if(count($adminCategory->subcategory))
                                                            @include('admin.category.editSubcategories', ['subcategories' => $adminCategory->subcategory])
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="flex">
                                                    <label for="category">Category</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Category" id="category">
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
                                                <input type="number" class="form-control" name="order_no" value="{{ $category->order_no }}" id="order">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="flex">
                                                <label for="status">Status</label>
                                                <select id="status" name="status" data-toggle="select" class="form-control">
                                                    <option value="0">Draft</option>    
                                                    <option value="1">Save</option>    
                                                </select>
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
@extends('admin.layouts.index')
@section('title','View Single Category')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>   
                                <strong>{!! session('message') !!}</strong>
                            </div>
                        @endif
                        @if (session()->has('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>   
                                <strong>{!! session('warning') !!}</strong>
                            </div>
                        @endif
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#category" role="tab"><span class="hidden-sm-up"><i class="ti-info-alt"></i></span> <span class="hidden-xs-down">Category Info</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tags" role="tab"><span class="hidden-sm-up"><i class="ti-tag"></i></span> <span class="hidden-xs-down">Tags</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#images" role="tab"><span class="hidden-sm-up"><i class="ti-image"></i></span> <span class="hidden-xs-down">Images</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="category" role="tabpanel">
                                <div class="row">

                                    <div class="m-t-20">
                                        <table class="display responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Name (Bangla)</th>
                                                    <th>Sub Categories</th>
                                                    <th>Order No</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr> 
                                                    <td></td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->name_bn }}</td>
                                                    <td>
                                                    @if(count($category->subcategory()->get()) > 0)
                                                    @foreach($category->subcategory()->get()->pluck('name')->toArray() as $subcategory)
                                                        <span  class="badge badge-info">{{ $subcategory }}</span>
                                                    @endforeach
                                                    @else
                                                    <span>There is no sub category.</span>
                                                    @endif
                                                    </td>
                                                
                                                    <td>{{ $category->order_no }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $category->status === 1 ? 'success' : 'warning' }}">{{ $category->status === 1 ? 'Active' : 'Inactive' }}</span></td>
                                                </tr>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane p-20" id="tags" role="tabpanel">
                                @if($category->tags !== null)
                                    @foreach(json_decode($category->tags) as $tags)
                                        <p class="tm-tag">{{ $tags }}</p>
                                    @endforeach
                                @else
                                    <p class="tm-tag">No Tags to show</p>
                                @endif
                            </div>
                            <div class="tab-pane p-20" id="images" role="tabpanel">
                                <p><img class="tm-tag" src="{{ 'data:image/' . $category->banner_type . ';base64,' . $category->banner }}" alt="{{ $category->name }}"></p>
                                <p><img class="tm-tag" src="{{ 'data:image/' . $category->image_type . ';base64,' . $category->image }}" alt="{{ $category->name }}"></p>
                                @if(isset($category->icon))
                                <p><img class="tm-tag" src="{{ 'data:image/' . $category->icon_type . ';base64,' . $category->icon }}" alt="{{ $category->name }}"></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
</div>  
@endsection
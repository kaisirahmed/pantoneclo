@extends('admin.layouts.index')
@section('title', 'Products List')
@section('routes')
    {{-- <a href="student-edit-account.html" class="btn btn-light ml-3"><i class="material-icons">edit</i> Edit</a> --}}
    
@endsection
@section('content')

<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h4 class="m-0">Products</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success ml-1">Create <i class="material-icons">account_circle</i></a>
    </div>
</div>
<div class="container page__container">
    <div class="card card-form">
        <div class="row no-gutters">
            {{-- <div class="container-fluid page__heading-container">
                <div class="page__heading d-flex align-items-center justify-content-between">
                    <h4 class="m-0">Products</h4>
                </div>
            </div> --}}
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
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-parent-name">Category</a>
                                </th>
                                
                                <th>Image</th> 
                                <th>Price</th> 
                                <th>Discount Amount</th> 
                                <th>Discount Percentage</th> 
                                <th>Sale Price</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="staff">
                            @foreach($products as $product)
                            <tr>

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="product-check" value="{{ $product->id }}">
                                        <label class="custom-control-label" for="product-check"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">
                                        {{-- <div class="avatar avatar-xs mr-2">
                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div> --}}
                                        <div class="media-body">
                                            
                                            <span class="js-lists-values-category-name">{{ $product->name }}</span>

                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <span class="js-lists-values-parent-name">
                                        {{ implode(', ', $product->categories()->get()->sortBy('name')->pluck('name')->toArray()) }}
                                    </span>
                                    
                                </td>
                                <td><img width="50px" src="{{ $product->image }}" alt="{{ $product->image }}"></td>
                                <td>{{ floatval($product->price) }}</td>
                                <td>{{ floatval($product->discount_amount) }}</td>
                                <td>{{ floatval($product->discount_percentage) }}&#37;</td>
                                <td>{{ floatval($product->sale_price) }}</td>
                                <td><span class="badge badge-{{ $product->status === 1 ? 'success' : 'warning' }}">{{ $product->status === 1 ? 'Active' : 'Draft' }}</span></td>
                                
                                {{-- <td>&dollar;12,402</td> --}}
                                <td>
                                    <div class="dropdown ml-auto">
                                        <a href="javascript:void(0)" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" style="display: none;">
                                            <a class="dropdown-item text-warning" href="{{ route('admin.products.edit', $product->id) }}"><i class="material-icons">edit</i> Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-success" href="{{ route('admin.products.show', $product->id) }}"><i class="material-icons">view_list</i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" type="submit" onclick="confirmDelete('{{ $product->id }}')"><i class="material-icons">delete</i> Delete</a>
                                            <form id="delete{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

</div>
        
@endsection
@section('script')
  <!-- List.js -->
  <script src="{{ asset('admin/assets/vendor/list.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/list.js') }}"></script>
@endsection

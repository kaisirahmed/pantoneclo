@extends('admin.layouts.index')
@section('title', 'Stock')
@section('content')
 
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> / Stock</h5>
    </div>
</div>
<div class="container page__container">
    <div class="card card-form">
        <div class="row no-gutters">
            {{-- <div class="container-fluid page__heading-container">
                <div class="page__heading d-flex align-items-center justify-content-between">
                    <h4 class="m-0">Categories</h4>
                </div>
            </div> --}}
            <div class="col-lg-12 card-form__body">


                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-sku-name","js-lists-values-model-name"]'>
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
                                <th>Image</th>
                                <th>
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-sku-name">Sku</a>
                                </th>
                                <th>Variation</th>
                                
                                <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-model-name">Model</a></th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="staff">
                            @foreach($stocks as $stock)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="customCheck1_1" value="{{ $stock->id }}">
                                        <label class="custom-control-label" for="customCheck1_1"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>
                                    <div class="avatar">
                                        <img src="{{ $stock->image != null ? $stock->image : asset('admin/assets/images/account-add-photo.png') }}" alt="" class="avatar-img">
                                    </div>
                                </td>
                                <td><span class="js-lists-values-sku-name">{{ $stock->sku }}</span></td>
                                <td>{{ $stock->name }}</td>
                                <td><span class="js-lists-values-model-name">{{ $stock->model }}</span></td>
                                <td><span id="quantityStock{{ $stock->id }}">{{ $stock->quantity }}</span></td>
                                <td><span class="badge badge-{{ $stock->status === 1 ? 'success' : 'warning' }}">{{ $stock->status === 1 ? 'Active' : 'Draft' }}</span></td>
                                <td>
                                    <div class="dropdown ml-auto">
                                        <a href="javascript:void(0)" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" style="display: none;">
                                            <a class="dropdown-item text-warning" href="javascript:;" onclick="editStock('{{ route('admin.stocks.edit', $stock->id) }}')"><i class="material-icons">edit</i> Edit</a>
                                            {{-- <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-success" href="{{ route('admin.stocks.show', $stock->id) }}"><i class="material-icons">view_list</i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" type="submit" onclick="confirmDelete('{{ $stock->id }}')"><i class="material-icons">delete</i> Delete</a>
                                            <form id="delete{{ $stock->id }}" action="{{ route('admin.stocks.destroy', $stock->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form> --}}
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
  @include('admin.ajax.stocks')
@endsection

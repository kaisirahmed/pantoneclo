@extends('admin.layouts.index')
@section('title','Variation Edit')
@section('content')
{!! Form::open([ 'method'=>'POST', 'route' => ['admin.variations.update',$product], 'files' => true]) !!}
@csrf
<div class="container page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> /<a href="{{ route('admin.products.index') }}"> Products</a> / Variations Edit</h5>
        <button type="submit" class="btn btn-success ml-1">Save<i class="material-icons">edit</i></button>
    </div>
</div>

<div class="container page__container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              
                <div class="card-header card-header-tabs-basic nav" role="tablist">
                    <a href="{{ route('admin.products.edit',$product) }}">Product Info</a>
                    <a href="{{ route('admin.attributes.edit',$product) }}">Attributes</a>
                    <a href="#variation" class="active" data-toggle="tab" role="tab" aria-controls="variation" aria-selected="true">Variation</a>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active show fade" id="variation">
                        <div class="col-lg-12 card-form__body">
                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-category-name","js-lists-values-parent-name"]'>
                                <div class="search-form search-form--light m-3">
                                    <input type="text" class="form-control search" placeholder="Search">
                                    <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                                </div>
                                <table class="table mb-0 thead-border-top-0">
                                    <thead class="bg-black">
                                        <tr>
                                            <th>Default</th>
                                            <th></th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Sale Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="staff">
                                        @foreach ($variations as $variation)    
                                        <tr>
                                                                                        
                                            <td>
                                                <div class="custom-control">
                                                    <input type="radio" name="is_default" value="{{ $variation->id }}" {{ $variation->is_default == 1 ? 'checked' : '' }}>
                                                    <input type="hidden" name="variant_id{{ $variation->id }}" value="{{ $variation->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                @if($variation->image != null)
                                                <div class="avatar">
                                                    <img src="{{ $variation->image }}" alt="Avatar" class="avatar-img">
                                                </div>
                                                @else
                                                <div class="avatar">
                                                    <img src="{{ asset('admin/assets/images/account-add-photo.png') }}" alt="Avatar" id="image{{ $variation->id }}" class="avatar-img">
                                                </div>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="col-12 col-md-12 mb-3">
                                                    <input type="text" name="image{{ $variation->id }}" class="form-control" id="imageLink{{ $variation->id }}" placeholder="image" value="{{ $variation->image }}" required="" onkeyup="showImage({{ $variation->id }})">
                                                </div>

                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control" value="{{ $variation->code }}">
                                                <span>{{ $variation->name }}</span>
                                            </td>
                                            <td>
                                                <div class="col-12 col-md-12 mb-3">
                                                    <input type="text" name="sku{{ $variation->id }}" class="form-control" id="sku" placeholder="SKU" value="{{ $variation->sku }}" required="">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12 col-md-12 mb-3">
                                                    <input type="number" name="price{{ $variation->id }}" class="form-control" id="price" placeholder="Price" min="0" value="{{ $variation->price }}" step="0.01" required="">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12 col-md-12 mb-3">
                                                    <input type="number" name="sale_price{{ $variation->id }}" class="form-control" id="sale_price" placeholder="Price" min="0" value="{{ $variation->sale_price }}" step="0.01" required="">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12 col-md-12 mb-3">
                                                    <input type="number" name="quantity{{ $variation->id }}" class="form-control" id="quantity" placeholder="Quantity" min="0" value="{{ $variation->quantity }}" required="">
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        function showImage(id){
            
            var imageLink = $('#imageLink'+id).val();
            if(imageLink != ''){
                $('#image'+id).attr('src',imageLink);
            } else {
                $('#image'+id).attr('src','{{ asset("admin/assets/images/account-add-photo.png") }}');
            }
            
            
        }
    </script>

@endsection
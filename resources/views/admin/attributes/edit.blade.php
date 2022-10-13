@extends('admin.layouts.index')
@section('title','Attributes Edit')
@section('content')
{!! Form::open([ 'method'=>'POST', 'route' => ['admin.attributes.update',$product->id], 'files' => true]) !!}
@csrf
<div class="container page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> /<a href="{{ route('admin.products.index') }}"> Products</a> / Attributes Edit</h5>
        <button type="submit" class="btn btn-success ml-1">Save<i class="material-icons">edit</i></button>
    </div>
</div>

<div class="container page__container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{-- <div class="card-header card-header-large bg-white d-flex align-items-center">
                    <h4 class="card-header__title flex m-0">Product Information</h4>
                    <div>
                        <a href="javascript:void(0)" class="link-date">13/03/2018 <span class="text-muted mx-1">to</span> 20/03/2018</a>
                    </div>
                </div> --}}
                <div class="card-header card-header-tabs-basic nav" role="tablist">
                    <a href="{{ route('admin.products.edit',$product->id) }}">Product Info</a>
                    <a href="#options" class="active" data-toggle="tab" role="tab" aria-controls="options" aria-selected="true">Attributes</a>
                    <a href="{{ route('admin.variations.edit',$product->id) }}">Variations</a>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active show fade" id="options">
                        @if($product->has_option)
                            @foreach ($product->options as $option)   
                                <div class="card card-form">
                                    <div class="row no-gutters">
                                        
                                        <div class="col-lg-2 card-body">
                                            <p><strong class="headings-color">{{ $option->name }} Attributes</strong></p>
                                            <p class="text-muted"></p>
                                        </div>
                                        <div class="col-lg-10 card-form__body card-body" id="{{ lcfirst($option->name) }}Option">
                                            
                                            <div class="form-row" id="#">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <input type="text" name="options[{{ lcfirst($option->name) }}]" class="form-control" id="options_name" placeholder="Options Name" value="{{ $option->name }}" readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <button type="button" class="btn btn-outline-primary" id="{{ lcfirst($option->name) }}Add">+</button>
                                                </div>
                                            </div>
                                            @foreach ($option->optionValues as $key => $optionValue)                                        
                                                <div class="form-row" id="{{ lcfirst($option->name) }}OptionSub">
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <input type="text" name="{{ lcfirst($option->name) }}{{ $optionValue->id }}" class="form-control" id="{{ lcfirst($option->name) }}" value="{{ $optionValue->value }}" placeholder="{{ $option->name }}" readonly>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <button type="button" class="btn btn-outline-warning" id="{{ lcfirst($option->name) }}Sub" >-</button> <!--$key == 0 ? 'disabled' : ''-->
                                                    </div>
                                                    
                                                </div>
                                            @endforeach   
                                        
                                        </div>
                                            
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if(count($product->options) == 0)
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
                                    <div class="form-row" id="sizeOptionSub">
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="text" name="size" class="form-control" id="size" value="" placeholder="Size">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <button type="button" class="btn btn-outline-warning" id="sizeSub" >-</button> <!--$key == 0 ? 'disabled' : ''-->
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
                                    <div class="form-row" id="colorOptionSub">
                                        <div class="col-12 col-md-6 mb-3">
                                            <input type="text" name="color" class="form-control" id="color" value="" placeholder="color">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <button type="button" class="btn btn-outline-warning" id="colorSub" >-</button> <!--$key == 0 ? 'disabled' : ''-->
                                        </div>
                                        
                                    </div>
                                
                                </div>
                                    
                            </div>
                        </div>
                        @endif
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

        $(document).ready(function() {
        
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
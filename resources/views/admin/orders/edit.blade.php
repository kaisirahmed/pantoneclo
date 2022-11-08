@extends('admin.layouts.index')
@section('title','Order Update')
@section('content')
{!! Form::open([ 'method'=>'PATCH', 'route' => ['admin.orders.update',$order->id], 'files' => true]) !!}
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
                <div class="page__heading d-flex align-items-center justify-content-between">
                    @include('common.message')
                </div>

                <div class="card-body tab-content">
                    <div class="tab-pane active show fade" id="generalinfo">
                    
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Order</strong></p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="was-validated">
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="name">Shipping Chanrge</label>
                                                <input type="text" name="shipping_charge" class="form-control" id="shipping_charge" placeholder="Shipping Charge" value="{{ $order->shipping_charge }}" required="">
                                                <div class="invalid-feedback">Please provide a shipping charge.</div>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="date">Shipping Date</label>
                                                <input id="date" type="hidden" name="shipping_date" class="form-control flatpickr-input" placeholder="" data-toggle="flatpickr" value="{{ $order->shipping_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                                        
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-2 card-body">
                                    <p><strong class="headings-color">Status</strong></p>
                                    <p class="text-muted">This is for save the order status</p>
                                </div>
                                <div class="col-lg-10 card-form__body card-body">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="flex">
                                                <label for="Product Status">Order Status</label>
                                                <select id="status" name="status" data-toggle="select" class="form-control">
                                                    @foreach (config('orders.getStatus') as $key => $status)
                                                    <option value="{{ $key }}" {{ $key == $order->status ? 'selected' : '' }}>{{ $status['label'] }}</option>    
                                                    @endforeach
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
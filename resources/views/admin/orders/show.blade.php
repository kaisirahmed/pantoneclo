@extends('admin.layouts.index')
@section('title', 'Orders')
@section('content')
 
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> / <a href="{{ route('admin.orders.index') }}">Orders</a> / Order View</h5>
    </div>
</div>
<div class="container-fluid page__container">
    <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
        <i class="material-icons mr-3">error_outline</i>
        <div class="text-body">
            You have an order ID <a href="#">#{{ $order->order_number }}</a> due for
            <strong class="text-danger">$ {{ $order->total }}</strong>
        </div>
        {{-- <a href="{{ route('admin.orders.edit',$order->id) }}" class="btn btn-warning ml-auto">Edit</a> --}}
    </div>

    <div class="card card-form">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">{{ $order->user->name }}</strong></p>
                <p>Payment Method: {{ $order->payment_method }}</p>
                <p>Order Date: {{ date("Y-m-d",strtotime($order->date)) }}</p>
                <p>Shipping Date: {{ date("Y-m-d",strtotime($order->shipping_date)) }}</p>
                <p>Status: <span class="badge badge-{{ config('orders.getStatus.'.$order->status.'.color') }}">{{ config('orders.getStatus.'.$order->status.'.label') }}</span></p>
            </div>
            <div class="col-lg-4 card-form__body card-body">

                <div class="d-flex align-items-center flex-wrap">
                    <div class="mr-3">
                        <strong>Billing Address</strong>
                        <p>{{ $order->billing()->first_name." ".$order->billing()->last_name }}<br>  
                        Phone: {{ $order->billing()->phone }} <br>Email: {{ $order->billing()->email }} <br>
                        Location: {{ $order->billing()->street }}, {{ $order->billing()->street2 }}, {{ ($order->billing()->city != 0 ? $order->billing()->city->name : '') }}, {{ $order->billing()->state->name }}, {{ $order->billing()->country->name }} <br> 
                        Zip Code: {{ $order->billing()->zip }}
                        </p>
                    </div>                   
                </div>

            </div>
            <div class="col-lg-4 card-form__body card-body">

                <div class="d-flex align-items-center flex-wrap">
                    <div class="mr-3">
                        <strong>Shipping Address</strong>
                        <p>{{ $order->shipping()->first_name." ".$order->shipping()->last_name }}<br>  
                        Phone: {{ $order->shipping()->phone }} <br>Email: {{ $order->shipping()->email }} <br>
                        Location: {{ $order->shipping()->street }}, {{ $order->shipping()->street2 }}, {{ ($order->shipping()->city != 0 ? $order->shipping()->city->name : '') }}, {{ $order->shipping()->state->name }}, {{ $order->shipping()->country->name }} <br> 
                        Zip Code: {{ $order->shipping()->zip }}
                        </p>
                    </div>

                     {{-- <div class="ml-auto">
                        <button class="btn btn-danger"> Remove</button>
                        <button class="btn btn-outline-primary"> Change</button>
                    </div> --}}
                </div>

            </div>

        </div>
    </div>



    <div class="card card-form">
        <div class="row no-gutters">
            <div class="col-lg-2 card-body">
                <p><strong class="headings-color">Invoices</strong></p>
                <p class="text-muted mb-0">{{ $order->invoice_number }}</p>
            </div>
            <div class="col-lg-10 card-form__body">

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Variation</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($order->items as $item)                            
                            <tr>
                                <td width="20%">{{ $item->product->name }}</td>
                                <td class="text-center">{{ $item->product_price }}$</td>
                                <td class="text-center">{{ $item->variation }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">{{ $item->discount_amount }}</td>
                                <td class="text-center">{{ $item->total_price }}$</td>
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

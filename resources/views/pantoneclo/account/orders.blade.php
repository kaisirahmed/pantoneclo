@extends('layouts.app')
@section('title','Account')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/account.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/header.css') }}">
@endsection
@section('banner')
<!-- Page Header Start -->
@include('layouts.partials.pagebanner')
@endsection
@section('content')
   <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            @include('pantoneclo.account.sidebar')
            <main class="col-md-9">
                @forelse($orders as $order)
                
                <article class="card mb-4" id="printOrders{{ $order->id }}">
                    <header class="card-header">
                        <a href="#" class="float-right" onclick="print('printOrders{{ $order->id }}')"> <i class="fa fa-print"></i> Print</a>
                        <strong class="d-inline-block mr-3">Order ID: {{ $order->order_number }}</strong>
                        <span>Order Date: {{ date("d F, Y",strtotime($order->date)) }}</span>
                    </header>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-md-8">
                                <h6 class="text-muted">Delivery to</h6>
                                <p>{{ $order->shipping()->first_name." ".$order->shipping()->last_name }}<br>  
                                Phone: {{ $order->shipping()->phone }} Email: {{ $order->shipping()->email }} <br>
                                Location: {{ $order->shipping()->street }}, {{ $order->shipping()->street2 }}, {{ ($order->shipping()->city != 0 ? $order->shipping()->city->name : '') }}, {{ $order->shipping()->state->name }}, {{ $order->shipping()->country->name }} <br> 
                                Zip Code: {{ $order->shipping()->zip }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">Payment</h6>
                                <span class="text-success">
                                    {{-- <i class="fab fa-lg fa-cc-visa"></i> --}}
                                    <i class="fab fa-fa-money" aria-hidden="true"></i>
                                    {{ $order->payment_method }}
                                </span>
                                <p>Subtotal: {{ $order->subtotal }} <br>
                                Shipping fee:  {{ $order->shipping_charge }} <br> 
                                <span class="b">Total:  ${{ $order->total }} </span>
                                </p>
                            </div>
                        </div> <!-- row.// -->
                    </div> <!-- card-body .// -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @forelse($order->items as $item)
                                <tr>
                                    <td>
                                        <img width="65" src="{{ $item->product->image }}" class="img-xs border">
                                    </td>
                                    <td> 
                                        <p class="title mb-0">{{ $item->product->name }}</p>
                                        <var class="price text-muted">USD {{ $item->product->sale_price }}</var>
                                    </td>
                                    <td> 
                                        <span>{{ $item->variation }}</span>
                                    </td>
                                    {{-- <td width="250"> <a href="#" class="btn btn-outline-primary">Track order</a> 
                                        <div class="dropdown d-inline-block">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-outline-secondary">More</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Return</a>
                                                <a href="#"  class="dropdown-item">Cancel order</a>
                                            </div>
                                        </div> <!-- dropdown.// -->
                                    </td> --}}
                                </tr>
                                @empty
                                <h5>Not Found</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- table-responsive .end// -->
                </article> <!-- card order-item .// -->
                @empty
                    <h5>Not Found</h5>
                @endforelse
                {{ $orders->links() }}
            </main> <!-- col.// -->
        </div>
    </div>
</section>
    
@endsection
@section('script')
<script>
    function print(id) {
        var divContents = document.getElementById(id).innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write('<body > <h1>Div contents are <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
@endsection
@extends('admin.layouts.index')
@section('title', 'Orders')
@section('content')
 
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> / Orders</h5>
    </div>
</div>
<div class="container page__container">
    <div class="card card-form">
        <div class="row no-gutters">
            <div class="page__heading d-flex align-items-center justify-content-between">
                <h4 class="m-0">Orders</h4>
                @include('common.message')
            </div>
            <div class="col-lg-12 card-form__body">


                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-order-date-name","js-lists-values-order-id-name","js-lists-values-customer-name"]'>
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
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-order-id-name">Order ID</a>
                                </th>
                                <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-order-date-name">Order Date</th>
                                
                                <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-customer-name">Customer</a></th>
                                <th>Quantity</th>
                                <th>Shipping Charge</th>
                                <th>Total</th>
                                <th>Shipping Date</th>  
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="staff">
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="order_check_id" value="{{ $order->id }}">
                                        <label class="custom-control-label" for="order_check_id"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td><span class="js-lists-values-order-id-name">{{ $order->order_number }}</span></td>
                                <td><span class="js-lists-values-order-date-name">{{ date("Y-m-d",strtotime($order->date)) }}</span></td>
                                <td><span class="js-lists-values-customer-name">{{ $order->user->name }}</span></td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->shipping_charge }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ date("Y-m-d",strtotime($order->shipping_date)) }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td><span class="badge badge-{{ config('orders.getStatus.'.$order->status.'.color') }}">{{ config('orders.getStatus.'.$order->status.'.label') }}</span></td>
                                <td>
                                    <div class="dropdown ml-auto">
                                        <a href="javascript:void(0)" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" style="display: none;">
                                            <a class="dropdown-item text-warning" href="{{ route('admin.orders.edit', $order->id) }}"><i class="material-icons">edit</i> Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-success" href="{{ route('admin.orders.show', $order->id) }}"><i class="material-icons">view_list</i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" type="submit" onclick="confirmDelete('{{ $order->id }}')"><i class="material-icons">delete</i> Delete</a>
                                            <form id="delete{{ $order->id }}" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: none;">
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

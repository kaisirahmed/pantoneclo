@extends('layouts.app')
@section('title','Address')
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
                <article>
                    
                    <div class="table-responsive">
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Street</td>
                                    <td>City</td>
                                    <td>State</td>
                                    <td>Country</td>
                                    <td>Zip</td>
                                    <td>Type</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addresses as $address)
                                <tr style="background-color: {{ $address->is_default == 1 ? 'azure' : 'none' }}">
                                    <td>{{ $address->first_name." ".$address->last_name }}</td>
                                    <td>{{ $address->email }}</td>
                                    <td>{{ $address->street.' '.$address->street2 }}</td>
                                    <td>{{ $address->city_id != 0 ? $address->city->name : '' }}</td>
                                    <td>{{ $address->state_id != 0 ? $address->state->name : '' }}</td>
                                    <td>{{ $address->country_id != 0 ? $address->country->name : '' }}</td>
                                    <td>{{ $address->zip }}</td>
                                    <td>{{ $address->type == 0 ? 'Billing/Shipping' : ($address->type == 1 ? 'Billing' : 'Shipping') }}</td>
                                    <td><a href="{{ route('account.address.edit',$address->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>&nbsp; 
                                        <a class="btn btn-outline-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{ $address->id }}')"><i class="fa fa-trash"></i></a>
                                        <form id="delete{{ $address->id }}" action="{{ route('account.address.destroy', $address->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $addresses->links() }}
                    </div> <!-- table-responsive .end// -->
                    <a href="{{ route('account.address.create') }}" class="btn btn-primary" >Add New</a>
                </article> <!-- card order-item .// -->
                
                
            </main> <!-- col.// -->
        </div>
    </div>
</section>
    
@endsection

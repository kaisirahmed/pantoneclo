@extends('admin.layouts.index')
@section('title', Auth::user()->superAdmin() ? 'Super Admin & all kinds of admin' : (Auth::user()->chiefAdmin() ? 'Chief Admin & Admins' : 'Admin'))
@section('content')
<div class="row">
	<div class="col-12">
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

                <a href="{{ route('admin.register') }}"><button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light float-right">+ New Admin</button></a>

                <div class="m-t-40">
                    <table id="datatable" class="display dt-responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
	                        	<th></th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Role</th>
	                            <th>Register Time</th>
	                            <th>Action</th>
	                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Role</th>
	                            <th>Register Time</th>
	                            <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($admins as $admin)
	                        <tr>
	                        	<td></td>
	                            <td>{{ $admin->name }}</td>
	                            <td>{{ $admin->email }}</td>
	                            <td>
	                            	<span class="badge badge-{{ $admin->role == 'superAdmin' ? 'orange' : 'blue-grey' }}">{{ $admin->role }}</span>
	                            </td>

	                            <td>
	                            	{{ date('d F, Y',strtotime($admin->created_at)) }}<br>{{ date('H:i a', strtotime($admin->created_at)) }}
	                            </td>

	                            <td>
	                            	<a href="{{ route('admin.edit', $admin->id) }}">
	                            		<button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
	                            	</a>

	                           
	                            	@if(Auth::user()->superAdmin())

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $admin->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
	                            	<form id="delete{{ $admin->id }}" action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display: none;">
	                                	@csrf
	                                	{{ method_field('DELETE') }}
									</form>

	                            	@endif
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

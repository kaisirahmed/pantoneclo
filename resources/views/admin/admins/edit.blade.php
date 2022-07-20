@extends('admin.layouts.index')
@section('title','Admin Edit')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
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

                        {!! Form::open([ 'method'=>'post', 'route' => ['admin.update', $admin->id], 'files' => true , 'class' => 'custom-validation']) !!}
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $admin->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $admin->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control valid" id="role" name="role" aria-required="true" aria-describedby="role" aria-invalid="false">
                                    <option value="">Please select</option>
                                    <option value="chiefAdmin" {{ $admin->role == 'chiefAdmin' ? 'selected' : '' }}>Chief Admin</option>
                                    <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
  
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Update') }}
                                </button>
                            </div>
                            
                        {{ Form::close() }}

                    </div>
                </div>
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
@endsection
@extends('admin.layouts.index')
@section('title','Register')
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

                        <form method="POST" action="{{ route('admin.register') }}" class="custom-validation">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            @if(Auth::user()->superAdmin())
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control valid" id="role" name="role" aria-required="true" aria-describedby="role" aria-invalid="false">
                                    <option value="">Please select</option>
                                    <option value="chiefAdmin">Chief Admin</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            @endif  
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="name">Permissions</label>
                                @foreach($permissions as $permission)
                                <div class="form-check">
                                  <input type="checkbox" name="names[]" value="{{ $permission->id }}">
                                  <label>{{ $permission->names }}</label>
                                </div>  
                                @endforeach
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Register') }}
                                </button>
                                <button type="reset" class="btn btn-warning">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
@endsection
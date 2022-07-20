@extends('admin.layouts.index')
@section('title','Permissions')
@section('content')
<div class="row">
	<div class="col-6">
		<div class="card">
        	<div class="card-body">
        		{!! Form::open([ 'method'=>'post', 'route' => ['admin.permissions.update', $admin->id], 'class' => 'custom-validation']) !!}
        		 	<div class="form-group">
                        <label for="adminId">Admin</label>
                        <select class="form-control valid" name="admin_id" aria-required="true" aria-describedby="admin" aria-invalid="false">
                            <option value="{{ $admin->id }}" selected="selected">{{ $admin->name }}</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Permissions</label>
                        @foreach($permissions as $permission)
                        <div class="form-check">
                          <input type="checkbox" name="names[]" value="{{ $permission->id }}" @if($admin->permissions->pluck('id')->contains($permission->id)) checked @endif }}>
                          <label>{{ $permission->names }}</label>
                        </div>  
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">
                            {{ __('Submit') }}
                        </button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
				{{ Form::close() }}
        	</div>
        </div>
    </div>
</div>
@endsection

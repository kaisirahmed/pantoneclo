@if ($message = Session::get('success'))
<div class="alert alert-soft-success d-flex align-items-center">
	<i class="material-icons mr-3">edit</i>
	<div class="text-body">
		{{ $message }} 
	</div>
</div>
@endif


@if ($message = Session::get('error'))
	<div class="alert alert-soft-danger d-flex align-items-center" role="alert">
		<i class="material-icons mr-3">error_outline</i>
		<div class="text-body">{{ $message }}</div>
	</div>
@endif


@if ($message = Session::get('warning'))
	<div class="alert alert-soft-warning d-flex align-items-center card-margin">
		<i class="material-icons mr-3">error_outline</i>
		<div class="text-body">
			{{ $message }} 
		</div>
	</div>
@endif


@if ($message = Session::get('info'))
	<div class="alert alert-soft-info d-flex align-items-center">
		<i class="material-icons mr-3">info_outline</i>
		<div class="text-body">
			{{ $message }} 
		</div>
	</div>
@endif


@if ($errors->any())
	<div class="alert alert-soft-danger d-flex align-items-center" role="alert">
		<i class="material-icons mr-3">error_outline</i>
		<div class="text-body">{!! json_encode($errors->all()) !!}</div>
	</div>
@endif
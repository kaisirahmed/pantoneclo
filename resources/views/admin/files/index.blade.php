@extends('admin.layouts.index')
@section('title', 'Files')
@section('routes')
    {{-- <a href="student-edit-account.html" class="btn btn-light ml-3"><i class="material-icons">edit</i> Edit</a> --}}
    
@endsection
@section('content')

{!! Form::open([ 'method'=>'POST', 'route' => ['admin.files.store'], 'files' => true , 'class' => 'custom-validation']) !!}
    @csrf
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center justify-content-between">
        <h5 class="m-0"><a href="{{ route('admin.dashboard') }}">Dashboard</a> / Files</h5>
        <button type="submit" class="btn btn-success ml-1">Save <i class="material-icons">account_circle</i></button>
    </div>
</div>
<div class="container page__container">
    <div class="card card-form">
        <div class="row no-gutters">
            <div class="container-fluid ">
                <div class="page__heading d-flex align-items-center justify-content-between">
                    <input type="file" name="files[]" class="btn btn-light" multiple>
                    @include('common.message')
                    @if(Session::has('limit'))
                    <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
                        <i class="material-icons mr-3">error_outline</i>
                        <div class="text-body">
                            {{ Session::get('limit') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            {{ Form::close() }}
            <div class="col-lg-12 card-form__body">

                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-category-name","js-lists-values-parent-name"]'>                  
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
                                 
                                <th>File</th> 
                                <th>
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-file-name">Name</a>
                                </th> 
                                <th>Size</th> 
                                <th>Link</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="staff">
                            @foreach ($files as $file)
                            <tr>

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="file-check" value="asdfsdafsd">
                                        <label class="custom-control-label" for="product-check"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>
                                <td><img width="50px" src="{{ asset($file->file) }}" alt="#"></td>
                                <td>

                                    <div class="media align-items-center">
                                        {{-- <div class="avatar avatar-xs mr-2">
                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div> --}}
                                        <div class="media-body">
                                            
                                            <span class="js-lists-values-file-name">{{ $file->name }}</span>

                                        </div>
                                    </div>

                                </td>
                                <td>{{ $file->size }}</td>
                                <td>
                                    <span style="display:none" id="{{ $file->id }}">{{ asset($file->file) }}</span>
                                    <button type="button" class="btn btn-light" onclick="copyToClipboard('{{ $file->id }}')">
                                        <i class="material-icons">link</i>
                                    </button>
                                </td>
                                
                                {{-- <td>&dollar;12,402</td> --}}
                                <td>
                                    <a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirmDelete('{{ $file->id }}')"><i class="material-icons">delete</i></a>
                                    <form id="delete{{ $file->id }}" action="{{ route('admin.files.destroy', $file->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-body text-center">
                        {{ $files->links() }}
                    </div>
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
  <script>
    function copyToClipboard(elementId) {

        // Create a "hidden" input
        var aux = document.createElement("input");

        // Assign it the value of the specified element
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);

        toastr.success('Link Copied');

    }
     
  </script>
@endsection

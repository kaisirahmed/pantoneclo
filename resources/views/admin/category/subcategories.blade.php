
@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}"> &nbsp;&nbsp;&nbsp;&nbsp;
        @if(!count($subcategory->subcategory))
        &nbsp;&nbsp;&nbsp;&nbsp; 
        @endif
        {{ $subcategory->name }}
    </option> 
    @if(count($subcategory->subcategory))
        @include('admin.category.subcategories', ['subcategories' => $subcategory->subcategory])
    @endif
@endforeach


@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}" @if(old('parent_id') == $category->id) selected @endif> &nbsp;&nbsp;&nbsp;&nbsp;
        @if(!count($subcategory->subcategory))
        &nbsp;&nbsp;&nbsp;&nbsp; 
        @endif
        {{ $subcategory->name }}
    </option> 
    @if(count($subcategory->subcategory))
        @include('category.subcategories', ['subcategories' => $subcategory->subcategory])
    @endif
@endforeach

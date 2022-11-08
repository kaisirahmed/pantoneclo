
@foreach($subcategories as $subcategory)
<option value="{{ $subcategory->id }}" {{ $subcategory->id == $category->parent->id ? 'selected' : '' }}> &nbsp;&nbsp;&nbsp;&nbsp;
    @if(!count($subcategory->subcategory))
    &nbsp;&nbsp;&nbsp;&nbsp; 
    @endif
    {{ $subcategory->name }}
</option> 
@if(count($subcategory->subcategory))
    @include('admin.category.editSubcategories', ['subcategories' => $subcategory->subcategory])
@endif
@endforeach


@foreach($subcategories as $subcategory)

    <li class="{{ count($subcategory->subcategory) > 0 ? 'hassubs' : '' }}">
        <a href="{{ route('category.products',$subcategory->slug) }}">{{ $subcategory->name }}</a>
        
        @if(count($subcategory->subcategory) > 0)
        <ul>
            {{-- <li class="{{ count($subcategory->subcategory) > 0 ? 'hassubs' : '' }}">
                <a href="{{ route('category.products',$subcategory->slug) }}">{{ $subcategory->name }}<i class="fa fa-chevron-right ml-auto"></i></a> --}}
                @include('layouts.partials.subcategories', ['subcategories' => $subcategory->subcategory])
            {{-- </li> --}}
        </ul>
        
        @endif
    </li>
    
@endforeach

<!-- Main Nav Menu -->

<div class="main_nav_menu ml-auto">
    <ul class="standard_dropdown main_nav_dropdown">
        <li><a href="{{ route('home') }}">Home<i class="fas fa-chevron-down"></i></a></li>
        @foreach ($categories as $category)
        <li>
            <a href="{{ route('category.products',$category->slug) }}">{{ $category->name }}</a>
        </li>
        @endforeach
    </ul>
</div>
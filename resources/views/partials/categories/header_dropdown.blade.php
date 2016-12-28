<ul id='dropdown_all_categories' class='dropdown-content'>
    @foreach($categories as $category)
        @include('partials.categories.item')
    @endforeach
</ul>
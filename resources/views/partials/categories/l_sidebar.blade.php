<ul class='categories_list bordered'>
    @foreach($categories as $category)
        @include('partials.categories.item')
    @endforeach
</ul>
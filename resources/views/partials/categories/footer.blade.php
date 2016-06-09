<ul>
    @foreach($categories as $category)
        @include('partials.categories.item', ['with_out_ico' => true])
    @endforeach
</ul>
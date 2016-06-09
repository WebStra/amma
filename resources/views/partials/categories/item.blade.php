<li>
    <a href="{{ route('view_category', ['category' => $category->slug]) }}">
        @if(! isset($with_out_ico))
            <i class="icon-grid-cube"></i>
        @endif
            {{ $category->name }}
    </a>
</li>
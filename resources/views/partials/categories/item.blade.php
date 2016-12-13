<li>
    <a href="{{ route('view_category', ['category' => $category->slug]) }}">
        @if(! isset($with_out_ico))
            {!! ($category->ico) ?  '<i class="ico_menu_" style="background:url('.str_replace("\\", "/",$category->ico).')no-repeat;"></i>' : '<i class="icon-grid-cube"></i>' !!}
        @endif
            {{ $category->name }}
    </a>
</li>
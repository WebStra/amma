<div class="col l6 m12 s12 hide-on-small-only">
    <div class="display-table links ">
        <div class="td">
            <h4>{!! $meta->getMeta('footer_menu_categories') !!}</h4>
            @include('partials.categories.footer')
        </div>
        @if(count($pages))
            <div class="td">
                <h4>{!! $meta->getMeta('footer_menu_pages') !!}</h4>
                <ul>
                    <li></li>
                    <li><a href="{{ route('contacts') }}">{!! $meta->getMeta('footer_menu_contacts') !!}</a></li>
                    <li><a href="{{ route('support') }}">{!! $meta->getMeta('footer_menu_support') !!}</a></li>

                    @foreach($pages as $page)
                        <li><a href="{{ route('show_page',['page' => $page->slug] ) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="td">
            <h4>{!! $meta->getMeta('footer_menu_colaboration') !!}</h4>
            <ul>
                <li><a href="#">{!! $meta->getMeta('footer_menu_colaborations') !!}</a></li>
            </ul>
        </div>
    </div>
</div><!-- navigation side bar -->
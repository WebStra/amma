<div class="col l6 m12 s12 hide-on-small-only">
    <div class="display-table links ">
        <div class="td">
            <h4>Categorii</h4>
            @include('partials.categories.footer')
        </div>
        @if(count($pages))
            <div class="td">
                <h4>Pagini</h4>
                <ul>
                    <li></li>
                    <li><a href="{{ route('contacts') }}">CONTACTE</a></li>
                    <li><a href="{{ route('support') }}">SUPPORT</a></li>
                    <li><a href="">DESPRE NOI</a></li>
                    @foreach($pages as $page)
                        <li><a href="{{ route('show_page',['page' => $page->slug] ) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="td">
            <h4>Colaborare</h4>
            <ul>
                <li><a href="#">Termeni si Conditii</a></li>
                <li><a href="#">Sa colaboram</a></li>
            </ul>
        </div>
    </div>
</div><!-- navigation side bar -->
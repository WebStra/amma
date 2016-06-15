<div class="partners hide-on-small-only">
    <ul class="container">
        @foreach($partners as $key => $partner)
            <li>
                <a href="{{ $partner->link }}">
                    <img src="{{ $partner->cover() }}" alt="{{ $partner->name }}">
                </a>
            </li>
        @endforeach
    </ul>
</div><!--partners-->
<div class="partners hide-on-small-only">
    <ul class="container">
        @foreach($partners as $key => $partner)
            <li>
                <a href="{{ $partner->link }}">
                    {{--todo: add images--}}
                    <img src="/assets/images/p2.png" alt="{{ $partner->name }}">
                </a>
            </li>
        @endforeach
    </ul>
</div><!--partners-->
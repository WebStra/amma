<div class="right top-bar-langs">
    {{--<!-- todo: find a way to use URL::lang_to($languages['current']->slug) -->--}}
    <span data-activates='dropdown_top-bar-langs' style="cursor: default"
       class="dropdown_top_bar"><i class="icon-{{$languages['current']->slug}}"></i>
        {{$languages['current']->title}}&nbsp;<i class="icon-la-down"></i>
    </span>
    <ul id='dropdown_top-bar-langs' class='dropdown-content'>
        @foreach($languages['other'] as $lang)
            <li>
                <a href="/{{ $lang->slug }}">
                    <i class="icon-{{$lang->slug}}"></i>&nbsp;{{$lang->title}}
                </a>
            </li>
        @endforeach
    </ul>
</div>
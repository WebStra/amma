@if(Auth::check())
    <div class="right top-bar-profile">
        <a href='{{ route('how_work')}}' data-activates='dropdown_top-bar-profile' class="dropdown_top_bar"><i class="icon-user"></i>
            {!! $meta->getMeta('top_bar_myprofile') !!} <i class="icon-la-down"></i></a>
        <ul id='dropdown_top-bar-profile' class='dropdown-content'>
            <li><a href="{{ route('logout') }}">{!! $meta->getMeta('top_bar_logout') !!}</a></li>
        </ul>
    </div>
    <div class="right">
        <a href='{{ route('create_vendor') }}'>{!! $meta->getMeta('top_bar_create_vendor') !!}</a>
    </div>

    @if(count(Auth::user()->vendors()->active()->get()))
        <div class="right">
            <span>{!! $meta->getMeta('top_bar_balance') !!}
                <span style="color: #ff6f00">{{ Auth::user()->wallet->amount }}&nbsp;MDL</span>
            </span>
        </div>
    @endif
@else
    <div class="right">
        <a href='{{ route('get_register') }}'>{!! $meta->getMeta('top_bar_register') !!}</a>
    </div>

    <div class="right">
        <a href='{{ route('get_login') }}'>{!! $meta->getMeta('top_bar_create_login') !!}</a>
    </div>
@endif
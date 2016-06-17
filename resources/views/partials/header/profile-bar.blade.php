@if(Auth::check())
    <div class="right top-bar-profile">
        <a href='#' data-activates='dropdown_top-bar-profile' class="dropdown_top_bar"><i class="icon-user"></i>
            Contul meu <i class="icon-la-down"></i></a>
        <ul id='dropdown_top-bar-profile' class='dropdown-content'>
            <li><a href="{{ route('my_vendors') }}">My Vendors</a></li>
            <li><a href="#!">Istoria cumpărăturilor</a></li>
            <li><a href="#!">Vouchere</a></li>
            <!-- <li class="divider"></li> -->
            <li><a href="#!">Produse favorite</a></li>

            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>

    <div class="right">
        <a href='{{ route('create_vendor') }}'>Create vendor</a>
    </div>
@else
    <div class="right">
        <a href='{{ route('get_register') }}'>Register</a>
    </div>

    <div class="right">
        <a href='{{ route('get_login') }}'>Login</a>
    </div>
@endif
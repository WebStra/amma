<header>
    <div class="top_bar">
        <div class="container cf">
            <div class="left"><i
                        class="icon-phone"></i>{!! $meta->getMeta('top_bar_phone') !!}  {{ settings()->getOption('contact_info::sellPhone') }}
            </div>
            <div class="left"><i
                        class="icon-pin"></i>{!! $meta->getMeta('top_bar_adress') !!}  {{ settings()->getOption('contact_info::adress') }}
            </div>
            @include('partials.header.language-bar')

            @include('partials.header.profile-bar')
        </div>
    </div>
    <div class="top_content cf">
        <div class="container">
            <div class="navbar_area cf">
                <nav class="navbar">
                    <div class="nav-wrapper">
                        <a href="{{ route('home') }}" class="brand-logo valign-wrapper left ">
                            <img src="/assets/images/logo.png" class="valign" alt="">
                        </a>
                        <ul class="left nav_wide hide-on-med-and-down">
                            <li><a href='{{ route('expire_soon_products') }}'>
                                    <span class="wrapp_badge">
                                        {!! $meta->getMeta('top_menu_offers') !!}
                                    </span>
                                </a>
                            </li>
                            <li><a href='{{ route('last_added_products') }}'>
                                    <span class="wrapp_badge">
                                        {!! $meta->getMeta('top_menu_last_added') !!}
                                        <span class="badge_top">New</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('view_blog') }}">
                                    {!! $meta->getMeta('top_menu_blog') !!}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('vendors') }}">
                                    {!! $meta->getMeta('top_menu_vendors') !!}
                                </a>
                            </li>
                        </ul>

                        <ul class="side-nav" id="mobile-navbar">
                            <li>
                                <a href='{{ route('home') }}'>
                                    {!! $meta->getMeta('top_menu_home') !!}
                                </a>
                            </li>
                            <li>
                                <a href='{{ route('expire_soon_products') }}'>
                                    <span class="wrapp_badge">
                                        {!! $meta->getMeta('top_menu_offers') !!}
                                        <span class="badge_top">New</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('view_blog') }}">
                                    {!! $meta->getMeta('top_menu_blog') !!}
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    {!! $meta->getMeta('top_menu_about') !!}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contacts') }}">
                                    {!! $meta->getMeta('top_menu_contacts') !!}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('vendors') }}">
                                    {!! $meta->getMeta('top_menu_vendors') !!}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('support') }}">
                                    {!! $meta->getMeta('top_menu_support') !!}
                                </a>
                            </li>
                            @if(count($pages))
                                @foreach($pages as $page)
                                    <li>
                                        <a href="{{ route('show_page',['page' => $page->slug] ) }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                        <a href="#" data-activates="mobile-navbar" class="button-collapse">
                            <i class="material-icons">menu</i>
                        </a>
                    </div>
                </nav>
                @if(Auth::check())
                    <?php $basket = count(Auth::user()->involved()->active()->where('type', 'buy')->get()) ?>
                    <a href="{{ route('my_involved',['type'=>'buy']) }}" class="cart btn_"><span>{{--<i class="icon-basket"></i>--}}
                            În coș ({{$basket >= 1 ? $basket : 0}}) </span></a>

                    <?php $involved = count(Auth::user()->involved()->active()->where('type', 'involve')->get()) ?>
                    <a href="{{ route('my_involved',['type'=>'involve']) }}" class="cart btn_"><span>{!! $meta->getMeta('top_menu_particip') !!}
                            ({{ $involved >= 1 ? $involved : 0 }})</span></a>
                @endif
            </div>
            <div class="top_categories row cf">
                <div class="col l3 m3 s12 wrapp_categories">
                    <a href='#' data-activates='dropdown_all_categories' class="navbar_dropdown"><i
                                class="icon-grid-line"></i>{!! $meta->getMeta('top_menu_categorii') !!}</a>
                    @include('partials.categories.header_dropdown')
                </div>
                <div class="col l9 m9 s12">
                    <form class="top_search cf" method="get">
                        <div class="form_white_area cf">
                            @include('partials.categories.search_dropdown')
                            <div class="input-field search_field">
                                <input placeholder="{!! $meta->getMeta('top_menu_search_placeholder') !!}" name="search"
                                       type="text"
                                       value="{{ (isset($_GET['search'])) ? $_GET['search'] : '' }}">
                            </div>
                        </div>
                        <div class="wrapp_submit">
                            <button type="submit">
                                <i class="icon-search"></i>
                                <span class="hide_767_down">{!! $meta->getMeta('top_menu_search') !!}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /end new header -->
</header>
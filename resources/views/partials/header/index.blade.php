<header>
    <div class="top_bar">
        <div class="container cf">
            <div class="left"><i class="icon-phone"></i> Telefon: {{ settings()->getOption('contact_info::sellPhone') }}</div>
            <div class="left"><i class="icon-pin"></i> Address: {{ settings()->getOption('contact_info::adress') }}</div>
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
                            <li><a href='{{ route('expire_soon_products') }}'><span class="wrapp_badge">OFERTE CARE EXPIRĂ <span
                                                class="badge_top">New</span></span> </a></li>
                            <li><a href="{{ route('view_blog') }}">BLOG</a></li>
                            <li><a href="{{ route('vendors') }}">VENDORS</a></li>
                        </ul>
                        <ul class="side-nav" id="mobile-navbar">
                            <li><a href='{{ route('home') }}'>ACASĂ</a></li>
                            <li><a href='{{ route('expire_soon_products') }}'><span class="wrapp_badge">OFERTE CARE EXPIRĂ <span
                                                class="badge_top">New</span></span> </a></li>
                            <li><a href="{{ route('view_blog') }}">BLOG</a></li>
                            <li><a href="">DESPRE NOI</a></li>
                            <li><a href="{{ route('contacts') }}">CONTACTE</a></li>
                            <li><a href="{{ route('vendors') }}">VENDORS</a></li>
                            <li><a href="{{ route('support') }}">SUPPORT</a></li>
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
                {{--<a href="#" class="cart btn_"><span><i class="icon-basket"></i>În coș (2) </span></a>--}}
                @if(Auth::check())
                    <?php $count = count(Auth::user()->involved()->active()->get()) ?>

                    <a href="{{ route('my_involved') }}" class="cart btn_">Particip ({{ $count >= 1 ? $count : 0 }})</a>
                @endif
            </div>
            <div class="top_categories row cf">
                <div class="col l3 m3 s12 wrapp_categories">
                    <a href='#' data-activates='dropdown_all_categories' class="navbar_dropdown"><i
                                class="icon-grid-line"></i> Categorii</a>
                    @include('partials.categories.header_dropdown')
                </div>
                <div class="col l9 m9 s12">
                    <form class="top_search cf" method="get">
                        <div class="form_white_area cf">
                            @include('partials.categories.search_dropdown')
                            <div class="input-field search_field">
                                <input placeholder="Cauta pe site" name="search" type="text"
                                       value="{{ (isset($_GET['search'])) ? $_GET['search'] : '' }}">
                            </div>
                        </div>
                        <div class="wrapp_submit">
                            <button type="submit">
                                <i class="icon-search"></i>
                                <span class="hide_767_down">Cauta</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /end new header -->
</header>
<header>
    <div class="top_bar">
        <div class="container cf">
            <div class="left"><i class="icon-phone"></i> Telefon: +373 695 24 115</div>
            <div class="left"><i class="icon-pin"></i> Address: Moldova, Chișinău str. Drumul Viilor 147</div>
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
                            <li>
                                <a href='{{ route('home') }}'>ACASĂ</a>
                                <!--      <ul id='dropdown_2' class='dropdown-content'>
                                         <li><a href="#!">INTEGRITATE</a></li>
                                         <li><a href="#!">CORUPȚIE</a></li>
                                     </ul> -->
                            </li>
                            <li><a href='#'><span class="wrapp_badge">OFERTE CARE EXPIRĂ <span
                                                class="badge_top">New</span></span> </a></li>
                            <li><a href="">OFERTE NOI</a></li>
                            <li><a href="{{ route('view_blog') }}">BLOG</a></li>
                            <li><a href="">DESPRE NOI</a></li>
                            <li><a href="">CONTACTE</a></li>

                            @if(count($pages))
                                @foreach($pages as $page)
                                    <li>
                                        <a href="{{ route('show_page',['page' => $page->slug] ) }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="side-nav" id="mobile-navbar">
                            <li><a href='#'>ACASĂ</a></li>
                            <li><a href='#'><span class="wrapp_badge">OFERTE CARE EXPIRĂ <span
                                                class="badge_top">New</span></span> </a></li>
                            <li><a href="">OFERTE NOI</a></li>
                            <li><a href="{{ route('view_blog') }}">BLOG</a></li>
                            <li><a href="">DESPRE NOI</a></li>
                            <li><a href="">CONTACTE</a></li>
                        </ul>

                        <a href="#" data-activates="mobile-navbar" class="button-collapse">
                            <i class="material-icons">menu</i>
                        </a>
                    </div>
                </nav>
                {{--<a href="#" class="cart btn_"><span><i class="icon-basket"></i>În coș (2) </span></a>--}}
                @if(Auth::check())
                    <a href="#" class="cart btn_">Particip (0)</a>
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
                                <input placeholder="Cauta pe site" name="product" type="text"
                                       value="{{ (isset($_GET['product'])) ? $_GET['product'] : '' }}">
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
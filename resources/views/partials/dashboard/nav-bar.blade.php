<div class="col l3 m5 s12">
    <div class="bordered divide-top">
        <div class="person_card styled1">
            <div class="display_flex border_bottom">
                <div class="wrapp_img">
                    <img src="/assets/images/avatar1.jpg">
                </div>
                <div class="content">
                    <h4>{{ \Auth::user()->present()->renderName() }}</h4>
                    <a href="{{ route('my_vendors') }}" class="btn_ btn_small btn_base waves-effect waves-teal f_small">My Vendors</a>
                </div>
            </div>
            <div class="buttons">
                <ul class="links_to">
                    <li><a href="#" class="active">Istoria cumpărăturilor</a></li>
                    <li><a href="#">Produse Favorite (10)</a></li>
                    <li><a href="{{ route('my_products') }}">Produsele mele (10)</a></li>
                    <li><a href="#">Vouchere (2)</a></li>
                    <li><a href="#">Setările contului</a></li>
                </ul>
            </div>
        </div>
    </div>
    {{--todo: (HIGH) rework it.--}}
    @if(request()->route()->getName() == 'my_products')
        <div class="elements bordered divide-top border_bottom">
            <div class="title">PRODUSE RECENT VIZIONATE</div>
            <div class="item product">
                <div class="display-table">
                    <div class="wrapp_img td">
                        <img src="assets/images/produs.jpg" alt="">
                    </div>
                </div>
                <h4 class="title">SONY EXPERIA BN-100</h4>
                <div class="wrapp_info">
                    <ul class="star_rating" data-rating_value="1">
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                    </ul>
                    <div class="price">
                        <div class="curent_price">8 987 Lei</div>
                        <div class="old_price">11 987 Lei</div>
                    </div>
                    <div class="stock">
                        22/50
                        <div class="progress">
                            <div class="determinate" style="width: 42%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item product">
                <div class="display-table">
                    <div class="wrapp_img td">
                        <img src="assets/images/produs.jpg" alt="">
                    </div>
                </div>
                <h4 class="title">SONY EXPERIA BN-100</h4>
                <div class="wrapp_info">
                    <ul class="star_rating" data-rating_value="1">
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                    </ul>
                    <div class="price">
                        <div class="curent_price">8 987 Lei</div>
                        <div class="old_price">11 987 Lei</div>
                    </div>
                    <div class="stock">
                        22/50
                        <div class="progress">
                            <div class="determinate" style="width: 42%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
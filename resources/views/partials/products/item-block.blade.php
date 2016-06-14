<div class="item product">
    <span class="info_label">
        <img src="/assets/images/info_corner.png">
    </span>
    <div class="display-table">
        <div class="wrapp_img with_hover td wrapp_countdown">
            <div class="countdown" data-endtime="12/12/2017">
                <span class="days">1</span>
                <span class="hours">2</span>
                <span class="minutes">3</span>
                <span class="seconds">2</span>
            </div>
            <div class="hover">
                <a href="#">
                    <i class="icon-favorite"></i>
                    Adaugă la Favorite
                </a>
                <a href="#">
                    <i class="icon-basket"></i>
                    Adaugă în coș
                </a>
            </div>
            <img src="/assets/images/produs.jpg" alt="">
        </div>
    </div>
    <h4 class="title"><a href="{{ route('view_product', ['product' => $item->id]) }}">{{ $item->name }}</a></h4>
    <div class="wrapp_info">
        <ul class="star_rating" data-rating_value="1">
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
        </ul>
        <div class="price">
            @if($item->sale > 0)
                <div class="curent_price">{{ $item->present()->renderPriceWithSale() }}</div>
                <div class="old_price">{{ $item->present()->renderPrice() }}</div>
            @else
                <div class="curent_price">{{ $item->present()->renderPrice() }}</div>
            @endif
        </div>
        <div class="stock">
            22/50
            <div class="progress">
                <div class="determinate" style="width: 42%"></div>
            </div>
        </div>
    </div>
</div>
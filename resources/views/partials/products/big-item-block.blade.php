<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        <span class="info_label">
            <img src="/assets/images/info_corner.png">
        </span>
        <div class="countdown" data-endtime="{{ $item->present()->endDate() }}">
            <span class="days">{{ $item->present()->diffEndDate()->d }}</span>
            <span class="hours">{{ $item->present()->diffEndDate()->h }}</span>
            <span class="minutes">{{ $item->present()->diffEndDate()->i }}</span>
            <span class="seconds">{{ $item->present()->diffEndDate()->s }}</span>
        </div>
        <a href="#" class=""><img src="/assets/images/produs2.jpg"></a>
    </div>
    <div class="content">
        <h4>{{ $item->present()->renderNameSimple() }}</h4>
        <ul class="star_rating" data-rating_value="4">
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
        </ul>
        <span class="small">22 păreri </span>
        <div class="price_wrapp">
            @if($item->sale > 0)
                <div class="price">{{ $item->present()->renderPriceWithSale() }}</div>
                <div class="old_price">{{ $item->present()->renderPrice() }}</div>
            @else
                <div class="price">{{ $item->present()->renderPrice() }}</div>
            @endif
        </div>
        <div class="colors cf">
            <span class="small">Culoare:</span>
            <ul>
                <li><span class="color_view"
                          style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                </li>
                <li><span class="color_view"
                          style="background-color:#e96500; border-color:#e96500;"></span>
                    Oranj(4)
                </li>
                <li><span class="color_view"
                          style="background-color:#e96500; border-color:#e96500;"></span>
                    Oranj(4)
                </li>
            </ul>
        </div>
        <div class="stock">
            42/50
            <div class="progress">
                <div class="determinate" style="width: 42%"></div>
            </div>
        </div>
    </div>
</li>
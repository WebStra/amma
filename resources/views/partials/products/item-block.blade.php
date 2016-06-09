<div class="item product">
    <span class="info_label">
        <img src="/assets/images/info_corner.png">
    </span>
    <div class="display-table">
        <div class="wrapp_img with_hover td wrapp_countdown">
            <div class="countdown" data-endtime="2/22/2016">
                <span class="days">0</span>
                <span class="hours">0</span>
                <span class="minutes">0</span>
                <span class="seconds">0</span>
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
    <h4 class="title"><a href="#">{{ $item->name }}</a></h4>
    <div class="wrapp_info">
        <ul class="star_rating" data-rating_value="1">
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
        </ul>
        <div class="price">
            <div class="curent_price">{{$item->price}} Lei</div>
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
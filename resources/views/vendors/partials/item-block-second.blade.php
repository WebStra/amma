<div class="col l4 m5 s12">
    <div class="bordered divide-top">
        <div class="block_title">DESPRE VÂNZĂTOR</div>
        <div class="person_card">
            <div class="display_flex border_bottom">
                <div class="wrapp_img">
                    <img src="{{ $item->present()->cover() }}">
                </div>
                <div class="content">
                    <h4>
                        <a href="{{ route('view_vendor', ['vendor' => $item->slug]) }}">{{ $item->present()->renderTitle()}}</a>
                    </h4>
                    <ul class="star_rating" data-rating_value="{{ ($item->likes()->count()) ? (round(0.05 * (($item->likes()->count() - $item->getLikes('dislike')->count()) / $item->likes()->count() * 100)))  : '1' }}">
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                    </ul>
                    <p class="small">{{ $item->likes()->count() }} păreri / {{  ($item->likes()->count()) ? ($item->likes()->count() - $item->getLikes('dislike')->count()) / $item->likes()->count() * 100 : '0' }} % positive </p>
                </div>
            </div>
            <div class="buttons row">
                <div class="col s12 padd_l_half">
                    <a href="#"
                       class="btn_ btn_white waves-effect waves-teal f_small right full_width">Contactează-ne</a>
                </div>
            </div>
        </div>
    </div>
</div>
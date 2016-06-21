<div class="bordered divide-top hide-on-small-only">
    <div class="block_title">DESPRE VÂNZĂTOR</div>
    <?php $vendor = $item->vendor;?>
    <div class="person_card">
        <div class="display_flex border_bottom">
            <div class="wrapp_img">
                <img src="{{ $vendor->present()->cover() }}">
            </div>
            <div class="content">
                <h4>{{ $vendor->present()->renderTitle() }}</h4>
                <ul class="star_rating" data-rating_value="4">
                    <li class="icon-star"></li>
                    <li class="icon-star"></li>
                    <li class="icon-star"></li>
                    <li class="icon-star"></li>
                    <li class="icon-star"></li>
                </ul>
                <p class="small">875 păreri / 99,9% positive</p>
            </div>
        </div>
        <div class="buttons row">
            <div class="col s6 padd_r_half">
                <a href="{{ route('view_vendor', ['vendor' => $vendor->slug]) }}" class="btn_ btn_base waves-effect waves-light f_small left full_width">Vezi
                    magazinul</a>
            </div>
            <div class="col s6 padd_l_half">
                <a href="#" class="btn_ btn_white waves-effect waves-teal f_small right full_width">Contactează-ne</a>
            </div>
        </div>
    </div>
</div>
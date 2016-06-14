@if($item->user->id == \Auth::id())
    @include('partials.dashboard.nav-bar')
@else
    <div class="col l4 m5 s12">
        <div class="bordered divide-top">
            <div class="block_title">DESPRE VÂNZĂTOR</div>
            <div class="person_card">
                <div class="display_flex border_bottom">
                    <div class="wrapp_img">
                        <img src="assets/images/avatar1.jpg">
                    </div>
                    <div class="content">
                        <h4>Numele Vânzătorului</h4>
                        <ul class="star_rating" data-rating_value="4">
                            <li class="icon-star"></li>
                            <li class="icon-star"></li>
                            <li class="icon-star"></li>
                            <li class="icon-star"></li>
                            <li class="icon-star"></li>
                        </ul>
                        <p class="small">875 păreri / 99,9% positive </p>
                    </div>
                </div>
                <div class="buttons row">
                    <div class="col s12 padd_l_half">
                        <a href="#" class="btn_ btn_white waves-effect waves-teal f_small right full_width">Contactează-ne</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
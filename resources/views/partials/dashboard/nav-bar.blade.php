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
                    <li><a href="#">Produsele mele (10)</a></li>
                    <li><a href="#">Vouchere (2)</a></li>
                    <li><a href="#">Setările contului</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
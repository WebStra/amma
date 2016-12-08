<div class="col l3 m5 s12">
    <div class="bordered divide-top">
        <div class="person_card styled1">
            <div class="display_flex border_bottom">
                <div class="wrapp_img">
                    <img src="{{  Auth::user()->present()->cover('asc', null, '/assets/images/no-avatar2.png') }}" height="53" width="55">
                </div>
                <div class="content">
                    <h4>{{ \Auth::user()->present()->renderName() }}</h4>
                    <a href="{{ route('my_vendors') }}" class="btn_ btn_small btn_base waves-effect waves-teal f_small">My Vendors</a>
                </div>
            </div>
            <div class="buttons">
                <?php $current= Route::currentRouteName();?>
                <ul class="links_to">
                    <li><a {{ $current == 'settings' ? 'class=active' : '' }} href="{{route('settings')}}">Editeaza profilul</a></li>
                    <li><a {{ $current == 'user_password' ? 'class=active' : '' }} href="{{ route('user_password') }}">Schimba parola</a></li>
                    <li><a  href="}">Notification Center</a></li>
                    <li><a  href="{{ route('support') }}">Help and Support</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col l3 m5 s12">
    <div class="bordered divide-top">
        <div class="person_card styled1">
            <div class="buttons">
                <?php $current= Route::currentRouteName();?>
                <ul class="links_to">
                    <li><a {{ $current == 'settings' ? 'class=active' : '' }} href="{{route('settings')}}">Editeaza profilul</a></li>
                    <li><a {{ $current == 'user_password' ? 'class=active' : '' }} href="{{ route('user_password') }}">Schimba parola</a></li>
                    <li><a  href="">Notification Center</a></li>
                    <li><a  href="{{ route('support') }}">Help and Support</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
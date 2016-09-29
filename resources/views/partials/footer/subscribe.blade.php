<div class="hide-on-small-only">
    <h4>Abonează-te la newsfeed</h4>
    <form class="form" method="post" action="{{route('subscribe')}}">
        <div class="input-field submit_in">
       <input placeholder="Adresa de email" name="email"  type="email" class="validate" value="{{ old('email') }}" required>
            {{csrf_field()}}
            <input type="submit" value="Aboneaza-te">
        </div>
        <p>Abonează-te pentru a primi notificări cu produse noi și reduceri.</p>
    </form>
</div><!-- Subscribe -->
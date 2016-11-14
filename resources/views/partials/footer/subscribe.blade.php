<div class="hide-on-small-only">
    <h4>{!! $meta->getMeta('footer_subscribe_title') !!}</h4>
    <form class="form" method="post" action="{{route('subscribe')}}">
        <div class="input-field submit_in">
       <input placeholder="Adresa de email" name="email"  type="email" class="validate" value="{{ old('email') }}" required>
            {{csrf_field()}}
            <input type="submit" value="{!! $meta->getMeta('footer_subscribe_button') !!}">
        </div>
        <p>{!! $meta->getMeta('footer_subscribe_message') !!}</p>
    </form>
</div><!-- Subscribe -->
<h6>{!! $meta->getMeta('footer_social_title') !!}</h6>

<ul class="social">
    @foreach($socials as $social)
        <li>
            <a href="{{ $social->link }}" class="icon-{{ $social->key }}"></a>
        </li>
    @endforeach
</ul><!-- Socials -->
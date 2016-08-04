<?php $current_url = request()->fullUrl() ?>

<ul class="social">

    @foreach(Share::load($current_url, $item->name, $item->present()->cover())->services() as $key => $social )
        <li>
            <a href="{{ Share::load($current_url, $item->name, $item->present()->cover())->$key() }}"
               onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;"
               class="icon-{{$key}}">
            </a>
        </li>
    @endforeach
</ul>
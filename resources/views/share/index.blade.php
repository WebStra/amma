<?php $current_url = request()->fullUrl() ?>

<ul class="social">
	@foreach(Share::load($current_url, $item->name)->services() as $key => $social )
		<li><a href="{{ Share::load($current_url, $item->name)->$key() }}" class="icon-{{$key}}" target="_blank"></a></li>
	@endforeach
</ul>
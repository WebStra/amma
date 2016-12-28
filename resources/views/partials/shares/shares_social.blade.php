<link rel="image_src" href="{{ $item->present()->cover() }}">
<meta property="og:url"        	content="{{ Request::fullUrl() }}" />
<meta property="og:title"      	content="{{ $item->present()->renderName() }}" />
<meta property="og:description"	content="{{ $item->description }}" />
<meta property="og:image"      	content="{{ $item->present()->cover() }}" />
<meta name="description" content="{{$item->description}}" />
<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
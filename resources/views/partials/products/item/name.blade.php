<h4 class="title">
	<a class="product_name" href="{{ route('view_product', ['product' => $item->id]) }}">{{ str_limit($item->present()->renderName(),$limit=20,$end='..') }}</a>
</h4>
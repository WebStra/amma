<h4 class="title">
	<a class="product_name" href="{{ route('view_product', ['product' => $item->id]) }}">{{ str_limit($item->name,$limit=20,$end='..') }}</a>
</h4>
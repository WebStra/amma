@if(count($products))
    @if(count($products) <= 6)
        <div class="row elements bordered pd10 styled1 no-row-margin divide-top">
            @foreach($products as $item)
                <div class="col l4 m6 s12">
                    @include('partials.products.item-block')
                </div>
            @endforeach
        </div>

        @include('partials.banners.wide')
    @else
        <?php
        list($before_banner, $after_banner) = $products->chunk(6);
        ?>
        <div class="row elements bordered pd10 styled1 no-row-margin divide-top">
            @foreach($before_banner as $item)
                <div class="col l4 m6 s12">
                    @include('partials.products.item-block')
                </div>
            @endforeach
        </div>

        @include('partials.banners.wide')

        <div class="row elements bordered pd10 styled1 no-row-margin divide-top">
            @foreach($after_banner as $item)
                <div class="col l4 m6 s12">
                    @include('partials.products.item-block')
                </div>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col l9 m12 s12">
            <div class="paginate_container">
                <div class="paginate_render">
                    {!! $products->render() !!}
                </div>
            </div>
        </div>
    </div>
@else
    <span>{{$meta->getMeta('filter-no-products-filters')}}</span>
@endif
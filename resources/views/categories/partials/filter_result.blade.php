@if(count($category->categoryables) <= 6)
    <div class="row elements bordered pd10 styled1 no-row-margin divide-top">
        @foreach($categoryable_products as $categoryable)
            <?php $item = $categoryable->categoryable ?>
            <div class="col l4 m6 s12">
                @include('partials.products.item-block')
            </div>
        @endforeach
    </div>

    @include('partials.banners.wide')
@else
    <?php
    list($before_banner, $after_banner) = $categoryable_products->chunk(6);
    ?>
    <div class="row elements bordered pd10 styled1 no-row-margin divide-top">
        @foreach($before_banner as $categoryable)
            <?php $item = $categoryable->categoryable ?>
            <div class="col l4 m6 s12">
                @include('partials.products.item-block')
            </div>
        @endforeach
    </div>

    @include('partials.banners.wide')

    <div class="row elements bordered pd10 styled1 no-row-margin divide-top">
        @foreach($after_banner as $categoryable)
            <?php $item = $categoryable->categoryable ?>
            <div class="col l4 m6 s12">
                @include('partials.products.item-block')
            </div>
        @endforeach
    </div>
@endif
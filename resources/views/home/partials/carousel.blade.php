<div class="cf row">
    <div class="col l12 m12 s12 divide-top">
        <div class="elements bordered">
            <div class="title">{{ strtoupper($name) }}</div>
            <div class="owl-carousel l-4">
                @foreach($items as $item)
                    @include('partials.products.item-block')
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="col l8 m12 s12 no_paddl_m-l hide-on-small-only">
    <div class="row">
        @foreach($banners as $banner)
            <div class="col l6 m6 s12 no_paddl_l-">
                @include('partials.banners.item')
            </div>
        @endforeach
    </div>
</div>
<div class="col l4 m6 s12  padd_l_half_m-l hide-on-med-and-down">
    @foreach($banners as $banner)
        @include('partials.banners.show', $banner)
    @endforeach
</div>
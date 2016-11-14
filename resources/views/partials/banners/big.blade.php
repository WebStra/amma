<div class="row">
    @foreach($banners as $banner)
        <div class="col l6 m6 s12 padd_r_half_m-">
            @include('partials.banners.item')
        </div>
    @endforeach
</div><!-- extended add-block -->
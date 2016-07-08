<div>
    <div id="slider" class="flexslider">
        <div class="flex-viewport" style="overflow: hidden; position: relative;">
            <ul class="slides simpleLens"
                style="width: 1000%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">

                @if(count($item->images))
                <?php $i = 1; ?>
                    @foreach($item->images()->ranked('asc')->get() as $image)
                            <li {{ ($i == 1) ? 'class="flex-active-slide"' : '' }}
                                style="width: 362px; margin-right: 0px; float: left; display: block;">
                                <img src="{{ $image->present()->image() }}" data-imagezoom="true"
                                     data-magnification="3" draggable="false">
                            </li>
                        <?php $i++ ?>
                    @endforeach
                @endif

                <!-- items mirrored twice, total of 12 -->
            </ul>
        </div>
        <ul class="flex-direction-nav">
            <li class="flex-nav-prev">
                <a class="flex-prev flex-disabled" href="#" tabindex="-1"></a>
            </li>
            <li class="flex-nav-next">
                <a class="flex-next" href="#"></a>
            </li>
        </ul>
    </div><!-- / slider images-->
    <div id="carousel" class="flexslider carousel" style="height: 107px">

        <!-- / slider thumbnails-->
        <div class="flex-viewport" style="overflow: hidden; position: relative;">
            <ul class="slides"
                style="width: 1000%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                @if(($count = count($item->images)))
                    <?php $i = 1; ?>
                    @foreach($item->images()->ranked('asc')->get() as $image)
                            <li {{ ($i == 1) ? 'class="flex-active-slide"' : '' }}
                                style="width: 111px; margin-right: 14px; float: left; display: block;">
                                <img src="{{ $image->present()->image() }}" draggable="false">
                            </li>
                        <?php $i++ ?>
                    @endforeach
                @endif
                <!-- items mirrored twice, total of 12 -->
            </ul>
        </div>
        <ul class="flex-direction-nav">
            <li class="flex-nav-prev">
                <a class="flex-prev flex-disabled" href="#" tabindex="-1"></a>
            </li>
            <li class="flex-nav-next">
                <a class="flex-next" href="#"></a>
            </li>
        </ul>
    </div><!-- carousel -->
</div><!-- slider -->
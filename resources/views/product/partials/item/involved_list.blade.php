<?php $involveds = $item->involved()->active()->get(); ?>
@if(count($involveds))
    <div class="col l3 m12 s12">
        <div class="bordered  elements">
            <div class="block_title">EI AU PROCURAT DEJA</div>

            @foreach($involveds as $involved)
                @include('product.partials.involved-block')
            @endforeach
        </div>
    </div>
@endif
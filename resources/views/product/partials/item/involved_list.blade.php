<?php $involveds = $item->involved()->active()->get(); ?>
@if(count($involveds))
    <div class="bordered  elements">
        <div class="block_title">EI AU PROCURAT DEJA</div>
        @foreach($involveds as $involved)
            @include('product.partials.involved-block')
        @endforeach
    </div>
@endif
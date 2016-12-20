<div class="group-size-color">
    <div class="size_color_sold_item overflow {{ isset($item_spec->id) ? 'saved' : '' }}" data-suite-id="{{ isset($item_spec->id) ? $item_spec->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_size') }}</span>
                <input type="text" name="spec_size[{{ isset($block_id) ? $block_id : 1 }}][size]" value="{{ isset($item_spec->size) ? $item_spec->size : '' }}" placeholder="Size">
            </div>
        </div>
        @if(isset($item_spec) && count($colors = $item_spec->specColors))
            @foreach($colors as $color)
                @include('lots.partials.form.size_color_specs')
                @break;
            @endforeach
        @else
            @include('lots.partials.form.size_color_specs')
        @endif
    </div>

    <div class="wrap_color_price">
        <div class="inner_color_price">
            @if(isset($item_spec) && count($colors = $item_spec->specColors))
                @foreach($colors as $key => $color)
                    @if($key > 0)
                        @include('lots.partials.form.color_specs')
                    @endif
                @endforeach
                <?php unset($color); ?>  
                @include('lots.partials.form.color_specs')
            @else
                @if(isset($item_spec) && count($colors = $item_spec->specColors))
                    @include('lots.partials.form.color_specs')
                @endif
            @endif
        </div>


        <div class="col l12 m12 s12">
            <label style="float: right;" class="label-add-spec-color">Add color <a onclick="loadSpecPriceColor(this); return false;" href="#add-spec-price-color">{{ $meta->getMeta('add') }}</a></label>
        </div>
    </div>
</div>

<div class="group-size-color">
    <div class="size_color_sold_item overflow {{ isset($item_spec->id) ? 'saved' : '' }}" data-suite-id="{{ isset($item_spec->id) ? $item_spec->id->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_size') }}</span>
                <input type="text" required="" name="i_spec[{{ isset($block_id) ? $block_id : 1 }}][size]" value="{{ isset($item_spec->id->size) ? $item_spec->id->size : '' }}" placeholder="Size">
            </div>
        </div>
        @if(isset($colors) && count($colors = $spec->specColors))
            @foreach($colors as $color)
                @if($loop->first)
                    @include('lots.partials.form.size_color_specs')
                @endif   
                @break;
            @endforeach
        @else
            @include('lots.partials.form.size_color_specs')
        @endif
    </div>

    <div class="wrap_color_price">
        <div class="inner_color_price">
            @if(isset($colors) && count($colors = $spec->specColors))
                @foreach($colors as $color)
                    @include('lots.partials.form.color_specs')
                @endforeach
                @include('lots.partials.form.color_specs')
            @else
                <!-- @if(isset($colors) && count($colors = $spec->specColors))
                    @include('lots.partials.form.color_specs')
                @endif -->
                @include('lots.partials.form.color_specs')
            @endif
        </div>


        <div class="col l12 m12 s12">
            <label style="float: right;" class="label-add-spec-color">Add color <a onclick="loadSpecPriceColor(this); return false;" href="#add-spec-price-color">{{ $meta->getMeta('add') }}</a></label>
        </div>
    </div>
</div>

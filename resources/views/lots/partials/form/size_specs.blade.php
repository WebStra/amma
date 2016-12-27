<div class="group-size-color">
    <div class="size_color_sold_item overflow {{ isset($item_spec->id) ? 'saved' : '' }}" data-suite-id="{{ isset($item_spec->id) ? $item_spec->id : '' }}" data-suite-spec="{{ isset($key_spec) ? $key_spec : 1 }}" data-suite-size="{{ isset($key_size) ? $key_size : 1 }}">
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_size') }}</span>
                <input type="text" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][size][{{ isset($key_size) ? $key_size : 1 }}][size]" value="{{ isset($item_spec->size) ? $item_spec->size : '' }}" placeholder="Size">

                <input type="hidden" class="js-group-size-color" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][size][{{ isset($key_size) ? $key_size : 1 }}][key]" value="{{ isset($item_spec->key) ? $item_spec->key : md5(microtime().rand()) }}"/>
            </div>
        </div>
        @if(isset($item_spec) && count($colors = $item_spec->specColors))
            @foreach($colors as $key_color => $color)
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
                @foreach($colors as $key_color => $color)
                    @if($key_color > 0)
                        @include('lots.partials.form.color_specs')
                    @endif
                @endforeach
                <?php unset($color); $key_color+=1;?>  
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

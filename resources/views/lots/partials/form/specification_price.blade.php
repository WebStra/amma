<div class="specification_suite_item overflow {{ isset($spec) ? 'saved' : '' }}" data-spec-id="{{ isset($spec) ? $spec->id : '' }}"
     data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">
    
    <div class="col l4 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('old_price') }}</span>
            <input type="text" class="old_price" required="required" name="old_price"
                   value="{{ ($product->old_price) ? : '' }}"
                   placeholder="0.00">
            @if(count($currencies))
                <span class="currency_type"
                      style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
            @endif
        </div>
    </div><!--old price-->

    <div class="col l4 s12 ">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('new_price') }}</span>
            <input type="text" required="required" class="new_price" name="price"
                   value="{{ ($product->price) ? : '' }}"
                   placeholder="0.00">
            @if(count($currencies))
                <span class="currency_type"
                      style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
            @endif
        </div>
    </div><!--new price-->

    <div class="col l4 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('sale') }}</span>
            <input type="text" class="create_sale" name="sale" placeholder="0%"
                   value="{{ ($product->sale) ? : '' }}">
            <span style="position: absolute;top:31px;right: 15px;color: #ff6f00;">%</span>
        </div>
    </div><!--sale-->


    <div class="col l4 m12 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('form_lot_size') }}</span>
            <input type="text" required="" name="i_spec[{{ $spec->id }}][size]" value="{{ ($spec->size) ? $spec->size : '' }}" placeholder="Size">
        </div>
    </div>
    <div class="col l4 m12 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('form_lot_color') }}</span>
            <div class="file-field">
                <!-- <div class="btn" {{ $spec->color_hash ? 'style="background-color:'. $spec->color_hash .'"' : '' }}></div> -->
                <button type="button" class="waves-effect waves-light btn btn-colorpicker" {{ $spec->color_hash ? 'style="background-color:'. $spec->color_hash .'"' : '' }}></button>
                <div class="file-path-wrapper">
                   <input type="text" class="input-colorpicker" name="i_spec[{{ $spec->id }}][color]" value="{{ ($spec->color_hash) ? $spec->color_hash : '' }}"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col l4 m12 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('form_lot_sold') }}</span>
            <input type="text" required="" name="i_spec[{{ $spec->id }}][sold]" value="{{ ($spec->amount) ? $spec->amount : '' }}" placeholder="0">
        </div>
    </div>




    <div class="col l6 m12 s12">
        <div class="input-field spec_name">
            <span class="label">{{ $meta->getMeta('label_name') }}</span>
            <input type="text" name="spec[{{ isset($block_id) ? $block_id : 1 }}][key]"
                   value="{{ isset($spec['key']) ? $spec['key'] : '' }}">
        </div>
    </div>

    <div class="col l5 m10 s10">
        <div class="input-field spec_value">
            <span class="label">{{ $meta->getMeta('description_spec') }}</span>
            <input type="text" name="spec[{{ isset($block_id) ? $block_id : 1 }}][value]"
                   value="{{ isset($spec['value']) ? $spec['value'] : '' }}">
        </div>
    </div>

<div class="col l1 m2 s2">
    <div class="input-field center-align"><br><a href="#remove-spec-price" onclick="removeSpecPrice(this); return false;" class="ico-remove remove-spec-price"><i class="material-icons">delete</i></a></div>
</div>
</div>

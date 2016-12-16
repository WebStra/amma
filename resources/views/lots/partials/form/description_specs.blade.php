    <div class="specification_suite_price_item overflow {{ isset($spec) ? 'saved' : '' }}" data-spec-id="{{ isset($spec) ? $spec->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">

        <div class="col l6 m12 s12">
            <div class="input-field spec_name">
                <span class="label">{{ $meta->getMeta('label_name') }}</span>
                <input type="text" name="spec_price[{{ isset($block_id) ? $block_id : 1 }}][key]"
                value="{{ isset($spec['key']) ? $spec['key'] : '' }}">
            </div>
        </div>

        <div class="col l5 m10 s10">
            <div class="input-field spec_value">
                <span class="label">{{ $meta->getMeta('description_spec') }}</span>
                <input type="text" name="spec_price[{{ isset($block_id) ? $block_id : 1 }}][value]"
                value="{{ isset($spec['value']) ? $spec['value'] : '' }}">
            </div>
        </div>

        <div class="col l1 m2 s2">
            <div class="input-field center-align"><br><a href="#remove-spec-price" onclick="removeSpecPriceDescription(this); return false;" class="ico-remove remove-spec-price"><i class="material-icons">delete</i></a></div>
        </div>

    </div>
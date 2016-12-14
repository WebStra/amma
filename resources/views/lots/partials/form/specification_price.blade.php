<div class="specification_price_item overflow {{ isset($spec) ? 'saved' : '' }}" data-spec-id="{{ isset($spec) ? $spec->id : '' }}"
     data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">
    <div class="col l12 m12 s12">
        <label style="float: right;"><a class="red-text" onclick="removeGroupPrice(this); return false;" href="#remove-group-price">Close</a></label>
    </div>
    <div class="col l4 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('old_price') }}</span>
            <input type="text" class="old_price" required="required" name="spec_price[{{ $spec->id }}][old_price]"
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
            <input type="text" required="required" class="new_price" name="spec_price[{{ $spec->id }}][new_price]"
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
            <input type="text" class="create_sale" name="spec_price[{{ $spec->id }}][sale]" placeholder="0%"
                   value="{{ ($product->sale) ? : '' }}">
            <span style="position: absolute;top:31px;right: 15px;color: #ff6f00;">%</span>
        </div>
    </div><!--sale-->

    @if(count($price_specs = $product->improvedSpecs))
        @foreach($price_specs as $price)
            @if(count($specs = $product->improvedSpecs))
                @foreach($specs as $spec)
                    @include('lots.partials.form.color_specs')
                @endforeach
            @endif
        @endforeach
    @endif

    <div class="col l12 m12 s12">
        <label style="float: right;" class="label-add-spec-color">{{ $meta->getMeta('add_specifications') }} <a onclick="loadImprovedSpec(this); return false;" href="#add-spec">{{ $meta->getMeta('add') }}</a></label>
    </div>


    <div class="specification_suite_item overflow {{ isset($spec) ? 'saved' : '' }}" data-spec-id="{{ isset($spec) ? $spec->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">

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
            <div class="input-field center-align"><br><a href="#remove-spec-price" onclick="removeSpecPrice(this); return false;" class="ico-remove remove-spec-price"><i class="material-icons">delete</i></a></div>
        </div>

    </div>

    <div class="col l12 m12 s12">
        <label style="float: right;">{{ $meta->getMeta('form_lot_add_spec_prod') }} <a onclick="loadSpec(this); return false;" href="#add-spec">{{ $meta->getMeta('add') }}</a></label>
    </div>

</div>

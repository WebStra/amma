<div class="specification_price_item overflow {{ isset($spec) ? 'saved' : '' }}" data-spec-id="{{ isset($spec) ? $spec->id : '' }}" data-suite-spec="{{ isset($key_spec) ? $key_spec : 1 }}" data-product="{{ $product->id }}">
    <div class="col l12 m12 s12">
        <label style="float: right;"><a class="red-text" onclick="removeGroupPrice(this); return false;" href="#remove-group-price">Close</a></label>
    </div>

    <div class="col l6 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('label_name') }}</span>
            <input type="text" title="{{ $meta->getMeta('label_name') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." class="iText" required="required" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][name]"
            value="{{ isset($spec->name) ? $spec->name : '' }}"
            placeholder="{{ $meta->getMeta('placeholder_product_name') }}">
            <input type="hidden" class="js-remove-group-price" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][key]" value="{{ isset($spec->key) && !empty($spec->key) ? $spec->key : md5(microtime().rand()) }}"/>
        </div>
    </div>
    <div class="col l6 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('label_unitate_masura') }}</span>
            <select name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][unit]" required class="unit iText" title="{{ $meta->getMeta('label_unitate_masura') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.">
                @foreach($units as $unit)
                    <option {{ (isset($spec->unit) && $spec->unit == $unit->id) ? 'selected' : ''}} value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col l4 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('old_price') }}</span>
            <input type="text" title="{{ $meta->getMeta('old_price') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." required="required" maxlength="9" class="old_price iText" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][old_price]"
                   value="{{ isset($spec->old_price) ? $spec->old_price : '' }}"
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
            <input type="text" title="{{ $meta->getMeta('new_price') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." required="required" maxlength="9" class="new_price iText" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][new_price]"
                   value="{{ isset($spec->new_price) ? $spec->new_price : '' }}"
                   placeholder="0.00">
            @if(count($currencies))
                <span class="currency_type" style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
            @endif
        </div>
    </div><!--new price-->

    <div class="col l4 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('sale') }}</span>
            <input type="text" title="{{ $meta->getMeta('sale') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." required="required" class="create_sale iText" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][sale]" placeholder="0%" value="{{ isset($spec->sale) ? $spec->sale : '' }}">
            <span style="position: absolute;top:31px;right: 15px;color: #ff6f00;">%</span>
        </div>
    </div><!--sale-->

    <div class="wrap_size_price">
        @if(isset($spec) && count($specs = $spec->improvedSpecs))
            @foreach($specs as $key_size => $item_spec)
                @include('lots.partials.form.size_specs')
            @endforeach
            <?php unset($item_spec); $key_size+=1;?>
            @include('lots.partials.form.size_specs')
        @else
            <?php unset($spec);?>
            @include('lots.partials.form.size_specs')
        @endif
    </div>

    <div class="col l12 m12 s12">
        <label style="float: right;" class="label-add-spec-color">{{ $meta->getMeta('add_specifications') }} <a onclick="loadImprovedSpecPrice(this); return false;" href="#add-spec">{{ $meta->getMeta('add') }}</a></label>
    </div>

    <div class="wrap_description_price">
        @if(isset($spec) && count($specs = $spec->getMetaGroup('price')))
            @foreach($specs as $key_desc => $spec)
                @include('lots.partials.form.description_specs')
            @endforeach
            <?php unset($spec); $key_desc+=1;?>
            @include('lots.partials.form.description_specs')
        @else
            <?php unset($spec);?>
            @include('lots.partials.form.description_specs')
        @endif
    </div>



    <div class="col l12 m12 s12">
        <label style="float: right;">{{ $meta->getMeta('form_lot_add_spec_prod') }} <a onclick="loadSpecPriceDescription(this); return false;" href="#add-spec-price-desc">{{ $meta->getMeta('add') }}</a></label>
    </div>

</div>

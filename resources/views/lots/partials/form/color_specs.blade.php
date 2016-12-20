<div class="color_sold_item overflow {{ isset($color->id) ? 'saved' : '' }}" data-suite-id="{{ isset($color->id) ? $color->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">

    <div class="col offset-l4 l4 m12 s12">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('form_lot_color') }}</span>
            <div class="file-field">
                <button type="button" class="waves-effect waves-light btn btn-colorpicker" {{ isset($color->color_hash) ? 'style="background-color:'. $color->color_hash .'"' : '' }}></button>
                <div class="file-path-wrapper">
                   <input type="text" class="input-colorpicker" name="spec_color[{{ isset($block_id) ? $block_id : 1 }}][color_hash]" value="{{ isset($color->color_hash) ? $color->color_hash : '' }}"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col l3 m10 s10">
        <div class="input-field">
            <span class="label">{{ $meta->getMeta('form_lot_sold') }}</span>
            <input type="text" name="spec_color[{{ isset($block_id) ? $block_id : 1 }}][amount]" value="{{ isset($color->amount) ? $color->amount : '' }}" placeholder="0">
        </div>
    </div>
    <div class="col l1 m2 s2">
        <div class="input-field center-align"><br>
            <a href="#remove-spec-pice-color" onclick="removeSpecPriceColor(this); return false;"
               class="ico-remove remove_spec_color"><i class="material-icons">delete</i></a>
        </div>
    </div>
</div>
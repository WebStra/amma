        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_color') }}</span>
                <div class="file-field colorpicker-component colorpicker-element">
                    <button type="button" class="waves-effect waves-light btn btn-colorpicker" {{ isset($color->color_hash) ? 'style=background-color:'.$color->color_hash.'' : '' }}></button>
                    <div class="file-path-wrapper">
                       <input type="text" class="input-colorpicker" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][size][{{ isset($key_size) ? $key_size : 1 }}][color][{{ isset($key_color) ? $key_color : 1 }}][color_hash]" value="{{ isset($color->color_hash) ? $color->color_hash : '' }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m10 s10">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_sold') }}</span>
                <input type="text" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][size][{{ isset($key_size) ? $key_size : 1 }}][color][{{ isset($key_color) ? $key_color : 1 }}][amount]" value="{{ isset($color->amount) ? $color->amount : '' }}" placeholder="0">
                
                <input type="hidden" name="spec_price[{{ isset($key_spec) ? $key_spec : 1 }}][size][{{ isset($key_size) ? $key_size : 1 }}][color][{{ isset($key_color) ? $key_color : 1 }}][key]" value="{{ isset($color->key) && !empty($color->key) ? $color->key : md5(microtime().rand()) }}"/>
            </div>
        </div>
        <div class="col l1 m2 s2">
            <div class="input-field center-align"><br>
                <a href="#remove-group-size-color" onclick="removeGroupSizeColor(this); return false;"
                   class="ico-remove remove_spec_color"><i class="material-icons">delete</i></a>
            </div>
        </div>
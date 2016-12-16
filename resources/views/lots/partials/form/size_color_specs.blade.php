        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_color') }}</span>
                <div class="file-field">
                    <button type="button" class="waves-effect waves-light btn btn-colorpicker" {{ isset($color->id->color_hash) ? 'style="background-color:'. $color->id->color_hash .'"' : '' }}></button>
                    <div class="file-path-wrapper">
                       <input type="text" class="input-colorpicker" name="i_spec[{{ isset($block_id) ? $block_id : 1 }}][color]" value="{{ isset($color->id->color_hash) ? $color->id->color_hash : '' }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m10 s10">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_sold') }}</span>
                <input type="text" required="" name="i_spec[{{ isset($block_id) ? $block_id : 1 }}][sold]" value="{{ isset($color->id->amount) ? $color->id->amount : '' }}" placeholder="0">
            </div>
        </div>
        <div class="col l1 m2 s2">
            <div class="input-field center-align"><br>
                <a href="#remove-group-size-color" onclick="removeGroupSizeColor(this); return false;"
                   class="ico-remove remove_spec_color"><i class="material-icons">delete</i></a>
            </div>
        </div>
<div class="wrap_size_color_sold overflow improved_specs_item" data-block="{{ $spec->id }}">
    <div class="size_color_sold_item overflow" data-suite-spec="{{ $spec->id }}">
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_size') }}</span>
                <input type="text" required="" name="i_spec[{{ $spec->id }}][size]" value="{{ ($spec->size) ? $spec->size : '' }}" placeholder="Size">
            </div>
        </div>
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_color') }}</span>
                <div class="file-field input-colorpicker">
                    <div class="btn" {{ $spec->color_hash ? 'style="background-color:'. $spec->color_hash .'"' : '' }}></div>
                    <div class="file-path-wrapper">
                        <input type="text" name="i_spec[{{ $spec->id }}][color]" value="{{ ($spec->color_hash) ? $spec->color_hash : '' }}" data-type="colorpicker" class="disabled_colorpicker"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m10 s10">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_sold') }}</span>
                <input type="text" required="" name="i_spec[{{ $spec->id }}][sold]" value="{{ ($spec->amount) ? $spec->amount : '' }}" placeholder="0">
            </div>
        </div>

        <div class="col l1 m2 s2">
            <div class="input-field center-align"><br>
                <a href="#remove-spec-color" onclick="removeImprovedSpec(this); return false;"
                   class="ico-remove remove_spec_color"><i class="material-icons">delete</i></a>
            </div>
        </div>
    </div>
</div>
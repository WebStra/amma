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
                <div class="file-field">
                    <!-- <div class="btn" {{ $spec->color_hash ? 'style="background-color:'. $spec->color_hash .'"' : '' }}></div> -->
                    <button type="button" class="waves-effect waves-light btn btn-colorpicker" {{ $spec->color_hash ? 'style="background-color:'. $spec->color_hash .'"' : '' }}></button>
                    <div class="file-path-wrapper">
                       <input type="text" class="input-colorpicker" name="i_spec[{{ $spec->id }}][color]" value="{{ ($spec->color_hash) ? $spec->color_hash : '' }}"/>
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
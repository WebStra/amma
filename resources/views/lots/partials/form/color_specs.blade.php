    <div class="size_color_sold_item overflow" data-suite-spec="{{ $item->id }}">
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_size') }}</span>
                <input type="text" required="" name="i_spec[{{ $item->id }}][size]" value="{{ ($item->size) ? $item->size : '' }}" placeholder="Size">
            </div>
        </div>
        <div class="col l4 m12 s12">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_color') }}</span>
                <div class="file-field">
                    <!-- <div class="btn" {{ $item->color_hash ? 'style="background-color:'. $item->color_hash .'"' : '' }}></div> -->
                    <button type="button" class="waves-effect waves-light btn btn-colorpicker" {{ $item->color_hash ? 'style="background-color:'. $item->color_hash .'"' : '' }}></button>
                    <div class="file-path-wrapper">
                       <input type="text" class="input-colorpicker" name="i_spec[{{ $item->id }}][color]" value="{{ ($item->color_hash) ? $item->color_hash : '' }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m10 s10">
            <div class="input-field">
                <span class="label">{{ $meta->getMeta('form_lot_sold') }}</span>
                <input type="text" required="" name="i_spec[{{ $item->id }}][sold]" value="{{ ($item->amount) ? $item->amount : '' }}" placeholder="0">
            </div>
        </div>
        <div class="col l1 m2 s2">
            <div class="input-field center-align"><br>
                <a href="#remove-spec-color" onclick="removeImprovedSpec(this); return false;"
                   class="ico-remove remove_spec_color"><i class="material-icons">delete</i></a>
            </div>
        </div>
    </div>
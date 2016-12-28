<div class="specification_suite_item overflow {{ isset($spec) ? 'saved' : '' }}" data-spec-id="{{ isset($spec) ? $spec->id : '' }}"
     data-suite-spec="{{ isset($key_spec_product) ? $key_spec_product : 1 }}">
    <div class="col l6 m12 s12">
        <div class="input-field spec_name">
            <span class="label">{{ $meta->getMeta('label_name') }}</span>
            <input type="text" name="spec[{{ isset($key_spec_product) ? $key_spec_product : 1 }}][key]"
                   value="{{ isset($spec['key']) ? $spec['key'] : '' }}">
        </div>
    </div>

    <div class="col l5 m10 s10">
        <div class="input-field spec_value">
            <span class="label">{{ $meta->getMeta('description_spec') }}</span>
            <input type="text" name="spec[{{ isset($key_spec_product) ? $key_spec_product : 1 }}][value]"
                   value="{{ isset($spec['value']) ? $spec['value'] : '' }}">
            <input type="hidden" name="spec[{{ isset($key_spec_product) ? $key_spec_product : 1 }}][key_unique]" value="{{ isset($spec['key_unique']) && !empty($spec['key_unique']) ? $spec['key_unique'] : md5(microtime().rand()) }}"/>
        </div>
    </div>

    <div class="col l1 m2 s2">
        <div class="input-field center-align"><br><a href="#remove-spec" onclick="removeSpec(this); return false;" class="ico-remove remove-spec"><i
                        class="material-icons">delete</i></a></div>
    </div>
</div>

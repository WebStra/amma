<div class="specification_suite" data-spec-id="{{ isset($spec) ? $spec->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}">
    <div class="input-field spec_name">
        <span class="label">{{ strtoupper('name') }}</span>
        <input type="text" name="spec[{{ isset($block_id) ? $block_id : 1 }}][key]" value="{{ isset($spec['key']) ? $spec['key'] : '' }}">
    </div>

    <div class="input-field spec_value">
        <span class="label">{{ strtoupper('description') }}</span>
        <input type="text" name="spec[{{ isset($block_id) ? $block_id : 1 }}][value]" value="{{ isset($spec['value']) ? $spec['value'] : '' }}">
    </div>

    <div class="input-field spec_remove remove-{{ isset($spec) ? 'added-' : '' }}spec">
        <a href="#remove-spec"><i class="icon-trash"></i></a>
    </div>
</div>
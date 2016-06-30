<div class="specification_suite" data-spec-id="{{ isset($spec) ? $spec->id : '' }}" data-suite-spec="{{ isset($block_id) ? $block_id : 1 }}" style="margin-top: 28px">
    <div class="input-field" style="float: left; width: 42%">
        <span class="label">{{ strtoupper('name') }}</span>
        <input type="text" name="spec[{{ isset($block_id) ? $block_id : 1 }}][key]" value="{{ isset($spec['key']) ? $spec['key'] : '' }}">
    </div>

    <div class="input-field" style="float: left; width: 50%; margin-left: 2%">
        <span class="label">{{ strtoupper('value') }}</span>
        <input type="text" name="spec[{{ isset($block_id) ? $block_id : 1 }}][value]" value="{{ isset($spec['value']) ? $spec['value'] : '' }}">
    </div>

    <div class="input-field remove-{{ isset($spec) ? 'added-' : '' }}spec" style="float: right; width: 4%; padding-top: 6%">
        <a href="#remove-spec"><i class="icon-trash"></i></a>
    </div>
</div>
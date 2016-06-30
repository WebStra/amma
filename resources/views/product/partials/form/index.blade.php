<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('name') }}</span>
        <input type="text" required name="name" value="{{ (old('name')) ? old('name') : $item->name }}" placeholder="Product's name">
    </div>
</div><!-- Name -->

@if(request()->route()->getName() !== 'edit_product')
    <div class="col l6 m6 s12">
        <div style="float:left; width: 60%">
            <div class="input-field" style="float: left; width: 40%">
                <span class="label">{{ strtoupper('price') }}</span>
                <input type="number" required name="price" value="{{ old('price') ? old('price') : $item->price }}" placeholder="0.00">
            </div>

            <div class="input-field" style="float:right; width: 50%">
                <span class="label">{{ strtoupper('sale') }}</span>
                {{--<input type="text" name="sale" placeholder="Add sale">--}}
                <select name="sale">
                    <option value="">0%</option>
                    <option value="2">2%</option>
                    <option value="3">3%</option>
                    @for($percent = 5; $percent <= 60; $percent = $percent + 10)
                        <?php
                        if(old('sale'))
                        {
                            $selected = old('sale') == $percent ? 'selected' : '';
                        } else {
                            $selected = $item->sale == $percent ? 'selected' : '';
                        }
                        ?>
                        <option value="{{ $percent }}" {{ $selected }}>{{ $percent }}%</option>
                    @endfor
                </select>
            </div>
        </div>

        <div id="new_price" class="input-field" style="float:right; width: 30%">
            <span class="label">{{ strtoupper('price with sale') }}</span>
            <input type="text" id="out_new_price" value="{{ $item->present()->renderPriceWithSale(true) }}" style="color: #ff6f00" readonly placeholder="0.00">
        </div>
    </div><!-- Price -->
@endif

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('categories') }}</span>

        <select name="categories[]" multiple required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div><!-- Categories -->

@if(request()->route()->getName() !== 'edit_product')
    <div class="col l6 m6 s12">
        <div class="input-field">
            <span class="label">{{ strtoupper('type') }}</span>
            <select name="type" required>
                <option value="new">New</option>
                <option value="old">Old</option>
            </select>
        </div>
    </div><!-- Type -->
@endif

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('count') }}</span>
        <input type="text" required name="count" value="{{ old('count') ? old('count') : $item->count }}" placeholder="Product's count">
    </div>
</div><!-- Count -->
<!--<div class="col l6 m6 s12">
    <div class="input-field" style="float:left; width: 45%">
        <span class="label">{{ strtoupper('published date(from)') }}</span>
        <input type="date" required name="published_date">
    </div>

    <div class="input-field" style="float:right; width: 45%">
        <span class="label">{{ strtoupper('expiration date(to)') }}</span>
        <input type="date" required name="expiration_date">
    </div>
</div>--><!-- Datetime -->
<div class="col l6 m6 s12" style="min-height: 84px">
    <div class="input-field">
        <span class="label">{{ strtoupper('colors') }}</span>
        <div id="colors_output" class="row" style="margin-left: 0; margin-right: 0; min-height: 51px;">
            @if(count($item->colors))
                @foreach($item->colors as $color)
                    <div class="col-md-1" data-color-id="{{ $color->id }}" style="width: 10%; float:left; margin-top: 5px; margin-left: 1px">
                        <div style="width: 24px; height: 24px; background-color: {{ $color->color_hash }};"></div>
                        <span class="remove_color" style="color: red; cursor: pointer;margin-left: 16%;">x</span>
                    </div>
                @endforeach
            @endif
        </div>
        <a id="add_color" class="btn" style="float: right; margin-top: 5px">Add</a>
        <input type="color" style="position:absolute; left:-9999px; top:-9999px;"
               id="colorpicker">
    </div>
</div><!-- Colors -->

<div class="col l6 m6 s12">
    <div class="specification-bundle">
        <div class="input-field">
            <span class="label">{{ strtoupper('specifications') }}</span>
        </div>
        @if(old('spec'))
            @foreach(old('spec') as $block_id => $spec)
                @include('product.partials.form.spec-item')
            @endforeach
        @else
            @if(count($specs = $item->getMetaGroup('spec')))
                @foreach($specs as $block_id => $spec)
                    @include('product.partials.form.spec-item')
                @endforeach
            @else
                @include('product.partials.form.spec-item')
            @endif
        @endif
    </div>

    <a class="btn" style="float: right" id="add_suite">Add</a>
</div><!-- Specifications -->

@section('js')
    <script src="/assets/js/dropzone.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js" type="text/javascript"></script>

    @include('product.partials.form.js')
@endsection
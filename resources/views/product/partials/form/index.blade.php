<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('name') }}</span>
        <input type="text" required name="name" value="{{ (old('name')) ? old('name') : $item->name }}"
               placeholder="Product's name">
    </div>
</div><!-- Name -->

@if(request()->route()->getName() !== 'edit_product')
<div class="col l6 m6 s12">
    <div class="product__create_price_box">
        <div class="input-field old_price">
            <span class="label">{{ strtoupper('old price') }}</span>
            <input type="text" id="old_price" required name="price" value="{{ old('price') ? old('price') : $item->price }}"
                   placeholder="0.00">
        </div>

        <div class="input-field new_price">
            <span class="label">{{ strtoupper('new price') }}</span>
            <input type="text" id="new_price" value="{{ $item->present()->renderPriceWithSale(true) }}"
                   placeholder="0.00">
        </div>
    </div>

    <div class="input-field product__create_sale">
        <span class="label">{{ strtoupper('sale') }}</span>
        <input type="text" name="sale" placeholder="0%" value="{{ old('sale') ? old('sale') : $item->present()->getSale(true) }}" readonly>
    </div>
</div><!-- Price -->
@endif

<div class="col l6 m6 s12 product_create_categories">
    <div class="input-field">
        <span class="label">{{ strtoupper('categories') }}</span>

        <select id="parent_categories" name="categories[]" required>
            @foreach($categories as $parent_category)
                <optgroup label="{{ $parent_category->present()->renderNameWithTax() }}">
                    @foreach($parent_category->categoryables()->categories()->active()->get() as $child)
                        <?php $category = $child->categoryable ?>
                        <?php
                            $selected = '';

                            if($item_cat = $item->categories && count($item->categories))
                            {
                                $selected = ($item->categories()->first()->category_id == $category->id) ? 'selected' : '';
                            }
                        ?>
                        <option value="{{ $category->id }}" {{ $selected }}>{{ $category->name }}</option>
                    @endforeach
                </optgroup>
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
        <input type="text" required name="count" value="{{ old('count') ? old('count') : $item->count }}"
               placeholder="Product's count">
    </div>
</div><!-- Count -->
<div class="col l6 m6 s12" style="min-height: 84px">
    <div class="input-field">
        <span class="label">{{ strtoupper('colors') }}</span>
        <div id="colors_output" class="row" style="margin-left: 0; margin-right: 0; min-height: 51px;">
            @if(count($item->colors))
                @foreach($item->colors as $color)
                    <div class="col-md-1" data-color-id="{{ $color->id }}"
                         style="width: 10%; float:left; margin-top: 5px; margin-left: 1px">
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
    <div class="input-field" style="float:left; width: 45%">
        <span class="label">{{ strtoupper('published date(from)') }}</span>
        <input type="date" class="datepicker-from" required name="published_date"
               value="{{ old('published_date') ? old('published_date') : $item->present()->date('published_date','Y-m-d') }}"
               data-value="{{ old('published_date') ? old('published_date') : $item->present()->date('published_date','Y-m-d') }}">
    </div>

    <div class="input-field" style="float:right; width: 45%">
        <span class="label">{{ strtoupper('expiration date(to)') }}</span>
        <input type="date" class="datepicker-to" required name="expiration_date"
               value="{{ old('expiration_date') ? old('expiration_date') : $item->present()->date('expiration_date','Y-m-d') }}"
               data-value="{{ old('expiration_date') ? old('expiration_date') : $item->present()->date('expiration_date','Y-m-d') }}">
    </div>
</div><!-- Datetime -->

<div class="col product__create_long_boxes">
    <div class="col product__add_specifications_block">
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
        <a class="btn add_spec_btn" id="add_suite">Add</a>
    </div><!-- Specifications -->
    <div class="col product__create_description">
        <div class="input-field">
            <span class="label">{{ strtoupper('description') }}</span>
            <textarea name="description">{{ old('description') ? old('description') : $item->description }}</textarea>
        </div>
    </div><!-- Description -->
</div>

@section('js')
    <script src="/assets/js/dropzone.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js" type="text/javascript"></script>

    @include('product.partials.form.js')
@endsection
<!--<div class="col l12 m12 s12">
    <div class="file-field input-field">
        <div class="wrapp_img left">
            <img src="/assets/images/no-avatar2.png" height="150" width="150">
        </div>
        <div class="left">
            <div class="btn_ btn_base input_file xsmall">
                <span>Cover Image</span>
                <input type="file" name="image" required class="avatar">
            </div>
        </div>
        <p class="left">* JPG minim 150x150px, proportie 1:1</p>
    </div>
</div> -->

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('add images') }}</span>
    </div>

    <div class="row gallery" style="margin-left: 0; margin-right: 0">
        <div class="col-md-2">
            <img src="http://kingofwallpapers.com/images/images-169.jpg" width="50">
        </div>
    </div>

    <input class="files" type="file" name="images[]" multiple>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('name') }}</span>
        <input type="text" required name="name" placeholder="Product's name">
    </div>
</div>

<div class="col l6 m6 s12">
    <div style="float:left; width: 60%">
        <div class="input-field" style="float: left; width: 40%">
            <span class="label">{{ strtoupper('price') }}</span>
            <input type="number" required name="price" placeholder="0.00">
        </div>

        <div class="input-field" style="float:right; width: 50%">
            <span class="label">{{ strtoupper('sale') }}</span>
            {{--<input type="text" name="sale" placeholder="Add sale">--}}
            <select name="sale">
                <option value="">0%</option>
                @for($percent = 5; $percent <= 60; $percent = $percent + 10)
                    <option value="{{ $percent }}">{{ $percent }}%</option>
                @endfor
            </select>
        </div>
    </div>

    <div id="new_price" class="input-field" style="float:right; width: 30%">
        <span class="label">{{ strtoupper('price with sale') }}</span>
        <input type="text" id="out_new_price" style="color: #ff6f00" readonly placeholder="0.00">
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('categories') }}</span>

        <select name="categories[]" multiple required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('type') }}</span>
        <select name="type" required>
            <option value="new">New</option>
            <option value="old">Old</option>
        </select>
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">{{ strtoupper('count') }}</span>
        <input type="text" required name="count" placeholder="Product's count">
    </div>
</div>

{{--todo: use jQueryUI, this stuff not working for Firefox browser--}}
<!--
<div class="col l6 m6 s12">
    <div class="input-field" style="float:left; width: 45%">
        <span class="label">{{ strtoupper('published date(from)') }}</span>
        <input type="date" required name="published_date">
    </div>

    <div class="input-field" style="float:right; width: 45%">
        <span class="label">{{ strtoupper('expiration date(to)') }}</span>
        <input type="date" required name="expiration_date">
    </div>
</div>
-->
<div class="col l6 m6 s12" style="min-height: 84px">
    <div class="input-field">
        <span class="label">{{ strtoupper('colors') }}</span>
        <div id="colors_output" class="row" style="margin-left: 0; margin-right: 0; min-height: 51px;"></div>
        <a id="add_color" class="btn" style="float: right; margin-top: 5px">Add</a>
        <input type="color" style="position:absolute; left:-9999px; top:-9999px;"
               id="colorpicker">
    </div>

    <input type="hidden" name="colors" value='{}'>
</div>

<div class="col l6 m6 s12">
    <div class="specification-bundle">
        <div class="input-field">
            <span class="label">{{ strtoupper('specifications') }}</span>
        </div>
        @if(old('spec'))
            @foreach(old('spec') as $block_id => $spec)
                <div class="specification_suite" data-suite-spec="1" style="margin-top: 28px">
                    <div class="input-field" style="float: left; width: 42%">
                        <span class="label">{{ strtoupper('name') }}</span>
                        <input type="text" name="spec[{{ $block_id }}][key]" value="{{ $spec['key'] }}">
                    </div>

                    <div class="input-field" style="float: left; width: 50%; margin-left: 2%">
                        <span class="label">{{ strtoupper('value') }}</span>
                        <input type="text" name="spec[{{ $block_id }}][value]" value="{{ $spec['value'] }}">
                    </div>

                    <div class="input-field remove-spec" style="float: right; width: 4%; padding-top: 6%">
                        <a href="#remove-spec"><i class="icon-trash"></i></a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="specification_suite" data-suite-spec="1" style="margin-top: 28px">
                <div class="input-field" style="float: left; width: 42%">
                    <span class="label">{{ strtoupper('name') }}</span>
                    <input type="text" name="spec[1][key]">
                </div>

                <div class="input-field" style="float: left; width: 50%; margin-left: 2%">
                    <span class="label">{{ strtoupper('value') }}</span>
                    <input type="text" name="spec[1][value]">
                </div>

                <div class="input-field remove-spec" style="float: right; width: 4%; padding-top: 6%">
                    <a href="#remove-spec"><i class="icon-trash"></i></a>
                </div>
            </div>
        @endif
    </div>

    <a class="btn" style="float: right" id="add_suite">Add</a>
</div>

@section('js')
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js" type="text/javascript"></script>
    <script src="//github.com/fyneworks/multifile/blob/master/jQuery.MultiFile.min.js" type="text/javascript" language="javascript"></script>

    <script>
        $(function() // Calculate saled price.
        {
            $('select[name=sale], input[name=price]').on('input change', function () {
                var sale = $('select[name=sale]').val();
                var price = $('input[name=price]').val();
                var output_price = $('#out_new_price');

                output_price.val(price - (price * (sale / 100)));
            });
        });

        $(function() // Add color patterns.
        {
            var output_color_wrap = $('#colors_output');
            var selected_colors = $('input[name=colors]');
            var color_input = $('#colorpicker');

            $('#add_color')
                    .on('click', function () {
                        color_input[0].click();
                    });

            color_input
                    .on('input', function () {
                        var color = $(this).val();
                        var template =
                                '<div class="col-md-1" style="width: 10%; float:left; margin-top: 5px; margin-left: 1px">' +
                                    '<div style="width: 24px; height: 24px; background-color: ' + color + '" id="color_' + color + '"></div>' +
                                    '<span ' + 'class="remove_color" data-color="' + color + '" style="color: red; cursor: pointer;margin-left: 16%;">x</span>' +
                                '</div>';

                        try {
                            var selected = JSON.parse(selected_colors.val());
                        } catch (e) {
                            var selected = {};
                        }

                        if (!selected.hasOwnProperty(color)) {
                            output_color_wrap
                                    .append(template);

                            selected[color] = color;
                            selected_colors.val(JSON.stringify(selected));
                        }
                    });

            output_color_wrap.on('click', 'span.remove_color', function (e) {
                e.preventDefault();
                var color = $(this).data('color');
                var selected = JSON.parse(selected_colors.val());

                delete selected[color]; // remove color from JSON.

                $(this)
                        .parent()
                        .remove(); // remove color preview box.

                selected_colors
                        .val(JSON.stringify(selected));
            });
        });

        $(function() // Add/remove specification
        {
            var block_id = {value: 2};

            $('#add_suite')
                    .on('click', function () {
                        $('.specification-bundle')
                                .append(getSpecSuiteTemplate(block_id.value));

                        block_id.value = block_id.value + 1;
                    });

            $('.specification-bundle')
                    .on('click', 'div.remove-spec', function () {
                        $(this).parent().remove();
                    });
        });

        function getSpecSuiteTemplate(block_id) // Get template of suite of specifications.
        {
            return '<div class="specification_suite" data-suite-spec="' + block_id + '" style="margin-top: 28px">'
                        + '<div class="input-field" style="float: left; width: 42%">'
                            + '<span class="label">{{ strtoupper('name') }}</span>'
                            + '<input type="text" name="spec[' + block_id + '][key]">'
                        + '</div>'
                        + '<div class="input-field" style="float: left; width: 50%; margin-left: 2%">'
                            + '<span class="label">{{ strtoupper('value') }}</span>'
                            + '<input type="text" name="spec[' + block_id + '][value]">'
                        + '</div>'
                        + '<div class="input-field remove-spec" style="float: right; width: 4%; padding-top: 6%">'
                            + '<a href="#remove-spec" class="remove-spec"><i class="icon-trash"></i></a>'
                        + '</div>'
                    + '</div>';
        }

        $(function() // Image gallery
        {
            $( ".gallery" ).sortable({
//                revert: true
            });

        });
    </script>
@endsection
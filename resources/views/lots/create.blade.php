@extends('layout')

@section('css')
    {{--{!!Html::style('/assets/css/dropzone.css')!!}--}}
    {!!Html::style('/assets/plugins/colorpicker/dist/css/bootstrap-colorpicker.min.css')!!}
    {!!Html::style('/assets/plugins/colorpicker/dist/css/bootstrap-colorpicker-plus.min.css')!!}
@endsection
@section('content')
    <section class="">
        <div class="container" id="lot_canvas">
            <div class="card-panel amber darken-4">
                <span class="white-text">{{ $meta->getMeta('create_lot_step_1') }}</span>
            </div>
            <div class="padding15 border lot">
                <div class="row">
                    <form method="post" action="{{ route('create_lot', [ 'lot' => $lot->id ]) }}" id="create_form_lot" class="form form-lot" enctype="multipart/form-data">
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('lot_name') }}</span>
                                <input type="text" title="{{ $meta->getMeta('lot_name') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." class="iText" required="required" name="name" value="{{ old('name') ? old('name') : $lot->present()->renderName() }}" placeholder="{{ $meta->getMeta('placeholder_lot_name') }}">
                            </div>
                        </div>
                        @if(count($categories))
                            <div class="col l6 m6 s12" id="primary_category">
                                <div class="input-field">
                                    <span class="label">{{ $meta->getMeta('category_lot') }}</span>
                                    <select class="iText browser-default" id="parent_category" name="category" required="required" title="{{ $meta->getMeta('category_lot') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.">
                                        <option value=''>{{ $meta->getMeta('label_select_category') }}</option>
                                        @foreach($categories as $category)
                                            <option data-procent="{{ $category->present()->renderTax() }}"
                                                    value="{{ $category->id }}"
                                                    {{ ($lot->category_id == $category->id) ? 'selected' : ''}}>{{ $category->present()->renderName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Categories -->
                        @else
                            <span>{{ $meta->getMeta('no_category') }}</span>
                        @endif
                        <div class="col l6 m6 s12">
                            <div class="input-field date-published">
                                <span class="label">{{ $meta->getMeta('published_date') }}</span>
                                <input type="date" class="datepicker-from iText" required="" name="public_date" value="{{ $lot->present()->getPublicDateAsString() }}"
                                       data-value="">
                                <span class="date-publish-info info-label"><i>{{ $meta->getMeta('info_label_date_publish') }}</i></span>
                            </div>
                        </div><!-- Datetime (from) -->
                        <div class="col l6 m6 s12">
                            <div class="input-field date-expiration">
                                <span class="label">{{ $meta->getMeta('expiration_date') }}</span>
                                <input type="date" class="datepicker-to iText" required="" name="expirate_date" value="{{ $lot->present()->getExpireDateAsString() }}"
                                       data-value="">
                                <br>
                                <br>
                            </div>
                        </div><!-- Datetime (to) -->

                        @if(count($currencies))
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('currency') }}</span>
                                <select name="currency" required class="browser-default currency iText">
                                    @foreach($currencies as $currency)
                                        <option data-sign="{{ $currency->sign }}" {{ ($lot->currency_id == $currency->id) ? 'selected' : ''}} data-title="{{ $currency->title }}" value="{{ $currency->id }}">{{ $currency->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- Currency -->
                        @else
                            <span>{{ $meta->getMeta('no_active_currency') }}</span>
                        @endif

                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('sum_complet') }}</span>
                                <input type="text" maxlength="9" title="{{ $meta->getMeta('sum_complet') }}" data-tooltip="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod." class="input-amount iText" required="" name="yield_amount" value="{{ old('yield_amount') ? old('yield_amount') : $lot->yield_amount }}"
                                       placeholder="0.00">
                                <span class="comision info-label"><i>{{ $meta->getMeta('label_comision').' '.settings()->getOption('site::yield_amount')}} MDL: <span class="comision-val">{{($lot->comision >= settings()->getOption('site::yield_amount'))? $lot->comision : settings()->getOption('site::yield_amount')}}</span> MDL</i></span>
                                <input type="hidden" class="js-comision" value="{{($lot->comision >= settings()->getOption('site::yield_amount'))? $lot->comision : settings()->getOption('site::yield_amount')}}" name="comision">
                                @if(count($currencies))
                                    <span class="currency_type" style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col l6 m6 s12">
                            
                            <span class="label label-delivery">{{ $meta->getMeta('label_delivery_method') }}</span>
                            @foreach($delivery as $item)
                                <input {{($lot->lotDeliveryPayment->where('method_type','delivery')->where('method_id',$item->id)->all()) ? 'checked ' : ''}}  id="delivery{{$item->id}}" type="checkbox" class="" name="method[delivery][]" value="{{$item->id}}">
                                <label for="delivery{{$item->id}}">{{$item->name}}</label>
                            @endforeach
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('description_delivery') }}</span>
                                <textarea name="description_delivery" maxlength="300" placeholder="{{ $meta->getMeta('placeholder_description_delivery') }}">{{ old('description_delivery') ? old('description_delivery') : $lot->description_delivery }}</textarea>
                            </div>
                        </div>
                        <div class="col l6 m6 s12">
                            <span class="label label-payment">{{ $meta->getMeta('label_payment_method') }}</span>
                            @foreach($payment as $item)
                                <input {{($lot->lotDeliveryPayment->where('method_type','payment')->where('method_id',$item->id)->all()) ? 'checked ' : ''}} id="payment{{$item->id}}" type="checkbox" class="" name="method[payment][]" value="{{$item->id}}">
                                <label for="payment{{$item->id}}">{{$item->name}}</label>
                            @endforeach
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('description_payment') }}</span>
                                <textarea name="description_payment" maxlength="300" placeholder="{{ $meta->getMeta('placeholder_description_payment') }}">{{ old('description_payment') ? old('description_payment') : $lot->description_payment }}</textarea>
                            </div>
                        </div>
                       <div class="col l12 m12 s12">
                           <div class="input-field">
                               <span class="label">{{ $meta->getMeta('label_description_lot') }}</span>
                               <textarea name="description" maxlength="300" placeholder="{{ $meta->getMeta('placeholder_description_lot') }}">{{ old('description') ? old('description') : $lot->description }}</textarea>
                           </div>
                       </div>
                        <div class="col l4 m6 s12 offset-l8 offset-m6 right-align-600">
                            <div class="input-field">
                                <button type="submit" id="save-lot" class="waves-effect waves-light btn save-lot"><i class="material-icons left">loop</i>{{ $meta->getMeta('form_lot_save') }}
                                </button>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>

            <div class="card-panel amber darken-4">
                <span class="white-text">{{ $meta->getMeta('create_lot_step_2') }}</span>
            </div>
            @if(count($lot->products))
                @foreach($lot->products as $product)
                    @include('lots.partials.form.product')
                @endforeach
            @endif
        </div>

        <div class="container">
            <div class="row">
                <div class="margin15">
                    <div class="col l4 m6 s12 offset-l8 offset-m6 right-align-600">
                        <a href="#add-product" class="waves-effect waves-light btn" id="lot_btn_add_product" data-action="{{ route('load_product_block_form', [ 'lot' => $lot->id ]) }}"><i
                                    class="material-icons left">library_add</i>{{ $meta->getMeta('add_product') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card-panel amber darken-4">
                <span class="white-text">{{ $meta->getMeta('create_lot_step_3') }}</span>
            </div>

            <div class="row">
                <div class="margin15">
                    <div class="col l5 m6 s12 offset-l7 offset-m6 right-align-600">
                        <button id="publish_lot" onclick="publishedLot('#create_form_lot','drafted'); return false;" class="btn amber darken-4"><i class="material-icons left">save</i>{{ $meta->getMeta('btn_save_to_draft') }}</button>
                        <button id="publish_lot" onclick="publishedLot('#create_form_lot','published'); return false;" class="btn"><i class="material-icons left">save</i>{{ $meta->getMeta('btn_publish_oferta') }}</button>
                        <p>{{ $meta->getMeta('label_lot_footer_condtion') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    {!!Html::script('/assets/plugins/moment/min/moment-with-locales.js')!!}
    {!!Html::script('/assets/plugins/pickadate/lib/translations/ro_RO.js')!!}
    {{--{!!Html::script('/assets/js/dropzone.js')!!}--}}
    {!!Html::script('/assets/plugins/colorpicker/dist/js/bootstrap-colorpicker.min.js')!!}
    {!!Html::script('/assets/plugins/colorpicker/dist/js/bootstrap-colorpicker-plus.min.js')!!}
@endsection

@section('scripts')
    @include('html.partials.js')

    <script>
$.validator.setDefaults({
       ignore: []
});
//tooltips
$(document).ready(function() {
    $.each($('select.initialized[data-tooltip]'),function() {
        var curent       = $(this);
        var data_tooltip = curent.attr('data-tooltip');
        var title        = curent.attr('title');
        curent.prevAll('input:first').attr('title', title).attr('data-tooltip', data_tooltip);
        curent.removeAttr('data-tooltip');
    });
    $.each($('[data-tooltip]'),function() {
        var curent       = $(this);
        var data_tooltip = curent.attr('data-tooltip');
        var title        = curent.attr('title');
        curent.qtip({
                 content: {
                    attr: 'data-tooltip',
                    title: title,

                     /*text: $(this_id)*/
                 },
            /*position: {
             viewport: $(window)
            },*/
            hide: {
                delay: 200,
                fixed: true, // <--- add this
                effect: function() { $(this).fadeOut(250); }
            },
            show: {
                effect: function() { $(this).fadeIn(250); }
            },
            position: {
                at: 'top center',
                my: 'bottom center',
                effect: false,
                viewport: $(window),
                target: $(this),
                adjust: {
                    method: 'flip flip'
                }
            },
            style: {
                classes: 'qtip-dark qtip-shadow',
                // tip: {
                //     corner: true,
                //     width: 10,
                //     height: 5
                // },
            }
             });
         });
});
        var category_input = '#parent_category';

        $('#lot_btn_add_product').on('click', function() // load product's block.
        {
            var url = $(this).data('action');
            var form = $('#create_form_lot');
            validateForm(form);
            if (form.valid()) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    success: function (response) {
                        if(response != 'false')
                        {
                            form.submit();
                            var formlast =  $('#lot_canvas').append(response).find('form:last');
                            $('#lot_canvas').find('.materialboxed').materialbox();
                            $('select').material_select();
                            initColor();
                            validateProduct(formlast);
                            Materialize.toast('{{ $meta->getMeta('msg_add_product') }}', 2000, 'green');
                            //var colorpicker = $('#lot_canvas').
                          


                            //$(category_input).attr('disabled', '');
                        } else {
                            alert('Select category first');

                            $(category_input).focus();
                        }
                    }
                });
            }else{
                $("html, body").animate({ scrollTop: "200px" });
                Materialize.toast('{{ $meta->getMeta('msg_save_lot') }}', 2000, 'red');

            }
        });
        function initColor(){
            var btn_colorpicker = $('.colorpicker-component');
            btn_colorpicker.colorpickerplus();
            btn_colorpicker.on('changeColor', function(e,color){
                if(color==null) {
                  //when select transparent color
                  $(this).find('input').val('#fff');
                  $(this).find('button').css('background-color', '#fff');//tranparent
                } else {
                    $(this).find('input').val(color);
                    $(this).find('button').css('background-color', color);
                }
            });
        }
        initColor();

        (function ($) // On change category save.
        {
            $('#parent_category').on('change', function(){
                var input = $(this);
                var value = input.val();

                if(value != '')
                {
                    $.ajax({
                        type: 'POST',
                        data: { category_id: value },
                        url: "{{ route('lot_select_category', [ $lot->id ]) }}",
                         success: function (response) {
                            $('.subcategories').material_select('destroy');
                            var option = '';
                            //var option = '<option value="">{{ $meta->getMeta('select_subcategory') }}</option>';
                            $.each(response.sub_category, function(index, item) {
                                 option += '<option value="'+item.id+'">'+item.name+'</option>'
                            });
                            
                            $('.subcategories').html(option).material_select();
                        }
                    });
                }
            });
        }(jQuery));

        function deleteProductBlock(btn) // On delete product.
        {
            if(confirm('Are you sure?'))
            {
                (function ($) {
                    var $this = $(btn);
                    var form = $this.parents('form');
                    var product_id = form.data('product');

                    $.ajax({
                        type: 'POST',
                        data: { product_id: product_id },
                        url: "{{ route("delete_product", [ $lot->id ]) }}",
                        success: function (response) {
                            Materialize.toast('{{ $meta->getMeta('delete_product_success') }}', 2000, 'green');
                            form.remove();
                        }
                    });
                }(jQuery));

                return;
            }

            return false;
        }

        function removeGroupPrice(group_price) // On delete product.
        {
            if(confirm('Are you sure?'))
            {
                (function ($) {
                    var $this = $(group_price);
                    var form  = $this.parents('.specification_price_item');
                    var key   = form.find('input.js-remove-group-price').val();
                    //var product_id = form.data('product');
                    $.ajax({
                        type: 'POST',
                        data: { key: key },
                        url: "{{ route("delete_group_price", [ $lot->id ]) }}",
                        success: function (response) {
                            Materialize.toast('{{ $meta->getMeta('delete_price_group_success') }}', 2000, 'green');
                            form.remove();
                        }
                    });
                }(jQuery));

                return;
            }

            return false;
        }

        $(function () // Calculate sealed price.
        {
            //var sale_zero = '0%';
            var sale_zero = '0';

            function validateSale($sale) {
                if ($sale > 0 && $sale <= 100) {
                    //return Math.round($sale).toFixed(0) + '%';
                    return parseFloat($sale.toFixed(2));
                }

                return sale_zero;
            }

            $(document).ready(function () {
                $('body').delegate("input.old_price, input.new_price, input.create_sale", "blur change", function (event) {
                    var curent_product = $(this).parents('.specification_price_item');
                    var sale      = curent_product.find('input.create_sale');
                    var old_price = curent_product.find('input.old_price');
                    var new_price = curent_product.find('input.new_price');

                    var val_sale      = parseFloat(sale.val()).toFixed(2);
                    var val_old_price = parseFloat(old_price.val()).toFixed(2);
                    var val_new_price = parseFloat(new_price.val()).toFixed(2);
                    sale.val(val_sale);
                    old_price.val(val_old_price);
                    new_price.val(val_new_price);
                    $(this).parents('form:first').valid();
                });
                $('body').delegate("input.old_price, input.new_price, input.create_sale", "keyup", function (event) {
                    var curent_product = $(this).parents('.specification_price_item');

                    var sale      = curent_product.find('input.create_sale');
                    var old_price = curent_product.find('input.old_price');
                    var new_price = curent_product.find('input.new_price');

                    var val_sale      = parseFloat(sale.val());
                    var val_old_price = parseFloat(old_price.val());
                    var val_new_price = parseFloat(new_price.val());

                    var target = $(event.target);
                    if (target.is('input.new_price') && val_new_price > val_old_price) {
                        $(this).parents('form:first').valid();
                    }
                    if (target.is("input.old_price") || target.is('input.new_price')) {
                        var diff = ((val_old_price - val_new_price) / val_old_price);

                        if (diff == 1 || diff == 0) {
                            return sale.val(sale_zero);
                        }
                        var calc = diff * 100;
                        var result = validateSale(calc);
                        sale.val(result);
                    } else if (target.is('input.create_sale')) {
                        var result =  parseFloat(val_old_price - (val_old_price / 100 * val_sale)).toFixed(2);
                        return new_price.val(result);
                    }
                    //return sale.val(result);
                });
            });
        });

        function validateProduct(form){
            $(form).validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid'
            });
            $.validator.addMethod("check_new_price", function(value, element) {
                var old_price = parseFloat($(form).find('input.old_price').val());
                var new_price = parseFloat($(form).find('input.new_price').val());
                return old_price >= new_price && new_price >= 0;
            },'AAAAAAAAAAAAAAAAA');
            $(form).find("input.create_sale").rules("add", {
                    required: true,
                    range: [0, 100]
            });
            $(form).find("input.old_price").rules("add", {
                    required: true,
                    range: [0, 100000000]
            });
            $(form).find("input.new_price").rules("add", {
                    required: true,
                    range: [0, 100000000],
                    check_new_price:true
            });
        }
        validateProduct($('form.form-product'));
        function saveProductBlock(form) // On save product.
        {
            (function ($) {
                validateProduct(form);
                var $form = $(form);
                var action = $form.attr('action');
                var canvas = $form.parent();
//                var data_old = $form.serialize();
                // !!!DO NOT USE JQUERY SELECTOR!!! instead form, it will doesn't work.
                var data = new FormData(form);
                if ($form.valid()) {
                    $.ajax({
                        type: 'POST',
                        data: data,
                        url: action,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            //canvas.html(response);
                            Materialize.toast('{{ $meta->getMeta('save_lot_success') }}', 2000, 'green');
                            //initProductElements(canvas);
                        }
                    });
                }
            }(jQuery));
        }

        function initProductElements(product_canvas)
        {
            product_canvas.find('.materialboxed').materialbox(); // zoom
//            product_canvas.find('.product_thumbs').sortable(); // sortable images

            product_canvas.find('.disabled_colorpicker')
                    .colorpicker({
                        component: '.btn',
                        format: 'hex'
                    })
                    .removeClass('disabled_colorpicker');
        }

        function loadSpec(btn) // Load specification block
        {
            var $this = $(btn);
            var form = $this.parents('form');
            var key_spec_product = 'temp'
                    + Math.floor((Math.random() * 10000) + 1)
                    + Math.random().toString(36).substring(7)
                    + Math.floor((Math.random() * 10000) + 1);

            $.ajax({
                type: 'POST',
                data: { key_spec_product: key_spec_product },
                url: "{{ route('load_spec', [ $lot ]) }}",
                success: function (view) {
                    form.find('.specification_suite_lot').append(view);
                }
            });
        }
        function loadSpecPrice(btn) // Load specification block
        {
            var $this = $(btn);
            var form = $this.parents('form');
            var product = form.data('product');
            var key_spec = 'temp'
                    + Math.floor((Math.random() * 10000) + 1)
                    + Math.random().toString(36).substring(7)
                    + Math.floor((Math.random() * 10000) + 1);

            $.ajax({
                type: 'POST',
                data: { key_spec: key_spec,product_id: product },
                url: "{{ route('load_spec_price', [ $lot ]) }}",
                success: function (view) {
                    form.find('.specification_price').append(view);
                    form.find('select').material_select();
                    initColor();
                }
            });
        }
        function loadSpecPriceDescription(btn) // Load specification block
        {
            var $this = $(btn);
            var form = $this.parents('.specification_price_item');
            var key_desc = 'temp'
                    + Math.floor((Math.random() * 10000) + 1)
                    + Math.random().toString(36).substring(7)
                    + Math.floor((Math.random() * 10000) + 1);
            var key_spec = form.data('suite-spec');
            $.ajax({
                type: 'POST',
                data: { key_spec: key_spec, key_desc: key_desc },
                url: "{{ route('load_spec_price_description', [ $lot ]) }}",
                success: function (view) {
                    form.find('.wrap_description_price').append(view);
                }
            });
        }
        function loadImprovedSpecPrice(btn)
        {
            var $btn = $(btn);
            var form = $btn.parents('.specification_price_item');
            //var product = form.data('product');
            var key_size = 'temp'
                + Math.floor((Math.random() * 10000) + 1)
                + Math.random().toString(36).substring(7)
                + Math.floor((Math.random() * 10000) + 1);

            var key_spec = form.data('suite-spec');
            $.ajax({
                type: 'POST',
                data: { key_spec: key_spec, key_size: key_size},
                url: "{{ route('load_improved_spec_price', [ $lot ]) }}",
                success: function (view) {
                    form.find('.wrap_size_price').append(view);
                    initColor();

                }
            });
        }

        function loadSpecPriceColor(btn)
        {
            var $btn = $(btn);
            var form = $btn.parents('.group-size-color');
            //var product = form.data('product');

            var key_spec = form.find('.size_color_sold_item ').data('suite-spec');
            var key_size = form.find('.size_color_sold_item ').data('suite-size');

            var key_color = 'temp'
                + Math.floor((Math.random() * 10000) + 1)
                + Math.random().toString(36).substring(7)
                + Math.floor((Math.random() * 10000) + 1);
            $.ajax({
                type: 'POST',
                data: {key_spec: key_spec, key_size: key_size, key_color: key_color},
                url: "{{ route('load_spec_price_color', [ $lot ]) }}",
                success: function (view) {
                    form.find('.inner_color_price').append(view);
                    initColor();

                }
            });
        }
        function loadImprovedSpec(btn)
        {
            var $btn = $(btn);
            var form = $btn.parents('form');
            var product = form.data('product');

            $.ajax({
                type: 'POST',
                data: { product_id: product },
                url: "{{ route('load_improved_spec', [ $lot ]) }}",
                success: function (view) {
                    form.find('.improved_specs_set').append(view);

                    var colorpicker = form.find('.disabled_colorpicker');
                    colorpicker
                            .colorpicker({
                                component: '.btn',
                                format: 'hex'
                            })
                            .removeClass('disabled_colorpicker');
                }
            });
        }

        function removeSpec(btn) // On remove spec.
        {
            var $this = $(btn);
            var block = $this.parents('.specification_suite_item');
            var product_id = block.parents('form').data('product');

            if(confirm('Remove specification ?'))
            {

                var key = block.find('input[type=hidden]').val();

                $.ajax({
                    url: "{{ route('remove-spec', [ $lot ]) }}",
                    data: { key: key, product_id: product_id },
                    method: 'post',
                    success: function () {
                        block.remove();
                        Materialize.toast('{{ $meta->getMeta('save_lot_success') }}', 2000, 'green');
                    }
                });
            }
        }
        function removeSpecPriceDescription(btn) // On remove spec.
        {

            if(confirm('Remove specification ?'))
            {
                    var $this       = $(btn);
                    var block_price = $this.parents('.specification_price_item');
                    var block       = $this.parents('.specification_suite_price_item');
                    var key         = block.find('input[type=hidden]').val();
                    var key_price   = block_price.find('input.js-remove-group-price').val();
                    $.ajax({
                        url: "{{ route('remove-spec-price-desc', [ $lot ])}}",
                        data: { key: key,key_price:key_price},
                        method: 'post',
                        success: function () {
                            block.remove();
                            Materialize.toast('{{ $meta->getMeta('delete_price_group_success') }}', 2000, 'green');
                        }
                    });
            }
        }
        function removeGroupSizeColor(btn) // On remove spec.
        {
            var $this = $(btn);
            var block = $this.parents('.group-size-color');
            //var product_id = block.parents('form').data('product');

            if(confirm('Remove group size color ?'))
            {
                    var key   = block.find('input.js-group-size-color').val();
                    $.ajax({
                        url: "{{ route('remove-group-size-color', [ $lot]) }}",
                        data: { key: key},
                        method: 'post',
                        success: function () {
                            block.remove();
                            Materialize.toast('{{ $meta->getMeta('delete_price_group_success') }}', 2000, 'green');
                        }
                    });
            }
        }
        function removeSpecPrice(btn) // On remove spec.
        {
            var $this = $(btn);
            var block = $this.parents('.specification_price_item');
            var product_id = block.parents('form').data('product');

            if(confirm('Remove specification Price?'))
            {
                    var id = block.data('spec-id');

                    $.ajax({
                        url: "{{ route('remove_product_spec_price', [ $lot->id ]) }}",
                        data: { spec_id: id, product_id: product_id },
                        method: 'post',
                        success: function () {
                            block.remove();
                            Materialize.toast('{{ $meta->getMeta('save_lot_success') }}', 2000, 'green');
                        }
                    });
            }
        }

        function removeSpecPriceColor(btn) // On remove spec.
        {
            var $this = $(btn);
            var block = $this.parents('.color_sold_item');
            //var product_id = block.parents('form').data('product');

            if(confirm('Remove specification color?'))
            {
                    var key = block.find('input[type=hidden]').val();
                    console.log(key);
                    $.ajax({
                        url: "{{ route('remove_spec_price_color', [ $lot->id ]) }}",
                        data: { key: key},
                        method: 'post',
                        success: function () {
                            block.remove();
                            Materialize.toast('{{ $meta->getMeta('delete_price_group_success') }}', 2000, 'green');
                        }
                    });
            }
        }
        function removeImprovedSpec(btn)
        {
            var $this = $(btn);
            var block = $this.parents('.improved_specs_item');
            var product_id = block.parents('form').data('product');

            if(confirm('Remove specification ?'))
            {
                var id = block.data('block');

                $.ajax({
                    url: "{{ route('remove_product_improved_spec', [ $lot->id ]) }}",
                    data: { spec_id: id, product_id: product_id },
                    method: 'post',
                    success: function () {
                        block.remove();
                    }
                });
            }
        }

        function removeImprovedSpecPrice(btn)
        {
            var $this = $(btn);
            var block = $this.parents('.size_color_sold_item');
            var product_id = block.parents('form').data('product');

            if(confirm('Remove specification ?'))
            {
                var id = block.data('block');

                $.ajax({
                    url: "{{ route('remove_product_improved_spec_price') }}",
                    //data: { spec_id: id, product_id: product_id },
                    method: 'post',
                    success: function () {
                        block.remove();
                    }
                });
            }
        }
        function uploadImages(input)
        {
            var $this = $(input);
            var product_gallery = $this.parents('.product_gallery');
            var thumbs_wrap = product_gallery.find('.product_thumbs');
            var total_file = input.files.length;
            var cover = $this.parent().find('img.cover_image_product');
//            cover_image_product
           for(var i=0;i<total_file;i++)
           {
               thumbs_wrap.append('<img src="'+URL.createObjectURL(event.target.files[i])+'" width="55" height="50" onclick="removeImage(this);return false;">');
           }
            cover.attr('src', URL.createObjectURL(event.target.files[0]));
        }

        function callUploadImages(btn, inputname)
        {
            var $this = $(btn);
            var product_gallery = $this.parents('.product_gallery');

//            product_gallery.find('input[name=' + inputname + ']').click();
            product_gallery.find('input[type=file]').click();
        }

        function removeImage(img)
        {
            if(confirm('Remove image?'))
            {
                var $img = $(img);
                var image_id = $img.data('image');
                if (typeof image_id !== typeof undefined && image_id !== false) {
                    $.ajax({
                        url: "{{ route('remove_product_image', [ $lot->id ]) }}",
                        data: { image_id: image_id },
                        method: 'post',
                        success: function () {
                            
                        }
                    });
                }
                $img.remove();

            }
        }
        function publishedLot(form,action)
        {
            var serialize = $(form).serialize()+'&action='+action;

            if(!$("#parent_category").valid()){
              $("#parent_category").prevAll('input.select-dropdown').addClass('iText error');
            }else{
                $("#parent_category").prevAll('input.select-dropdown').removeClass('iText error');
            }
            console.log(serialize);
            if ($(form).valid()) {
                $.ajax({
                    url: "{{ route('published_lot', [$lot->id]) }}",
                    data: serialize,
                    method: 'post',
                    success: function (respons) {
                        if (respons.status == 'complete') {
                            window.location.href = "{{route('my_lots')}}";
                        }else{
                            //Materialize.toast('{{ $meta->getMeta('msg_published_lot') }}', 6000, 'green');
                            window.location.href = "{{route('my_lots')}}";
                        }
                    },
                    error: function(respons){
                        // Error...
                        Materialize.toast('{{ $meta->getMeta('no_amount') }}', 3000, 'red');
                    }
                });
            }else{
                $("html, body").animate({ scrollTop: "200px" });
            }
        }

        function createLot(form) // On create product.
        {
            console.log('open modal');
            return false;
            //
        }


        function validateForm(form){
            $(form).validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid', 
                    rules:{
                        yield_amount:{
                            required: true,
                            range: [2, 1000000000],
                        }
                    }
            }); 
        }
        validateForm('#create_form_lot');

       $('#create_form_lot').submit(function(event) {
            event.preventDefault();
            current = $(this);
            var serialize = current.serialize();
            if(!$("#parent_category").valid()){
              $("#parent_category").prevAll('input.select-dropdown').addClass('iText error');
            }else{
                $("#parent_category").prevAll('input.select-dropdown').removeClass('iText error');
            }
            if (current.valid()) {
                $.ajax({
                    url: "{{ route('update_lot', [ $lot->id ]) }}",
                    data: serialize,
                    method: 'POST',
                    success: function (response) {
                        Materialize.toast('{{ $meta->getMeta('save_lot_success') }}', 3000, 'green');
                    }
                });
            }
        });
        

    </script>
@endsection
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
                    <form method="post" action="{{ route('create_lot', [ 'lot' => $lot->id ]) }}" id="create_form_lot" class="form form-lot"
                          enctype="multipart/form-data">
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('lot_name') }}</span>
                                <input type="text" class="iText" required="required" name="name" value="{{ old('name') ? old('name') : $lot->present()->renderName() }}" placeholder="{{ $meta->getMeta('placeholder_lot_name') }}">
                            </div>
                        </div>
                        @if(count($categories))
                            <div class="col l6 m6 s12" id="primary_category">
                                <div class="input-field">
                                    <span class="label">{{ $meta->getMeta('category_lot') }}</span>
                                    <select class="iText" id="parent_category"
                                            name="category" required="required">
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
                                <select name="currency" required class="currency iText">
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
                                <input type="text" class="input-amount iText" required="" name="yield_amount" value="{{ old('yield_amount') ? old('yield_amount') : $lot->yield_amount }}"
                                       placeholder="0.00">
                                <span class="comision info-label"><i>{{ $meta->getMeta('label_comision') }}: <span class="comision-val">{{$lot->comision}}</span></i></span>
                                <input type="hidden" class="js-comision" value="{{$lot->comision}}" name="comision">
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
                    <div class="col l4 m6 s12 offset-l8 offset-m6 right-align-600">
                        <button id="publish_lot" onclick="publishedLot('#create_form_lot'); return false;" class="btn"><i class="material-icons left">save</i>{{ $meta->getMeta('btn_publish_oferta') }}</button>
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
        var category_input = '#parent_category';

        $('#lot_btn_add_product').on('click', function() // load product's block.
        {
            var url = $(this).data('action');

            $.ajax({
                type: 'POST',
                url: url,
                success: function (response) {
                    if(response != 'false')
                    {
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
        });
        function initColor(){
            var btn_colorpicker = $('.btn-colorpicker');
            btn_colorpicker.colorpickerplus();
            btn_colorpicker.on('changeColor', function(e,color){
                if(color==null) {
                  //when select transparent color
                  $(this).next().find('input').val('#fff');
                  $(this).css('background-color', '#fff');//tranparent
                } else {
                    $(this).next().find('input').val(color);
                    $(this).css('background-color', color);
                }
            });
        }
        initColor();
        $("select[name=currency]").on('change', function() // change globaly currency.
        {
            var $this = $(this);

            $('span.currency_type')
                    .html($this
                            .find(':selected')
                            .data('title')
                    );
        });

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


        function validateProduct(form){
            $(form).validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid'
            });
        }
        validateProduct('form');
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
                    console.log(key);
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
//            for(var i=0;i<total_file;i++)
//            {
//                thumbs_wrap.append('<img src="'+URL.createObjectURL(event.target.files[i])+'" width="75" height="70">');
//            }

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

                $.ajax({
                    url: "{{ route('remove_product_image', [ $lot->id ]) }}",
                    data: { image_id: image_id },
                    method: 'post',
                    success: function () {
                        $img.remove();
                    }
                });
            }
        }
        function publishedLot(form)
        {
            var serialize = $(form).serialize();
            $.ajax({
                url: "{{ route('published_lot', [$lot->id]) }}",
                data: serialize,
                method: 'post',
                success: function (respons) {
                    if (respons.status == 'complete') {
                        window.location.href = "{{route('my_lots')}}";
                    }else{
                        Materialize.toast('{{ $meta->getMeta('msg_published_lot') }}', 6000, 'green');
                    }
                },
                error: function(respons){
                    // Error...
                    Materialize.toast('{{ $meta->getMeta('no_amount') }}', 3000, 'red');
                }
            });
        }

        function createLot(form) // On create product.
        {
            console.log('open modal');
            return false;
            //
        }

        $.validator.setDefaults({
               ignore: []
        });

        var form_lot = $('#create_form_lot');
        form_lot.validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid', 
        });

        form_lot.submit(function(event) {
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
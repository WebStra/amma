<script>
    function removeImageAjax($image) {
        $.ajax({
            url: "http://public.amma.md/ro/product/501/remove-image",
            data: {image_id: $image},
            method: 'post'
        });
    }

    $(function () // Upload images/dropzone form (dropzone).
    {
        Dropzone.autoDiscover = false;

        var success = '<div class="dz-success-mark">    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Check</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  </div>';
        var failed = '<div class="dz-error-mark">    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>  </div>';
        var error_msg = '<div class="dz-error-message"><span data-dz-errormessage></span></div>';
        var remove_btn = '<span data-dz-remove>remove</span>';

        var template = ''
                + '<div class="dz-preview dz-file-preview">'
                + '<div class="dz-details">'
                //+ '<div class="dz-filename"><span data-dz-name></span></div>'
                + '</div>'
                + '<div class="dz-image" style="border-radius: 0">'
                + '<img data-dz-thumbnail >'
                + '</div>'
                + failed
                + remove_btn
                + '<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>'
                + '</div>';

        var container = $('.preview-img-block');

        $("#dropzone_form")
                .dropzone({
                    maxFiles: 5,
                    previewsContainer: '#preview_container',
                    dictRemoveFile: '/file/delete',
                    init: function (file, response) {
                        this.on("success", function (file, response) {
                            var previewTemplate = $(file.previewTemplate);
                            previewTemplate.attr('id', 'item-' + response.id);
                        });
                        this.on("removedfile", function (file) {
                            var attached = $(file.previewTemplate).attr('id').split('item-')[1];

                            removeImageAjax(parseInt(attached));
                        });
                    }
                    , previewTemplate: template
                });
    });

    $(function () // Init dropzone and sortable it.
    {
        var sort_selector = $("#preview_container");

        sort_selector
                .sortable({
                    update: function (event, ui) {
                        var $this = $(this);
                        var data = $this.sortable('serialize');
                        $this.sortable("disable");

                        $.ajax({
                            data: data,
                            type: 'POST',
                            url: 'http://public.amma.md/ro/product/501/image-sort',
                            success: function (response) {
                                $this.sortable('enable');
                            }
                        });
                    }
                });
    });

    $(function () // Remove image.
    {
        $('.remove-image').on('click', function () {
            var $this = $(this);
            var item_id = $this.parent().attr('id').split("item-")[1];

            removeImageAjax(parseInt(item_id));

            $this.parent().remove();
        })
    });

    $(function () // Calculate sealed price.
    {
        //var sale_zero = '0%';
        var sale_zero = '0';

        function validateSale($sale)
        {
            if ($sale > 0)
            {
                //return Math.round($sale).toFixed(0) + '%';
                return parseFloat($sale.toFixed(2));
            }

            return sale_zero;
        }

        $(document).ready(function () {
            $(".add_product").delegate("input.old_price, input.new_price, input.create_sale", "keyup", function(event){
                var curent_product = $(this).parents('.inner_product');

                var sale          = curent_product.find('input.create_sale');
                var old_price     = curent_product.find('input.old_price');
                var new_price     = curent_product.find('input.new_price');

                var val_sale      = sale.val();
                var val_old_price = old_price.val();
                var val_new_price = new_price.val();
                var target = $( event.target );
                if (target.is( "input.old_price" ) || target.is('input.new_price')) {
                    var diff = ((val_old_price - val_new_price) / val_old_price);

                    if(diff == 1 || diff == 0)
                    {
                        return sale.val(sale_zero);
                    }
                    var calc = diff * 100;
                    var result = validateSale(calc);
                }else if(target.is('input.create_sale') && !isNaN(val_sale) && !isNaN(val_old_price)){
                    var result = validateSale(val_old_price - (val_old_price/100*val_sale));
                    return new_price.val(result);
                }

                return sale.val(result);
            });
        });
    });

    $(function () // Add color patterns.
    {
        var output_color_wrap = $('#colors_output');
        var color_input = $('#colorpicker');
        var add_btn = $('#add_color_old');

        add_btn
                .on('click', function () {
                    color_input[0].click();
                });

        color_input
                .on('input', function () {
                    var color = $(this).val();

                    $.ajax({
                        type: "POST",
                        url: "http://public.amma.md/ro/product/501/add-color",
                        data: {_token: "ZbHLBfFWcS0DZbZd35FPI90OlCoEpFo4XTiy1n54", color: color},
                        success: function (response) {
                            if (typeof response == 'object') {
                                output_color_wrap
                                        .append(
                                                '<div class="col-md-1" data-color-id="' + response.id + '" style="width: 10%; float:left; margin-top: 5px; margin-left: 1px">'
                                                + '<div style="width: 24px; height: 24px; background-color: ' + color + '"></div>'
                                                + '<span class="remove_color" style="color: red; cursor: pointer;margin-left: 16%;">x</span>'
                                                + '</div>'
                                        );
                            }
                        }
                    });
                });

        output_color_wrap.on('click', 'span.remove_color', function (e) {
            e.preventDefault();
            var color_block = $(this).parent();
            var color_id = color_block.data('color-id');

            $.ajax({
                type: "POST",
                url: "http://public.amma.md/ro/product/501/remove-color",
                data: {_token: "ZbHLBfFWcS0DZbZd35FPI90OlCoEpFo4XTiy1n54", color_id: color_id},
                success: function () {
                    color_block
                            .remove(); // remove color preview box.
                }
            });
        });
    });

    $(function () // Add/remove specification.
    {
        var key_lot     = {value: 2};
        var key_product = {value: 2};
        var key_color   = {value: 2};
        var key_size    = {value: 2};
        var key_scs     = {value: 2};
        var curent_currency     = {value: 'MDL'};

        $(".add_product").delegate(".add_suite", "click", function(){
            var curent_product = $(this).parents('.inner_product');
            if (curent_product.find('.specification_suite_item').length < 20) {
                curent_product.find('.specification_suite_lot').append(getSpecSuiteTemplateLot(key_lot.value));
                key_lot.value = key_lot.value + 1;
            }
        });

        $(".add_product").delegate(".remove-spec", "click", function(){
            $(this).parents('.specification_suite_remove').remove();
        });

        $('.input-colorpicker').colorpicker({
          component: '.btn',
          format: 'hex'
        });

        $('#btn_add_product').click(function (event) {
            if ($('.inner_product').length  < 10) {
                $('.add_product').append(addProduct(key_product.value, curent_currency.value));
                $('select').material_select('update');
                $('.input-colorpicker').colorpicker();
                $('.materialboxed').materialbox();


                $('.inner_product').last()
                    .animate({borderColor:'#26a69a'}, 1000)
                    .delay(500)
                    .animate({borderColor:'#e9e9e9'}, 2000);
                key_product.value = key_product.value + 1;
            }

        });
        $(".add_product").delegate("a.btn-remove-product", "click", function(){
            if (!confirm("Are you sure?")) return false;
            $(this).parents('.remove_product').fadeOut(500, function() { $(this).remove(); });
        });


         $(".add_product").delegate("a.add_color", "click", function(){
            var spec_color = $(this).parents('.wrap_spec_color').find('.spec_color');
            if (spec_color.find('.spec_color_item').length  < 10) {
                spec_color.append(getSpecSuiteTemplateColor(key_color.value));
                $('.input-colorpicker').colorpicker();
                key_color.value = key_color.value + 1;
            }
        });

        $(".add_product").delegate("a.add_size", "click", function(){
            var spec_size = $(this).parents('.wrap_spec_size').find('.spec_size');
            if (spec_size.find('.spec_size_item').length < 10) {
                spec_size.append(getSpecSuiteTemplateSize(key_size.value));
                key_size.value = key_size.value + 1;
            }
        });

        $(".add_product").delegate("a.add_size_color_sold", "click", function(){
            var curent_product = $(this).parents('.inner_product');
            if (curent_product.find('.size_color_sold_item').length < 10) {
                curent_product.find('.wrap_size_color_sold').append(getSpecSuiteTemplateSizeColorSold(key_scs.value));
                $('.input-colorpicker').colorpicker();
                key_scs.value = key_scs.value + 1;
            }
        });

        $(".add_product").delegate("a.clone-product", "click", function(){
            var curent_product = $(this).parents('.inner_product');
            //var clone_product = curent_product.clone();
            if ($('.inner_product').length  < 10) {
                curent_product.after(addProduct(key_product.value, curent_currency.value));
                curent_product.next().animate({borderColor:'#ff6f00'}, 1000).delay(500).animate({borderColor:'#e9e9e9'}, 2000);
                $('select').material_select('update');
                $('.input-colorpicker').colorpicker();
                $('.materialboxed').materialbox();
                key_product.value = key_product.value + 1;
            }
        });

        $(".add_product").delegate("a.remove-size-color-sold", "click", function(){
            $(this).parents('.size_color_sold_item_remove').remove();
        });

        $(".add_product").delegate("a.remove_spec_size", "click", function(){
            $(this).parents('.spec_size_item_remove').remove();
        });

        $(".add_product").delegate("a.remove_spec_color", "click", function(){
            $(this).parents('.spec_color_item_remove').remove();
        });

        $(".add_product").delegate("a.save-product", "click", function(){
            var curent_product = $(this).parents('.inner_product');
            curent_product.animate({borderColor:'#26a69a'}, 1000).delay(500).animate({borderColor:'#e9e9e9'}, 2000);
        });
        $('.currency').change(function(event) {
           var simbol = $(this).find(':selected').data('simbol');
           $('.new_price, .old_price, .input-amount').attr('placeholder', simbol);
           curent_currency.value = simbol;
        });
        

        

        /*$('.remove-added-spec')
                .on('click', function () {
                    var item = $(this).parent();
                    var id = item.data('spec-id');

                    $.ajax({
                        url: "http://public.amma.md/ro/product/501/remove-spec",
                        data: {id: id},
                        method: 'post',
                        success: function () {
                            item.remove();
                        }
                    });
                });*/
    });

    $(function (){
        $('.input-units').keyup(function(event) {
            if ($(this).val() != '') {
                $('.input-amount').attr('disabled', true);
            }else{
                $('.input-amount').removeAttr('disabled');
            }
        });
        $('.input-amount').keyup(function(event) {
            if ($(this).val() != '') {
                $('.input-units').attr('disabled', true);
            }else{
                $('.input-units').removeAttr('disabled');
            }
        });
    });

    $(function (){
        var $from = $(".datepicker-from");
        var $to = $(".datepicker-to");
        var __$from = {};
        var __$to = {};
        $from.pickadate({
            selectMonths: true,
            selectYears: 3,
            format: 'dd.mm.yyyy',
            closeOnClear: true,
            min: 1,
            onRender: function () {
                __$from = this;
            },
            onSet: function () {
                var picker = this;
               // __$to.set('min', +2);
                __$to.set('min', picker.get());
            },
            onOpen: function(){
                __$from.set('max', 30);
                //__$from.set('max', __$to.get());
            }
        });

        $to.pickadate({
            selectMonths: true,
            selectYears: 3,
            format: 'dd.mm.yyyy',
            closeOnClear: true,
            min: 1,
            onRender: function () {
                __$to = this;
            },
            onClose: function () {
                var picker = this;
                __$from.set('max', picker.get());
            },
            onOpen: function(){
                __$to.set('min', __$from.get());

            }
        });
    });

    function getSpecSuiteTemplate(block_id) // Get template of suite of specifications.
    {
        return '<div class="specification_suite" data-suite-spec="' + block_id + '">'
                + '<div class="input-field spec_name">'
                + '<span class="label">NAME</span>'
                + '<input type="text" name="spec[' + block_id + '][key]">'
                + '</div>'
                + '<div class="input-field spec_value">'
                + '<span class="label">DESCRIPTION</span>'
                + '<input type="text" name="spec[' + block_id + '][value]">'
                + '</div>'
                + '<div class="input-field">'
                + '<a href="#remove-spec" class="ico-remove remove-spec"><i class="icon-trash"></i></a>'
                + '</div>'
                + '</div>';
    }

    function getSpecSuiteTemplateLot(block_id) // Get template of suite of specifications.
    {
        return '<div class="specification_suite_item specification_suite_remove" data-suite-spec="' + block_id + '">'
                + '<div class="col l6 m12 s12">'
                + '<div class="input-field spec_name">'
                + '<span class="label">{{ strtoupper('name') }}</span>'
                + '<input type="text" name="spec[' + block_id + '][key]">'
                + '</div>'
                + '</div>'
                + '<div class="col l5 m10 s10">'
                + '<div class="input-field spec_value">'
                + '<span class="label">{{ strtoupper('description') }}</span>'
                + '<input type="text" name="spec[' + block_id + '][value]">'
                + '</div>'
                + '</div>'
                + '<div class="col l1 m2 s2">'
                + '<div class="input-field center-align"><br>'
                + '<a href="#remove-spec" class="ico-remove remove-spec"><i class="material-icons">delete</i></a>'
                + '</div>'
                + '</div>'
                + '</div>';
    }
    function addProduct(key, currency) // Get template of suite of specifications.
    {
        return '<div class="inner_product border margin15 remove_product" data-product="' + key + '">'
                + '<div class="col l4 m6 s12">'
                + '<div class="input-field">'
                + '<p>PHOTO</p>'
                + '<img class="materialboxed img-responsive" src="http://placehold.it/350x350">'
                + '</div>'
                + '</div>'
                + '<div class="col l8 m6 s12">'
                + '<div class="row">'
                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<span class="label">NAME</span>'
                + '<input type="text" required="" name="name" value="" placeholder="Product\'s name">'
                + '</div>'
                + '</div>'
                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<span class="label">{{ strtoupper('type') }}</span>'
                + '<select name="type" required>'
                + '<option value="new">New</option>'
                + '<option value="old">Old</option>'
                + '</select>'
                + '</div>'
                + '</div>'
                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<span class="label">{{ strtoupper('old price') }}</span>'
                + '<input type="text" class="old_price" required name="price" value="" placeholder="' + currency + '">'
                + '</div>'
                + '</div>'
                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<span class="label">{{ strtoupper('new price') }}</span>'
                + '<input type="text" required="" class="new_price" name="price" value="" placeholder="' + currency + '">'
                + '</div>'
                + '</div>'
                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<span class="label">{{ strtoupper('SALE') }}</span>'
                + '<input type="text" class="create_sale" name="sale" placeholder="0%" value="0">'
                + '</div>'
                + '</div>'

                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<span class="label">{{ strtoupper('Subcategories') }}</span>'
                + '<select name="subcategories[]" required>'
                + '<option value="">vvvvvvvvvvvv</option>'
                + '<option value="">vvvvvvvvvvvv</option>'
                + '</select>'
                + '</div>'
                + '</div>'

                + '</div>'
                + '<div class="row">'
                + '<div class="col l12 m12 s12">'
                + '<label>Specifications</label>'
                + '</div>'
                + '</div>'
                + '<div class="row">'
                + '<div class="specification_suite_lot">'
                + '<div class="specification_suite_item" data-suite-spec="1">'
                + '<div class="col l6 m12 s12">'
                + '<div class="input-field spec_name">'
                + '<span class="label">NAME</span>'
                + '<input type="text" name="spec[1][key]" value="">'
                + '</div>'
                + '</div>'
                + '<div class="col l6 m12 s12">'
                + '<div class="input-field spec_value">'
                + '<span class="label">DESCRIPTION</span>'
                + '<input type="text" name="spec[1][value]" value="">'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '<div class="row">'
                + '<div class="col l1 m2 s2 offset-s10 offset-l11 offset-m10 center-align">'
                + '<a href="#add-spec" class="add_spec_btn add_suite"><i class="material-icons center">library_add</i></a>'
                + '</div>'
                + '</div>'


                + '<div class="row">'

                + '<div class="wrap_size_color_sold overflow">'
                + '<div class="size_color_sold_item overflow" data-suite-spec="1">'
                + '<div class="col l4 m12 s12">'
                + '<div class="input-field">'
                + '<span class="label">Size</span>'
                + '<input type="text" required="" name="size" value="" placeholder="Size">'
                + '</div>'
                + '</div>'

                + '<div class="col l4 m12 s12">'
                + '<div class="input-field">'
                + '<span class="label">COLORS</span>'
                + '<div class="file-field input-colorpicker" data-color="#26a69a"  data-format="hex" data-component=".btn">'
                + '<div class="btn"></div>'
                + '<div class="file-path-wrapper">'
                + '<input type="text" name="color" class="" />'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'

                + '<div class="col l4 m12 s12">'
                + '<div class="input-field">'
                + '<span class="label">Sold</span>'
                + '<input type="text" required="" name="sold" value="" placeholder="0">'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'

                + '<div class="row">'
                + '<div class="col l1 m2 s2 offset-s10 offset-l11 offset-m10 center-align">'
                + '<div class="input-field">'
                + '<a href="#add-spec" class="add_spec_btn add_size_color_sold"><i class="material-icons center">library_add</i></a>'
                + '</div>'
                + '</div>'
                + '</div>'

                + '<div class="row right-align-600-992">'
                + '<div class="col l8 s12 push-l4">'
                + '<div class="row">'
                + '<div class="col l6 s12">'
                + '<div class="input-field">'
                + '<a href="#clone-product" class="clone-product waves-effect waves-light btn amber darken-4"><i class="material-icons left">view_stream</i>Clone</a>'
                + '</div>'
                + '</div>'
                + '<div class="col l6 s12 right-align-992">'
                + '<div class="input-field">'
                + '<a href="#save-product" class="waves-effect waves-light btn save-product"><i class="material-icons left">loop</i>Save</a>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'



                + '<div class="col l4 s12 pull-l8">'
                + '<div class="row">'
                + '<div class="col l12 m12 s12">'
                + '<div class="input-field">'
                + '<a href="#remove-product" class="waves-effect waves-light btn red btn-remove-product"><i class="material-icons left">delete</i>Del</a>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'

                + '</div>'
                + '</div>'
                + '</div>';
    }
    function getSpecSuiteTemplateSize(key) // Get template of suite of specifications.
    {
        return '<div class="spec_size_item overflow spec_size_item_remove" data-suite-spec="' + key + '">'
                + '<div class="col l10 m10 s10">'
                + '<div class="input-field">'
                + '<span class="label">Size</span>'
                + '<input type="text" required="" name="size[' + key + '][value]" value="" placeholder="Size">'
                + '</div>'
                + '</div>'
                + '<div class="col l2 m2 s2">'
                + '<div class="input-field center-align"><br>'
                + '<a href="#remove-spec-size" class="ico-remove remove_spec_size"><i class="material-icons">delete</i></a>'
                + '</div>'
                + '</div>'
                + '</div>';
    }

    function getSpecSuiteTemplateColor(key) // Get template of suite of specifications.
    {
        return '<div class="spec_color_item overflow spec_color_item_remove" data-suite-spec="' + key + '">'
                + '<div class="col l10 m10 s10">'
                + '<div class="input-field">'
                + '<span class="label">COLORS</span>'
                + '<div class="file-field input-colorpicker" data-color="#26a69a"  data-format="hex" data-component=".btn">'
                + '<div class="btn"></div>'
                + '<div class="file-path-wrapper">'
                + '<input type="text" name="color[' + key + '][value]" class="" />'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '<div class="col l2 m2 s2">'
                + '<div class="input-field center-align"><br>'
                + '<a href="#remove-spec-color" class="ico-remove remove_spec_color"><i class="material-icons">delete</i></a>'
                + '</div>'
                + '</div>'
                + '</div>';
    }

    function getSpecSuiteTemplateSizeColorSold(key) // Get template of suite of specifications.
    {
        return '<div class="size_color_sold_item size_color_sold_item_remove overflow" data-suite-spec="' + key + '">'
                + '<div class="col l4 m12 s12">'
                + '<div class="input-field">'
                + '<span class="label">Size</span>'
                + '<input type="text" required="" name="size" value="" placeholder="Size">'
                + '</div>'
                + '</div>'
                + '<div class="col l4 m12 s12">'
                + '<div class="input-field">'
                + '<span class="label">COLORS</span>'
                + '<div class="file-field input-colorpicker" data-color="#26a69a"  data-format="hex" data-component=".btn">'
                + '<div class="btn"></div>'
                + '<div class="file-path-wrapper">'
                + '<input type="text" name="color" class="" />'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '<div class="col l3 m10 s10">'
                + '<div class="input-field">'
                + '<span class="label">Sold</span>'
                + '<input type="text" required="" name="sold" value="" placeholder="0">'
                + '</div>'
                + '</div>'

                + '<div class="col l1 m2 s2">'
                + '<div class="input-field center-align"><br>'
                + '<a href="#remove-size-color-sold" class="ico-remove remove-size-color-sold"><i class="material-icons">delete</i></a>'
                + '</div>'
                + '</div>'
                + '</div>';
    }

</script>
<script>
    $(function () // Remove image.
    {
        $('.remove-image').on('click', function () {
            var $this = $(this);
            var item_id = $this.parent().attr('id').split("item-")[1];

            removeImageAjax(parseInt(item_id));

            $this.parent().remove();
        })
    });

    $(function () // Add/remove specification.
    {
        function sortable() {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        }

        function reInit() {
            //$('select').material_select('destroy');
            $('select').material_select();

            $('.materialboxed').materialbox();
            //$('.input-colorpicker').colorpicker();  
        }

        //sortable();
        var key_lot = {value: 2};
        var key_product = {value: 2};
        var key_color = {value: 2};
        var key_size = {value: 2};
        var key_scs = {value: 2};
        var curent_currency = {value: 'MDL'};

        $(".add_product").delegate(".add_suite", "click", function () {
            var curent_product = $(this).parents('.inner_product');
            if (curent_product.find('.specification_suite_item').length < 20) {
                curent_product.find('.specification_suite_lot').append(getSpecSuiteTemplateLot(key_lot.value));
                key_lot.value = key_lot.value + 1;
            }
        });

        $(".add_product").delegate(".remove-spec", "click", function () {
            $(this).parents('.specification_suite_remove').remove();
        });

        /*$('.input-colorpicker').colorpicker({
            component: '.btn',
            format: 'hex'
        });*/

        $('#btn_add_product').click(function (event) {
            if ($('.inner_product').length < 10) {
                $('.add_product').append(addProduct(key_product.value, curent_currency.value));
                reInit();
                //$('.input-colorpicker').colorpicker();
                //sortable();
                $('.inner_product').last()
                        .animate({borderColor: '#26a69a'}, 1000)
                        .delay(500)
                        .animate({borderColor: '#e9e9e9'}, 2000);
                key_product.value = key_product.value + 1;
            }

        });

        $(".add_product").delegate("a.add_color", "click", function () {
            var spec_color = $(this).parents('.wrap_spec_color').find('.spec_color');
            if (spec_color.find('.spec_color_item').length < 10) {
                spec_color.append(getSpecSuiteTemplateColor(key_color.value));
                //$('.input-colorpicker').colorpicker();
                key_color.value = key_color.value + 1;
            }
        });

        $(".add_product").delegate("a.add_size", "click", function () {
            var spec_size = $(this).parents('.wrap_spec_size').find('.spec_size');
            if (spec_size.find('.spec_size_item').length < 10) {
                spec_size.append(getSpecSuiteTemplateSize(key_size.value));
                key_size.value = key_size.value + 1;
            }
        });

        $(".add_product").delegate("a.add_size_color_sold", "click", function () {
            var curent_product = $(this).parents('.inner_product');
            if (curent_product.find('.size_color_sold_item').length < 10) {
                curent_product.find('.wrap_size_color_sold').append(getSpecSuiteTemplateSizeColorSold(key_scs.value));
                //$('.input-colorpicker').colorpicker();
                key_scs.value = key_scs.value + 1;
            }
        });

        $(".add_product").delegate("a.clone-product", "click", function () {
            var curent_product = $(this).parents('.inner_product');

            if ($('.inner_product').length < 10) {
                curent_product.find('select').material_select('destroy');
                //curent_product.find('.input-colorpicker').colorpicker('destroy');
                var curent_val = curent_product.find('select').val();
                var clone_product = curent_product.clone();
                curent_product.after(clone_product);
                curent_product.next().find('select').val(curent_val);
                curent_product.next().animate({borderColor: '#ff6f00'}, 1000).delay(500).animate({borderColor: '#e9e9e9'}, 2000);
                reInit();
                /*$('.input-colorpicker').colorpicker({
                    component: '.btn',
                    color: '#26a69a',
                    format: 'hex'
                });*/
                //$('.input-colorpicker').colorpicker('update');
                //sortable();
                key_product.value = key_product.value + 1;
            }
        });

        $(".add_product").delegate("a.remove-size-color-sold", "click", function () {
            $(this).parents('.size_color_sold_item_remove').remove();
        });

        $(".add_product").delegate("a.remove_spec_size", "click", function () {
            $(this).parents('.spec_size_item_remove').remove();
        });

        $(".add_product").delegate("a.remove_spec_color", "click", function () {
            $(this).parents('.spec_color_item_remove').remove();
        });

        $(".add_product").delegate("a.save-product", "click", function () {
            var curent_product = $(this).parents('.inner_product');
            curent_product.animate({borderColor: '#26a69a'}, 1000).delay(500).animate({borderColor: '#e9e9e9'}, 2000);
        });

        $("select[name=currency]").on('change', function (event) {
            $('span.currency_type').html($(this).find(':selected').data('title'));
            var simbol      = $(this).find(':selected').data('simbol');
            var procent     = $('#parent_category').find(':selected').data('procent');
            var sum         = $('input.input-amount').val();
            var currency_id = $(this).val()
            $('.new_price, .old_price, .input-amount').attr('placeholder', simbol);
            curent_currency.value = simbol;
            comisionForLot(currency_id,sum,procent);
        });

        $('input.input-amount').on('blur change keyup', function (event) {
            var procent     = $('#parent_category').find(':selected').data('procent');
            var sum         = $(this).val();
            var currency_id = $("select[name=currency]").find(':selected').val();
            comisionForLot(currency_id,sum,procent);
        });

        function comisionForLot(currency_id=null, sum, procent){
            var comision = "{{settings()->getOption('site::yield_amount')}}";
            if (!isNaN(sum)) {
                comision = sum / 100 * procent;
                if (currency_id == 1) {
                    comision *= parseFloat("{{ $usd }}");
                }else if(currency_id == 2){
                    comision *= parseFloat("{{ $eur }}");
                }
                comision = Math.round(comision).toFixed(0);
                if (comision < parseInt("{{settings()->getOption('site::yield_amount')}}")) {
                    comision = "{{settings()->getOption('site::yield_amount')}}";
                }
            }
            $('.comision-val').text(comision);
            $('.js-comision').val(comision);
        }

        $('#parent_category').on('change', function (event) {
            var procent     = $(this).find(':selected').data('procent');
            var sum         = $('input.input-amount').val();
            var currency_id = $("select[name=currency]").find(':selected').val();
            comisionForLot(currency_id,sum,procent);
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

    moment.locale('ro');
    $(function (){
        var $from   = $(".datepicker-from");
        var $to     = $(".datepicker-to");
        var __$from = {};
        var __$to   = {};
        $from.pickadate({
            selectMonths: true,
            selectYears: 2,
            format: 'dd.mm.yyyy',
            closeOnSelect: true,
            closeOnClear: true,
            //min: 1,
            today:'',
            onRender: function () {
                __$from = this;
            },
            onSet: function (ele) {
                $($from).valid();
                var picker = this;
                __$to.set('min', picker.get());
                if(ele.select){
                    picker.close();
                }
                //picker.close();
            },
            onOpen: function(){
                var min_date = 1;
                var max_date = 30;
                if (__$to.get() != '' && __$to.get() > moment().format("DD.MM.YYYY")) {
                    max_date = moment(__$to.get(), "DD.MM.YYYY").add(-1, 'days').format('L');
                }
                __$from.set('min', min_date);
                __$from.set('max', max_date);
               // __$from.set('max', moment().add(1, 'days').add(1, 'month').locale('ro').format('L'));
                //__$from.set('max', __$to.get());
            },
            onClose: function() {
                $(document.activeElement).blur()
            }
        });

        $to.pickadate({
            selectMonths: true,
            selectYears: 2,
            format: 'dd.mm.yyyy',
            closeOnSelect: true,
            closeOnClear: true,
            //min: 1,
            //max: 30,
            today:'',
            onRender: function () {
                __$to = this;
            },
            onClose: function () {
                var picker = this;
                __$from.set('max', picker.get());
                $(document.activeElement).blur();
            },
            onOpen: function(){
                var min_date = 5;
                var max_date = 30;
                if (__$from.get() != '' && __$from.get() > moment().format("DD.MM.YYYY")) {
                    min_date = moment(__$from.get(), "DD.MM.YYYY").add(5, 'days').format('L');
                    max_date = moment(__$from.get(), "DD.MM.YYYY").add(5, 'days').add(1, 'month').format('L');
                }
                __$to.set('min', min_date);
                __$to.set('max', max_date);
            },
            onSet: function (ele) {
                $($to).valid();
                var picker = this;
                //picker.close();
                if(ele.select){
                    picker.close();
                }
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
                + '<span class="label">{{ strtoupper('Subcategories') }}</span>'
                + '<select class="subcategories">'
                + '<option value="vvvvvvvvvvvv1">vvvvvvvvvvvv11</option>'
                + '<option value="vvvvvvvvvvvv2">vvvvvvvvvvvv12</option>'
                + '<option value="vvvvvvvvvvvv3">vvvvvvvvvvvv13</option>'
                + '<option value="vvvvvvvvvvvv4">vvvvvvvvvvvv14</option>'
                + '<option value="vvvvvvvvvvvv5">vvvvvvvvvvvv15</option>'
                + '<option value="vvvvvvvvvvvv6">vvvvvvvvvvvv16</option>'
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
                + '<div class="file-field">'
                + '<button type="button" class="waves-effect waves-light btn btn-colorpicker"></button>'
                + '<div class="file-path-wrapper">'
                + '<input type="text" name="color" class="input-colorpicker" />'
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
                + '<a href="#clone-product" class="clone-product btn amber darken-4"><i class="material-icons left">view_stream</i>Clone</a>'
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
                + '<div class="file-field">'
                + '<button type="button" class="waves-effect waves-light btn btn-colorpicker"></button>'
                + '<div class="file-path-wrapper">'
                + '<input type="text" name="color[' + key + '][value]" class="input-colorpicker" />'
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
                + '<div class="file-field">'
                + '<button type="button" class="waves-effect waves-light btn btn-colorpicker"></button>'
                + '<div class="file-path-wrapper">'
                + '<input type="text" name="color" class="input-colorpicker" />'
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
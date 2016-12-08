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

    $(function () // Calculate sealed price.
    {
        //var sale_zero = '0%';
        var sale_zero = '0';

        function validateSale($sale) {
            if ($sale > 0) {
                //return Math.round($sale).toFixed(0) + '%';
                return parseFloat($sale.toFixed(2));
            }

            return sale_zero;
        }

        $(document).ready(function () {
            $('body').delegate("input.old_price, input.new_price, input.create_sale", "keyup", function (event) {
                var curent_product = $(this).parents('.inner_product');

                var sale = curent_product.find('input.create_sale');
                var old_price = curent_product.find('input.old_price');
                var new_price = curent_product.find('input.new_price');

                var val_sale = sale.val();
                var val_old_price = old_price.val();
                var val_new_price = new_price.val();
                var target = $(event.target);
                if (target.is("input.old_price") || target.is('input.new_price')) {
                    var diff = ((val_old_price - val_new_price) / val_old_price);

                    if (diff == 1 || diff == 0) {
                        return sale.val(sale_zero);
                    }
                    var calc = diff * 100;
                    var result = validateSale(calc);
                } else if (target.is('input.create_sale') && !isNaN(val_sale) && !isNaN(val_old_price)) {
                    var result = validateSale(val_old_price - (val_old_price / 100 * val_sale));
                    return new_price.val(result);
                }

                return sale.val(result);
            });
        });
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

        $('.input-colorpicker').colorpicker({
            component: '.btn',
            format: 'hex'
        });

        $('#btn_add_product').click(function (event) {
            if ($('.inner_product').length < 10) {
                $('.add_product').append(addProduct(key_product.value, curent_currency.value));
                reInit();
                $('.input-colorpicker').colorpicker();
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
                $('.input-colorpicker').colorpicker();
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
                $('.input-colorpicker').colorpicker();
                key_scs.value = key_scs.value + 1;
            }
        });

        $(".add_product").delegate("a.clone-product", "click", function () {
            var curent_product = $(this).parents('.inner_product');

            if ($('.inner_product').length < 10) {
                curent_product.find('select').material_select('destroy');
                curent_product.find('.input-colorpicker').colorpicker('destroy');
                var curent_val = curent_product.find('select').val();
                var clone_product = curent_product.clone();
                curent_product.after(clone_product);
                curent_product.next().find('select').val(curent_val);
                curent_product.next().animate({borderColor: '#ff6f00'}, 1000).delay(500).animate({borderColor: '#e9e9e9'}, 2000);
                reInit();
                $('.input-colorpicker').colorpicker({
                    component: '.btn',
                    color: '#26a69a',
                    format: 'hex'
                });
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
        $('.currency').change(function (event) {
            var simbol = $(this).find(':selected').data('simbol');
            $('.new_price, .old_price, .input-amount').attr('placeholder', simbol);
            curent_currency.value = simbol;
        });

        $('input.input-amount').keyup(function (event) {
            var procent = $('#parent_category').find(':selected').data('procent');
            var sum = $(this).val();
            var comision = Math.round(sum / 100 * procent).toFixed(0);
            $('.comision-val').text(comision);
            $('.js-comision').val(comision);
        });

        $('#parent_category').change(function (event) {
            var procent = $(this).find(':selected').data('procent');
            var sum = $('input.input-amount').val();
            var comision = Math.round(sum / 100 * procent).toFixed(0);
            $('.comision-val').text(comision);
            $('.js-comision').val(comision);
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
        var $from = $(".datepicker-from");
        var $to = $(".datepicker-to");
        var __$from = {};
        var __$to = {};
        $from.pickadate({
            selectMonths: true,
            selectYears: 2,
            format: 'dd.mm.yyyy',
            closeOnSelect: true,
            closeOnClear: true,
            min: 1,
            today:'',
            onRender: function () {
                __$from = this;
            },
            onSet: function (ele) {
                var picker = this;
                __$to.set('min', picker.get());
                if(ele.select){
                    picker.close();
                }
                //picker.close();
            },
            onOpen: function(){
                __$from.set('max', __$to.get());
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
            min: 1,
            max: 30,
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
                var new_date = moment(__$from.get(), "DD.MM.YYYY").add(5, 'days').locale('ro');
                console.log(new Date());
                console.log(moment());
                __$to.set('min', new_date.format('L'));
            },
            onSet: function (ele) {
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
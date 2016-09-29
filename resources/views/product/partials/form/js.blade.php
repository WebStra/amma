<script>
    function removeImageAjax($image) {
        $.ajax({
            url: "{{ route('remove_product_image', ['product' => $item->id]) }}",
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
                            url: '{{ route('sort_product_image', ['product' => $item->id]) }}',
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
        var sale_zero = '0%';

        function validateSale($sale)
        {
            if ($sale > 0)
            {
                return Math.round($sale).toFixed(0) + '%';
            }

            return sale_zero;
        }

        $(document).ready(function () {
            $('input[id=old_price], input[id=new_price]').on('input', function () {
                var sale = $('input[name=sale]');
                var old_price = $('input[id=old_price]').val();
                var new_price = $('input[id=new_price]').val();

                var diff = ((old_price - new_price) / old_price);

                if(diff == 1 || diff == 0)
                {
                    return sale.val(sale_zero);
                }
                var calc = diff * 100;
                var result = validateSale(calc);

                return sale.val(result);
            });
        });
    });

    $(function () // Add/remove specification.
    {
        var block_id = {value: 2};

        $('#add_suite')
                .on('click', function () {
                    $('.specification-bundle')
                            .append(getSpecSuiteTemplate(block_id.value));

                    block_id.value = block_id.value + 1;
                });

        $('#add_suite')
                .on('click', function () {
                    $('.specification_suite_lot')
                            .after(getSpecSuiteTemplateLot(block_id.value));

                    block_id.value = block_id.value + 1;
                });

        $('.specification-bundle')
                .on('click', 'div.remove-spec', function () {
                    $(this).parent().remove();
                });

        $('.remove-added-spec')
                .on('click', function () {
                    var item = $(this).parent();
                    var id = item.data('spec-id');

                    $.ajax({
                        url: "{{ route('remove_product_spec', ['product' => $item->id]) }}",
                        data: {id: id},
                        method: 'post',
                        success: function () {
                            item.remove();
                        }
                    });
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
            min: true,
            onRender: function () {
                __$from = this;
            },
            onSet: function () {
                var picker = this;
                __$to.set('min', picker.get());
            },
            onOpen: function(){
                __$from.set('max', __$to.get());
            }
        });

        $to.pickadate({
            selectMonths: true,
            selectYears: 3,
            format: 'dd.mm.yyyy',
            closeOnClear: true,
            min: 2,
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
                + '<span class="label">{{ strtoupper('name') }}</span>'
                + '<input type="text" name="spec[' + block_id + '][key]">'
                + '</div>'
                + '<div class="input-field spec_value">'
                + '<span class="label">{{ strtoupper('description') }}</span>'
                + '<input type="text" name="spec[' + block_id + '][value]">'
                + '</div>'
                + '<div class="input-field spec_remove remove-spec">'
                + '<a href="#remove-spec" class="remove-spec"><i class="icon-trash"></i></a>'
                + '</div>'
                + '</div>';
    }

    function getSpecSuiteTemplateLot(block_id) // Get template of suite of specifications.
    {
        return '<div class="specification_suite_lot" data-suite-spec="' + block_id + '">'
                + '<div class="col l6 m6 s12">'
                + '<div class="input-field spec_name">'
                + '<span class="label">{{ strtoupper('name') }}</span>'
                + '<input type="text" name="spec[' + block_id + '][key]">'
                + '</div>'
                + '</div>'
                + '<div class="col l5 m5 s12">'
                + '<div class="input-field spec_value">'
                + '<span class="label">{{ strtoupper('description') }}</span>'
                + '<input type="text" name="spec[' + block_id + '][value]">'
                + '</div>'
                 + '</div>'
                + '</div>';
    }
</script>
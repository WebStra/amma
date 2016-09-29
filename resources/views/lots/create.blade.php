@extends('layout')

@section('css')
    {!!Html::style('/assets/css/dropzone.css')!!}
    {!!Html::style('/assets/plugins/materialize-colorpicker/dist/css/materialize-colorpicker.min.css')!!}
    {!!Html::style('/assets/plugins/materialize-colorpicker/prism/themes/prism.css')!!}
@endsection

@section('content')
    <section class="">
        <div class="container" id="lot_canvas">
            <div class="card-panel amber darken-4">
                <span class="white-text">Setarii generale pentru lot (Step 1)</span>
            </div>
            <div class="padding15 border lot">
                <div class="row">
                    <form method="post" action="{{ route('create_lot', [ 'lot' => $lot->id ]) }}" id="create_form_lot" class="form form-lot"
                          enctype="multipart/form-data">
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">NAME</span>
                                <input type="text" required="" name="name" value="{{ old('name') ? old('name') : $lot->present()->renderName() }}" placeholder="Lot's name">
                            </div>
                        </div>

                        @if(count($categories))
                            <div class="col l6 m6 s12" id="primary_category">
                                <div class="input-field">
                                    <span class="label">{{ strtoupper('category') }}</span>
                                    <select id="parent_category" name="category" required {{ ($lot->category_id) ? 'disabled' : '' }}>
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                            <option data-procent="{{ $category->present()->renderTax() }}"
                                                    value="{{ $category->id }}"
                                                    {{ ($lot->category_id == $category->id) ? 'selected' : ''}}>{{ $category->present()->renderName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Categories -->
                        @else
                            <span>No categories</span>
                        @endif
                        <div class="col l6 m6 s12">
                            <div class="input-field date-published">
                                <span class="label">{{ strtoupper('published date(from)') }}</span>
                                <input type="date" class="datepicker-from" required name="public_date" value="{{ old('public_date') ? old('public_date') : $lot->public_date }}"
                                       data-value="">
                            </div>
                        </div><!-- Datetime (from) -->
                        <div class="col l6 m6 s12">
                            <div class="input-field date-expiration">
                                <span class="label">{{ strtoupper('expiration date(to)') }}</span>
                                <input type="date" class="datepicker-to" required name="expirate_date" value="{{ old('expire_date') ? old('expire_date') : $lot->expire_date }}"
                                       data-value="">
                            </div>
                        </div><!-- Datetime (to) -->

                        @if(count($currencies))
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">{{ strtoupper('Currency') }}</span>
                                <select name="currency" required class="currency">
                                    @foreach($currencies as $currency)
                                        <option data-sign="{{ $currency->sign }}" data-title="{{ $currency->title }}" value="{{ $currency->id }}">{{ $currency->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- Currency -->
                        @else
                            <span>No active currencies</span>
                        @endif

                        <div class="col l3 m6 s12">
                            <div class="input-field">
                                <span class="label">Complete dupa sumă</span>
                                <input type="text" class="input-amount" required="" name="yield_amount" value="{{ old('yield_amount') ? old('yield_amount') : $lot->yield_amount }}"
                                       placeholder="0.00">
                                @if(count($currencies))
                                    <span class="currency_type" style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col l12 m12 s12">
                            <div class="input-field">
                                <span class="label">DESCRIPTION</span>
                                <textarea name="description">{{ old('description') ? old('description') : $lot->description }}</textarea>
                            </div>
                        </div>

                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
            <div class="card-panel amber darken-4">
                <span class="white-text">Adaugarea produselor in lot (Step 2)</span>
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
                                    class="material-icons left">library_add</i>Add product</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card-panel amber darken-4">
                <span class="white-text">Crearea lotului (Step 3)</span>
            </div>

            <div class="row">
                <div class="margin15">
                    <div class="col l4 m6 s12 offset-l8 offset-m6 right-align-600">
                        <a form="create_form_lot" class="btn" id="lot_btn_add_product" data-action="{{ route('load_product_block_form', [ 'lot' => $lot->id ]) }}"><i
                                    class="material-icons left">save</i>Create</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    {!!Html::script('/assets/plugins/pickadate/lib/translations/ro_RO.js')!!}
    {!!Html::script('/assets/js/dropzone.js')!!}
    {!!Html::script('/assets/plugins/materialize-colorpicker/prism/prism.js')!!}
    {!!Html::script('/assets/plugins/materialize-colorpicker/dist/js/materialize-colorpicker.min.js')!!}
@endsection

@section('scripts')
    @include('html.partials.js')

    <script>
        var category_input = '#parent_category';

        $('#lot_btn_add_product').on('click', function(){
            var url = $(this).data('action');

            $.ajax({
                type: 'POST',
                url: url,
                success: function (response) {
                    if(response != 'false')
                    {
                        $('#lot_canvas').append(response);

                        $('div#primary_category input[class=select-dropdown]').attr('disabled', '');
                    } else {
                        alert('Select category first');

                        $(category_input).focus();
                    }
                }
            });
        });

        $("select[name=currency]").on('change', function()
        {
            var $this = $(this);

            $('span.currency_type')
                    .html($this
                            .find(':selected')
                            .data('title')
                    );
        });

        $('#parent_category').on('change', function(){
            var input = $(this);
            var value = input.val();

            if(value != '')
            {
                $.ajax({
                    type: 'POST',
                    data: { category_id: value },
                    url: "{{ route('lot_select_category', [ $lot->id ]) }}"
                });
            }
        });

        function deleteProductBlock(btn)
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
                        url: "{{ route("delete_product", [ $lot->id, $product->id ]) }}",
                        success: function (response) {
                            form.remove();
                        }
                    });
                }(jQuery));

                return;
            }

            return false;
        }

        function saveProductBlock(btn)
        {
            (function ($) {
                var $this = $(btn);
                var form = $this.parents('form');
                var action = $this.parents('form').attr('action');

                $.ajax({
                    type: 'POST',
                    data: form.serialize(),
                    url: action,
                    success: function (response) {
                        console.log(response);
                        alert('Saved');
                    }
                });
            }(jQuery));
        }
    </script>
@endsection
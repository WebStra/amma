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
                <span class="white-text">Setarii generale pentru lot</span>
            </div>
            <div class="padding15 border lot">
                <div class="row">
                    <form method="post" action="http://amma/ro/vendor/et-eum/product/413/create" class="form form-lot"
                          enctype="multipart/form-data">
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">NAME</span>
                                <input type="text" required="" name="name" value="" placeholder="Product's name">
                            </div>
                        </div>

                        @if(count($categories))
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">{{ strtoupper('categories') }}</span>
                                    <select id="parent_categories" name="categories" required>
                                        @foreach($categories as $category)
                                            <option data-procent="{{ $category->present()->renderTax() }}" value="{{ $category->id }}">{{ $category->present()->renderName() }}</option>
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
                                <input type="date" class="datepicker-from" required name="published_date" value=""
                                       data-value="">
                            </div>
                        </div><!-- Datetime (from) -->
                        <div class="col l6 m6 s12">
                            <div class="input-field date-expiration">
                                <span class="label">{{ strtoupper('expiration date(to)') }}</span>
                                <input type="date" class="datepicker-to" required name="expiration_date" value=""
                                       data-value="">
                            </div>
                        </div><!-- Datetime (to) -->

                        @if(count($currencies))
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">{{ strtoupper('Currency') }}</span>
                                <select name="currency" required class="currency">
                                    @foreach($currencies as $currency)
                                        <option data-simbol="{{ $currency->sign }}" value="{{ $currency->id }}">{{ $currency->title }}</option>
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
                                <input type="text" class="input-amount" required="" name="amount" value=""
                                       placeholder="MDL">
                                {{--<span class="comision"><i>Comision: <span class="comision-val">0</span></i></span>--}}
                            </div>
                        </div>

                        <div class="col l12 m12 s12">
                            <div class="input-field">
                                <span class="label">DESCRIPTION</span>
                                <textarea name="description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-panel amber darken-4">
                <span class="white-text">Adaugarea produselor in lot</span>
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
        $('#lot_btn_add_product').on('click', function(){
            var url = $(this).data('action');

            $.ajax({
                type: 'POST',
                url: url,
                success: function (response) {
                    $('#lot_canvas').append(response);
                }
            });
        });
    </script>
@endsection
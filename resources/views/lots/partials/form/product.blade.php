<form method="post" action="{{ route('save_product', [ 'product' => $product->id ]) }}" class="form form-product"
      enctype="multipart/form-data">
    <div class="row add_product" id="sortable">
        <div class="inner_product border margin15">
            <div class="col l4 m6 s12">
                <div class="input-field">
                    <p>PHOTO</p>
                    <img class="materialboxed img-responsive" src="http://placehold.it/350x350">
                </div>
            </div>

            <div class="col l8 m6 s12">
                <div class="row">
                    <div class="col l6 s12">
                        <div class="input-field">
                            <span class="label">NAME</span>
                            <input type="text" required="" name="name" value="{{ ($product->name) ? : '' }}"
                                   placeholder="Product's name">
                        </div>
                    </div>

                    <div class="col l6 s12">
                        <div class="input-field">
                            <span class="label">{{ strtoupper('Subcategories') }}</span>
                            <select class="subcategories">
                                <option value="vvvvvvvvvvvv1">vvvvvvvvvvvv11</option>
                            </select>
                        </div>
                    </div><!-- Subcategories -->

                    <div class="col l6 s12">
                        <div class="input-field">
                            <span class="label">{{ strtoupper('old price') }}</span>
                            <input type="text" class="old_price" required name="old_price" value="{{ ($product->old_price) ? : '' }}"
                                   placeholder="MDL">
                        </div>
                    </div>

                    <div class="col l6 s12 ">
                        <div class="input-field">
                            <span class="label">{{ strtoupper('new price') }}</span>
                            <input type="text" required="" class="new_price" name="price" value="{{ ($product->price) ? : '' }}"
                                   placeholder="MDL">
                        </div>
                    </div>

                    <div class="col l6 s12">
                        <div class="input-field">
                            <span class="label">{{ strtoupper('SALE') }}</span>
                            <input type="text" class="create_sale" name="sale" placeholder="0%" value="{{ ($product->sale) ? : '' }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col l12 m12 s12">
                        <label>Specifications</label>
                    </div>
                </div>

                <div class="row">
                    <div class="specification_suite_lot overflow">
                        <div class="specification_suite_item overflow" data-suite-spec="1">
                            <div class="col l6 m12 s12">
                                <div class="input-field spec_name">
                                    <span class="label">NAME</span>
                                    <input type="text" name="spec[1][key]" value="">
                                </div>
                            </div>
                            <div class="col l6 m12 s12">
                                <div class="input-field spec_value">
                                    <span class="label">DESCRIPTION</span>
                                    <input type="text" name="spec[1][value]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l1 m2 s2 offset-s10 offset-l11 offset-m10 center-align">
                        <a href="#add-spec" class="add_spec_btn add_suite"><i class="material-icons center">library_add</i></a>
                    </div>
                </div>

                <div class="row">
                    <div class="wrap_size_color_sold overflow">
                        <div class="size_color_sold_item overflow" data-suite-spec="1">
                            <div class="col l4 m12 s12">
                                <div class="input-field">
                                    <span class="label">Size</span>
                                    <input type="text" required="" name="size" value="" placeholder="Size">
                                </div>
                            </div>
                            <div class="col l4 m12 s12">
                                <div class="input-field">
                                    <span class="label">COLORS</span>
                                    <div class="file-field input-colorpicker">
                                        <div class="btn"></div>
                                        <div class="file-path-wrapper">
                                            <input type="text" name="color" class=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l4 m12 s12">
                                <div class="input-field">
                                    <span class="label">Sold</span>
                                    <input type="text" required="" name="sold" value="" placeholder="0">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col l1 m2 s2 offset-s10 offset-l11 offset-m10 center-align">
                        <div class="input-field">
                            <a href="#add-spec" class="add_spec_btn add_size_color_sold"><i
                                        class="material-icons center">library_add</i></a>
                        </div>
                    </div>
                </div>

                <div class="row right-align-600-992">

                    <div class="col l8 s12 push-l4">
                        <div class="row">
                            <div class="col l6 s12 offset-l6 right-align-992">
                                <div class="input-field">
                                    <button type="submit" onclick="saveProductBlock(this); return false;"
                                       class="waves-effect waves-light btn save-product"><i
                                                class="material-icons left">loop</i>Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Add color size sold-->
            </div>
        </div>
    </div>

    {!! csrf_field() !!}
</form>
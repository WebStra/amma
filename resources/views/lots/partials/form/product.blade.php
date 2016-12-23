<div class="product_canvas" data-product="{{ $product->id }}">
    <form method="post" data-product="{{ $product->id }}"
          onsubmit="saveProductBlock(this);return false;"
          action="{{ route('save_product', [ $lot->id, 'product' => $product->id ]) }}"
          class="form form-product"
          enctype="multipart/form-data">
        <div class="row add_product" id="sortable">
            <div class="inner_product border margin15" style="cursor: default;">
                <div class="col l4 m6 s12">
                    <div class="input-field product_gallery">
                        <p>{{ $meta->getMeta('photo') }}</p>
                        @if(count($images = $product->images))
                            <img class="materialboxed img-responsive cover_image_product" src="{{ $product->present()->cover() }}">
                        @else
                            <img class="materialboxed img-responsive cover_image_product" src="http://placehold.it/350x350">
                        @endif

                        <div class="product_thumbs" style="margin-top: 5px;">
                            @if(count($images = $product->images))
                                @foreach($images as $image)
                                    <img src="{{ $image->present()->image() }}" onclick="removeImage(this);return false;" data-image="{{ $image->id }}" class="lots_product thumb" width="55" height="50">
                                @endforeach
                            @endif
                        </div>

                        <a href="#upload_imgs" class="waves-effect waves-light btn blue" style="width: 100%; margin-top:5px;"
                           onclick="callUploadImages(this, 'image'); return false;"><i
                                    class="material-icons left">input</i>&nbsp;{{ $meta->getMeta('form_lot_upload') }}</a>

                        <input type="file" name="image[]" multiple
                               style="display: none" onchange="uploadImages(this);">
                    </div>
                </div><!-- Galery -->

                <div class="col l8 m6 s12">
                    <div class="row">
                        <!-- <div class="col l6 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('label_name') }}</span>
                                <input type="text" required="required" name="name"
                                       value="{{ ($product->name) ? : '' }}"
                                       placeholder="{{ $meta->getMeta('placeholder_product_name') }}">
                            </div>
                        </div> -->

                        @if($lot->category_id)
                            @if(count($sub_categories = $lot->category->subCategories))
                                <div class="col l12 s12">
                                    <div class="input-field">
                                        <span class="label">{{ $meta->getMeta('subcategory') }}</span>
                                        <select class="subcategories" name="sub_category"
                                                required="required">
                                            @foreach($sub_categories as $sub_category)
                                                <?php $selected = ($product->sub_category_id == $sub_category->id) ? 'selected' : ''; ?>
                                                <option value="{{ $sub_category->id }}"
                                                        {{ $selected }}>{{ $sub_category->present()->renderName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Subcategories -->
                            @endif
                        @endif
<!-- 
                        <div class="col l4 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('old_price') }}</span>
                                <input type="text" class="old_price" required="required" name="old_price"
                                       value="{{ ($product->old_price) ? : '' }}"
                                       placeholder="0.00">
                                @if(count($currencies))
                                    <span class="currency_type"
                                          style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
                                @endif
                            </div>
                        </div>old price

                        <div class="col l4 s12 ">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('new_price') }}</span>
                                <input type="text" required="required" class="new_price" name="price"
                                       value="{{ ($product->price) ? : '' }}"
                                       placeholder="0.00">
                                @if(count($currencies))
                                    <span class="currency_type"
                                          style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
                                @endif
                            </div>
                        </div>new price

                        <div class="col l4 s12">
                            <div class="input-field">
                                <span class="label">{{ $meta->getMeta('sale') }}</span>
                                <input type="text" class="create_sale" name="sale" placeholder="0%"
                                       value="{{ ($product->sale) ? : '' }}">
                                <span style="position: absolute;top:31px;right: 15px;color: #ff6f00;">%</span>
                            </div>
                        </div>sale -->
                    </div><!--Form-->
                    <div class="row" style="margin-bottom: 25px;">
                        <div class="col l12 specification_price overflow">
                            @if(old('spec_price'))
                                @foreach(old('spec_price') as $key_spec => $spec)
                                    @include('lots.partials.form.specification_price')
                                @endforeach
                                <?php $key_spec+=1;?>
                                @include('lots.partials.form.specification_price')
                            @else
                                @if(count($spec_price = $product->specPrice))
                                    @foreach($spec_price as $key_spec => $spec)
                                        @include('lots.partials.form.specification_price')
                                    @endforeach
                                    <?php unset($spec); $key_spec+=1;?>
                                    @include('lots.partials.form.specification_price')
                                @else
                                    @include('lots.partials.form.specification_price')
                                @endif
                            @endif
                        </div>

                        <div class="col l12 m12 s12">
                            <label style="float: right;">Add group price <a onclick="loadSpecPrice(this); return false;" href="#add-spec-price">{{ $meta->getMeta('add') }}</a></label>
                        </div>
                    </div><!--Specs-->

                    <div class="row" style="margin-bottom: 25px;">
                        <div class="specification_suite_lot overflow">
                            @if(old('spec'))
                                @foreach(old('spec') as $key_spec_product => $spec)
                                    @include('lots.partials.form.specification')
                                @endforeach
                                <?php $key_spec_product+=1;?>
                                @include('lots.partials.form.specification')
                            @else
                                @if(count($specs = $product->getMetaGroup('spec')))
                                    @foreach($specs as $key_spec_product => $spec)
                                        @include('lots.partials.form.specification')
                                    @endforeach
                                    <?php unset($spec); $key_spec_product+=1;?>
                                    @include('lots.partials.form.specification')
                                @else
                                    @include('lots.partials.form.specification')
                                @endif
                            @endif
                        </div>

                        <div class="col l12 m12 s12">
                            <label style="float: right;">{{ $meta->getMeta('form_lot_add_spec_prod') }} <a onclick="loadSpec(this); return false;" href="#add-spec">{{ $meta->getMeta('add') }}</a></label>
                        </div>
                    </div><!--Specs-->


                    <div class="row" style="height: 75px;margin-top: 25px">
                        {{--<div class="col 2">--}}
                            {{--<div class="input-field">--}}
                                {{--<a href="#clone-product" class="clone-product btn amber darken-4"><i--}}
                                            {{--class="material-icons left">view_stream</i>Clone</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="col 2">
                            <div class="row">
                                <div class="col l12 m12 s12">
                                    <div class="input-field">
                                        <a href="#remove-product" onclick="deleteProductBlock(this); return false;"
                                           class="waves-effect waves-light btn red btn-remove-product"><i
                                                    class="material-icons left">delete</i>{{ $meta->getMeta('form_lot_del') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col l6 s12 right-align-992">
                            <div class="input-field">
                                <button type="submit"
                                        class="waves-effect waves-light btn save-product"><i
                                            class="material-icons left">loop</i>{{ $meta->getMeta('form_lot_save') }}
                                </button>
                            </div>
                        </div>
                    </div><!--buttons-->
                </div><!--form-->
            </div>
        </div>
        {!! csrf_field() !!}
    </form>
</div>
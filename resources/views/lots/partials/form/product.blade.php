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
                        <p>PHOTO</p>
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
                                    class="material-icons left">input</i>&nbsp;Upload Image</a>

                        <input type="file" name="image[]" multiple
                               style="display: none" onchange="uploadImages(this);">
                    </div>
                </div><!-- Galery -->

                <div class="col l8 m6 s12">
                    <div class="row">
                        <div class="col l6 s12">
                            <div class="input-field">
                                <span class="label">NAME</span>
                                <input type="text" required="required" name="name"
                                       value="{{ ($product->name) ? : '' }}"
                                       placeholder="Product's name">
                            </div>
                        </div><!-- name -->

                        @if($lot->category_id)
                            @if(count($sub_categories = $lot->category->subCategories))
                                <div class="col l6 s12">
                                    <div class="input-field">
                                        <span class="label">{{ strtoupper('Subcategory') }}</span>
                                        <select class="subcategories browser-default" name="sub_category"
                                                required="required">
                                            <option value="">Select subcategory</option>
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

                        <div class="col l6 s12">
                            <div class="input-field">
                                <span class="label">{{ strtoupper('old price') }}</span>
                                <input type="text" class="old_price" required="required" name="old_price"
                                       value="{{ ($product->old_price) ? : '' }}"
                                       placeholder="0.00">
                                @if(count($currencies))
                                    <span class="currency_type"
                                          style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
                                @endif
                            </div>
                        </div><!--old price-->

                        <div class="col l6 s12 ">
                            <div class="input-field">
                                <span class="label">{{ strtoupper('new price') }}</span>
                                <input type="text" required="required" class="new_price" name="price"
                                       value="{{ ($product->price) ? : '' }}"
                                       placeholder="0.00">
                                @if(count($currencies))
                                    <span class="currency_type"
                                          style="position: absolute;top:31px;right: 15px;color: #ff6f00;">{{ ($lot->currency) ? $lot->currency->title : $currencies->first()->title }}</span>
                                @endif
                            </div>
                        </div><!--new price-->

                        <div class="col l6 s12">
                            <div class="input-field">
                                <span class="label">{{ strtoupper('SALE') }}</span>
                                <input type="text" class="create_sale" name="sale" placeholder="0%"
                                       value="{{ ($product->sale) ? : '' }}">
                                <span style="position: absolute;top:31px;right: 15px;color: #ff6f00;">%</span>
                            </div>
                        </div><!--sale-->
                    </div><!--Form-->

                    <div class="row" style="margin-bottom: 25px;">
                        <div class="specification_suite_lot overflow">
                            @if(old('spec'))
                                @foreach(old('spec') as $block_id => $spec)
                                    @include('lots.partials.form.specification')
                                @endforeach
                            @else
                                @if(count($specs = $product->getMetaGroup('spec')))
                                    @foreach($specs as $block_id => $spec)
                                        @include('lots.partials.form.specification')
                                    @endforeach
                                @endif
                            @endif
                        </div>

                        <div class="col l12 m12 s12">
                            <label style="float: right;">Add specifications for your product. <a onclick="loadSpec(this); return false;" href="#add-spec">Add</a></label>
                        </div>
                    </div><!--Specs-->

                    <div class="spec_improved">
                        @if(count($specs = $product->improvedSpecs))
                            <div class="row improved_specs_set">
                                @foreach($specs as $spec)
                                    @include('lots.partials.form.improved_specs')
                                @endforeach
                            </div><!--specs-improved-->
                        @endif
                        <div class="row">
                            <div class="col l12 m12 s12">
                                <label style="float: right;">Add improved specifications for your product. <a onclick="loadImprovedSpec(this); return false;" href="#add-spec">Add</a></label>
                            </div>
                        </div><!--add spec-->
                    </div><!--Improved specs-->

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
                                                    class="material-icons left">delete</i>Del</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col l6 s12 right-align-992">
                            <div class="input-field">
                                <button type="submit"
                                        class="waves-effect waves-light btn save-product"><i
                                            class="material-icons left">loop</i>Save
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
<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        <a href="#" class=""><img src="{{ $item->present()->cover() }}"></a>
    </div>
    <div class="hover">
        <div class="display-table body">
            <div class="td">
                <h5>Sigur dorești să ștergi produsul?</h5>
                <div>
                    <a href="#" class="btn_ btn_base inline small">Da vreau</a>
                    <a href="#" class="btn_ btn_white c_base inline small remove_hover">Nu, m-am razgindit</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <h4><a href="{{ route('view_vendor', ['slug' => $item->slug]) }}">{{ $item->present()->renderTitle() }}</a></h4>
        <ul class="star_rating" data-rating_value="4">
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
            <li class="icon-star"></li>
        </ul>
        <span class="small">22 păreri </span>

        <div class="cf"></div>
        <div class="left_side labels">
            <div class=" label"><span class="title">Suma acumulată:</span> 16 000 MDL</div>
            <div class="label"><span class="title">Cantitate:</span> 36 unități</div>

            <div class="stock">
                22/50
                <div class="progress">
                    <div class="determinate" style="width: 42%"></div>
                </div>
            </div>
        </div>
        <div class="right_side">
            <button class="btn_ btn_white small show_details" data-show-id="show_detail_product_1"><i
                        class="icon-more"></i> Vezi detalii
            </button>
            <button class="btn_ btn_white small add_hover"><i class="icon-trash"></i> Șterge produsul</button>
            <a href="{{ route('edit_vendor', ['slug' => $item->slug]) }}" class="btn_ btn_white small">Edit vendor</a>
            <a href="{{ route('add_product', ['slug' => $item->slug]) }}" class="btn_ btn_white small">Add product</a>
        </div>

    </div>
    <div class="cf"></div>
    <div class="sub_content" id="show_detail_product_1">
        <div class="body">
            <div class="model_info bordered">
                <div class="half_width label colors">
                    <span class="title">Culoare:</span>
                    <ul>
                        <li><span class="color_view" style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                        </li>
                    </ul>
                </div>
                <div class="label half_width"><span class="title">Marime:</span> 36 (EUR)</div>
                <div class="total">TOTAL : <span>23 000 MDL</span></div>
            </div>
            <div class="model_info bordered ">
                <div class="half_width label colors">
                    <span class="title">Culoare:</span>
                    <ul>
                        <li><span class="color_view" style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                        </li>
                    </ul>
                </div>
                <div class="label half_width"><span class="title">Marime:</span> 36 (EUR)</div>
                <div class="total">TOTAL : <span>23 000 MDL</span></div>
            </div>
            <div class="model_info bordered ">
                <div class="half_width label colors">
                    <span class="title">Culoare:</span>
                    <ul>
                        <li><span class="color_view" style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                        </li>
                    </ul>
                </div>
                <div class="label half_width"><span class="title">Marime:</span> 36 (EUR)</div>
                <div class="total">TOTAL : <span>23 000 MDL</span></div>
            </div>
            <div class="model_info bordered ">
                <div class="half_width label colors">
                    <span class="title">Culoare:</span>
                    <ul>
                        <li><span class="color_view" style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                        </li>
                    </ul>
                </div>
                <div class="label half_width"><span class="title">Marime:</span> 36 (EUR)</div>
                <div class="total">TOTAL : <span>23 000 MDL</span></div>
            </div>
            <div class="model_info bordered ">
                <div class="half_width label colors">
                    <span class="title">Culoare:</span>
                    <ul>
                        <li><span class="color_view" style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                        </li>
                    </ul>
                </div>
                <div class="label half_width"><span class="title">Marime:</span> 36 (EUR)</div>
                <div class="total">TOTAL : <span>23 000 MDL</span></div>
            </div>
            <div class="model_info bordered ">
                <div class="half_width label colors">
                    <span class="title">Culoare:</span>
                    <ul>
                        <li><span class="color_view" style="background-color:#fff; border-color:#e0e0e0;"></span> Alb(1)
                        </li>
                    </ul>
                </div>
                <div class="label half_width"><span class="title">Marime:</span> 36 (EUR)</div>
                <div class="total">TOTAL : <span>23 000 MDL</span></div>
            </div>
        </div>
    </div><!--subcontent-->
</li>
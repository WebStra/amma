@extends('layout')

@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection


@section('content')
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="http://amma/ro"><i class="icon-home"></i></a></li>
            <li><a href="http://amma/ro">Home</a></li>
            <li><a href="http://amma/ro/vendors/view/official-jeans-magazin">Official Jeans Magazin</a></li>
            <li class="active">Desperado Jeans (M, S, XXL) Summer 2016 July</li>
        </ul>
    </div>

    <section class="produs">
        <div class="container">
            <div class="row">
                <div class="col l4 m5 s12">
                    <div id="slider" class="flexslider">
                        <div class="flex-viewport">
                            <ul class="slides simpleLens">

                                <li>
                                    <img src="/assets/images/product1.jpg" data-imagezoom="true"
                                         data-magnification="3"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-imagezoom="true"
                                         data-magnification="3"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-imagezoom="true"
                                         data-magnification="3"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-imagezoom="true"
                                         data-magnification="3"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-imagezoom="true"
                                         data-magnification="3"/>
                                </li>

                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>
                    </div><!-- / slider images-->
                    <div id="carousel" class="flexslider carousel" style="height: 107px">

                        <!-- / slider thumbnails-->
                        <div class="flex-viewport">
                            <ul class="slides">
                                <li>
                                    <img src="/assets/images/product1.jpg" data-id-product="12"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-id-product="13"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-id-product="14"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-id-product="15"/>
                                </li>
                                <li>
                                    <img src="/assets/images/product1.jpg" data-id-product="16"/>
                                </li>

                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>
                        <ul class="flex-direction-nav">
                            <li class="flex-nav-prev">
                                <a class="flex-prev flex-disabled" href="#" tabindex="-1"></a>
                            </li>
                            <li class="flex-nav-next">
                                <a class="flex-next" href="#"></a>
                            </li>
                        </ul>
                    </div><!-- carousel -->
                    <div class="bordered divide-top hide-on-small-only">
                        <div class="block_title">DESPRE VÂNZĂTOR</div>
                        <div class="person_card">
                            <div class="display_flex border_bottom">
                                <div class="wrapp_img">
                                    <img src="/upload/vendors/41\1468244019_556bcc8c4de594d70963e4ee3c4e3965.jpg">
                                </div>
                                <div class="content">
                                    <h4>Official Jeans Magazin</h4>
                                    <span class="set_vote" data-type="like"
                                          data-action="http://amma/ro/vote_vendor/official-jeans-magazin?like_type=like">Like (<span>0</span>)</span>
                                    <span class="set_vote" data-type="dislike"
                                          data-action="http://amma/ro/vote_vendor/official-jeans-magazin?like_type=dislike">Unlike (<span>0</span>)</span>
                                    <div id="#something"></div>
                                    <p class="small">0 păreri / 99,9% positive</p>
                                    <p class="small"><a href="http://amma/ro/vendors/view/official-jeans-magazin">1
                                            active</a> / 8 total</p>
                                </div>
                            </div>
                            <div class="buttons row">
                                <div class="col s6 padd_r_half">
                                    <a href="http://amma/ro/vendors/view/official-jeans-magazin"
                                       class="btn_ btn_base waves-effect waves-light f_small left full_width">Vezi
                                        magazinul</a>
                                </div>
                                <div class="col s6 padd_l_half">
                                    <a href="#" class="btn_ btn_white waves-effect waves-teal f_small right full_width">Contactează-ne</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bordered  elements hide-on-small-only">
                        <div class="block_title">EI AU PROCURAT DEJA</div>
                        <div class="person_card ">
                            <div class="display_flex">
                                <div class="wrapp_img">
                                    <img src="/assets/images/avatar1.jpg">
                                </div>
                                <div class="content">
                                    <h4>John Wick</h4>
                                    <p class="">Count: 1</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col l8 m7 s12 product_info form">
                    <div class="product-name">Laptop 11.6" ACER V5-123-12104G50nss, Silver</div>
                    <div class="clearfix">
                        <div class="label lot-info"><span class="c-gray">Lot:</span> <a href="#">Incaltaminte din
                                Vietnam...</a></div>

                        <div class="label wrap-countdown" style=''><span class="c-gray">Expira la:</span>
                            <div class="countdown" data-endtime="09/12/2016">
                                <span class="days">0</span>
                                <span class="hours">0</span>
                                <span class="minutes">0</span>
                                <span class="seconds">0</span>
                            </div>
                        </div>
                        {{-- <div class="label category"><span class="c-gray">Category:</span> <a href="#">Incaltaminte</a></div> --}}
                        <div class="label subcategory"><span class="c-gray">Subcategory:</span> <a
                                    href="#">Incaltaminte</a></div>
                        <div class="label label-color">
                            <span class="c-gray">Color:</span>
                            <ul class="color-select">
                                <li><label style="background-color:#111;"><input name="color" type="radio"></label></li>
                                <li><label style="background-color:#ccc;"><input name="color" type="radio"></label></li>
                                <li><label style="background-color:#dcdcdc;"><input name="color" type="radio"></label>
                                </li>
                                <li><label style="background-color:#ffddcc;"><input name="color" type="radio"></label>
                                </li>
                                <li><label style="background-color:#ddd;"><input name="color" type="radio"></label></li>
                                <li><label style="background-color:#ededed;"><input name="color" type="radio"></label>
                                </li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>

                        <div class="label label-sizes">
                            <span class="c-gray">Sizes:</span>
                            10, 10.3, 11, 12, 13.4, 15, 16, XXL, L
                        </div>
                        <div class="label available"><span class="c-gray">Available:</span>23</div>
                        <div class="label price-old"><span class="c-gray">Old Price:</span>790</div>
                        <div class="label price-new"><span class="c-gray">New Price:</span>720</div>
                        <div class="info-lot">
                            <div class="lot-name"></div>
                        </div>

                        <div class="sell_info display-table td_bordered_right">
                            <div class="td">
                                <h5>PARTICIPANTI</h5>
                                <p>1</p>
                            </div>
                            <div class="td">
                                <h5>REDUCERE</h5>
                                <p>20%</p>
                            </div>
                            <div class="td">
                                <h5>ECONOMISEȘTI</h5>
                                <p>200 MDL</p>
                            </div>
                        </div>
                        <form class="row childs_margin_top" method="post" action="http://amma/ro/involve/product/247">
                            <div class="counting col l3 m6 s12">
                                <div class="wrapp_input">
                                    <span class="minus left in"><i class="icon-minus"></i></span>
                                    <input type="text" readonly="readonly" value="1" name="count">
                                    <span class="plus right in"><i class="icon-plus"></i></span>
                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <button type="submit" class="btn_ full_width btn_base put_in_basket">
                                    <i class="icon-basket"></i>
                                    <span class="hide-on-med-only">Adaugă în coș</span>
                                </button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col s12">
                                <ul class="tabs" style="width: 100%;">
                                    <li class="tab" style="width: 50%;"><a class="active cursor-default"
                                                                           href="#about_product">DESPRE PRODUS</a></li>
                                    <div class="indicator" style="right: 0px; left: 0px;"></div>
                                    <div class="indicator" style="right: 0px; left: 0px;"></div>
                                    <div class="indicator" style="right: 0px; left: 0px;"></div>
                                </ul>
                            </div>
                            <div id="about_product" class="col s12 tab_content">
                                <ul class="">
                                    <li>
                                        <span class="">Размеры:</span>
                                        <span class="">XXL, S, M</span>
                                    </li>
                                    <li>
                                        <span class="">Цвета:</span>
                                        <span class="">Светло-синие, Светло-серые</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem
                                    ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla porttitor
                                    accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non
                                    nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                                    cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet
                                    ligula. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat.
                                    Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p>
                            </div>
                        </div>
                        <ul class="social">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Famma%2Fro%2Fproduct%2F247&amp;title=Desperado%20Jeans%20%28M%2C%20S%2C%20XXL%29%20Summer%202016%20July"
                                   onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;"
                                   class="icon-facebook">
                                </a>
                            </li>
                            <li>
                                <a href="https://connect.ok.ru/offer?url=http%3A%2F%2Famma%2Fro%2Fproduct%2F247&amp;title=Desperado%20Jeans%20%28M%2C%20S%2C%20XXL%29%20Summer%202016%20July"
                                   onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;"
                                   class="icon-odnoklassniki">
                                </a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url=http%3A%2F%2Famma%2Fro%2Fproduct%2F247"
                                   onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;"
                                   class="icon-google-plus">
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?url=http%3A%2F%2Famma%2Fro%2Fproduct%2F247&amp;text=Desperado%20Jeans%20%28M%2C%20S%2C%20XXL%29%20Summer%202016%20July"
                                   onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;"
                                   class="icon-twitter">
                                </a>
                            </li>
                            <li>
                                <a href="http://vk.com/share.php?url=http%3A%2F%2Famma%2Fro%2Fproduct%2F247&amp;title=Desperado%20Jeans%20%28M%2C%20S%2C%20XXL%29%20Summer%202016%20July&amp;image=%2Fupload%2Fproducts%2F247%5C1468248814_4cac34f5cc6e5f5ca2498087707ca8b5.jpg&amp;noparse=false"
                                   onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;"
                                   class="icon-vkontakte">
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col l3 m12 s12 product_vendor_block">
                        <div id="modal" class="auth_modal modal modal_tabs">
                            <div class="modal-content">
                                <ul class="tabs" style="width: 100%;">
                                    <li class="tab"><a class="active" href="#logare">LOGARE</a></li>
                                    <li class="tab"><a href="#register">INREGISTRARE</a></li>
                                    <div class="indicator"></div>
                                    <div class="indicator"></div>
                                </ul>
                                <div id="logare" class="col s12 tab_content">
                                    <div class="row">
                                        <div class="content_tab">
                                            <div class=" display-table authentification">
                                                <div class="td">
                                                    <h1>INTRA ÎN CONTUL TĂU</h1>
                                                    <p class=" center">Completează formularul pentru a te loga în
                                                        cont.</p>
                                                    <form action="http://amma/ro/login" class="form styled3"
                                                          method="post">
                                                        <div class="col s12">
                                                            <div class="input-field">
                                                                <input type="email" name="email" placeholder="Email"
                                                                       value="">
                                                            </div>
                                                        </div>
                                                        <div class="col s12">
                                                            <div class="input-field">
                                                                <input type="password" name="password"
                                                                       placeholder="Password">
                                                            </div>
                                                        </div>
                                                        <div class="col s12">
                                                            <div class="input-field">
                                                                <p class="left-align" style="margin-bottom: 25px;">
                                                                    <input type="checkbox" id="check1">
                                                                    <label for="check1">Vreau să intru automat</label>
                                                                    <br>
                                                                </p>
                                                                <input type="submit" value="Intră în cont"
                                                                       class="btn btn_base btn_submit full_width">
                                                            </div>
                                                        </div>
                                                        <div class="col s12">
                                                            <hr class="hr-text" data-content="OR">
                                                            <div class="input-field">
                                                                <a href="http://amma/ro/social/login/facebook"
                                                                   class="btn btn_facebook full_width">
                                                                    <i class="icon-facebook"></i>&nbsp;Intră cu ajutorul
                                                                    Facebook
                                                                </a>
                                                                <a href="#" class="btn btn_gplus full_width">
                                                                    <i class="icon-google-plus"></i>&nbsp;Intră cu
                                                                    ajutorul Google+
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="_token"
                                                               value="nEm0PWfPxgvNEqDcwyUqyYbAm2NKhhSSMyEXUNY6">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="register" class="col s12 tab_content" style="display: none;">
                                    <div class="row">
                                        <h1>ÎNREGISTRAREA CONTULUI</h1>
                                        <p>Completează formularul pentru a crea un cont.</p>
                                        <form action="http://amma/ro/register" class="form styled3" method="post">
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="text" name="firstname" required=""
                                                           placeholder="Firstname" value="">
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="text" name="lastname" required=""
                                                           placeholder="Lastname" value="">
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="email" name="email" required=""
                                                           placeholder="Ex: maria@gmail.com" value="">
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="text" name="phone" required=""
                                                           placeholder="+373 777 77 777" value="">
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="password" required="" name="password"
                                                           placeholder="Enter password">
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <div class="input-field">
                                                    <input type="password" required="" name="password_confirmation"
                                                           placeholder="Confirm password">
                                                </div>
                                            </div>
                                            <div class="col s12">
                                                <input type="submit" value="Crează un cont"
                                                       class="btn btn_base btn_submit full_width">
                                                <p class="center">Ai deja un cont? <a href="http://amma/ro/login"
                                                                                      class="c_base">Intră în cont</a>
                                                </p>
                                            </div>
                                            <input type="hidden" name="_token"
                                                   value="nEm0PWfPxgvNEqDcwyUqyYbAm2NKhhSSMyEXUNY6">
                                        </form>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="cf row">
                    <div class="col l12 m12 s12 divide-top">
                        <div class="elements bordered">
                            <div class="title">{{ strtoupper('same products') }}</div>
                            <div class="owl-carousel l-4">
                                <div class="item product">
                                    <div class="display-table">
                                        <div class="wrapp_img with_hover td wrapp_countdown">
                                            <div class="countdown" data-endtime="12/8/2015">
                                                <span class="days"></span>
                                                <span class="hours"></span>
                                                <span class="minutes"></span>
                                                <span class="seconds">12</span>
                                            </div>
                                            <div class="hover">
                                                <a href="#">
                                                    <i class="icon-favorite"></i>
                                                    Adaugă la Favorite
                                                </a>
                                                <a href="#">
                                                    <i class="icon-basket"></i>
                                                    Adaugă în coș
                                                </a>
                                            </div>
                                            <img src="assets/images/produs.jpg" alt=""/>
                                        </div>
                                    </div>
                                    <h4 class="title"><a href="produs_interior.php">SONY EXPERIA BN-100</a></h4>
                                    <div class="wrapp_info">
                                        <ul class="star_rating" data-rating_value="1">
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                        </ul>
                                        <div class="price">
                                            <div class="curent_price">8 987 Lei</div>
                                            <div class="old_price">11 987 Lei</div>
                                        </div>
                                        <div class="stock">
                                            22/50
                                            <div class="progress">
                                                <div class="determinate" style="width: 42%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item product">
                                    <div class="display-table">
                                        <div class="wrapp_img with_hover td wrapp_countdown">
                                            <div class="countdown" data-endtime="12/8/2015">
                                                <span class="days"></span>
                                                <span class="hours"></span>
                                                <span class="minutes"></span>
                                                <span class="seconds">12</span>
                                            </div>
                                            <div class="hover">
                                                <a href="#">
                                                    <i class="icon-favorite"></i>
                                                    Adaugă la Favorite
                                                </a>
                                                <a href="#">
                                                    <i class="icon-basket"></i>
                                                    Adaugă în coș
                                                </a>
                                            </div>
                                            <img src="assets/images/produs.jpg" alt=""/>
                                        </div>
                                    </div>
                                    <h4 class="title"><a href="produs_interior.php">SONY EXPERIA BN-100</a></h4>
                                    <div class="wrapp_info">
                                        <ul class="star_rating" data-rating_value="1">
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                            <li class="icon-star"></li>
                                        </ul>
                                        <div class="price">
                                            <div class="curent_price">8 987 Lei</div>
                                            <div class="old_price">11 987 Lei</div>
                                        </div>
                                        <div class="stock">
                                            22/50
                                            <div class="progress">
                                                <div class="determinate" style="width: 42%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--@foreach($same as $product)--}}
                                {{--@include('partials.products.item-block')--}}
                                {{--@endforeach--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- / container-->
    </section>


    <section id="comments">
        <div class="container">
            <div class="block_title divide-top">Comentarii</div>
            <div id="fb-root"></div>
            <div class="fb-comments" data-href="http://amma/ro/product/247" data-width="1154" data-numposts="3"></div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(function () {
            $('.title-product').change(function (event) {
                $('.slides li').find("[data-id-product='" + $(this).val() + "']").click();
            });
            $('.color-select li input').change(function (event) {
                $('.color-select li label').removeClass('color-visited');
                if ($(this).is(":checked")) {
                    $(this).parent().addClass('color-visited');
                }
            });
        });
    </script>
@endsection
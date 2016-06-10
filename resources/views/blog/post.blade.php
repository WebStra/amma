@extends('layout')

@section('breadcrumbs')
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="#" class="icon-home"></a></li>
            <li>Blog</li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col l9 m12 s12">
                    <div class="articles">
                        <div class="article">
                            <h2 class="title">{{ $post->present()->renderTitle() }}</h2>
                            <p>
                                <span><i class="icon-clock"></i> Postat <span
                                            class="c_base">21 Noiembrie 2015</span></span>
                                <span><i class="icon-watch"></i> Vizualizări  <span class="c_base">15 147</span></span>
                            </p>
                            <div class="wrapp_img">
                                <img src="/assets/images/img3.jpg">
                            </div>
                            <div class="text">
                                {{ $post->body }}
                            </div>
                        </div>

                    </div>
                </div>
                <!--l9-->
                <div class="col l3 m12 s12">
                    <div class="bordered  elements aside">
                        <div class="block_title">ARTICOLE POPULARE</div>

                        @include('blog.partials.popular-sidebar')
                    </div>
                </div>
            </div>
            <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid"
                 data-href="http://developers.facebook.com/docs/plugins/comments/" data-numposts="1" data-width="100%"
                 fb-xfbml-state="rendered"><span style="height: 675px;"><iframe id="f414df9ea59c0c"
                                                                                name="f26bd761eafe068" scrolling="no"
                                                                                title="Facebook Social Plugin"
                                                                                class="fb_ltr fb_iframe_widget_lift"
                                                                                src="https://www.facebook.com/plugins/comments.php?api_key=&amp;channel_url=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df3a86577537fd68%26domain%3Decommerce.hm.md%26origin%3Dhttp%253A%252F%252Fecommerce.hm.md%252Ff2056b43cdf5ccc%26relation%3Dparent.parent&amp;href=http%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2Fcomments%2F&amp;locale=ru_RU&amp;numposts=1&amp;sdk=joey&amp;version=v2.5&amp;width=100%25"
                                                                                style="border: none; overflow: hidden; height: 675px; width: 100%;"></iframe></span>
            </div>

            <div id="fb-root" class=" fb_reset">
                <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
                    <div>
                        <iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true"
                                scrolling="no" id="fb_xdm_frame_http" aria-hidden="true"
                                title="Facebook Cross Domain Communication Frame" tabindex="-1"
                                src="http://staticxx.facebook.com/connect/xd_arbiter.php?version=42#channel=f2056b43cdf5ccc&amp;origin=http%3A%2F%2Fecommerce.hm.md"
                                style="border: none;"></iframe>
                        <iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true"
                                allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true"
                                title="Facebook Cross Domain Communication Frame" tabindex="-1"
                                src="https://staticxx.facebook.com/connect/xd_arbiter.php?version=42#channel=f2056b43cdf5ccc&amp;origin=http%3A%2F%2Fecommerce.hm.md"
                                style="border: none;"></iframe>
                    </div>
                </div>
                <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
                    <div></div>
                </div>
            </div>
            <script id="facebook-jssdk" src="//connect.facebook.net/ru_RU/sdk.js#xfbml=1&amp;version=v2.5"></script>
            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

        </div><!-- / container-->
    </section>
@endsection
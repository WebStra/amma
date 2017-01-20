@include('auth.auth_modal')
<div class="bordered divide-top">
    <div class="block_title">DESPRE VÂNZĂTOR</div>
    <?php if (!$vendor) {
        $vendor = $item->lot->vendor;
    }?>
    <div class="person_card">
        <div class="display_flex border_bottom">
            <div class="wrapp_img">
                <img src="{{ $vendor->present()->cover() }}">
            </div>
            <div class="content">
                <h4>{{ $vendor->present()->renderTitle() }}</h4>

                <span class="set_vote" data-type="like"
                      data-action="{{ route('vote_vendor', ['vendor' => $vendor->slug, 'like_type' => 'like']) }}">
                    <i class="like material-icons {{($vendor->wasLiked('like')) ? 'vote_active' : '' }}">thumb_up</i>
                    <span>{{ count($vendor->getLikes('like')) }} </span>
                </span>
                <span class="set_vote" data-type="dislike"
                      data-action="{{ route('vote_vendor', ['vendor' => $vendor->slug, 'like_type' => 'dislike']) }}">
                    <i class="unlike material-icons {{($vendor->wasLiked('dislike')) ? 'vote_active' : '' }}">thumb_down</i>
                     <span>{{ count($vendor->getLikes('dislike')) }}</span>
                </span>
                <div id="#something"></div>
                <p class="small"><span class="likes_count">{{ $vendor->likes->count() }}</span> păreri /
                    <span class="likes_percent"> {{ $vendor->present()->renderPozitiveVotes() }} </span> % positive</p>
            </div>
        </div>
        <br><span class="c-gray" style="text-align:left; font-size: 12px;">Telefon: <strong>(+373) {{$vendor->phone}}</strong></span>
        <br><span class="c-gray" style="text-align:left; font-size: 12px;">Email: <strong>{{$vendor->email}}</strong></span>
        @include('vendors.partials.contact-modal')
        <div class="buttons row">
            <div class="col s6 padd_r_half">
                <a href="{{ route('view_vendor', ['vendor' => $vendor->slug]) }}"
                   class="btn_ btn_base waves-effect waves-light f_small left full_width">Vezi
                    magazinul</a>
            </div>
            <div class="col s6 padd_l_half">
                <a href="javascript:void(0)" class="btn_ btn_white waves-effect waves-teal f_small right full_width {{(Auth::user()) ? 'contact_modal' : 'set_vote'}}">Contactează-ne</a>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @if(Auth::user())
        <script type="text/javascript">
            $(function () {
                var ajax_running = false;
                var like_btn = $('span[data-type=like]');
                var dislike_btn = $('span[data-type=dislike]');

                $('.set_vote').click(function () {
                    var $this = $(this);
                    var count = $(this).find('span');

                    if (!ajax_running) {
                        ajax_running = true;
                        $.ajax({
                            type: 'post',
                            url: $this.data('action'),
                            data: {vendor: "{{$vendor->slug}}", like_type: $this.data('type')},
                            success: function (response) {
                                var out = JSON.parse(response);
                                like_btn.find('span').html(out.likes);
                                dislike_btn.find('span').html(out.dislikes);
                                $('.likes_count').html(out.likes_count);
                                $('.likes_percent').html(Math.round(out.likes_percent));
                                if (out.was_liked == 'like') {
                                    $('.like').addClass('vote_active');
                                    $('.unlike').removeClass('vote_active');
                                }
                                if (out.was_liked == 'unlike') {
                                    $('.like').removeClass('vote_active');
                                    $('.unlike').addClass('vote_active');
                                }
                                if (out.was_liked == 'not_liked') {
                                    $('.like').removeClass('vote_active');
                                    $('.unlike').removeClass('vote_active');
                                }

                            },
                            complete: function () {
                                ajax_running = false;
                            }
                        });
                    }
                });
            });
        </script>
    @else
        <script>
            $('.set_vote').click(function () {
                $('#modal').openModal();
                $('.modal-trigger').leanModal({
                    dismissible: true,
                    opacity: .5,
                    in_duration: 300,
                    out_duration: 200,
                });
            });
        </script>
    @endif

    <script>
        $('.auth_submit_ajax, .auth_register_ajax').on("click", function (event) {
            event.preventDefault();
            var form = $(this).parents('form').serialize();
            var response = $(this).parents('form').find('.response');
            var authtype = $(this).parents('form').data('authtype');
            var btn = $(this);
            $('.auth_errors li').remove();
            btn.attr("disabled", true);
            $.ajax({
                url: $(this).parents('form').data('action'),
                method: 'POST',
                dataType: 'json',
                data: form,
                success: function (data) {
                    var wrap = $('form[data-authtype=' + authtype + '] .auth_errors');
                    if (data.errors) {
                        $.each(data.errors, function (input_name, errors) {
                            if ($.isArray(errors)) {
                                $.each(errors, function (k, error) {
                                    wrap.append('<li>' + error + '</li>');
                                });
                            }
                            $('form[data-authtype=' + authtype + '] input[name=' + input_name + ']').css('border', '1px solid red');
                            setTimeout(function () {
                                $('.auth_errors li').remove();
                            }, 5000);
                        });
                        return;
                    }

                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }
                    wrap.append('<li style="background:#f5f5f5; border:1px solid green; color:green;">Login Success!</li>');
                    location.reload();
                    return;
                },
                complete: function () {
                    if (btn.attr("disabled")) {
                        btn.attr("disabled", false);
                    }
                }
            });
        });
    </script>

    <script>
        $('select.select_product_quantity').change(function () {
            var element = $(this).find(":selected");
            var currency = element.data('currency');
            $('.price span').html(element.data('new-price') + ' ' + currency);
            $('.old_price span').html(element.data('old-price') + ' ' + currency);
            $('#salePrice span').html(element.data('sale'));
            $('#economy span').html(element.data('old-price') - element.data('new-price'));
            if (currency == 'USD') {

                var valute = '{{$usd}}';
            }
            else {
                var valute = '{{$euro}}';
            }
            $('.conver_mdl span').html(Math.round(element.data('new-price') * valute));

            $('ul.sizes_product li').remove();
            $('ul.color_product li').remove();
            var id = element.data('product-id');
            $.ajax({
                method: "POST",
                url: "{{route('product_specification')}}",
                data: {id: id},
                success: function (data) {
                    var out = JSON.parse(data);
                    $.each(out, function (i, val) {
                        $('ul.sizes_product').append('<li data-id="' + val.id + '">' + val.size + '</li>');
                    });
                }
            });
        });
    </script>

    <script>
        $('ul.sizes_product').delegate('li', 'click', function () {
            var id = $(this).data('id');
            $('ul.sizes_product li.active').removeClass('active');
            $(this).addClass('active notclickable');
            $('#sizes_product').val(id);
            $('.color_product').html('');
            $.ajax({
                method: "POST",
                url: "{{route('product_specification_color')}}",
                data: {id: id},
                success: function (data) {
                    var out = JSON.parse(data);
                    $.each(out, function (i, val) {
                        $('.color_product').append('<li data-count="' + val.amount + '" data-id="' + val.id + '" style="background:' + val.color_hash + ';"></li>');
                    });
                    $('ul.color_product li:first-child').addClass('active');
                    var count = $('ul.color_product li:first-child').data('count');
                    var colorId = $('ul.color_product li:first-child').data('id');
                    $('#color_product').val(colorId);
                    $('.amount_products').html(count);
                    $('.counting input').attr('max', '' + count);
                },
                complete: function () {
                    $('ul.sizes_product li').removeClass('notclickable');
                }
            })
        });
        $('ul.color_product').delegate('li', 'click', function () {
            $('ul.color_product li.active').removeClass('active');
            var id = $(this).data('id');
            var count = $(this).data('count');
            $('.amount_products').html(count);
            $('.counting input').attr('max', '' + count);
            $('#color_product').val(id);
            $(this).addClass('active');

        });
    </script>

@endsection

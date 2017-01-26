@section('scripts')
    <script>
        $(document).ready(function () {
            // Configure/customize these variables.
            var showChar = 156;  // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "{{ $meta->getMeta('show_more') }}";
            var lesstext = "{{ $meta->getMeta('show_less') }}";


            $('.showmore').each(function () {
                var content = $(this).html();

                if (content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);

                    var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                    $(this).html(html);
                }

            });

            $(".morelink").click(function () {
                if ($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle();
                $(this).prev().toggle();
                return false;
            });
        });
    </script>

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
        $('select.select_product_quantity').on('change', function () {
            var element = $(this).find(":selected");
            var currency = element.data('currency');
            $('.price span').html(element.data('new-price') + ' ' + currency);
            $('.old_price span').html(element.data('old-price') + ' ' + currency);
            $('#salePrice span').html(element.data('sale'));
            $('#economy span').html(element.data('old-price') - element.data('new-price'));
            if (currency == 'USD') {
                $('.conver_mdl span').html(Math.round(element.data('new-price') * '{{$usd}}'));
            }
            else {
                $('.conver_mdl span').html(Math.round(element.data('new-price') * '{{$euro}}'));
            }
            $('ul.sizes_product li').remove();
            $('ul.color_product li').remove();
            var id = element.data('product-id');
            $.ajax({
                method: "POST",
                url: "{{route('product_specification')}}",
                data: {id: id},
                success: function (data) {
                    var out = JSON.parse(data);
                    $('ul.sizes_product').html(out);
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
                    $('.color_product').html(out.colorHTML);
                    $('ul.color_product li:first-child').addClass('active');
                    $('#color_product').val(out.colorId);
                    $('.amount_products').html(out.colorAmount);
                    $('.counting input').attr('max', '' + out.colorAmount);
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
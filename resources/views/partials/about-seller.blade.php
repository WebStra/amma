@include('auth.auth_modal')
<div class="bordered divide-top hide-on-small-only">
    <div class="block_title">DESPRE VÂNZĂTOR</div>
    <?php $vendor = $item->vendor;?>
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
                <p class="small"><a href="{{ route('view_vendor', ['vendor' => $vendor->slug]) }}">{{ $vendor->present()->activeCount() }} active</a> / {{ $vendor->present()->totalCount() }} total</p>
            </div>
        </div>
        <div class="buttons row">
            <div class="col s6 padd_r_half">
                <a href="{{ route('view_vendor', ['vendor' => $vendor->slug]) }}"
                   class="btn_ btn_base waves-effect waves-light f_small left full_width">Vezi
                    magazinul</a>
            </div>
            <div class="col s6 padd_l_half">
                <a href="#" class="btn_ btn_white waves-effect waves-teal f_small right full_width">Contactează-ne</a>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
@section('scripts')
    @if(Auth::user())
        <script type="text/javascript">
            $(function () {
                var like_btn = $('span[data-type=like]');
                var dislike_btn = $('span[data-type=dislike]');

                $('.set_vote').click(function () {
                    var $this = $(this);
                    var count = $(this).find('span');

                    $.ajax({
                        type: 'post',
                        url: $this.data('action'),
                        data: {vendor: "{{$vendor->slug}}", like_type: $this.data('type')},
                        success: function (response) {
                            var out = JSON.parse(response);
                            like_btn.find('span').html(out.likes);
                            dislike_btn.find('span').html(out.dislikes);
                        }
                    });
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
=======
@section('js')
@if(Auth::user())
    <script type="text/javascript">
    $(function(){
        var ajax_running = false;
        var like_btn = $('span[data-type=like]');
        var dislike_btn = $('span[data-type=dislike]');
        
        $('.set_vote').click(function() {
            var $this = $(this);
            var count = $(this).find('span');

            if(!ajax_running) {
                ajax_running = true; 
                $.ajax({
                    type: 'post',
                    url: $this.data('action'),
                    data: { vendor : "{{$vendor->slug}}", like_type : $this.data('type') },
                    success: function(response)
                    {
                        var out = JSON.parse(response);
                        like_btn.find('span').html(out.likes);
                        dislike_btn.find('span').html(out.dislikes);
                        $('.likes_count').html(out.likes_count);
                        $('.likes_percent').html(out.likes_percent);
                        if(out.was_liked == 'like')
                        {
                            $('.like').addClass('vote_active');
                            $('.unlike').removeClass('vote_active');
                        }
                        if(out.was_liked == 'unlike') 
                        { 
                            $('.like').removeClass('vote_active');
                            $('.unlike').addClass('vote_active');
                        }
                        if(out.was_liked == 'not_liked')
                        {
                            $('.like').removeClass('vote_active');
                            $('.unlike').removeClass('vote_active');
                        }
                        
                    },
                    complete: function (){
                        ajax_running = false;
                    }
                });
            }
       });
    });    
    </script>
@else
    <script>
    $('.set_vote').click(function() {
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
$('.auth_submit_ajax, .auth_register_ajax').on("click", function(event){
        event.preventDefault();
        var form = $(this).parents('form').serialize();
        var response = $(this).parents('form').find('.response');
        var authtype = $(this).parents('form').data('authtype');
        var btn = $(this);
        $('.auth_errors li').remove(); 
            btn.attr("disabled", true);
            $.ajax({
                url : $(this).parents('form').data('action'),
                method : 'POST',
                dataType : 'json',
                data : form,
                success : function(data){
                    var wrap = $('form[data-authtype='+ authtype + '] .auth_errors');

                    if(data.errors){
                        $.each(data.errors, function(input_name, errors){
                            if($.isArray(errors)){
                                $.each(errors, function(k, error){
                                   wrap.append('<li>'+ error +'</li>');
                                });
                            }
                            $('form[data-authtype='+ authtype + '] input[name='+input_name+']').css('border','1px solid red');
                            setTimeout(function()
                            { 
                                $('.auth_errors li').remove(); 
                            }, 5000);
                        }); 
                        return;    
                    }

                    if(data.redirect){
                        window.location.href = data.redirect;
                        return;
                    }
                   wrap.append('<li style="background:#f5f5f5; border:1px solid green; color:green;">Login Success!</li>');
                    location.reload();
                    return;
                },
                complete : function(){
                    if(btn.attr("disabled")){
                        btn.attr("disabled", false);
                    }
                }
            });
    });
</script>
>>>>>>> develop
@endsection

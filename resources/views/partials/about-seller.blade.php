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
                    data-action="{{ route('vote_vendor', ['vendor' => $vendor->slug, 'like_type' => 'like']) }}">Like (<span>{{ count($vendor->getLikes('like')) }}</span>)</i></span>
                <span class="set_vote" data-type="dislike" 
                    data-action="{{ route('vote_vendor', ['vendor' => $vendor->slug, 'like_type' => 'dislike']) }}">Unlike (<span>{{ count($vendor->getLikes('dislike')) }}</span>)</span>
                <div id="#something"></div>
                <p class="small">{{ count($vendor->likes) }} păreri / 99,9% positive</p>
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
@endsection

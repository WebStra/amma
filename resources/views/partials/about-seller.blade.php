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

<div class="col l4 m5 s12">
    <div class="bordered divide-top">
        <div class="block_title">DESPRE VÂNZĂTOR</div>
        <div class="person_card">
            <div class="display_flex border_bottom">
                <div class="wrapp_img">
                    <img src="{{ $item->present()->cover(null, '/assets/images/no-avatar2.png') }}">
                </div>
                <div class="content">
                    <h4>
                        <a href="{{ route('view_vendor', ['vendor' => $item->slug]) }}">{{ $item->present()->renderTitle()}}</a>
                    </h4>
                    <div class="label" style=''>
                        <div class="user-rating">
                            <span class="stars"><span class="bg" style="width: {{ $item->present()->renderPozitiveVotes() }}%"></span></span>
                            <span>{{ $item->present()->renderPozitiveVotes() }}%</span>
                            <span class="c-gray"> ({{ $item->present()->getLikesNumber() }} de votari)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons row">
                <div class="col s12 padd_l_half">
                    <a href="#"
                       class="btn_ btn_white waves-effect waves-teal f_small right full_width">Contactează-ne</a>
                </div>
            </div>
        </div>
    </div>
</div>
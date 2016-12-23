<span class="info_label">
    {{--@if($item->lot->verify_status == 'expired')
        <img src="/assets/images/badge_stoc_expirat.png">--}}
    @if($item->count == $item->involved->sum('count'))
        <img src="/assets/images/badge_stoc_epuizat.png">
    @endif
</span>
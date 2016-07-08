<div class="count_down">
    <h5>PÂNĂ LA FINELE OFERTEI</h5>
    <div class="countdown big" data-endtime="{{ $item->present()->endDate() }}"> <!-- m/d/Y -->
        <span class="wrapp_span">
            <span class="days">{{ $item->present()->diffEndDate()->d }}</span>
            ZILE
        </span>
        <span class="wrapp_span">
            <span class="hours">{{ $item->present()->diffEndDate()->h }}</span>
            ORE
        </span>
        <span class="wrapp_span">
            <span class="minutes">{{ $item->present()->diffEndDate()->i }}</span>
            MINUTE
        </span>
        <span class="wrapp_span">
            <span class="seconds">{{ $item->present()->diffEndDate()->s }}</span>
            SECUNDE
        </span>
    </div>
</div>
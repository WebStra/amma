<div class="count_down">
    <h5>PÂNĂ LA FINELE OFERTEI</h5>
    <div class="countdown big" data-endtime="{{ $lot->present()->endDate() }}"> <!-- m/d/Y -->
        <span class="wrapp_span">
            <span class="days">{{ $lot->present()->diffEndDate()->d }}</span>
            ZILE
        </span>
        <span class="wrapp_span">
            <span class="hours">{{ $lot->present()->diffEndDate()->h }}</span>
            ORE
        </span>
        <span class="wrapp_span">
            <span class="minutes">{{ $lot->present()->diffEndDate()->i }}</span>
            MINUTE
        </span>
        <span class="wrapp_span">
            <span class="seconds">{{ $lot->present()->diffEndDate()->s }}</span>
            SECUNDE
        </span>
    </div>
</div>
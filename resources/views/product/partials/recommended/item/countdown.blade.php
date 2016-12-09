<div class="countdown" data-endtime="{{ $lot->present()->endDate() }}">
    <span class="days">{{ $lot->present()->diffEndDate()->d }}</span>
    <span class="hours">{{ $lot->present()->diffEndDate()->h }}</span>
    <span class="minutes">{{ $lot->present()->diffEndDate()->i }}</span>
    <span class="seconds">{{ $lot->present()->diffEndDate()->s }}</span>
</div>
<div class="stock">
    {{ $item->present()->renderPrice($item->present()->getSalesSumm()) }}
    /{{ $item->present()->renderPrice($item->present()->getTotalSumm()) }}
    <div class="progress">
        <div class="determinate" style="width: {{ $item->present()->getSalesPercent() }}%"></div>
    </div>
</div>
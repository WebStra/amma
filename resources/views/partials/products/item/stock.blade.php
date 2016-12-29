<div class="stock">
   {{-- {{ $item->involved->sum('count') }} /
    {{ $item->count }}--}}
    <div class="progress">
       {{-- <div class="determinate" style="width: {{($item->count) ?  number_format((100 * $item->involved->sum('count'))  / $item->count) : 0 }}%"></div>--}}
        <div class="determinate" style="width:0%"></div>
    </div>
</div>
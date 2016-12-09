@if(count(Auth::user()->vendors))
        <div class="bordered divide-top">
            <div class="person_card styled1">
                <div class="buttons">
                    <?php $current= Route::currentRouteName();?>
                    <ul class="links_to">
                        <li><a {{ $current == 'my_lots' ? 'class=active' : '' }} href="{{ route('my_lots') }}">{!! $meta->getMeta('top_bar_mylots') !!}</a></li>
                        <li><a {{ ($current == 'my_vendors') ? 'class=active' : '' }} href="{{ route('my_vendors') }}">{!! $meta->getMeta('top_bar_myvendors') !!}</a></li>
                    </ul>
                </div>
            </div>
        </div>
@endif
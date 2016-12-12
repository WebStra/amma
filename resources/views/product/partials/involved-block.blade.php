<div class="person_card ">
    <div class="display_flex">
        <div class="wrapp_img">
            <img src="{{($involved->user->present()->cover()) ? $involved->user->present()->cover() : '/assets/images/no-avatar.png' }}">
        </div>
        <div class="content">
            <h4>{{ $involved->user->present()->renderName() }}</h4>

            @if($user = $item->user && Auth::id() == $user->id)
                email: {{ $involved->user->email }}
                on-summ: {{ $item->present()->renderPriceWithSale() * $involved->count }}
                telefon: {{ $item->user->profile->phone }}
            @endif

            <p class="">Count: {{ $involved->count }}</p>
        </div>
    </div>
</div>
<div class="article">
    <h2 class="title">{{ $item->present()->renderTitle() }}</h2>
    <p>
        <span><i class="icon-clock"></i> Postat <span class="c_base">{{ $item->present()->renderPublishedDate() }}</span></span>
        <span><i class="icon-watch"></i> Vizualizări  <span class="c_base">{{ $item->present()->renderPostViews() }}</span></span>
    </p>
    <div class="wrapp_img">
        <img src="{{ $item->present()->cover('/assets/images/img3.jpg') }}">
    </div>
    <div class="text">
        {!! $item->present()->renderShortDescription(300) !!}
    </div>
    <a href="{{ route('view_post', ['slug' => $item->slug]) }}" class="link">
        Citește articolul întreg <i class="icon-arrow-to-right"></i>
    </a>
</div>
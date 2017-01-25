<div class="article">
    <h2 class="title">{{ $item->present()->renderTitle() }}</h2>
    <p>
        <span><i class="icon-clock"></i> {{$meta->getMeta('date-post-article')}} <span class="c_base">{{ $item->present()->renderPublishedDate() }}</span></span>
        <span><i class="icon-watch"></i> {{$meta->getMeta('views-post-article')}} <span class="c_base">{{ $item->present()->renderPostViews() }}</span></span>
    </p>
    <div class="wrapp_img">
        <img src="{{ $item->present()->cover(null, '/assets/images/img3.jpg') }}" width="870" height="472">
    </div>
    <div class="text">
        {!! $item->present()->renderShortDescription(300) !!}
    </div>
    <a href="{{ route('view_post', ['slug' => $item->slug]) }}" class="link">
         {{$meta->getMeta('read-full-article-blog')}} <i class="icon-arrow-to-right"></i>
    </a>
</div>
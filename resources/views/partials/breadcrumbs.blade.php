@if ($breadcrumbs)
    <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ul>
@endif
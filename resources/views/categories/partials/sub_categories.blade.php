@if($category->subCategories()->count())
    <div class="elements bordered divide-top border_bottom hide-on-med-and-down">
        <ul class="categories">
            @foreach($category->subCategories as $item)
                <?php $item = $item->categoryable ?>
                @if(isset($item))
                    <li>
                        <a href="{{ route('view_category', ['category' => $item->slug]) }}">
                            <div class="wrapp_img">
                                <img src="{{ $item->present()->cover() }}">
                            </div>
                            <h4>{{ $item->name }}</h4>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
        <a href="#" class="link c_base">Afișează toate categoriile</a>
    </div>
@endif
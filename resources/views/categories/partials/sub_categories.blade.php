<?php $subCategories = $category->categoryables()->subcategories()->child()->get(); ?>
@if(count($subCategories))
    <div class="elements bordered divide-top border_bottom hide-on-med-and-down">
        <ul class="categories">
            @foreach($subCategories as $item)
                <?php $item = $item->categoryable ?>
                <li>
                    <a href="{{ route('view_category', ['category' => $item->slug]) }}">
                        <div class="wrapp_img">
                            <img src="/assets/images/img5.jpg">
                        </div>
                        <h4>{{ $item->name }}</h4>
                    </a>
                </li>
            @endforeach
        </ul>
        <a href="#" class="link c_base">Afișează toate categoriile</a>
    </div>
@endif
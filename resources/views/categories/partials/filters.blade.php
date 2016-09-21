<div class="col l3 m5 s12">
    <form class="bordered divide-top filtre sidebar_search" action="" method="get">
        <div class="filtru">
            <h5>Pretul</h5>
            <div class="range_select">
                <?php
                    $price_min_default = 0;
                    $price_max_default = 10000;
                ?>
                <p id="range1" data-min="{{ $price_min_default }}" data-max="{{ $price_max_default }}"></p>
                <input type="hidden" id="price_min" name="price_min"
                       value="{{ isset($_GET['price_min']) ? $_GET['price_min'] : $price_min_default }}"/>
                <input type="hidden" id="price_max" name="price_max"
                       value="{{ isset($_GET['price_max']) ? $_GET['price_max'] : $price_max_default }}"/>
            </div>
        </div>

        @if(count($groups))
            @foreach($groups as $group)
                <div class="filtru">
                    <h5>{{ $group }}</h5>
                    <p>
                        @foreach($category->tags()->select('*')->translated()->whereGroup($group)->get() as $tag)
                            <span>
                                <?php
                                    /* @warning: This stuff works only for checkbox input's. */
                                    $name = (\App\Repositories\TagRepository::renderDynamicFilterName($group, $tag->normalized));
                                    $id   = strtolower(sprintf("%s_%s", $group, $tag->name));
                                ?>
                                <input type="checkbox" name="{{ $name }}" id="{{ $id }}"
                                        {{ (isset($_GET[$name])) ? 'checked' : '' }}>
                                <label for="{{ $id }}">{{ $tag->name }}</label>
                            </span>
                        @endforeach
                    </p>
                </div><!-- {{ $group }} filter -->
            @endforeach
        @endif

        <div class="wrapp_submit">
            <button type="submit">Filter</button>
        </div>
    </form>
</div><!-- category filter -->

@section('scripts')
    <script>
        (function ($) {
            $("form.filtre input").on("change", function(){
                var $this = $(this); // this input changed
                var form = $this.parents('form'); // serialize the form
                var output_content = $('div.filter-result');

                output_content.html("Loading ..."); // instead this use loading animation ...

                $.query.set("rows", 10);
//                window.location.search = $.query.set("rows", 10);
//                window.history.pushState("object or string", "Title", "/new-url"); // push & it work
//                console.log(window.location.hash);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('filter_category', ['category' => $category->slug]) }}',
                    data: form.serialize(),
                    success: function(response){
                        $('div.filter-result').html(response);
                    }
                });
            });
        }(jQuery));
    </script>
@endsection
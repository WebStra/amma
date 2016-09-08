<div class="col l3 m5 s12">
    <form class="bordered divide-top filtre sidebar_search" action="" method="get">
        <div class="filtru">
            <h5>Pretul</h5>
            <div class="range_select">
                <p id="range1" data-min="100" data-max="10000"></p>
                <input type="hidden" id="price_min" name="price_min"
                       value="{{ isset($_GET['price_min']) ? $_GET['price_min'] : '2000' }}"/>
                <input type="hidden" id="price_max" name="price_max"
                       value="{{ isset($_GET['price_max']) ? $_GET['price_max'] : '8000' }}"/>
            </div>
        </div>

        @foreach($groups as $group)
            <div class="filtru">
                <h5>{{ $group }}</h5>
                <p>
                    @foreach($category->tags()->select('*')->translated()->whereGroup($group)->get() as $tag)
                        <span>
                            <?php
                                // @warning: This stuff works only for checkbox input's.
                                $name = sprintf("%s_%s", strtolower($group), $tag->name);
                                $id   = sprintf("%s_%s", $group, $tag->name);
                            ?>
                            <input type="checkbox" name="{{ $name }}" id="{{ $id }}"
                                    {{ (isset($_GET[$name])) ? 'checked' : '' }}>
                            <label for="{{ $id }}">{{ $tag->name }}</label>
                        </span>
                    @endforeach
                </p>
            </div><!-- {{ $group }} filter -->
        @endforeach

        <div class="wrapp_submit">
            <button type="submit">Filter</button>
        </div>
    </form>
</div><!-- category filter -->

@section('js')
    <script>
        (function ($) {
            return;
            $("form.filtre input").on("change", function(){
                var $this = $(this);
                var form = $this.parents('form');

                form.submit();
            });
        }(jQuery));
    </script>
@endsection
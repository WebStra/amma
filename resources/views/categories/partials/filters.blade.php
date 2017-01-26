<div class="col l3 m5 s12">
    <form class="bordered divide-top filtre sidebar_search" action="" method="get">
        @if(count($subCategories = $category->subCategories))
            <div class="filtru subcategories_filters">
                <h5>{{$meta->getMeta('subcategories-title')}}</h5>
                <p>
                    @foreach($subCategories as $subCategory)
                    <span style="display: block">
                        <a href="{{ route('view_sub_category', [ $category->slug , $subCategory->slug ]) }}"
                           title="{{ $subCategory->present()->renderName() }}">{{ $subCategory->present()->renderName() }}</a>
                    </span>
                    @endforeach
                </p>
            </div>
        @endif

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
                                    $id   = str_slug(sprintf("%s_%s", $group, $tag->name));
                                ?>
                                <input type="checkbox" data-value="{{ (isset($_GET[$name]) ? '1' : '0') }}" name="{{ $name }}" id="{{ $id }}"
                                        {{ (isset($_GET[$name])) ? 'checked' : '' }}>
                                <label for="{{ $id }}">{{ $tag->name }}</label>
                            </span>
                        @endforeach
                    </p>
                </div><!-- {{ $group }} filter -->
            @endforeach
        @endif

        <div class="filtru">
            <h5>{{$meta->getMeta('filter-price')}}</h5>
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

        <div class="wrapp_submit">
            <button type="submit">{!! $meta->getMeta('filter_submit') !!}</button>
        </div>
    </form>
</div><!-- category filter -->

@section('scripts')
    <script>
        (function ($) {
            // On production change this value.
            var status_site = "{{ config('app.env') }}";

            function isEnabled(elm)
            {
                return elm.data('value') == 1;
            }

            function getCurrentUrlLink()
            {
                if(status_site == 'production')
                {
                    return window.location.protocol + '//'
                            + window.location.hostname
                            + window.location.pathname;
                }

                return window.location.protocol + '//'
                        + window.location.hostname
                        + ':' + window.location.port
                        + window.location.pathname;
            }

            function getUrlVars()
            {
                var vars = {}, hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

                if(hashes[0] != getCurrentUrlLink())
                {
                    $.each(hashes, function(k, item){
                        hash = item.split('=');
                        vars[hash[0]] = hash[1];
                    });

                    return vars;
                }

                return {};
            }

            function updateUrl(element)
            {
                var state = {category: "{{ $category }}"};
                var title = 'Amma Filter';
                var url = getCurrentUrlLink();
                var vars = getUrlVars();
                var newVars = {};

                if(isEnabled(element))
                {
                    newVars[element.attr("name")] = "on";

                    vars = $.extend(vars, newVars);
                } else {
                    if(vars[element.attr("name")])
                    {
                        delete vars[element.attr("name")];
                    }
                }

                var params = '';
                var $i = 0;
                var paramSeparator;
                $.each(vars, function(paramName, paramValue){
                    if($i == 0) {
                        paramSeparator = '?'
                    } else {
                        paramSeparator = '&';
                    }

                    params += paramSeparator + paramName + '=' + paramValue;
                    $i++;
                });
                $i = 0;

                window.history.pushState(state, title, url + params);
            }

            $("form.filtre input").on("change", function(){ // only checkbox
                var $this = $(this); // this input changed
                var form = $this.parents('form'); // serialize the form
                var output_content = $('div.filter-result');

                output_content.html("Loading ..."); // instead this use loading animation ...

                if(isEnabled($this))
                {
                    $this.data('value', 0);
                } else {
                    $this.data('value', 1);
                }

                updateUrl($this);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('view_category', ['category' => $category->slug]) }}',
                    data: form.serialize(),
                    success: function(response){
                        $('div.filter-result').html(response);
                    }
                });
            });
        }(jQuery));
    </script>
@endsection
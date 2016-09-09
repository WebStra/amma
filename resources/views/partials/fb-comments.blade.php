<section id="comments">
    <div class="container">
        <div class="block_title divide-top">Comentarii</div>
        <div id="fb-root"></div>
        <div class="fb-comments" data-href="{{ Request::url() }}" data-width="1154" data-numposts="3"></div>
    </div>
</section>
@section('scripts')
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=907351076004785";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
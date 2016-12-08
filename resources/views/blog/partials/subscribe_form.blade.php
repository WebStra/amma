<h1>BLOG <span class="c_base">AMMA</span></h1>
<h4 class="f_300">{{ $meta->getMeta('label_subscribe_article_utile') }}</h4>

<div class="head_block"
     style="background-image: url('/assets/images/bg1.jpg'); background-size:cover; background-position:center center">
    <div class="form_wrapp styled1">
        <h2 class="title">{{ $meta->getMeta('label_subscribe') }}</h2>
        <form action="{{route('subscribe')}}" method="post" class="form styled3 row">
            <div class="col s12">
                <div class="input-field no-mar-bot">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Ex: maria@gmail.com">
                </div>
            </div>
            {{csrf_field()}}
            <div class="col s12">
                <input type="submit" value="{{ $meta->getMeta('btn_subscribe') }}" class="btn btn_base btn_submit full_width">
            </div>

        </form>
    </div>
</div>
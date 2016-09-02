<div class=" display-table authentification">
    <div class="td">
        <h1>INTRA ÎN CONTUL TĂU</h1>
     
        <p class=" center">Completează formularul pentru a te loga în cont.</p>
        <form action="{{ route('post_login') }}" class="form styled3" method="post">
              @include('partials.errors.list')
                <div class="col s12">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <p class="left-align" style="margin-bottom: 25px;">
                            <input type="checkbox" id="check1">
                            <label for="check1">Vreau să intru automat</label>
                            <br>
                        </p>
                        <input type="submit" value="Intră în cont" class="btn btn_base btn_submit full_width">
                    </div>
                </div>
                <div class="col s12">
                        <hr class="hr-text" data-content="OR">

                    <div class="input-field">
                        <a href="{{ route('social_auth', 'facebook') }}" class="btn btn_facebook full_width">
                            <i class="icon-facebook"></i>&nbsp;Intră cu ajutorul Facebook
                        </a>
                        <a href="#" class="btn btn_gplus full_width">
                            <i class="icon-google-plus"></i>&nbsp;Intră cu ajutorul Google+
                        </a>
                    </div>
                </div>
                <div class="response"></div>
            {!! csrf_field() !!}
        </form>
    </div>
</div>


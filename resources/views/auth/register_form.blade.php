
            <h1>ÎNREGISTRAREA CONTULUI</h1>
            <p>Completează formularul pentru a crea un cont.</p>
            <form action="{{ route('post_register') }}" class="form styled3 
            {{ (request()->route()->getName() == 'get_register') ? "row" : ""}}" data-authtype="register" 
                method="post" data-action='{{ route('auth_modal_register') }}'>
                @include('partials.errors.list')
                 <div class="col s12">
                        <div class="input-field">
                            <input type="text" name="firstname" required placeholder="Firstname" value="{{ old('firstname') }}">
                        </div>
                    </div>
                     <div class="col s12">
                        <div class="input-field">
                            <input type="text" name="lastname" required placeholder="Lastname" value="{{ old('lastname') }}">
                        </div>
                    </div>
                     <div class="col s12">
                        <div class="input-field">
                        <input type="email" name="email" required placeholder="Ex: maria@gmail.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field register_form_phone">
                            <input type="tel" required name="phone" placeholder="XXXXXXXX"
                                   value="{{ old('phone') }}" length="8">
                            <span class="country_code_register">+373</span>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <input type="password" required name="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <input type="password" required name="password_confirmation" placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="col s12">
                        <input type="submit" value="Crează un cont" class="btn btn_base btn_submit full_width auth_register_ajax">
                        <div class="input-field">
                            <a href="{{ route('social_auth', 'facebook') }}" class="btn btn_facebook full_width">
                                <i class="icon-facebook"></i>&nbsp;Intră cu ajutorul Facebook
                            </a>
                            <a href="#" class="btn btn_gplus full_width">
                                <i class="icon-google-plus"></i>&nbsp;Intră cu ajutorul Google+
                            </a>
                            <p class="center">Ai deja un cont? <a href="{{ route('get_login') }}" class="c_base
                            ">Intră în cont</a></p>
                        </div>
                    </div>
                {!! csrf_field() !!}
            </form>
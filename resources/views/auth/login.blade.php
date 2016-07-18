@extends('auth.layout')

@section('content')
    <div class=" display-table authentification">
        <div class="td">
            <h1>INTRA ÎN CONTUL TĂU</h1>
            <p>Completează formularul pentru a te loga în cont.</p>
            <form action="{{ route('post_login') }}" class="form styled3 row" method="POST">
                @include('partials.errors.list')
                @if(session()->has('status'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session('status') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">ADRESA ELECTRONICA*</span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">PAROLA*</span>
                        <input type="password" name="password" placeholder="Password">
                        <p class="left-align">
                            <input type="checkbox" id="check1">
                            <label for="check1">Vreau să intru automat</label>
                        </p>
                    </div>
                </div>
                <div class="col s12">
                    <input type="submit" value="Intră în cont" class="btn btn_base btn_submit full_width">
                    <p>Ai uitat parola?<a href="{{ route('get_recover') }}" class="c_base">&nbsp;Restabilești-o</a></p>
                    <a href="{{ route('social_auth', 'facebook') }}" class="btn btn_facebook full_width">
                        <i class="icon-facebook"></i>&nbsp;Intră cu ajutorul Facebook
                    </a>
                    <a href="#" class="btn btn_gplus full_width">
                        <i class="icon-google-plus"></i>&nbsp;Intră cu ajutorul Google+
                    </a>
                    <p>Nu ai cont? <a href="{{ route('get_register') }}" class="c_base">Registrarea</a></p>

                </div>

                {!! csrf_field() !!}
            </form>
        </div>
    </div>
@endsection
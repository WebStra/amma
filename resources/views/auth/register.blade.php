@extends('auth.layout')

@section('content')
    <div class=" display-table  authentification">
        <div class="td">
            <h1>ÎNREGISTRAREA CONTULUI</h1>

            <p>Completează formularul pentru a crea un cont.</p>
            <form action="{{ route('post_register') }}" class="form styled3 row" method="post">
                @include('partials.errors.list')
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">ADRESA ELECTRONICA*</span>
                        <input type="email" name="email" placeholder="Ex: maria@gmail.com" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">PAROLA*</span>
                        <input type="password" name="password">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">CONFIRMA PAROLA*</span>
                        <input type="password" name="password_confirmation">
                    </div>
                </div>
                <div class="col s12">
                    <input type="submit" value="Crează un cont" class="btn btn_base btn_submit full_width">
                    <p>Ai deja un cont? <a href="{{ route('get_login') }}" class="c_base">Intră în cont</a></p>
                </div>

                {!! csrf_field() !!}
            </form>
        </div>
    </div>
@endsection
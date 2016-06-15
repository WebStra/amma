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
                        <span class="label">Your First Name*</span>
                        <input type="text" name="firstname" required placeholder="Firstname" value="{{ old('firstname') }}">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">Your Last Name*</span>
                        <input type="text" name="lastname" required placeholder="Lastname" value="{{ old('lastname') }}">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">ADRESA ELECTRONICA*</span>
                        <input type="email" name="email" required placeholder="Ex: maria@gmail.com" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">PAROLA*</span>
                        <input type="password" required name="password" placeholder="Enter password">
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">CONFIRMA PAROLA*</span>
                        <input type="password" required name="password_confirmation" placeholder="Confirm password">
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
@extends('auth.layout')
<div class=" display-table authentification">
    <div class="td">
        <h1>Reseteaza Parola</h1>
        <p class=" center">Completează formularul modifica parola.</p>
        <form class="form styled3 row" method="POST" action="{{ route('reset_password') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token->token }}">

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
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
            </div>

            <div class="col s12">
                <input type="submit" value="Resset Password" class="btn btn_base btn_submit full_width">
            </div>
        </form>
    </div>
</div>

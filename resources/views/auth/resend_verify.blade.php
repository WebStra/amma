@extends('auth.layout')

@section('content')
    <div class="display-table authentification">
        <div class="td">
            <h1>Confirmation code email</h1>
            <p>Check email adress for confirmation code to finish registration. If you don't receive any message resend confirmation code or please contact the support.</p>
            @if(\Session::has('success'))
                <div>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <form action="{{ route('resend_verify_email') }}" class="form styled3 row" method="POST">
                <div class="col s12">
                    <input type="submit" value="RESEND" class="btn btn_base btn_submit full_width">
                </div>
            </form>
        </div>
    </div>
@endsection
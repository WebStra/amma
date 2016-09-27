@extends('emails.layout')

@section('subject')
    This is link to reset your password
@endsection

@section('message')
For reset password click on this button
@stop

@section('link_text')
    Reset Password
@stop

@section('link')
    {{ route('reset_password_token', [ 'token' => $token ]) }}
@stop

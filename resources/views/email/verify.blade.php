@extends('email.layout')

<?php $link = route('verify_email', ['confirmation_code' => $user->confirmation_code]) ?>

@section('content')
    Thanks for creating an account.
    Please follow the link below to verify your email address
    <a target="_blank" href="{{ $link }}">Confirm Email Address</a>
@endsection
@extends('email.layout')

<?php $link = route('verify_email', ['confirmation_code' => $user->confirmation_code]) ?>

@section('content')
    {!! $meta->getMeta('confirm_email') !!}
    <a target="_blank" href="{{ $link }}">{!! $meta->getMeta('link_confirm') !!}</a>
@endsection
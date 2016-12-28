@extends('emails.layout')

@section('subject')
    @if(session()->has('subject'))
        {{ session()->get('subject') }}
    @endif
@endsection

@section('message')
    {{ $product->lot->involved->sum('count') }}
@endsection

@section('link')

@endsection
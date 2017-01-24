@extends('emails.layout')


@section('subject')
   {{$request->name}}
@endsection

@section('message')
    <p>{{$request->message}}</p>
    <span  style="color:#000;  line-height: 54px; display:block; min-width:240px; font-size: 18px; font-weight: 500;">Telefon: (+373) {{$request->phone}}</span>
    <span  style="color:#000;  line-height: 54px; display:block; min-width:240px; font-size: 18px; font-weight: 500;">Email: {{$request->email}}</span>
@endsection


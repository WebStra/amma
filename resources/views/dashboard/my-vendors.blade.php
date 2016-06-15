@extends('layout')

@section('content')
    <ul>
        @foreach($vendors as $item)
            <li>
                <a href="{{ route('view_vendor', ['slug' => $item->slug]) }}">{{ $item->present()->renderTitle() }}</a>
                &nbsp;
                <a href="{{ route('edit_vendor', ['slug' => $item->slug]) }}">Edit</a>
            </li>
        @endforeach
    </ul>
@endsection
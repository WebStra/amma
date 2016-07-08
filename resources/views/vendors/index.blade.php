@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @foreach($vendors as $item)
                    @include('vendors.partials.item-block-second')
                @endforeach
            </div>

            <div style="width: 100%">
                <div style="text-align: center; margin-top: 35px">
                    {!! $vendors->render() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
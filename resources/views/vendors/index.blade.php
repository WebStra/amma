@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @foreach($vendors as $item)
                    @include('vendors.partials.item-block-second')
                @endforeach
            </div>

            <div class="paginate_container">
                <div class="paginate_render">
                    {!! $vendors->render() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
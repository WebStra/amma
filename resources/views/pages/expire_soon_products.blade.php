@extends('layout')

@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col l12 m7 s12 list-lots">
                    @if(count($lot))
                        @foreach($lot as $item)
                            @include('lots.partials.single_lot',['lot'=>$item])
                        @endforeach
                    @endif
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection
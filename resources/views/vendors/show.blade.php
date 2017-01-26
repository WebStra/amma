@extends('layout')

@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('vendors.partials.left-sidebar')
                <div class="col l8 m7 s12 list-lots">
                    @if(count($lots = $item->lots))
                        @foreach($lots as $lot)
                            @include('lots.partials.single_lot', [ 'lot' => $lot ])
                        @endforeach
                    @else
                        <p>This vendor don't have a lots.</p>
                    @endif
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection
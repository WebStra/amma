@extends('layout')

@section('content')
    <div class="list-lots">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    @if(count($lots))
                        @foreach($lots as $lot)
                            @include('lots.partials.single_lot')
                        @endforeach
                    @else
                        <span>You don't have a lots.</span>
                    @endif
                </div>
            </div>

            @if(count($lots))
                <div class="row">
                    <div class="col l9 m7 s12">
                        <div class="paginate_container">
                            <div class="paginate_render">
                                {!! $lots->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
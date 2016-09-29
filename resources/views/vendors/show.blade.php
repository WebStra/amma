@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('vendors.partials.left-sidebar')
                <div class="col l8 m7 s12">
                    @if(count($lots = $item->lots))
                        <ul class="elements divide-top bordered pd_8">
                            @foreach($lots as $lot)
                                @include('lots.partials.lot_product', [ 'item' => $lot ])
                            @endforeach
                        </ul>
                    @else
                        <p>This vendor don't have a lots.</p>
                    @endif
                </div><!--right block-->
            </div>
        </div>
        @include('partials.fb-comments')
    </section>
@endsection
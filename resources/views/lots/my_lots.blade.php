@extends('layout')

@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection

@section('content')
    <div class="list-lots">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12 list-lots">
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
    <!-- Modal Structure -->
    <div id="number-buyers" class="modal">
        <div class="modal-content">
            <h4>Nothing</h4>
        </div>
<!--         <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
</div> -->
    </div>
@endsection

@section('js')
    <script>
          $(document).ready(function(){
            var inProcess = false;
            $('a[data-target="modal"]').click(function(event) {
                $.LoadingOverlay("show", {color: "rgba(255, 255, 255, 0.9)"});
                 if (!inProcess) {
                    var id = $(this).data('lot-id');
                    $.ajax({
                        url: "{{route('getBuyers')}}",
                        data: {lot_id:id},
                        method: 'post',
                        beforeSend: function () {
                            inProcess = true;
                        },
                        success: function (view) {
                            if (view != 'false') {
                                $('#number-buyers .modal-content').html(view);
                                $.LoadingOverlay("hide")
                                $('#number-buyers').openModal({dismissible: true,opacity: .5,in_duration: 300,out_duration: 200});
                            }
                        },
                        error: function(view){

                        }
                    }).done(function( view ) {
                        inProcess = false;
                    });
                }else{
                    //$("html, body").animate({ scrollTop: "200px" });
                }
            });
          });
    </script>
@endsection
@if(session()->has('status'))
    <span class="hidden" data-notification>{{ session()->get('status') }}</span>
@endif

@section('js')
    <script>
    $(function () {
        $(document).ready(function () {
            var $message = $('span[data-notification]').html();

            Materialize.toast($message, 5000);
        });
    });
    </script>
@endsection
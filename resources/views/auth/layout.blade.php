<html lang="en" style="height:100%">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <link href="/assets/fonts/myfont/css/myfont.css" type="text/css" rel="stylesheet" media="">
    <link href="/administrator/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="">
    <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="">
    <link href="/assets/css/main.css" type="text/css" rel="stylesheet" media="">
    <link href="/assets/css/custom.css" type="text/css" rel="stylesheet" media="">
    @yield('css')

</head>

<body style="height:100%">

@include('partials.notification')

@yield('content')

@yield('js')

{!!Html::script('/assets/js/jquery-2.1.1.min.js')!!}
{!!Html::script('/assets/plugins/materialize/js/materialize.min.js')!!}
{!!Html::script('/assets/plugins/toastr/build/toastr.min.js')!!}

<script>
    $(document).ready(function(){
        $(function () {
            var $span = $('span[data-notification]');

            if ($span.length) {
                Materialize.toast($span.html(), 5000);
            }
        });
    });
</script>

</body>
</html>
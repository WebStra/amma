<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{!! $meta->getMeta('verify_your_email_address') !!}</h2>

        <div>
            @yield('content')
        </div>

    </body>
</html>
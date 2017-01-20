<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>E-commerce</title>
    <!-- IE6-10 -->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- other browsers -->
    <link rel="icon" href="/favicon.ico">

    @include('partials.assets.css')
    @yield('meta')
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="loading-animation">&nbsp;</div>
</div>
<!-- /Preloader -->

@include('partials.header.index')

@if(Breadcrumbs::exists())
    <div class="container">
        {!! Breadcrumbs::render() !!}
    </div>
@endif

@include('partials.notification')

@yield('content')

@include('partials.footer.index')

<!-- Scripts -->
@include('partials.assets.js')
{{--Load additional js libraries--}}
@yield('js')
{{--Load additional scripts--}}
@yield('scripts')

</body>

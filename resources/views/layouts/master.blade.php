<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Base asset -->
    <base href="{{asset('')}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=" {{asset('css/style.css')}} " type="text/css"/>
    @yield('css')
    <!-- Using file boostrap.js from mix -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/file.js') }}"></script>
    <title>Cafebiz</title>
</head>

<body>
<div class="wapper">

    @include('layouts.header')
    @include('layouts.advertise.advertise_top')`
    @yield('content')
    @include('layouts.advertise.advertise_bottom')

    @include('layouts.footer')
</div>
</body>

@yield('script')

</html>

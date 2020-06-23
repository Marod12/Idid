<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (Route::current()->getName() === 'home' ? 'Home' : Route::current()->getName()) }}</title>

    <!-- Icon -->
    <link rel="icon" href="../storage/logo/spatula-branca.svg">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icones Site -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" 
        crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/main.css')) }}">


</head>
<body>
    
    <main>
        @yield('content')
    </main>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  <!-- *Jquery -->
    <script src="{{ asset('js/image.js') }}"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script> -->  <!-- *Ajax -->

</body>
</html>

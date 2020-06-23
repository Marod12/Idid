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
    @if(Auth::user() == TRUE)
        <!-- Menu principal -->
        <header class="topnav">
            <div class="container">
                <a class="topnav__logo" href="{{ route('home') }}">
                    <img src="../storage/logo/spatula-laranja.svg" alt="Idid">
                </a>
                <button class="topnav__icon">
                    <a href="{{ route('Cadastro de receita') }}">
                        <i class="">Cadastrar receita</i>
                    </a>
                </button>

                <button class="topnav__icon">
                    <a href="{{ route('Pesquisar') }}">
                        <i class="fa fa-search"></i>
                    </a>
                </button>

                <button class="topnav__icon">
                    <div class="topnav__usuario">
                        <a href="{{ route('Perfil') }}">    
                            @if(Auth::user()->foto  == null)
                                <img src="/storage/padrao/chef.png">
                            @else
                                <img src="/storage/{{ Auth::user()->foto }}">
                            @endif
                        </a>
                    </div>
                </button>

                <button class="topnav__icon">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </button>

                <form id="logout-form" 
                    action="{{ route('logout') }}" 
                    method="POST"  
                    style="display: none;">
                    @csrf
                </form>
            </div>
        </header>
    @else
    @endif
    
    <main>
        @yield('content')
    </main>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  <!-- *Jquery -->
    <script src="{{ asset('js/image.js') }}"></script>

</body>
</html>

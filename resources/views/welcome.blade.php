<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Idid</title>

        <!-- Icon -->
        <link rel="icon" href="storage/logo/spatula-laranja.svg">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/welcome.css')) }}">

    </head>
    <body>
        <section>
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    @auth
                    <div class="top-right links">
                        <a href="{{ url('/home') }}">
                            <img class="spatula_home" src="storage/logo/spatula-branca.svg" alt="Home">
                        </a>
                    </div>
                    @endauth
                @endif

                <div class="content">
                    <img src="{{ asset('storage/logo/logo-full-branca.svg') }}" alt="logo"/>
                    <div class="title m-b-md">
                        Sejá um Idider!
                    </div>

                    
                    @if (Route::has('login'))    
                        @auth
                        @else
                            <div class="links">
                                <a href="/login">Login</a>
                                <a href="/register">Cadastre-se</a>
                            </div>
                        @endauth
                    @endif

                </div>
            </div>
        </section>
    </body>
</html>

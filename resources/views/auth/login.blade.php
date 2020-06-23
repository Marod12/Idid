@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="content">
            <section>
                <img class="logo" src="{{ asset('storage/logo/logo-orig.svg') }}" alt="Idid"/>
                <div class="links">
                    <a href="{{ route('register') }}">Não tenho cadastro</a>
                </div>
            </section>

            <form action="{{ route('login') }}" method="post">
                @csrf
                
                <h1>Faça seu login</h1>
                <!-- Login -->
                <input type="email" placeholder="  Digite seu email" 
                name="email" id="email"
                required autocomplete="email" autofocus>
            
                <!-- Senha -->
                <input type="password" placeholder="  Digite sua senha" 
                name="password" id="password">
    
                <button class="button" type="sunmit">Entrar</button>

                <div class="links-r">
                    <a href="{{ route('register') }}">Não tenho cadastro</a>
                </div>
            </form>
        </div>
    </div>
@endsection

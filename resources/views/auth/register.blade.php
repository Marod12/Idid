@extends('layouts.app')

@section('content')
    <div class="register-container">
        <div class="content">
            <section>
                <img class="logo" src="{{ asset('storage/logo/logo-orig.svg') }}" alt="Idid"/>

                <div class="title">
                    Junte-se a nos e sejá um Idider
                    <img class="spatula" src="{{ asset('storage/logo/spatula-preta.svg') }}" alt="Spatula"/>
                </div>

                <div class="links">
                    <a href="{{ route('login') }}">Já tenho cadastro</a>
                </div>
            </section>

            <form action="{{ route('register') }}" method="post">
                @csrf

                <h1>Cadastro</h1>
                <!-- Nome -->
                <input type="text" required
                    placeholder="  Nome Sobrenome" name="nome" id="nome"
                    class="form-control @error('nome') is-invalid @enderror"> <!-- required="" -->
                
                <!-- Email -->
                <input type="email" required
                    placeholder="  @email.com" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Já temos esse email cadastrado!</strong>
                            <strong>Informe outro email, para realizar seu cadastro.</strong>
                        </span>
                    @enderror
                
                <div class="input-group">
                    <!-- Senha -->
                    <input type="password" 
                        placeholder="  Digite sua senha" name="password"
                        id="password" required autocomplete="new-password"
                        class="form-control @error('password') is-invalid @enderror">
                    <!-- Confirmação de senha -->
                    <input type="password" 
                        placeholder="  Confirme sua senha" name="password_confirmation"
                        id="password-confirm" required autocomplete="new-password">
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>As senhas não conferem!</strong>
                    </span>
                @enderror   

                <button class="button" type="submit">Cadastrar</button>

                <div class="links-r">
                    <a href="{{ route('login') }}">Já tenho cadastro</a>
                </div>
            </form>
        </div>
    </div>
@endsection

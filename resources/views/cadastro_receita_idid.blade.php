@extends('layouts.appSmenu')
    
@section('content')
    <div class="container">
        <div class="cadastro-receita-container">
            <div class="cadastro-receita-content-idid">
                    <header class="cadastro-receita__header-idid">
                        <h1>Cadastro<img src="{{ asset('storage/logo/logo-full-branca.svg') }}" alt="Idid"></h1> 
                    </header>
                    
                    <figure class="cadastro-receita__figure">
                        <img id="input__img" src="{{ asset('storage/padrao/cooking.jpg') }}" alt="imagem da sua receita aqui">
                    </figure>
                    
                <form action="{{ route('Cadastro de receita.do') }}" 
                method="post" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" IMPORTANTE p/ enviar arquivos em um form-->
                    @csrf
                    <!-- id User -->
                    <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                    <!-- id Receita -->
                    <input type="hidden" name="idid" value="{{ $receita->id }}">
                    <!-- Title -->
                    <input class="input-cadastro-receita" type="text" required
                            placeholder="  Título da receita" name="title" id="title"> <!-- required="" -->
                    <!-- Descrição -->
                        <textarea class="textarea-cadastro-receita" name="descricao"
                        placeholder="  Conte um pouco sobre sua recita. Como Tempo: 30min Rendimento: 6 porções Dificuldade: fácil "></textarea>
                    <!-- Ingredientes -->
                    <textarea class="textarea-cadastro-receita" name="ingredientes" required
                        placeholder="  Ingredientes, 1 colher de sopa..."></textarea>
                    <!-- Modo de preparo -->
                    <textarea class="textarea-cadastro-receita" name="modoPreparo" required
                        placeholder="  Modo de preparo, coloque no forno pré aquecido por 20mins."></textarea>     
                    
                    <input type="file" id="mediaFile" name="foto">

                    <button class="button" type="submit">
                        <img src="{{ asset('storage/logo/logo-full-branca.svg') }}" alt="Idid">
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="cadastro-receita__header">
        <h1>Receita original do<img src="{{ asset('storage/logo/logo-full-laranja.svg') }}" alt="Idid"></h1> 
    </div>

    <div class="container">
        <div class="cadastro-receita-container">
            <section class="feed">
                    <article class="post">
                        <header class="post__header">
                            @foreach($users as $user)
                                @if($receita->author == $user->id)
                                    <div class="user">
                                        <a href="{{ route('Usuario', ['user' => $user->id, 'name' => $user->name]) }}" class="user__thumb">
                                            @if($user->foto == null)
                                                <img src="/storage/padrao/chef.png">
                                            @else
                                                <img src="/storage/{{ $user->foto }}">
                                            @endif
                                        </a>
                                        <a href="{{ route('Usuario', ['user' => $user->id, 'name' => $user->name]) }}" class="user__name">{{ $user->name }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </header>

                        <figure class="post__figure">
                            @if($receita->foto == null)
                                <img src="/storage/padrao/cooking.jpg">
                            @else
                                <img src="/storage/{{ $receita->foto }}" alt="imagem da receita">
                            @endif
                        </figure>
                        
                        <div class="post-content">
                            <div>
                                <h1>{{ $receita->title }}</h1>
                            </div>
                            <p>
                                {{ $receita->descricao }}
                            </p>

                            <h2>Ingredientes</h2>
                            <pre>{{$receita->ingredientes}}</pre>
                            
                            <h2>Modo de Preparo</h2>
                            <div class="modoPreparo">
                                <p1>
                                    {{$receita->modoPreparo}}
                                </p1>
                            </div>    
                        </div>
   
                    </article>
            </section>
        </div>
    </div>
@endsection
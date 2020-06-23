@extends('layouts.appSmenu')
    
@section('content')
    <div class="container">
        <div class="cadastro-receita-container">
            <div class="cadastro-receita-content">
                    <header class="cadastro-receita__header">
                        <h1>Cadastro de receita</h1>
                    </header>
                    
                    <figure class="cadastro-receita__figure">
                        <img id="input__img" src="{{ asset('storage/padrao/cooking.jpg') }}" alt="imagem da sua receita aqui">
                    </figure>
                    
                <form action="{{ route('Cadastro de receita.do') }}" 
                method="post" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" IMPORTANTE p/ enviar arquivos em um form-->
                    @csrf
                    <!-- id User -->
                    <input type="hidden" name="author" value="{{ Auth::user()->id }}">
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

                    <button class="button" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
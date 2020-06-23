@extends('layouts.appSmenu')
    
@section('content')
    <div class="container">
        <div class="cadastro-receita-container">
            <div class="cadastro-receita-content">
                    
                    <figure class="cadastro-receita__figure">
                        @if($receita->foto != null)
                            <img id="input__img" src="/storage/$receita->foto" alt="imagem da sua receita aqui">
                        @else
                            <img id="input__img" src="{{ asset('storage/padrao/cooking.jpg') }}" alt="imagem da sua receita aqui">
                        @endif
                        </figure>
                    
                <form action="{{ route('Editar receita.do', ['receita' => $receita->id]) }}" 
                method="post" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" IMPORTANTE p/ enviar arquivos em um form-->
                    @csrf
                    @method('PUT')
                    <!-- id User -->
                    <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                    <!-- Title -->
                    <input class="input-cadastro-receita" type="text" required
                        value="{{ $receita->title }}" name="title" id="title"> <!-- required="" -->
                    <!-- Descrição -->
                        <textarea class="textarea-cadastro-receita" name="descricao"
                        placeholder="  Conte um pouco sobre sua recita. Como Tempo: 30min Rendimento: 6 porções Dificuldade: fácil ">{{ $receita->descricao }}</textarea>
                    <!-- Ingredientes -->
                    <textarea class="textarea-cadastro-receita" name="ingredientes" required
                        >{{ $receita->ingredientes }}</textarea>
                    <!-- Modo de preparo -->
                    <textarea class="textarea-cadastro-receita" name="modoPreparo" required
                        >{{ $receita->modoPreparo }}</textarea>     
                    
                    <input type="file" id="mediaFile" name="foto">

                    <button class="button" type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
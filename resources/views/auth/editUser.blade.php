@extends('layouts.appSmenu')
    
@section('content')
    <div class="container">
        <section class="editar--perfil">
            <h1>Editar dados</h1>
            <div class="editar__container--perfil">
                <div class="content__edit">
                    <span class="figure__user">
                        @if(Auth::user()->foto  == null)
                            <img id="input__img" src="/storage/padrao/chef.png">
                        @else
                            <img id="input__img" src="/storage/{{ Auth::user()->foto }}">
                        @endif
                    </span>
                </div>

                <div class="content__edit">
                    <form class="form__edit--perfil"
                    action="{{ route('edit.user', ['user' => $user->id]) }}" 
                    method="post" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" IMPORTANTE p/ enviar arquivos em um form-->
                        @csrf
                        @method('PUT')
                        <!-- Nome -->
                        <input type="text" required
                            placeholder="  Nome" name="nome" id="nome"
                            value="{{ $user->name }}">
                        <!-- Email -->
                        <input type="email" required
                            placeholder="  @mail.com" name="email" id="email"
                            value="{{ $user->email }}">

                        <!-- Descrição -->
                        <textarea name="descricao">
                            {{ $user->descricao }}
                        </textarea>
                        <div class="input-group">
                            <!-- Sexo -->
                            <select name="sexo" >
                                <option value="{{ $user->sexo }}">Escolha uma opção</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                            <!-- Data de Nascimento -->
                            <input type="date" name="dt_nasc" id="dt_nasc"
                            value="{{ $user->dt_nasc }}">
                        </div>
                        <input type="file" id="mediaFile" name="foto" >
                    
                        <button type="submit">Salvar</button>
                    </form>
                </div>
            </div>
        </section> 
    </div>

    <div class="container">
        <section class="editar--senha">
            <div class="editar__container--senha">
                <h1>Editar senha</h1>
                <form class="form__edit--senha"
                action="{{ route('senha.user', ['user' => $user->id]) }}" 
                method="Post">
                    @csrf
                    @method('PUT')
                    <!-- Senha atual -->
                    <input type="password" name="senhaAtual"
                    placeholder=" Senha atual">
                    <!-- Nova senha -->
                    <input type="password" name="senhaNova" 
                    placeholder=" Nova senha">
                    <!-- Confirmação da nova senha -->
                    <input type="password" name="senhaNovaConfirmacao"
                    placeholder=" Confirmação da nova senha">

                    <button type="submit">Salvar</button>
                </form>
            </div>
        </section>
    </div>
@endsection
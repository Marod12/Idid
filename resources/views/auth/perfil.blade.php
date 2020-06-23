@extends('layouts.app')
    
@section('content')
    <div class="container">
        <seciton class="perfil">
            <div class="pefil__container">
                <div class="perfil__dado">
                    <div class="user__image user__image--decoration"> 
                        <span class="user__image__wrapper">
                            @if(Auth::user()->foto  == null)
                                <img src="/storage/padrao/chef.png">
                            @else
                                <img src="/storage/{{ Auth::user()->foto }}">
                            @endif
                        </span>
                    </div>
                </div>

                <div class="perfil__dado">
                    <p1>{{ Auth::user()->name }}</p1>
                    <p>{{ Auth::user()->email }}</p>
                    <p>
                        @if(Auth::user()->dt_nasc === null)
                        @else
                            {{ @date("d/m/Y", strtotime( Auth::user()->dt_nasc )) }}
                        @endif
                    </p>
                    <p>
                        @if(Auth::user()->sexo == 'M')
                            Masculino
                        @elseif(Auth::user()->sexo == 'F')
                            Feminino
                        @endif
                    </p>
                    <p2>{{ Auth::user()->descricao }}</p2>
                </div>

                <div class="perfil__dado">
                    <a class="fa fa-edit" href="{{ route('Editar dados', ['user' => Auth::user()->id]) }}">
                    </a>
                    <a class="fa fa-user-times" 
                        href="{{ route('destroy.user', ['user' => Auth::user()->id]) }}"
                        onclick="event.preventDefault();
                        document.getElementById('destroy-form-user').submit();">
                    </a>
                    <form id="destroy-form-user"
                        action="{{ route('destroy.user', ['user' => Auth::user()->id]) }}"
                        method="POST" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </seciton>

        <nav class="catalogo-menu">
            <div class="container">
                <ul class="catalogo-menu-lista">
                    <li class="catalogo-menu-lista-item">
                        <button value="amigosUser" onclick="openSection('amigosUser')">Amizades</a>
                    </li>
                    <li class="catalogo-menu-lista-item">
                        <button value="receitasUser" onclick="openSection('receitasUser')">Receitas</a>
                    </li>
                    <li class="catalogo-menu-lista-item">
                        <button value="savesUser" onclick="openSection('savesUser')">Salvas</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="receitas" id="receitasUser" style="display: none;">
            @if($receitas == '[]')
                <h1>Notei que ainda não possui receitas cadastradas</h1>
                <button class="new__receita">
                    <a href="{{ route('Cadastro de receita') }}">
                        Cadastre uma receita
                    </a>
                </button>
            @else
                @foreach($receitas as $receita)
                  @if($receita->idid == null)
                    <article class="receita">
                        <figure class="receita__figure">
                            <a href="{{ route('Receita', ['slug' => $receita->slug, 'receita' => $receita->id ]) }}" >
                                @if($receita->foto == null)
                                    <img src="/storage/padrao/cooking.jpg" alt="imagem da receita">
                                @else
                                    <img src="storage/{{ $receita->foto }}" alt="imagem da receita">
                                @endif
                            </a>
                        </figure>
                        <div class="receita__body">
                            <div class="receita__content">
                                <h1>{{ $receita->title }}</h1>
                                <h2>{{ $receita->descricao }}</h2> 
                            </div>

                            <div class="receita__footer">
                                <button>
                                    <a class="fa fa-edit" href="{{ route('Editar receita', ['receita' => $receita->id]) }}">
                                    </a>
                                </button>
                                <button>
                                    <a class="fa fa-trash" 
                                        href="{{ route('destroy.receita', ['receita' => $receita->id]) }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('destroy-form-receita').submit();">
                                    </a>
                                    <form id="destroy-form-receita"
                                        action="{{ route('destroy.receita', ['receita' => $receita->id]) }}" 
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </button>
                            </div>
                        </div>
                    </article>
                  @else
                    <article class="receita">
                        <figure class="receita__figure">
                            <a href="{{ route('Receita', ['slug' => $receita->slug, 'receita' => $receita->id ]) }}" >
                                @if($receita->foto == null)
                                    <img src="/storage/padrao/cooking.jpg" alt="imagem da receita">
                                @else
                                    <img src="storage/{{ $receita->foto }}" alt="imagem da receita">
                                @endif
                            </a>
                        </figure>
                        <div class="receita__body-idid">
                            <div class="receita__content-idid">
                                <h1>{{ $receita->title }}</h1>
                                <h2>{{ $receita->descricao }}</h2> 
                            </div>

                            <div class="receita__footer">
                                <button>
                                    <a class="fa fa-edit" href="{{ route('Editar receita', ['receita' => $receita->id]) }}">
                                    </a>
                                </button>
                                <button>
                                    <a class="fa fa-trash" 
                                        href="{{ route('destroy.receita', ['receita' => $receita->id]) }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('destroy-form-receita').submit();">
                                    </a>
                                    <form id="destroy-form-receita"
                                        action="{{ route('destroy.receita', ['receita' => $receita->id]) }}" 
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </button>
                            </div>
                        </div>
                    </article>
                  @endif  
                @endforeach
            @endif
        </section>
        
        <section class="receitas" id="amigosUser" style="display: none;">
            @if($colegas == '[]')
                <h1>Notei que ainda não possui amigos</h1>
                <button class="new__receita">
                    <a href="{{ route('Pesquisar') }}">
                        Procure um amigo
                    </a>
                </button>
            @else
                @foreach($colegas as $colega)
                    @foreach($users as $user)
                        @if($colega->seguido == $user->id)
                            <article class="receita">
                                <figure class="receita__figure-user">
                                    <a href="{{ route('Usuario', ['user' => $user->id, 'name' => $user->name]) }}" class="user__thumb" >
                                        @if($user->foto == null)
                                            <img src="/storage/padrao/chef.png">
                                        @else
                                            <img src="/storage/{{ $user->foto }}">
                                        @endif
                                    </a>
                                </figure>
                                <div class="receita__body">
                                    <div class="receita__content">
                                        <h1>{{ $user->name }}</h1>
                                        <h2>{{ $user->descricao }}</h2> 
                                    </div>

                                    <div class="receita__footer">
                                        <button>
                                            <a href=""
                                            onclick="event.preventDefault();
                                            document.getElementById('destroy__seguir-form{{ $colega->id }}').submit();">
                                                Deixar de seguir
                                            </a>
                                        </button>
                                        <form id="destroy__seguir-form{{ $colega->id }}" 
                                            action="{{ route('destroy.colega', ['colega' => $colega->id]) }}" 
                                            method="POST"  
                                            style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endif
                    @endforeach    
                @endforeach
            @endif
        </section>

        <section class="receitas" id="savesUser" style="display: none;">
            @if($saves == '[]')
                <h1>Você ainda não tem nenhuma receita salva</h1>
            @else
                @foreach($saves as $save)
                    @foreach($receitasC as $receitaC)
                        @if($save->receita == $receitaC->id)
                            <article class="receita">
                                <figure class="receita__figure">
                                    <a href="{{ route('Receita', ['slug' => $receitaC->slug, 'receita' => $receitaC->id ]) }}" >
                                        @if($receitaC->foto == null)
                                            <img src="/storage/padrao/cooking.jpg" alt="imagem da receita">
                                        @else
                                            <img src="storage/{{ $receitaC->foto }}" alt="imagem da receita">
                                        @endif
                                    </a>
                                </figure>
                                <div class="receita__body">
                                    <div class="receita__content">
                                        <h1>{{ $receitaC->title }}</h1>
                                        <h2>{{ $receitaC->descricao }}</h2> 
                                    </div>

                                    <div class="receita__footer">
                                        <button class="post__control">
                                            <a href="{{ route('Cadastro idid', ['receita' => $receitaC->id ]) }}" >
                                                <img src="/storage/logo/spatula-laranja.svg" alt="Idid">
                                            </a>
                                        </button>
                                        <button class="post__control">
                                            <a href="{{ route('destroy.save', ['save' => $save->id]) }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('store-form-destroy{{ $receita->id }}').submit();">
                                                    <img src="/storage/padrao/batedeira.svg" alt="Batedeira">
                                            </a>
                                        </button>
                                        <form id="store-form-destroy{{ $receita->id }}"
                                            action="{{ route('destroy.save', ['save' => $save->id]) }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endif
                    @endforeach    
                @endforeach
            @endif
        </section>
    </div>

    <script>
        function openSection(id) {
            if(document.getElementById(id).style.display == 'flex'){
                document.getElementById(id).style.display = 'none';
            } else{
                document.getElementById(id).style.display = 'flex';
            }
        }
    </script>
@endsection

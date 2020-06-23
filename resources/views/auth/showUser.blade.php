@extends('layouts.appSmenu')

@section('content')
    <div class="container">
        <seciton class="perfil">
            <div class="pefil__container">
                <div class="perfil__dado">
                    <div class="user__image user__image--decoration"> 
                        <span class="user__image__wrapper">
                            @if($user->foto == null)
                                <img src="/storage/padrao/chef.png">
                            @else
                                <img src="/storage/{{ $user->foto }}">
                            @endif
                        </span>
                    </div>
                </div>

                <div class="perfil__dado">
                    <p1>{{ $user->name }}</p1>
                    <p>{{ $user->sobrenome }}</p>
                    <p>
                        @if( $user->sexo == 'M' )
                            Masculino
                        @elseif( $user->sexo == 'F' )
                            Feminino
                        @endif
                    </p>
                    <p2>{{ $user->descricao }}</p2>
                </div>

                @if(Auth::user() ?? '')
                    @if(Auth::user()->id != $user->id)
                        @if(count($colegas) == 0)
                            <div class="perfil__dado">
                                <button class="topnav__icon">
                                    <a href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('seguir-form').submit();">
                                        Seguir 
                                    </a>
                                </button>
                                <form id="seguir-form" 
                                    action="{{ route('newAmizade') }}" 
                                    method="POST"  
                                    style="display: none;">
                                    @csrf
                                    <!-- id User a ser seguido -->
                                    <input type="hidden" name="seguido" value="{{ $user->id }}">
                                </form>
                            </div>
                        @else
                            <div class="perfil__dado">
                                @foreach($colegas as $colega)

                                    @if($colega->seguido == $user->id && $colega->seguidor == Auth::user()->id)
                                        <button class="{{ route('destroy.colega', ['colega' => $colegas->id]) }}">
                                            <a href="#"
                                            onclick="event.preventDefault();
                                            document.getElementById('destroy__seguir-form').submit();">
                                                Deixar de seguir
                                            </a>
                                        </button>
                                        <form id="destroy__seguir-form" 
                                            action="{{ route('destroy.colega', ['colega' => $colegas->id]) }}" 
                                            method="POST"  
                                            style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    @else    
                                        <button class="topnav__icon">
                                            <a href="#"
                                            onclick="event.preventDefault();
                                            document.getElementById('seguir-form').submit();">
                                                Seguir 
                                            </a>
                                        </button>
                                        <form id="seguir-form" 
                                            action="{{ route('newAmizade') }}" 
                                            method="POST"  
                                            style="display: none;">
                                            @csrf
                                            <!-- id User a ser seguido -->
                                            <input type="hidden" name="seguido" value="{{ $user->id }}">
                                        </form>
                                    @endif 
                                @endforeach
                            </div>
                        @endif
                    @endif
                @endif
                    
            </div>
        </seciton>

        @if($receitas == '[]')
        @else
            <section class="receitas">
                <h1>Receitas</h1>
                @foreach($receitas as $receita)
                    @if($receita->idid == null)
                        <article class="receita">
                            <figure class="receita__figure">
                                <a href="{{ route('Receita', ['slug' => $receita->slug, 'receita' => $receita->id ]) }}" >
                                    @if($receita->foto == null)
                                        <img src="/storage/padrao/cooking.jpg" alt="imagem da receita">
                                    @else
                                        <img src="/storage/{{$receita->foto }}" alt="imagem da receita">
                                    @endif
                                </a>
                            </figure>
                            <div class="receita__body">
                                <div class="receita__content">
                                    <h1>{{ $receita->title }}</h1>
                                    <h2>{{ $receita->descricao }}</h2> 
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
                                        <img src="/storage/{{$receita->foto }}" alt="imagem da receita">
                                    @endif
                                </a>
                            </figure>
                            <div class="receita__body-idid">
                                <div class="receita__content-idid">
                                    <h1>{{ $receita->title }}</h1>
                                    <h2>{{ $receita->descricao }}</h2> 
                                </div>
                            </div>
                        </article>
                    @endif
                @endforeach
            </section>
        @endif
    </div>
@endsection
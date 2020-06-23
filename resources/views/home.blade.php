@extends('layouts.app')

@section('content')
    <div class="top"></div>
    
    <div class="container">
        @if($colegas == '[]')
            <section class="hello__feed">
                <h1>Notei que ainda não segue ninguém</h1>
                <button class="pesquisa__feed">
                    <a href="{{ route('Pesquisar') }}">
                        Comece a seguir alguém
                    </a>
                </button>
            </section>
        @else
            @foreach($colegas as $colega)
                <section class="feed">
                    @foreach($receitas as $receita)
                        @if($receita->author == $colega->seguido)
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
                                    @if($receita->idid != null)
                                        <img src="{{ asset('storage/logo/logo-full-laranja.svg') }}" alt="Idid">
                                    @endif
                                </header>

                                <figure class="post__figure">
                                    <a href="{{ route('Receita', ['slug' => $receita->id, 'receita' => $receita->id ]) }}" >
                                        @if($receita->foto == null)
                                            <img src="/storage/padrao/cooking.jpg">
                                        @else
                                            <img src="/storage/{{ $receita->foto }}" alt="imagem da receita">
                                        @endif
                                    </a>
                                </figure>
                                
                                <div class="post-content">
                                    <div>
                                        <h1>{{ $receita->title }}</h1>
                                    </div>
                                    <p>
                                        {{ $receita->descricao }}
                                    </p>
                                </div>

                                <nav class="post__controls">
                                    <?php
                                        $avaliacaoInput = array();
                                    ?>

                                    @foreach($avaliacoes as $avaliacao)
                                        @if($avaliacao->receita == $receita->id && $avaliacao->author == Auth::user()->id)
                                            <?php
                                                array_push($avaliacaoInput, $avaliacao->receita . $avaliacao->author);
                                            ?>
                                        @endif    
                                    @endforeach

                                    @if(in_array($receita->id . Auth::user()->id, $avaliacaoInput))
                                        <button class="post__control" onclick="openDiv('avaliacaoEdit{{ $receita->id }}')">
                                            <img src="/storage/logo/spatula-preta.svg" alt="Idid">
                                        </button>
                                    @else
                                        <button class="post__control" onclick="openDiv('avaliacao{{ $receita->id }}')">
                                            <img src="/storage/logo/spatula-preta.svg" alt="Idid">
                                        </button>
                                    @endif


                                    <span>
                                        <?php
                                            $notas = array();
                                        ?>

                                        @foreach($avaliacoes as $avaliacao)
                                            @if($avaliacao->receita == $receita->id)
                                                <?php
                                                    array_push($notas, $avaliacao->nota);
                                                ?>
                                            @endif
                                        @endforeach
                                        
                                        @if($notas == null)
                                        @else 
                                            <?php
                                            $media = array_sum($notas)/count($notas); 
                                            ?>
                                            <?php
                                                print_r($media);
                                            ?>
                                        @endif
                                        
                                    </span>
                                    
                                    <div id="avaliacao{{ $receita->id }}" style="display: none;">
                                        <form action="{{ route('newAvaliacao') }}" method="post">
                                            @csrf
                                            <input type="hidden" id="receita" name="receita" value="{{ $receita->id }}">
                                            <input type="number" name="avaliacao" placeholder="1 a 5">
                                            <button type="submit" class="topnav__icon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <div id="avaliacaoEdit{{ $receita->id }}" style="display: none;">
                                        @foreach($avaliacoes as $avaliacao)
                                            @if($avaliacao->receita == $receita->id && $avaliacao->author == Auth::user()->id)
                                                <form action="{{ route('Editar avaliacao.do', ['avaliacao' => $avaliacao->id]) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="avaliacao" value="{{ $avaliacao->nota }}">
                                                    <button type="submit" class="topnav__icon">
                                                        <i class="fa fa-angle-double-right"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endforeach
                                    </div>    
                        
                                    <button class="post__control" onclick="openDiv('comentario{{ $receita->id }}')">
                                        <i class="fa fa-comment"></i>
                                    </button>

                                    <span>
                                        <?php
                                            $coments = array();
                                        ?>

                                        @foreach($comentarios as $comentario)
                                            @if($comentario->receita == $receita->id) 
                                                <?php
                                                    array_push($coments, $comentario->id);
                                                ?>
                                            @endif
                                        @endforeach

                                        <?php
                                            print_r(count($coments));
                                        ?>
                                    </span>
                                    
                                    @if($saves == '[]')
                                        <button class="post__control">
                                            <a href="{{ route('newSave') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('store-form-saves{{ $receita->id }}').submit();">
                                                    <img src="/storage/padrao/batedeirasc.svg" alt="Batedeira">
                                            </a>
                                        </button>
                                        <form id="store-form-saves{{ $receita->id }}"
                                            action="{{ route('newSave') }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" id="receita" name="receita" value="{{ $receita->id }}">
                                        </form>
                                    @else
                                        <?php
                                            $saveReceita = array();
                                        ?>

                                        @foreach($saves as $save)
                                            @if($save->receita == $receita->id && $save->author == Auth::user()->id)
                                                <?php
                                                    array_push($saveReceita, $receita->id . $save->author);
                                                ?>
                                            @endif
                                        @endforeach

                                        @if(in_array($receita->id . Auth::user()->id, $saveReceita))
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
                                        @else
                                            <button class="post__control">
                                                <a href="{{ route('newSave') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('store-form-saves{{ $receita->id }}').submit();">
                                                        <img src="/storage/padrao/batedeirasc.svg" alt="Batedeira">
                                                </a>
                                            </button>
                                            <form id="store-form-saves{{ $receita->id }}"
                                                action="{{ route('newSave') }}" 
                                                method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" id="receita" name="receita" value="{{ $receita->id }}">
                                            </form>
                                        @endif
                                    @endif

                                </nav>
                                <div id="comentario{{ $receita->id }}"  style="display: none;" >
                                    <div class="post__comentario" @if(count($coments) == 0) style='display: none;' @endif>
                                        <div class="coments">
                                        @foreach($comentarios as $comentario)
                                            @if($comentario->receita == $receita->id)
                                                @foreach($users as $user)
                                                    @if($comentario->author == $user->id)
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

                                                <div class="conteudo">
                                                    <p>
                                                        {{ $comentario->comentario }} 
                                                    </p>
                                                </div>
                                                    @if($comentario->author == Auth::user()->id)
                                                        <div class="receita__footer">
                                                            <button onclick="openDiv('comentarioEdit{{ $receita->id . $comentario->id }}')">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <a class="fa fa-trash" 
                                                                href="{{ route('destroy.comentario', ['comentario' => $comentario->id]) }}"
                                                                onclick="event.preventDefault();
                                                                document.getElementById('destroy-form-comentario').submit();">
                                                            </a>
                                                            <form id="destroy-form-comentario"
                                                                action="{{ route('destroy.comentario', ['comentario' => $comentario->id]) }}" 
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </div>
                                                        <div id="comentarioEdit{{ $receita->id . $comentario->id }}" style="display: none;" >
                                                            <form action="{{ route('Editar comentario.do', ['comentario' => $comentario->id]) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <textarea type="text" id="comentario" name="comentario">{{ $comentario->comentario }}</textarea>
                                                                <button type="submit" class="topnav__icon">
                                                                    <i class="fa fa-angle-double-right"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="comentar">
                                        <div class="user">
                                            <div class="user__thumb">
                                                @if(Auth::user()->foto == null)
                                                    <img src="/storage/padrao/chef.png">
                                                @else
                                                    <img src="/storage/{{ Auth::user()->foto }}">
                                                @endif
                                            </div>
                                        </div>
                                        <form action="{{ route('newComentario') }}" method="post">
                                            @csrf
                                            <input type="hidden" id="receita" name="receita" value="{{ $receita->id }}">
                                            <textarea type="text" id="comentario" name="comentario" placeholder="Seu comentário"></textarea>
                                            <button type="submit" class="topnav__icon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>    
                            </article>
                        @endif
                    @endforeach    
                </section>
            @endforeach
        @endif
    </div>

    <script>
        function openDiv(id) {
            if(document.getElementById(id).style.display == 'block'){
                document.getElementById(id).style.display = 'none';
            } else{
                document.getElementById(id).style.display = 'block';
            }
        }
    </script>
@endsection

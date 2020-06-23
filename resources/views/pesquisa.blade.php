@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Pesquisa -->
        <div class="pesquisa">
            <form method="POST"
                    action="{{ route('Pesquisa') }}" >
                @csrf

                <input type="text" name="pesquisa" value="{{ $pesquisa ?? '' }}">
                <button class="topnav__icon">
                    <a href="{{ route('Pesquisar') }}">
                        <i class="fa fa-search"></i>
                    </a>
                </button>
            </form>
        </div>
        <div class="content_pesquisa">
            <!-- Resultados dos usuarios -->
            @if($Rusers ?? '')
                <!-- <p>{{ count($Rusers) }} Usuários encontrados.</p> -->
                <div class="results__pesquisa">
                    @foreach($Rusers as $Ruser)
                        @if($Ruser->id != Auth::user()->id)
                            <div class="user">
                                <a href="{{ route('Usuario', ['user' => $Ruser->id, 'name' => $Ruser->name]) }}" class="user__thumb">
                                    @if($Ruser->foto == null)
                                        <img src="/storage/padrao/chef.png">
                                    @else
                                        <img src="/storage/{{ $Ruser->foto }}">
                                    @endif
                                </a>
                                <span>
                                    <a href="{{ route('Usuario', ['user' => $Ruser->id, 'name' => $Ruser->name]) }}" class="user__name">{{ $Ruser->name }}</a>
                                </span>   
                            </div>
                        @endif    
                    @endforeach
                </div>
            @endif
            <!-- Resultados das receitas -->
            @if($Rreceitas ?? '')
                <!-- <p class="qtreceitas">{{ count($Rreceitas) }} Receitas encontradas.</p> -->
                <div class="results__pesquisa">
                    @foreach($Rreceitas as $Rreceita)
                            <div class="receita">
                                <span>
                                    <a href="{{ route('Receita', ['slug' => $Rreceita->id, 'receita' => $Rreceita->id ]) }}" class="receita__title">{{ $Rreceita->title }}</a>
                                </span> 
                            </div>         
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection

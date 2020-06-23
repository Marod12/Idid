<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\Receita;
use App\User;
use App\Colega;
use App\Comentario;
use App\Save;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $receita = Receita::all(); //retorna todo os dados da receita
        $user = User::all(); //retorna todos os dados da tabela usuarios
        $colegas = Colega::all()->where('seguidor', '=', Auth::user()->id); //retorna todos os dados da tabela colegas que correspondem ao usuario logado
        $comentario = Comentario::all(); //retorna todos os comentarios
        $avaliacao = Avaliacao::all(); //retorna todas as avaliações
        $saves = Save::all()->where('author', '=', Auth::user()->id); //retorna todas as saves que sao do user logado
        
        // retorno
        return view('home', [
            'receitas' => $receita,
            'users' => $user,
            'colegas' => $colegas,
            'comentarios' => $comentario,
            'avaliacoes' => $avaliacao,
            'saves' => $saves
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receita;
use Illuminate\Foundation\Auth\User as AuthUser;

class PesquisaController extends Controller
{
    public function index() {
        return view('pesquisa');
    }

    public function pesquisar(Request $request) {
        //dd($request);
        //Pesquisa na tabela receitas em busca de um resultado
        $resultReceita = Receita::where('title', 'like', '%'.$request->pesquisa.'%')->get(); 
        //dd($resultReceita);
        //Pesquisa na tabela receitas em busca de um resultado
        $resultUser = AuthUser::where('name', 'like', '%'.$request->pesquisa.'%')->get(); 
        //dd($resultUser);

        return view('pesquisa', [
            'Rreceitas' => $resultReceita,
            'Rusers' => $resultUser,
            'pesquisa' => $request->pesquisa
        ]);
    }
}

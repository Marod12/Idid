<?php

namespace App\Http\Controllers;

use App\Receita;
use App\Avaliacao;
use App\User;
use App\Colega;
use App\Comentario;
use App\Save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receita = Receita::all(); //retorna todo os dados da receita

        // retorno
        return view('home', [
            'receitas' => $receita
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastro_receita');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIdid(Receita $receita)
    {
        $user = User::all(); //retorna todos os dados da tabela usuarios
   
        return view('cadastro_receita_idid', [
            'receita' => $receita,
            'users' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->idid == null){
            // Salva os dados da Receita na tabela receitas
            $receita = new Receita();
            $receita->title = $request->title;
            $receita->descricao = $request->descricao;
            $receita->ingredientes = $request->ingredientes;
            $receita->modoPreparo = $request->modoPreparo;
            $receita->author = $request->author;

            if($request->foto != null){
                // Verifica quantos arquivos estão sendo enviados
                $file = $request->foto;
                $receita->foto = $file->store('receita/');
            }

            $receita->save();
        }else {
            $receita = new Receita();
            $receita->title = $request->title;
            $receita->descricao = $request->descricao;
            $receita->ingredientes = $request->ingredientes;
            $receita->modoPreparo = $request->modoPreparo;
            $receita->author = $request->author;
            $receita->idid = $request->idid;

            if($request->foto != null){
                // Verifica quantos arquivos estão sendo enviados
                $file = $request->foto;
                $receita->foto = $file->store('receita/');
            }

            $receita->save();
        }
        
        return redirect()->route('Perfil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function show(Receita $receita)
    {
        $user = User::all(); //retorna todos os dados da tabela usuarios
        $comentario = Comentario::all(); //retorna todos os comentarios
        $avaliacao = Avaliacao::all(); //retorna todas as avaliações
        $saves = Save::all()->where('author', '=', Auth::user()->id); //retorna todas as saves que sao do user logado
        $receitaI = Receita::where('id', '=', $receita->idid)->first(); //retorna a receita do idid

        return view('showReceita', [
            'receita' => $receita,
            'users' => $user,
            'comentarios' => $comentario,
            'avaliacoes' => $avaliacao,
            'saves' => $saves,
            'receitaI' => $receitaI
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function edit(Receita $receita)
    {
        if(Auth::user()->id == $receita->author){
            return view('editReceita', [
                'receita' => $receita
            ]);
        }else {
            return redirect()->route('Perfil');
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receita $receita)
    {
        $receita->title = $request->title;
        $receita->descricao = $request->descricao;
        $receita->ingredientes = $request->ingredientes;
        $receita->modoPreparo = $request->modoPreparo;
        
        if($request->foto != null){
            // Verifica quantos arquivos estão sendo enviados
            $file = $request->foto;
            // tem que deletar o arquivo que ja está na pasta!! FAZER ESSA LÓGICA.
            $receita->foto = $file->store('receita/');
        }

        $receita->save();

        return redirect()->route('Perfil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receita $receita)
    {
        $receita->delete();

        return redirect()->route('Perfil');
    }
}

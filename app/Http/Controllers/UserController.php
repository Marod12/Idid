<?php

namespace App\Http\Controllers;

use App\Colega;
use App\Receita;
use App\User;
use App\Save;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saves = Save::all()->where('author', '=', Auth::user()->id);
        $colegas = Colega::all()->where('seguidor', '=', Auth::user()->id);
        $users = User::all(); //retorna todos os dados da tabela usuarios
        $receitas = Receita::all()->where('author', '=', Auth::user()->id);
        $receitasC = Receita::all();

        return view('auth.perfil', [
            'receitas' => $receitas,
            'users' => $users,
            'colegas' => $colegas,
            'saves' => $saves,
            'receitasC' => $receitasC
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $receitas = Receita::all()->where('author', '=', $user->id); //retorna todas as receitas desse user

        if(Auth::user()) { //se o usuario estiver logado faça isso
            $colegas = Colega::all()->where('seguidor', '=', Auth::user()->id); //a amizade entre os dois, se tiver
            return view('auth/showUser', [
                'user' => $user,
                'receitas' => $receitas,
                'colegas' => $colegas
            ]);
        }else {
            return view('auth/showUser', [
                'user' => $user,
                'receitas' => $receitas
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  AuthUser::where('id', '=', $id)->first();
        //dd($user);
        return view('auth.editUser', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,Request $request)
    {
        $user->name = $request->nome;
        $user->descricao = $request->descricao;
        $user->sexo = $request->sexo;
        $user->dt_nasc = $request->dt_nasc;

        if($request->foto != null) {
            $file = $request->foto;
            $user->foto = $file->store('user/');
        }

        $user->save();

        return redirect()->route('Perfil');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSenha(User $user, Request $request)
    {
        //faz a verificação se a senha atual é igual a sua do input
        if ( Hash::check($request->senhaAtual, $user->password) ) {
            // verifica se a senha nova foi confirmada corretamente
            if ( $request->senhaNova == $request->senhaNovaConfirmacao ) {
                // coloca a nova senha criptografada no lugar da atual e salva no BD
                $user->password = Hash::make($request->senhaNova);
                //$user->save();
            }    
        }
        return redirect()->route('Perfil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  AuthUser::where('id', '=', $id)->first();
        
        $user->delete();
        return redirect()->route('welcome');
    }
}

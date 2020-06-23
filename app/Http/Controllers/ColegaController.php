<?php

namespace App\Http\Controllers;

use App\Colega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->id != $request->seguido) { 
            $colega = new Colega();

            $colega->seguido = $request->seguido;
            $colega->seguidor = Auth::user()->id;
            $colega->save();

            return redirect()->route('Perfil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Colega  $colega
     * @return \Illuminate\Http\Response
     */
    public function show(Colega $colega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Colega  $colega
     * @return \Illuminate\Http\Response
     */
    public function edit(Colega $colega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colega  $colega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colega $colega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colega  $colega
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colega $colega)
    {
        $colega->delete();

        return redirect()->route('Perfil');
    }
}
